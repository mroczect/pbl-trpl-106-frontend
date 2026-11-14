<h2 class="page-title">Manajemen Pesanan Masuk</h2>
<p>Kelola status pengiriman untuk pesanan yang masuk ke depot Anda.</p>

<fieldset class="mt-3">
    <legend>Daftar Pesanan</legend>
    <table class="data-grid">
        <thead>
            <tr>
                <th scope="col">ID Pesanan</th>
                <th scope="col">Konsumen</th>
                <th scope="col">Alamat Tujuan</th>
                <th scope="col">Total Tagihan</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>ORD-9921</td>
                <td>Budi Santoso</td>
                <td>Jl. Ahmad Yani No. 12 (Patokan: Depan Bakso)</td>
                <td>Rp 45.000</td>
                <td><span class="status-pending">Menunggu</span></td>
                <td>
                    <button type="button" class="btn-sm" disabled>Proses</button>
                    <button type="button" class="btn-sm" disabled>Tolak</button>
                </td>
            </tr>
            <tr>
                <td>ORD-9920</td>
                <td>Siti Aminah</td>
                <td>Komplek Batam Center Blok C</td>
                <td>Rp 20.000</td>
                <td><span class="status-info">Dikirim</span></td>
                <td>
                    <button type="button" class="btn-sm" disabled>Selesaikan</button>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
