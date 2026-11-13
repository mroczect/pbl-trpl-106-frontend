<?php

$routes = [
    'home' => ['file' => 'home.php', 'layout' => 'public'],
    '404' => ['file' => '404.php', 'layout' => 'public'],
    'auth/login' => ['file' => 'auth/login.php', 'layout' => 'public'],
    'auth/register-user' => ['file' => 'auth/register-user.php', 'layout' => 'public'],
    'auth/register-agent' => ['file' => 'auth/register-agent.php', 'layout' => 'public'],
    'auth/logout' => ['file' => 'auth/logout.php', 'layout' => 'blank'],

    'customer/dashboard' => ['file' => 'customer/dashboard.php', 'layout' => 'customer'],
    'customer/profile' => ['file' => 'customer/profile.php', 'layout' => 'customer'],
    'customer/products' => ['file' => 'customer/products.php', 'layout' => 'customer'],
    'customer/cart' => ['file' => 'customer/cart.php', 'layout' => 'customer'],
    'customer/checkout' => ['file' => 'customer/checkout.php', 'layout' => 'customer'],
    'customer/orders' => ['file' => 'customer/orders.php', 'layout' => 'customer'],
    'customer/history' => ['file' => 'customer/history.php', 'layout' => 'customer'],
    'customer/invoice' => ['file' => 'customer/invoice.php', 'layout' => 'customer'],
    'customer/contact-agent' => ['file' => 'customer/contact-agent.php', 'layout' => 'customer'],
    'customer/reminder' => ['file' => 'customer/reminder.php', 'layout' => 'customer'],

    'agent/dashboard' => ['file' => 'agent/dashboard.php', 'layout' => 'agent'],
    'agent/orders' => ['file' => 'agent/orders.php', 'layout' => 'agent'],
    'agent/products' => ['file' => 'agent/products.php', 'layout' => 'agent'],
    'agent/stock' => ['file' => 'agent/stock.php', 'layout' => 'agent'],
    'agent/profile-depot' => ['file' => 'agent/profile-depot.php', 'layout' => 'agent'],

    'admin/dashboard' => ['file' => 'admin/dashboard.php', 'layout' => 'admin'],
    'admin/customers' => ['file' => 'admin/customers.php', 'layout' => 'admin'],
    'admin/agents' => ['file' => 'admin/agents.php', 'layout' => 'admin'],
];

$page = $_GET['page'] ?? 'home';

if (!isset($routes[$page])) {
    http_response_code(404);
    $page = '404';
}

$layout      = $routes[$page]['layout'];
$isDashboard = in_array($layout, ['customer', 'agent', 'admin'], true);
$file        = __DIR__ . '/pages/' . $routes[$page]['file'];

$pageTitles = [
    'home' => 'Galonku',
    '404' => 'Halaman Tidak Ditemukan',
    'auth/login' => 'Masuk',
    'auth/register-user' => 'Daftar Konsumen',
    'auth/register-agent' => 'Daftar Agent Depot',
    'customer/dashboard' => 'Dashboard Konsumen',
    'customer/profile' => 'Profil',
    'customer/products' => 'Katalog Produk',
    'customer/cart' => 'Keranjang',
    'customer/checkout' => 'Konfirmasi Pesanan',
    'customer/orders' => 'Pesanan Saya',
    'customer/history' => 'Riwayat Pesanan',
    'customer/invoice' => 'Invoice',
    'customer/contact-agent' => 'Hubungi Agent',
    'customer/reminder' => 'Reminder',
    'agent/dashboard' => 'Dashboard Agent',
    'agent/orders' => 'Pesanan Masuk',
    'agent/products' => 'Kelola Produk',
    'agent/stock' => 'Kelola Stok',
    'agent/profile-depot' => 'Profil Depot',
    'admin/dashboard' => 'Dashboard Admin',
    'admin/customers' => 'Data Konsumen',
    'admin/agents' => 'Data Agent',
];
$pageTitle = $pageTitles[$page] ?? 'Galonku';

$centeredPages = ['home', '404', 'auth/login', 'auth/register-user', 'auth/register-agent'];
$isCentered    = in_array($page, $centeredPages, true);


if ($layout === 'blank') {
    if (file_exists($file)) {
        include $file;
    }
    exit;
}

include __DIR__ . '/components/head.php';
include __DIR__ . '/components/navbar.php';

if ($isDashboard) {
    echo '<div class="app-layout">';
    include __DIR__ . "/components/sidebar-{$layout}.php";
    echo '<main id="main-content" class="app-main">';
    echo '<div class="app-main-inner">';

    echo file_exists($file) ? '' : '<p>Halaman tidak ditemukan.</p>';
    if (file_exists($file)) {
        include $file;
    }

    echo '</div></main>';
    echo '</div>';
} else {
    $mainClass = 'app-main' . ($isCentered ? ' app-main--centered' : '');
    echo '<main id="main-content" class="' . $mainClass . '">';
    echo '<div class="app-main-inner">';

    echo file_exists($file) ? '' : '<p>Halaman tidak ditemukan.</p>';
    if (file_exists($file)) {
        include $file;
    }

    echo '</div></main>';
}

include __DIR__ . '/components/footer.php';
