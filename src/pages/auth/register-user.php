<div class="window" style="width: 300px;">
    <div class="title-bar">
        <div class="title-bar-text">Daftar Konsumen</div>
    </div>
    <div class="window-body">
        <form action="/index.php?page=customer/dashboard" method="POST">
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
            <div class="field-row mt-2" style="justify-content: flex-end;">
                <button type="submit">Daftar</button>
            </div>
        </form>
        <div class="mt-2" style="text-align: center;">
            <a href="/index.php?page=auth/register-agent">Daftar sebagai Agent</a>
        </div>
    </div>
</div>
