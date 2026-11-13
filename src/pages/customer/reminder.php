<h2 class="page-title">Atur Reminder</h2>

<fieldset>
    <legend>Pengingat Berikutnya</legend>
    <form action="/index.php" method="POST">
        <input type="hidden" name="page" value="customer/reminder">
        <div class="field-row-stacked" style="margin-bottom: 12px;">
            <label for="tanggal">Tanggal Pengingat</label>
            <input id="tanggal" type="date" name="tanggal" required>
        </div>
        <div class="field-row" style="justify-content: flex-end;">
            <button type="submit" class="default">Simpan</button>
        </div>
    </form>
</fieldset>
