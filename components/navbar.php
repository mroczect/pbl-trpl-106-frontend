<?php
$layout ??= 'public'; $isDashboard = in_array($layout, ['customer', 'agent', 'admin'], true); $roleLabels = [ 'customer' => 'Konsumen', 'agent' => 'Agent Depot', 'admin' => 'Admin', ]; $roleLabel = $roleLabels[$layout] ?? 'Portal'; ?>
<header class="title-bar app-title-bar">
    <a class="app-title-bar-brand" href="/index.php?page=home">
        Galonku<?php if ($layout !== 'public'): ?> <span class="app-title-bar-role">&mdash; <?= htmlspecialchars($roleLabel, ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
    </a>

    <nav class="app-title-bar-nav" aria-label="Navigasi akun">
        <?php if ($layout === 'public'): ?>
            <a class="button" href="/index.php?page=auth/login">Masuk</a>
            <a class="button" href="/index.php?page=auth/register-user">Daftar</a>
        <?php elseif ($isDashboard): ?>
            <a class="button" href="/index.php?page=auth/logout">Keluar</a>
        <?php endif; ?>
    </nav>
</header>
