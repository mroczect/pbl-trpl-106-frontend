<div class="title-bar" style="padding: 3px; margin-bottom: 10px;">
    <div class="title-bar-text">GALONKU System</div>
    <div class="title-bar-controls" style="display: flex; gap: 5px;">
        <?php if (isset($layout) && $layout === 'public'): ?>
            <button onclick="window.location.href='/index.php?page=auth/login'">Login</button>
            <button onclick="window.location.href='/index.php?page=auth/register-user'">Register</button>
        <?php elseif (isset($layout) && in_array($layout, ['customer', 'agent', 'admin'])): ?>
            <span style="font-size: 11px; align-self: center; color: #fff; margin-right: 10px;">Role: <?= ucfirst($layout) ?></span>
            <button onclick="window.location.href='/index.php?page=auth/logout'">Logout</button>
        <?php endif; ?>
    </div>
</div>
