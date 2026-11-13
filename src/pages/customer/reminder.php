<h2 class="page-title">Atur Reminder</h2>

<fieldset>
    <legend>Pengingat Berikutnya</legend>
    <form action="/index.php?page=customer/reminder" method="POST">
        <div class="field-row-stacked mt-2">
            <label for="tanggal">Tanggal Pengingat</label>
            <input id="tanggal" type="date" name="tanggal" required>
        </div>
        <div class="field-row mt-2" style="justify-content: flex-end;">
            <button type="submit" class="default">Simpan</button>
        </div>
    </form>
</fieldset>
