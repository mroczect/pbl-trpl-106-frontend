<div class="window" style="width: 300px;">
    <div class="title-bar">
        <div class="title-bar-text">Daftar Konsumen</div>
    </div>
    <div class="window-body">
        <form action="/index.php" method="GET">
            <input type="hidden" name="page" value="customer/dashboard">

            <div class="field-row-stacked">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" required>
            </div>

            <div class="field-row-stacked">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required>
            </div>

            <div class="field-row-stacked">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>

            <div class="field-row-stacked">
                <label for="no_hp">No. HP</label>
                <input id="no_hp" type="tel" name="no_hp" required>
            </div>

            <div class="field-row-stacked">
                <label for="lokasi">Alamat Lengkap</label>
                <textarea id="lokasi" name="lokasi" rows="3" required></textarea>
            </div>

            <div class="field-row" style="justify-content: flex-end; margin-top: 10px;">
                <button type="submit">Daftar</button>
            </div>
        </form>
        <div style="margin-top: 10px; text-align: center;">
            <a href="/index.php?page=auth/register-agent">Daftar sebagai Agent</a>
        </div>
    </div>
</div>
