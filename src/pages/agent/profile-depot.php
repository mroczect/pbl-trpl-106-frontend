<h2 style="margin-top: 0; color: #000080;">Profil Depot</h2>

<fieldset style="margin-top: 15px; max-width: 500px;">
    <legend>Informasi Depot</legend>
    <form action="/index.php" method="GET">
        <input type="hidden" name="page" value="agent/profile-depot">

        <div class="field-row-stacked" style="margin-bottom: 10px;">
            <label for="nama_depot">Nama Depot</label>
            <input id="nama_depot" type="text" value="Depot Air Segar" style="width: 100%; box-sizing: border-box; padding: 4px;">
        </div>

        <div class="field-row-stacked" style="margin-bottom: 15px;">
            <label for="shareloc">Lokasi Shareloc (Google Maps)</label>
            <input id="shareloc" type="text" value="https://maps.app.goo.gl/..." style="width: 100%; box-sizing: border-box; padding: 4px;">
        </div>

        <div class="field-row" style="justify-content: flex-end;">
            <button type="submit" style="padding: 4px 15px;">Simpan Perubahan</button>
        </div>
    </form>
</fieldset>
