<?php
$currentPage = $_GET['page'] ?? '';
$items = [
    ['admin/dashboard', 'Dashboard'],
    ['admin/customers', 'Data Konsumen'],
    ['admin/agents',    'Data Agent'],
];
?>
<aside class="app-sidebar" aria-label="Menu Admin">
    <ul class="tree-view">
        <?php foreach ($items as [$page, $label]): ?>
            <?php $active = $currentPage === $page; ?>
            <li>
                <a href="/index.php?page=<?= htmlspecialchars($page, ENT_QUOTES, 'UTF-8') ?>"
                   <?= $active ? 'aria-current="page"' : '' ?>>
                    <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</aside>
