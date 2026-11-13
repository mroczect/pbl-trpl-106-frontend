<?php

declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    fwrite(STDERR, "CLI only.\n");
    exit(1);
}

$autoload = __DIR__ . '/../vendor/autoload.php';
if (!is_file($autoload)) {
    fwrite(STDERR, "ERROR: vendor/ tidak ada. Jalankan `composer install` dulu.\n");
    exit(1);
}
require $autoload;

use MatthiasMullie\Minify;

$root    = dirname(__DIR__);
$srcDir  = $root . '/src';
$distDir = $root . '/dist';

if (!is_dir($srcDir)) {
    fwrite(STDERR, "ERROR: Jalankan dari root repo (src/ tidak ditemukan).\n");
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
    foreach ($it as $f) {
        $f->isDir() ? rmdir($f->getPathname()) : unlink($f->getPathname());
    }
    rmdir($dir);
}

if (is_dir($distDir)) {
    rmrf($distDir);
}
mkdir($distDir, 0755, true);

$stats = ['php' => 0, 'css' => 0, 'js' => 0, 'copy' => 0];

$it = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($srcDir, FilesystemIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($it as $path) {
    $rel = substr($path->getPathname(), strlen($srcDir) + 1);
    $dst = $distDir . '/' . str_replace('\\', '/', $rel);

    if ($path->isDir()) {
        if (!is_dir($dst)) {
            mkdir($dst, 0755, true);
        }
        continue;
    }

    $dirname = dirname($dst);
    if (!is_dir($dirname)) {
        mkdir($dirname, 0755, true);
    }

    $isVendor = str_starts_with($rel, 'assets/vendor/');
    $isAsset  = (bool) preg_match('/\.(png|jpe?g|gif|svg|ico|webp|woff2?|ttf|otf|eot)$/i', $rel);

    if ($isVendor || $isAsset) {
        copy($path->getPathname(), $dst);
        $stats['copy']++;
        continue;
    }

    if (str_ends_with($rel, '.php')) {
        file_put_contents($dst, php_strip_whitespace($path->getPathname()));
        $stats['php']++;
        continue;
    }

    if (str_ends_with($rel, '.css')) {
        (new Minify\CSS($path->getPathname()))->minify($dst);
        $stats['css']++;
        continue;
    }

    if (str_ends_with($rel, '.js')) {
        (new Minify\JS($path->getPathname()))->minify($dst);
        $stats['js']++;
        continue;
    }

    copy($path->getPathname(), $dst);
    $stats['copy']++;
}

echo "✓ dist/ built\n";
echo "  PHP   : {$stats['php']} file\n";
echo "  CSS   : {$stats['css']} file\n";
echo "  JS    : {$stats['js']} file\n";
echo "  Copy  : {$stats['copy']} file\n";
echo "  Output: {$distDir}\n";
