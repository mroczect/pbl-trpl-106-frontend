<nav class="w3-bar w3-white">
    <a href="/index.php?page=home" class="w3-bar-item">Galonku</a>

    <?php if (isset($layout) && $layout === 'public'): ?>
        <a href="/index.php?page=auth/login" class="w3-bar-item">Masuk</a>
        <a href="/index.php?page=auth/register-user" class="w3-bar-item">Daftar</a>

    <?php elseif (isset($layout) && in_array($layout, ['customer', 'agent', 'admin'])): ?>
        <a href="/index.php?page=auth/logout" class="w3-bar-item w3-right w3-text-red">Logout</a>
    <?php endif; ?>
</nav>
