<?php
declare(strict_types=1);

function galonku_build_info(): array
{
    static $cache = null;
    if ($cache !== null) {
        return $cache;
    }

    $defaults = [
        'hash'      => 'dev',
        'branch'    => 'dev',
        'timestamp' => null,
        'dirty'     => false,
    ];

    $buildFile = dirname(__DIR__) . '/build-info.php';
    if (is_file($buildFile)) {
        $info = require $buildFile;
        if (is_array($info)) {
            return $cache = $info + $defaults;
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

    return $cache = [
        'hash'      => $hCode === 0 && $hash !== '' ? $hash : 'dev',
        'branch'    => $branch !== '' ? $branch : 'dev',
        'timestamp' => null,
        'dirty'     => $status !== '',
    ];
}

function galonku_version_string(): string
{
    $info = galonku_build_info();
    $v = $info['hash'] ?? 'dev';
    if (!empty($info['dirty'])) {
        $v .= '-dirty';
    }
    return $v;
}

function galonku_version_title(): string
{
    $info = galonku_build_info();
    $parts = [];
    if (!empty($info['branch'])) {
        $parts[] = 'branch: ' . $info['branch'];
    }
    if (!empty($info['timestamp'])) {
        $parts[] = 'built: ' . $info['timestamp'];
    }
    if (!empty($info['dirty'])) {
        $parts[] = 'uncommitted changes';
    }
    return $parts ? implode(' · ', $parts) : 'development build';
}

function galonku_run_git(string $args, string $cwd): array
{
    $desc = [1 => ['pipe', 'w'], 2 => ['pipe', 'w']];
    $proc = @proc_open('git ' . $args, $desc, $pipes, $cwd);
    if (!is_resource($proc)) {
        return ['', 1];
    }
    $stdout = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $code = proc_close($proc);
    return [trim((string) $stdout), $code];
}
