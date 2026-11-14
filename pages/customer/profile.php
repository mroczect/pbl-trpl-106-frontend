<h2 class="page-title">Profil Saya</h2>

<fieldset class="mt-3">
    <legend>Data Diri</legend>
    <form action="/index.php?page=customer/profile" method="POST">
        <div class="field-row-stacked">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" value="budi123" required>
        </div>
        <div class="field-row-stacked mt-3">
            <label for="no_hp">No. HP</label>
            <input id="no_hp" type="tel" name="no_hp" value="08123456789" required>
        </div>
        <div class="field-row-stacked mt-3">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" rows="3" required>Jl. Ahmad Yani No. 12</textarea>
        </div>
        <div class="form-actions">
            <button type="submit">Simpan</button>
        </div>
    </form>
</fieldset>
