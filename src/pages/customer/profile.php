<h2 class="page-title">Profil Saya</h2>

<fieldset>
    <legend>Data Diri</legend>
    <form action="/index.php?page=customer/profile" method="POST">
        <div class="field-row-stacked mt-2">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" value="budi123" required>
        </div>
        <div class="field-row-stacked mt-2">
            <label for="no_hp">No. HP</label>
            <input id="no_hp" type="tel" name="no_hp" value="08123456789" required>
        </div>
        <div class="field-row-stacked mt-2">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" rows="3" required>Jl. Ahmad Yani No. 12</textarea>
        </div>
        <div class="field-row mt-2" style="justify-content: flex-end;">
            <button type="submit" class="default">Simpan</button>
        </div>
    </form>
</fieldset>
