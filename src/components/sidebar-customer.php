<?php
$currentPage = $_GET['page'] ?? '';
$items = [
    ['customer/dashboard',     'Dashboard'],
    ['customer/profile',       'Profil'],
    ['customer/products',      'Produk'],
    ['customer/cart',          'Keranjang'],
    ['customer/orders',        'Pesanan'],
    ['customer/history',       'Riwayat'],
    ['customer/reminder',      'Reminder'],
    ['customer/contact-agent', 'Hubungi Agent'],
];
?>
<aside class="app-sidebar" aria-label="Menu Konsumen">
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