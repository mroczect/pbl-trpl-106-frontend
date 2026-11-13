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
    <title><?= htmlspecialchars($fullTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="https://unpkg.com/98.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<a class="skip-link" href="#main-content">Lewati ke konten utama</a>
