<?php

declare(strict_types=1);

use MatthiasMullie\Minify;

if (PHP_SAPI !== 'cli') {
    fwrite(STDERR, "CLI only.\n");
    exit(1);
}

$autoload = __DIR__ . '/../vendor/autoload.php';

if (!is_file($autoload) || !is_readable($autoload)) {
    fwrite(STDERR, "vendor/autoload.php is missing. Run `composer install` first.\n");
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

function fail(string $message): never
{
    fwrite(STDERR, $message . "\n");
    exit(1);
}

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
    $rel      = str_replace('\\', '/', substr($pathname, strlen($srcDir) + 1));

    if ($rel === '') {
        continue;
    }

    $dst = $distDir . '/' . $rel;

    if ($path->isDir()) {
        ensure_dir($dst);
        continue;
    }

    ensure_dir(dirname($dst));

    $isVendor = str_starts_with($rel, 'assets/vendor/');
    $isBinary = (bool) preg_match('/\.(png|jpe?g|gif|svg|ico|webp|woff2?|ttf|otf|eot)$/i', $rel);

    if ($isVendor || $isBinary) {
        if (!copy($pathname, $dst)) {
            fail("Failed to copy {$pathname} -> {$dst}");
        }
        $stats['copy']++;
        continue;
    }

    if (str_ends_with($rel, '.php')) {
        $stripped = php_strip_whitespace($pathname);

        if ($stripped === '') {
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

    if (!copy($pathname, $dst)) {
        fail("Failed to copy {$pathname} -> {$dst}");
    }
    $stats['copy']++;
}

echo "[OK] dist/ built\n";
echo "  PHP   : {$stats['php']} file\n";
echo "  CSS   : {$stats['css']} file\n";
echo "  JS    : {$stats['js']} file\n";
echo "  Copy  : {$stats['copy']} file\n";
echo "  Output: {$distDir}\n";
