<h2 class="page-title">Atur Reminder</h2>

<fieldset class="mt-3">
    <legend>Pengingat Berikutnya</legend>
    <form action="/index.php?page=customer/reminder" method="POST">
        <div class="field-row-stacked">
            <label for="tanggal">Tanggal Pengingat</label>
            <input id="tanggal" type="date" name="tanggal" required>
        </div>
        <div class="form-actions">
            <button type="submit">Simpan</button>
        </div>
    </form>
</fieldset>
