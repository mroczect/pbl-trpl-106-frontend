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

$layout = $routes[$page]['layout'];
$is_dashboard = in_array($layout, ['customer', 'agent', 'admin']);
$file = __DIR__ . '/pages/' . $routes[$page]['file'];

if ($layout !== 'blank') {
    include __DIR__ . '/components/head.php';
    include __DIR__ . '/components/navbar.php';

    if ($is_dashboard) {
        echo '<div class="dashboard-wrapper">';
        echo '<div class="sidebar-container">';
        include __DIR__ . "/components/sidebar-{$layout}.php";
        echo '</div>';
        echo '<div class="window content-container">';
        echo '<div class="content-body">';
    } else {
        echo '<div style="padding: 15px; min-height: calc(100vh - 80px); display: flex; align-items: center; justify-content: center;">';
    }
}

if (file_exists($file)) {
    include $file;
} else {
    echo '<p>File halaman tidak ditemukan.</p>';
}

if ($layout !== 'blank') {
    if ($is_dashboard) {
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '</div>';
    }
    include __DIR__ . '/components/footer.php';
}
?>
