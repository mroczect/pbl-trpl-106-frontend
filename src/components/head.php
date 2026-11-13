<?php
$pageTitle = $pageTitle ?? 'Galonku';
$fullTitle = $pageTitle === 'Galonku' ? 'Galonku' : $pageTitle . ' - Galonku';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi Pengelolaan Depot Air Minum Isi Ulang">
    <meta name="theme-color" content="#008080">
    <title><?= htmlspecialchars($fullTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="preconnect" href="https://unpkg.com" crossorigin>
    <link rel="stylesheet" href="https://unpkg.com/98.css@0.1.20/dist/98.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'><text y='14' font-size='14'>💧</text></svg>">
    <script src="/assets/js/sidebar.js" defer></script>
    <script src="/assets/js/perf-overlay.js" defer></script>
</head>
<body>
<a class="skip-link" href="#main-content">Lewati ke konten utama</a>
