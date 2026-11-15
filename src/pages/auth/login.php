<?php
require_once __DIR__ . '/../../lib/api.php';
require_once __DIR__ . '/../../lib/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $res = api_request('POST', '/auth/login', [
        'email' => $email,
        'password' => $password,
    ]);

    if ($res['status'] === 200) {
        set_auth_session($res['body']['token'], $res['body']['user']);

        $role = $res['body']['user']['role'];
        if ($role === 'admin') {
            header('Location: /index.php?page=admin/dashboard');
        } elseif ($role === 'agent') {
            header('Location: /index.php?page=agent/dashboard');
        } else {
            header('Location: /index.php?page=customer/dashboard');
        }
        exit;
    } else {
        $error = $res['body']['error']['message'] ?? 'Login gagal. Periksa email dan password.';
    }
}
?>

<div class="window">
    <div class="title-bar">
        <div class="title-bar-text">Masuk</div>
    </div>
    <div class="window-body">
        <?php if ($error): ?>
            <div class="notification" style="background-color: #ffebee; border-color: #ef9a9a; color: #c62828;">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="field-row-stacked mt-3">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required>
            </div>
            <div class="field-row-stacked mt-3">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>
            <div class="form-actions split">
                <a class="btn btn-ghost" href="/index.php?page=home">Batal</a>
                <button type="submit">Masuk</button>
            </div>
        </form>
    </div>
</div>
