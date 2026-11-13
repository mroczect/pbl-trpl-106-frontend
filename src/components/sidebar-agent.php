<?php
$currentPage = $_GET['page'] ?? '';
$items = [
	['agent/dashboard', 'Dashboard'],
	['agent/orders',    'Pesanan'],
	['agent/products',  'Produk'],
	['agent/stock',     'Stok'],
	['agent/profile-depot', 'Profil Depot'],
];
?>
<aside class="app-sidebar" aria-label="Menu Agent">
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
