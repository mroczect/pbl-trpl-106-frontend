<h2 class="page-title">Kelola Stok</h2>

<fieldset class="form-narrow mt-3">
    <legend>Perbarui Stok Produk</legend>
    <form action="/index.php?page=agent/stock" method="POST">
        <div class="field-row-stacked">
            <label for="produk">Pilih Produk</label>
            <select id="produk" name="produk">
                <option>Galon 19L</option>
                <option>Gas LPG 3kg</option>
            </select>
        </div>

        <div class="field-row-stacked mt-3">
            <label for="jumlah">Jumlah Stok Baru</label>
            <input id="jumlah" type="number" name="jumlah" value="50">
        </div>

        <div class="form-actions">
            <button type="submit">Simpan Stok</button>
        </div>
    </form>
</fieldset>
