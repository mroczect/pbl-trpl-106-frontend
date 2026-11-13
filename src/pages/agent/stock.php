<h2 style="margin-top: 0; color: #000080;">Kelola Stok</h2>

<fieldset style="margin-top: 15px; max-width: 400px;">
    <legend>Perbarui Stok Produk</legend>
    <form action="/index.php" method="GET">
        <input type="hidden" name="page" value="agent/stock">

        <div class="field-row-stacked" style="margin-bottom: 10px;">
            <label for="produk">Pilih Produk</label>
            <select id="produk" name="produk" style="width: 100%; box-sizing: border-box; padding: 4px;">
                <option>Galon 19L</option>
                <option>Gas LPG 3kg</option>
            </select>
        </div>

        <div class="field-row-stacked" style="margin-bottom: 15px;">
            <label for="jumlah">Jumlah Stok Baru</label>
            <input id="jumlah" type="number" value="50" style="width: 100%; box-sizing: border-box; padding: 4px;">
        </div>

        <div class="field-row" style="justify-content: flex-end;">
            <button type="submit" style="padding: 4px 15px;">Simpan Stok</button>
        </div>
    </form>
</fieldset>
