<?php

declare(strict_types=1);

/**
 * Build metadata resolution.
 *
 * This module answers a single question: which build is currently serving
 * the request. It does so without touching the source tree at deploy
 * time, without a database, and without crashing when the environment is
 * incomplete.
 *
 * Resolution proceeds from cheapest to most expensive source:
 *
 *   1. build-info.php — static artefact produced by `make build`. One
 *      file read, used in production. Values are frozen at build time,
 *      making the answer stable and deterministic across requests.
 *   2. git CLI — invoked only when the build artefact is absent, which
 *      is the development case. Values reflect the live working tree.
 *   3. defaults — the final safety net. Guarantees a complete return
 *      structure even when no data source is available.
 *
 * Module contract: **no function here may throw.** The application
 * footer renders the output of this module on every request; a single
 * uncaught exception would break the entire page. All failures are
 * swallowed and returned as a valid fallback value.
 */

/**
 * Build metadata for the current request.
 *
 * The result is cached at function scope via a static variable. Rationale:
 * within one request, the footer calls both `galonku_version_string()`
 * and `galonku_version_title()`, and both call this function. Without the
 * cache, the `git` CLI would execute twice per request in development.
 * With the cache, `git` executes at most once, and zero times when
 * `build-info.php` exists.
 *
 * The `timestamp` field is intentionally `null` when the source is git.
 * Build time is not available from a working tree, and fabricating the
 * current time would be misleading. Only `build.php` populates this
 * field, because it is the sole point that genuinely knows when the
 * build ran.
 *
 * The `dirty` field signals that the working tree had uncommitted
 * changes at the moment the data was captured. In production (source:
 * build-info.php) this value is frozen at `make build`, meaning the
 * artefact was produced from a dirty tree. In development (source: git)
 * the value is recomputed every request.
 *
 * @return array{
 *     hash: string,
 *     branch: string,
 *     timestamp: string|null,
 *     dirty: bool
 * }
 */
function galonku_build_info(): array
{
    /** @var array{hash: string, branch: string, timestamp: string|null, dirty: bool}|null $cache */
    static $cache = null;

    if ($cache !== null) {
        return $cache;
    }

    /** @var array{hash: string, branch: string, timestamp: string|null, dirty: bool} $defaults */
    $defaults = [
        'hash'      => 'dev',
        'branch'    => 'dev',
        'timestamp' => null,
        'dirty'     => false,
    ];

    /** @var non-falsy-string $buildFile */
    $buildFile = dirname(__DIR__) . '/build-info.php';

    if (is_file($buildFile)) {
        try {
            /** @var mixed $info */
            $info = require $buildFile;

            if (is_array($info)) {
                /**
                 * `+` keeps keys from the left operand and fills the rest
                 * from the right. This guarantees the return shape stays
                 * identical to the declared type even when an older or
                 * partially written build-info.php omits a field. Using
                 * array_merge would let an incomplete file override
                 * defaults with null-ish values, breaking the contract.
                 *
                 * @var array{hash: string, branch: string, timestamp: string|null, dirty: bool} $merged
                 */
                $merged = $info + $defaults;

                return $cache = $merged;
            }
        } catch (\Throwable $e) {
            /**
             * A corrupt or half-written build-info.php must not surface
             * to the user. The exception is deliberately not re-thrown;
             * execution falls through to git, then to defaults. This is
             * the only case where a Throwable is caught without action
             * being taken, and it is intentional: the footer is a
             * non-critical UI element that must never break the page.
             */
        }
    }
    $dir = __DIR__;

    while ($dir !== dirname($dir) && !is_dir($dir . '/.git')) {
        $dir = dirname($dir);
    }

    if (!is_dir($dir . '/.git')) {
        return $cache = $defaults;
    }

    [$hash, $hCode] = galonku_run_git('rev-parse --short HEAD', $dir);
    [$branch]       = galonku_run_git('rev-parse --abbrev-ref HEAD', $dir);
    [$status]       = galonku_run_git('status --porcelain', $dir);

    /**
     * Exit code is checked only for the hash query. If `rev-parse` fails,
     * HEAD is unborn (fresh repo, no commits yet) or git is not usable,
     * and the hash string would be meaningless. The branch and status
     * queries degrade gracefully to empty strings, which the ternary
     * below converts to the 'dev' sentinel.
     */
    return $cache = [
        'hash'      => $hCode === 0 && $hash !== '' ? $hash : 'dev',
        'branch'    => $branch !== '' ? $branch : 'dev',
        'timestamp' => null,
        'dirty'     => $status !== '',
    ];
}

