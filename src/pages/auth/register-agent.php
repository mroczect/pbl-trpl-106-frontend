<?php
require_once __DIR__ . '/../../lib/api.php';
require_once __DIR__ . '/../../lib/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payload = [
        'pic_nama' => $_POST['pic_nama'] ?? '',
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? '',
        'nama_usaha' => $_POST['nama_usaha'] ?? '',
        'nib' => $_POST['nib'] ?? '',
        'npwp' => $_POST['npwp'] ?? '',
        'kapasitas' => (int)($_POST['kapasitas'] ?? 0),
        'armada' => (int)($_POST['armada'] ?? 0),
        'jam_ops' => $_POST['jam_ops'] ?? '',
        'shareloc' => $_POST['shareloc'] ?? '',
    ];

    $res = api_request('POST', '/auth/register-agent', $payload);

    if ($res['status'] === 200 || $res['status'] === 201) {
        set_auth_session($res['body']['token'], $res['body']['user']);
        header('Location: /index.php?page=agent/dashboard');
        exit;
    } else {
        $error = $res['body']['error']['message'] ?? 'Registration failed.';
    }
}
?>

<div class="window">
    <div class="title-bar">
        <div class="title-bar-text">Pendaftaran Mitra Depot</div>
    </div>
    <div class="window-body">

        <?php if ($error): ?>
            <div class="notification" style="background-color: #ffebee; border-color: #ef9a9a; color: #c62828;">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST">
            <fieldset>
                <legend>Legalitas Perusahaan</legend>
                <div class="field-row-stacked">
                    <label for="nama_usaha">Nama Badan Usaha / Depot</label>
                    <input id="nama_usaha" type="text" name="nama_usaha" required placeholder="PT. Air Jaya / Depot Makmur">
                </div>
                <div class="field-row-stacked mt-3">
                    <label for="nib">Nomor Induk Berusaha (NIB)</label>
                    <input id="nib" type="text" name="nib" required placeholder="1234567890">
                </div>
                <div class="field-row-stacked mt-3">
                    <label for="npwp">Nomor NPWP</label>
                    <input id="npwp" type="text" name="npwp" placeholder="00.000.000.0-000.000">
                </div>
            </fieldset>

            <fieldset class="mt-3">
                <legend>Kapasitas &amp; Operasional</legend>
                <div class="field-row-stacked">
                    <label for="kapasitas">Kapasitas Produksi Harian (Galon)</label>
                    <input id="kapasitas" type="number" name="kapasitas" required placeholder="500">
                </div>
                <div class="field-row-stacked mt-3">
                    <label for="armada">Jumlah Armada Pengantaran</label>
                    <input id="armada" type="number" name="armada" required placeholder="3">
                </div>
                <div class="field-row-stacked mt-3">
                    <label for="jam_ops">Jam Operasional</label>
                    <input id="jam_ops" type="text" name="jam_ops" required placeholder="08:00 - 20:00">
                </div>
            </fieldset>

            <fieldset class="mt-3">
                <legend>Akun Akses &amp; PIC</legend>
                <div class="field-row-stacked">
                    <label for="pic_nama">Nama Penanggung Jawab (PIC)</label>
                    <input id="pic_nama" type="text" name="pic_nama" required>
                </div>
                <div class="field-row-stacked mt-3">
                    <label for="email">Email Bisnis</label>
                    <input id="email" type="email" name="email" required>
                </div>
                <div class="field-row-stacked mt-3">
                    <label for="password">Password Akun</label>
                    <input id="password" type="password" name="password" required>
                </div>
                <div class="field-row-stacked mt-3">
                    <label for="shareloc">Link Shareloc Gudang (Maps)</label>
                    <input id="shareloc" type="url" name="shareloc" required>
                </div>
            </fieldset>

            <div class="form-actions split">
                <a class="btn btn-ghost" href="/index.php?page=home">Batal</a>
                <button type="submit">Kirim Pendaftaran</button>
            </div>
        </form>
    </div>
</div>
