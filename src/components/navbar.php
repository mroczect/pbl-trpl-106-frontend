<?php
$layout ??= 'public';
$isDashboard = in_array($layout, ['customer', 'agent', 'admin'], true);

$roleLabels = [
    'customer' => 'Konsumen',
    'agent'    => 'Agent Depot',
    'admin'    => 'Admin',
];
$roleLabel = $roleLabels[$layout] ?? 'Portal';
?>
<header class="title-bar app-title-bar">
	<div class="title-bar-text">
    Galonku<?= $layout === 'public' ? '' : ' &mdash; ' . htmlspecialchars($roleLabel, ENT_QUOTES, 'UTF-8') ?>
	</div>
    <nav class="app-title-bar-nav" aria-label="Navigasi akun">
        <?php if ($layout === 'public'): ?>
            <a class="button" href="/index.php?page=auth/login">Masuk</a>
            <a class="button" href="/index.php?page=auth/register-user">Daftar</a>
        <?php elseif ($isDashboard): ?>
            <a class="button" href="/index.php?page=auth/logout">Logout</a>
        <?php endif; ?>
    </nav>
</header>