/**
 * Short version string suitable for user-facing display.
 *
 * Produces the compact form rendered in the footer status bar:
 * `<short-hash>` or `<short-hash>-dirty`. The `-dirty` suffix is appended
 * only when uncommitted changes existed at capture time, mirroring the
 * convention used by `git describe --dirty`.
 *
 * @return string
 */
function galonku_version_string(): string
{
    $info = galonku_build_info();
    $v = $info['hash'];

    if ($info['dirty']) {
        $v .= '-dirty';
    }

    return $v;
}

/**
 * Human-readable summary of build provenance.
 *
 * Rendered as the `title` attribute of the footer version field, so a
 * hover reveals branch, build time, and dirtiness without occupying
 * screen space. Components are joined with a middle dot (U+00B7) rather
 * than a comma or pipe, because the string is short and the separator
 * should not visually compete with the values.
 *
 * When every component is absent — which is the default fallback state —
 * the function returns a fixed phrase rather than an empty string, so
 * the tooltip never renders as a blank box.
 *
 * @return string
 */
function galonku_version_title(): string
{
    $info = galonku_build_info();

    /** @var list<string> $parts */
    $parts = [];

    if ($info['branch'] !== '' && $info['branch'] !== 'dev') {
        $parts[] = 'branch: ' . $info['branch'];
    }

    if ($info['timestamp'] !== null && $info['timestamp'] !== '') {
        $parts[] = 'built: ' . $info['timestamp'];
    }

    if ($info['dirty']) {
        $parts[] = 'uncommitted changes';
    }

    return $parts !== []
        ? implode(' · ', $parts)
        : 'development build';
}

/**
 * Execute a git subcommand and capture its stdout and exit code.
 *
 * Wraps `proc_open` to give the caller a plain tuple without worrying
 * about descriptor spec, pipe handling, or process cleanup. Stderr is
 * consumed and discarded; git writes warnings there routinely, and the
 * footer has no channel for surfacing them. The `@` on `proc_open`
 * suppresses the PHP warning emitted when the `git` binary is missing
 * from PATH, which is a legitimate environment, not an error condition.
 *
 * Returns `['', 1]` on process creation failure. Callers treat exit code
 * `1` identically to a git command that ran but failed, which is the
 * desired behaviour: both mean "no usable output".
 *
 * @return array{0: string, 1: int}
 */
function galonku_run_git(string $args, string $cwd): array
{
    /** @var array<int, array{0: string, 1: string}> $desc */
    $desc = [1 => ['pipe', 'w'], 2 => ['pipe', 'w']];

    /**
     * Pre-initialised to an empty array so the variable is defined before
     * being passed by reference to `proc_open`. PHP would create it on the
     * fly, but static analysers cannot infer the type of a variable that
     * only ever gets written through a by-reference parameter.
     *
     * @var array<int, resource> $pipes
     */
    $pipes = [];

    /** @var resource|false $proc */
    $proc = @proc_open('git ' . $args, $desc, $pipes, $cwd);

    /**
     * Both conditions are checked against concrete keys rather than the
     * array itself. `proc_open` populates only the descriptors specified
     * in `$desc`; if for any reason one key is absent, `stream_get_contents`
     * below would receive `null` instead of a resource and crash.
     */
    if (!is_resource($proc) || !isset($pipes[1], $pipes[2])) {
        return ['', 1];
    }

    /** @var string|false $stdout */
    $stdout = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    fclose($pipes[2]);

    /** @var int $code */
    $code = proc_close($proc);

    return [trim((string) $stdout), $code];
}
