<?php
require_once __DIR__ . '/../lib/version.php';

$version = galonku_version_string();
$title   = galonku_version_title();
?>
<footer class="app-status-bar" role="contentinfo">
    <p class="status-bar-field">Galonku</p>
    <p class="status-bar-field">Aplikasi Pengelolaan Depot Air</p>
    <p class="status-bar-field" title="<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>">
        Build <?= htmlspecialchars($version, ENT_QUOTES, 'UTF-8') ?>
    </p>
</footer>
</body>
</html>
