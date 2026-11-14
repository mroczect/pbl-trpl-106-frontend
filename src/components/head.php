<?php
$pageTitle ??= 'Galonku';
$fullTitle = $pageTitle === 'Galonku' ? 'Galonku' : $pageTitle . ' - Galonku';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi Pengelolaan Depot Air Minum Isi Ulang">
    <title><?= htmlspecialchars($fullTitle, ENT_QUOTES, 'UTF-8') ?></title>

    <link rel="icon" href="/assets/images/favicon.png" type="image/png" sizes="32x32">
    <link rel="apple-touch-icon" href="/assets/images/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="theme-color" content="#002B58">

    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="/assets/js/main.js" defer></script>
</head>
<body>
<a class="skip-link" href="#main-content">Lewati ke konten utama</a>
