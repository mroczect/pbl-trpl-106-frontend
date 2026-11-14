<h2 class="page-title">Konfirmasi Pesanan &amp; Pembayaran</h2>

<fieldset class="form-narrow-md mt-3">
    <legend>Detail Pengiriman</legend>
    <form action="/index.php?page=customer/orders" method="POST">
        <div class="field-row-stacked">
            <label for="alamat">Alamat Lengkap Pengiriman</label>
            <textarea id="alamat" name="alamat" rows="2" required>Jl. Ahmad Yani No. 12</textarea>
        </div>

        <div class="field-row-stacked mt-3">
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

        <fieldset class="mt-3">
            <legend>Ringkasan Biaya</legend>
            <p>Subtotal Barang: Rp 40.000</p>
            <p>Ongkos Kirim: Rp 5.000</p>
            <hr>
            <p><strong>Total: Rp 45.000</strong></p>
        </fieldset>

        <div class="form-actions split">
            <a class="btn btn-ghost" href="/index.php?page=customer/cart">Kembali</a>
            <button type="submit">Konfirmasi &amp; Pesan</button>
        </div>
    </form>
</fieldset>
