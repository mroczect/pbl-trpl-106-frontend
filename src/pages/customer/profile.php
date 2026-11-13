<h2 class="page-title">Profil Saya</h2>

<fieldset>
    <legend>Data Diri</legend>
    <form action="/index.php" method="POST">
        <input type="hidden" name="page" value="customer/profile">
        <div class="field-row-stacked" style="margin-bottom: 10px;">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" value="budi123" required>
        </div>
        <div class="field-row-stacked" style="margin-bottom: 10px;">
            <label for="no_hp">No. HP</label>
            <input id="no_hp" type="tel" name="no_hp" value="08123456789" required>
        </div>
        <div class="field-row-stacked" style="margin-bottom: 12px;">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" rows="3" required>Jl. Ahmad Yani No. 12</textarea>
        </div>
        <div class="field-row" style="justify-content: flex-end;">
            <button type="submit" class="default">Simpan</button>
        </div>
    </form>
</fieldset>
