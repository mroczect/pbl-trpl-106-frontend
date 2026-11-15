<?php
require_once __DIR__ . '/../../lib/api.php';
require_once __DIR__ . '/../../lib/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payload = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'address' => $_POST['address'] ?? '',
        'gmaps_url' => $_POST['gmaps_url'] ?? ''
    ];

    $res = api_request('POST', '/auth/register', $payload);

    if ($res['status'] === 200 || $res['status'] === 201) {
        set_auth_session($res['body']['token'], $res['body']['user']);
        header('Location: /index.php?page=customer/dashboard');
        exit;
    } else {
        $error = $res['body']['error']['message'] ?? 'Registration failed.';
    }
}
?>

<div class="window">
    <div class="title-bar">
        <div class="title-bar-text">Daftar Konsumen</div>
    </div>
    <div class="window-body">
        <?php if ($error): ?>
            <div class="notification" style="background-color: #ffebee; border-color: #ef9a9a; color: #c62828;">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="field-row-stacked">
                <label for="name">Nama Lengkap</label>
                <input id="name" type="text" name="name" required>
            </div>
            <div class="field-row-stacked mt-3">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required>
            </div>
            <div class="field-row-stacked mt-3">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>

            <!-- name="phone" (Sesuai DTO) -->
            <div class="field-row-stacked mt-3">
                <label for="phone">No. HP</label>
                <input id="phone" type="tel" name="phone" required>
            </div>

            <!-- name="address" (Sesuai DTO) -->
            <div class="field-row-stacked mt-3">
                <label for="address">Alamat Lengkap</label>
                <textarea id="address" name="address" rows="3" required></textarea>
            </div>
            <div class="field-row-stacked mt-3">
                <label for="gmaps_url">Link Google Maps (Shareloc)</label>
                <input id="gmaps_url" type="url" name="gmaps_url" placeholder="https://maps.app.goo.gl/..." required>
            </div>

            <div class="form-actions split">
                <a class="btn btn-ghost" href="/index.php?page=home">Batal</a>
                <button type="submit">Daftar</button>
            </div>
        </form>
    </div>
</div>
