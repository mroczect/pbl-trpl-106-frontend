<div class="title-bar" style="padding: 3px;">
    <div class="title-bar-text">Galonku</div>
    <div class="title-bar-controls" style="display: flex; gap: 5px;">
        <?php if (isset($layout) && $layout === 'public'): ?>
            <button onclick="window.location.href='/index.php?page=auth/login'">Masuk</button>
            <button onclick="window.location.href='/index.php?page=auth/register-user'">Daftar</button>
        <?php elseif (isset($layout) && in_array($layout, ['customer', 'agent', 'admin'])): ?>
            <button onclick="window.location.href='/index.php?page=auth/logout'">Logout</button>
        <?php endif; ?>
    </div>
</div>
