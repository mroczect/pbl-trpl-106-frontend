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

    'agent/dashboard' => ['file' => 'agent/dashboard.php', 'layout' => 'agent'],

    'admin/dashboard' => ['file' => 'admin/dashboard.php', 'layout' => 'admin'],
    'admin/customers' => ['file' => 'admin/customers.php', 'layout' => 'admin'],
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
        include __DIR__ . "/components/sidebar-{$layout}.php";
        echo '<div class="dashboard-content">';
    } else {
        echo '<div class="public-wrapper">';
    }
}

if (file_exists($file)) {
    include $file;
} else {
    echo '<h1>404</h1>';
}

if ($layout !== 'blank') {
    echo '</div>';
    if ($is_dashboard) {
        echo '</div>';
    }
    include __DIR__ . '/components/footer.php';
}
