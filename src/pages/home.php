<div class="window" style="width: 600px;">
    <div class="title-bar">
        <div class="title-bar-text">Tentang Aplikasi</div>
        <div class="title-bar-controls">
            <button aria-label="Minimize"></button>
            <button aria-label="Maximize"></button>
            <button aria-label="Close"></button>
        </div>
    </div>

    <div class="window-body">
        <div style="text-align: center; margin-bottom: 15px;">
            <h1 style="font-size: 28px; margin: 0; letter-spacing: 2px;">GALONKU</h1>
            <p style="margin: 5px 0 0 0; font-size: 13px;">Aplikasi Pengelolaan Depot Air Minum Isi Ulang</p>
        </div>

        <div class="sunken-panel" style="padding: 15px; height: 200px; overflow-y: scroll;">
            <p style="margin-top: 0; text-align: justify;">
                GALONKU dirancang untuk membantu pengelolaan depot air minum isi ulang. Aplikasi ini mempermudah proses pemesanan, pengelolaan stok, pencatatan transaksi, dan pengingat pembelian pelanggan yang sebelumnya dilakukan secara manual.
            </p>

            <fieldset>
                <legend>Karakteristik Pengguna</legend>
                <ul style="margin-top: 5px; padding-left: 20px;">
                    <li style="margin-bottom: 5px;"><b>Konsumen:</b> Melihat produk, memesan, melihat riwayat, mengatur reminder, dan menghubungi agen.</li>
                    <li style="margin-bottom: 5px;"><b>Agent Depot:</b> Mengelola profil depot, pesanan masuk, produk, dan stok.</li>
                    <li><b>Admin:</b> Mengelola data konsumen dan data agent.</li>
                </ul>
            </fieldset>
        </div>

        <div class="field-row" style="justify-content: center; margin-top: 20px; gap: 10px;">
            <button onclick="window.location.href='/index.php?page=auth/login'" style="width: 120px; padding: 4px;">Masuk</button>
            <button onclick="window.location.href='/index.php?page=auth/register-user'" style="width: 120px; padding: 4px;">Daftar</button>
        </div>

        <p style="text-align: center; font-size: 11px; margin-top: 15px; margin-bottom: 0;">
            Belum punya akun? Silakan klik tombol Daftar.
        </p>
    </div>
</div>
