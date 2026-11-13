<h2 style="color: #000080; margin-top: 0;">Konfirmasi Pesanan & Pembayaran</h2>

<fieldset style="max-width: 600px; margin-top: 15px;">
    <legend>Detail Pengiriman</legend>
    <form action="/index.php" method="GET">
        <input type="hidden" name="page" value="customer/orders">

        <div class="field-row-stacked" style="margin-bottom: 10px;">
            <label for="alamat">Alamat Lengkap Pengiriman</label>
            <textarea id="alamat" name="alamat" rows="2" required>Jl. Ahmad Yani No. 12</textarea>
        </div>

        <div class="field-row-stacked" style="margin-bottom: 10px;">
            <label for="catatan">Catatan untuk Kurir (Opsional)</label>
            <input id="catatan" type="text" name="catatan" placeholder="Contoh: Titip ke satpam jika kosong">
        </div>

        <div class="field-row-stacked" style="margin-bottom: 15px;">
            <label for="metode">Metode Pembayaran</label>
            <select id="metode" name="metode">
                <option value="cod">Tunai / COD (Bayar di Tempat)</option>
                <option value="transfer">Transfer Bank (BCA/Mandiri)</option>
            </select>
        </div>

        <fieldset style="margin-bottom: 15px; background: #e6e6e6;">
            <legend>Ringkasan Biaya</legend>
            <p style="margin: 2px 0; font-size: 12px;">Subtotal Barang: Rp 40.000</p>
            <p style="margin: 2px 0; font-size: 12px;">Ongkos Kirim: Rp 5.000</p>
            <hr style="margin: 5px 0;">
            <p style="margin: 2px 0; font-size: 14px;"><b>Total: Rp 45.000</b></p>
        </fieldset>

        <div class="field-row" style="justify-content: flex-end; gap: 8px;">
            <button type="button" onclick="window.location.href='/index.php?page=customer/cart'">Kembali</button>
            <button type="submit" style="font-weight: bold;">Konfirmasi & Pesan</button>
        </div>
    </form>
</fieldset>
