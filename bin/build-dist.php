<?php

declare(strict_types=1);

use MatthiasMullie\Minify;

/**
 * Production asset builder.
 *
 * Reads `src/` and writes a parallel tree into `dist/` with assets
 * reduced to their smallest functionally-equivalent form. The output
 * directory is not a source of truth; it is discarded and rebuilt on
 * every run, so partial state from a failed build never accumulates
 * across invocations.
 *
 * Building into a separate tree rather than minifying in place keeps
 * `src/` readable for `make serve` and reviewable in diffs. `dist/` is
 * gitignored for the same reason: minified output has no review value.
 *
 * The script is standalone. It is invoked by `make dist` and never
 * required by the application, so helper functions are declared in the
 * global scope without a namespace. If that assumption changes, move
 * them into a class under `bin/lib/`.
 *
 * Failure model: the first unrecoverable error aborts the process.
 * A half-built `dist/` is worse than none at all — it looks complete
 * but serves stale content mixed with new. Because `make dist` deletes
 * the directory at the start of every run, an aborted build is
 * recovered by the next invocation without manual cleanup.
 */

if (PHP_SAPI !== 'cli') {
    fwrite(STDERR, "CLI only.\n");
    exit(1);
}

$autoload = __DIR__ . '/../vendor/autoload.php';

if (!is_file($autoload) || !is_readable($autoload)) {
    fwrite(STDERR, "vendor/autoload.php is missing or unreadable. Run `composer install` first.\n");
    exit(1);
}

require $autoload;

$root    = dirname(__DIR__);
$srcDir  = $root . '/src';
$distDir = $root . '/dist';

if (!is_dir($srcDir)) {
    fwrite(STDERR, "src/ not found. Run from the repository root.\n");
    exit(1);
}

/**
 * Abort with a diagnostic on STDERR.
 *
 * The `never` return type matters in the callers below: after a failed
 * `copy` the function returns control, and the stats increment that
 * follows must not run. `never` makes that guarantee explicit to both
 * the reader and static analysis, so a later refactor cannot
 * accidentally wrap the call in a conditional.
 */
function fail(string $message): never
{
    fwrite(STDERR, $message . "\n");
    exit(1);
}

/**
 * Recursively delete a directory and its contents.
 *
 * Reimplemented here rather than pulled from a dependency because this
 * is the only call site in the codebase. `symfony/filesystem` would add
 * a transitive dependency for a single helper, and the PHP standard
 * library has no recursive delete. The traversal is post-order
 * (CHILD_FIRST) so directory removal never races against its own
 * children.
 *
 * Removal failures abort rather than warn. A half-removed `dist/` would
 * be silently mixed with new output, producing a build whose provenance
 * cannot be trusted.
 */
function rmrf(string $dir): void
{
    if (!is_dir($dir)) {
        return;
    }

    $it = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );

    foreach ($it as $entry) {
        $pathname = $entry->getPathname();
        $removed  = $entry->isDir() ? @rmdir($pathname) : @unlink($pathname);

        if (!$removed) {
            fail("Failed to remove: {$pathname}");
        }
    }

    if (!@rmdir($dir)) {
        fail("Failed to remove directory: {$dir}");
    }
}

/**
 * Create a directory recursively, idempotently.
 *
 * The `is_dir` guard is not redundant with the `$recursive = true`
 * flag: `mkdir` still emits an `E_WARNING` when the target exists,
 * which pollutes build logs on reruns. The extra `stat` call per
 * directory is negligible compared to the file operations that follow.
 */
function ensure_dir(string $dir): void
{
    if (is_dir($dir)) {
        return;
    }

    if (!mkdir($dir, 0755, true) && !is_dir($dir)) {
        fail("Failed to create directory: {$dir}");
    }
}

if (is_dir($distDir)) {
    rmrf($distDir);
}

ensure_dir($distDir);

/** @var array{php: int, css: int, js: int, copy: int} $stats */
$stats = ['php' => 0, 'css' => 0, 'js' => 0, 'copy' => 0];

$it = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($srcDir, FilesystemIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($it as $path) {
    $pathname = $path->getPathname();

    // Slashes are normalised here, before any prefix comparison, not
    // later at the destination. PHP on Windows produces backslashed
    // paths; the `str_starts_with` guard below would then fail to
    // recognise `assets\vendor\98.css` as vendored and send it through
    // the CSS minifier. The resulting bytes would diverge from the
    // SRI hash in `head.php` and the browser would reject the
    // stylesheet on every Windows machine in the team.
    $rel = str_replace('\\', '/', substr($pathname, strlen($srcDir) + 1));

    if ($rel === '') {
        continue;
    }

    $dst = $distDir . '/' . $rel;

    if ($path->isDir()) {
        ensure_dir($dst);
        continue;
    }

    ensure_dir(dirname($dst));

    // Vendored CSS is copied byte-for-byte, never transformed. The
    // `integrity` attribute on the stylesheet link in `head.php` was
    // computed against the exact bytes under `assets/vendor/`;
    // minifying changes them and the browser refuses to apply the
    // sheet. This is not an optimisation opportunity — it is a
    // correctness constraint.
    //
    // Binary assets take the same path for a different reason: no
    // minifier in this pipeline processes images or fonts, and
    // passing them through `php_strip_whitespace` or `Minify\CSS`
    // would corrupt the bytes outright.
    $isVendor = str_starts_with($rel, 'assets/vendor/');
    $isBinary = (bool) preg_match('/\.(png|jpe?g|gif|svg|ico|webp|woff2?|ttf|otf|eot)$/i', $rel);

    if ($isVendor || $isBinary) {
        if (!copy($pathname, $dst)) {
            fail("Failed to copy {$pathname} -> {$dst}");
        }
        $stats['copy']++;
        continue;
    }

    // `php_strip_whitespace` is PHP-aware: it removes comments and
    // whitespace inside `<?php ?>` blocks while leaving the HTML
    // between them untouched. A generic text minifier would also
    // collapse literal HTML and break templates that depend on
    // meaningful whitespace (inline-block gaps in tables, preserved
    // line breaks in `<pre>` regions).
    if (str_ends_with($rel, '.php')) {
        $stripped = php_strip_whitespace($pathname);

        if ($stripped === false) {
            fail("Failed to strip whitespace from {$pathname}");
        }

        if (file_put_contents($dst, $stripped) === false) {
            fail("Failed to write {$dst}");
        }

        $stats['php']++;
        continue;
    }

    if (str_ends_with($rel, '.css')) {
        (new Minify\CSS($pathname))->minify($dst);
        $stats['css']++;
        continue;
    }

    if (str_ends_with($rel, '.js')) {
        (new Minify\JS($pathname))->minify($dst);
        $stats['js']++;
        continue;
    }

    // Everything else — `.json`, `.webmanifest`, `.map`, `.txt` — is
    // copied verbatim. JSON is tempting to minify but the gain is
    // trivial and a non-JSON-aware minifier can corrupt edge-case
    // strings. A manifest that fails to parse disables install; the
    // trade is not worth it.
    if (!copy($pathname, $dst)) {
        fail("Failed to copy {$pathname} -> {$dst}");
    }
    $stats['copy']++;
}

echo "dist/ built\n";
echo "  PHP   : {$stats['php']} file\n";
echo "  CSS   : {$stats['css']} file\n";
echo "  JS    : {$stats['js']} file\n";
echo "  Copy  : {$stats['copy']} file\n";
echo "  Output: {$distDir}\n";
