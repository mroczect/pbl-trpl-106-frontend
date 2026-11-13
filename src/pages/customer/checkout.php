<h2 class="page-title">Konfirmasi Pesanan &amp; Pembayaran</h2>

<fieldset class="form-narrow-md mt-3">
    <legend>Detail Pengiriman</legend>
    <form action="/index.php?page=customer/orders" method="POST">
        <div class="field-row-stacked mt-2">
            <label for="alamat">Alamat Lengkap Pengiriman</label>
            <textarea id="alamat" name="alamat" rows="2" required>Jl. Ahmad Yani No. 12</textarea>
        </div>

        <div class="field-row-stacked mt-2">
            <label for="catatan">Catatan untuk Kurir (Opsional)</label>
            <input id="catatan" type="text" name="catatan" placeholder="Contoh: Titip ke satpam jika kosong">
        </div>

        <div class="field-row-stacked mt-3">
            <label for="metode">Metode Pembayaran</label>
            <select id="metode" name="metode">
                <option value="cod">Tunai / COD (Bayar di Tempat)</option>
                <option value="transfer">Transfer Bank (BCA/Mandiri)</option>
            </select>
        </div>

        <fieldset class="mt-3" style="background: #e6e6e6;">
            <legend>Ringkasan Biaya</legend>
            <p style="margin: 2px 0; font-size: 12px;">Subtotal Barang: Rp 40.000</p>
            <p style="margin: 2px 0; font-size: 12px;">Ongkos Kirim: Rp 5.000</p>
            <hr style="margin: 5px 0;">
            <p style="margin: 2px 0; font-size: 14px;"><b>Total: Rp 45.000</b></p>
        </fieldset>

        <div class="field-row mt-3" style="justify-content: flex-end; gap: 8px;">
            <a class="button" href="/index.php?page=customer/cart">Kembali</a>
            <button type="submit" class="default">Konfirmasi &amp; Pesan</button>
        </div>
    </form>
</fieldset>
