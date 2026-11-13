<h2 class="page-title">Profil Depot</h2>

<fieldset class="form-narrow mt-3">
    <legend>Informasi Depot</legend>
    <form action="/index.php?page=agent/profile-depot" method="POST">
        <div class="field-row-stacked mt-2">
            <label for="nama_depot">Nama Depot</label>
            <input id="nama_depot" type="text" name="nama_depot" value="Depot Air Segar">
        </div>

        <div class="field-row-stacked mt-3">
            <label for="shareloc">Lokasi Shareloc (Google Maps)</label>
            <input id="shareloc" type="url" name="shareloc" value="https://maps.app.goo.gl/...">
        </div>

        <div class="field-row mt-2" style="justify-content: flex-end;">
            <button type="submit">Simpan Perubahan</button>
        </div>
    </form>
</fieldset>
