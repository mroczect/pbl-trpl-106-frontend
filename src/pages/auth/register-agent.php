<div class="window" style="width: 300px;">
    <div class="title-bar">
        <div class="title-bar-text">Daftar Agent Depot</div>
    </div>
    <div class="window-body">
        <form action="/index.php" method="GET">
            <input type="hidden" name="page" value="agent/dashboard">

            <div class="field-row-stacked">
                <label for="username">Username (Nama Depot)</label>
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
                <label for="lokasi_depot">Lokasi Depot</label>
                <textarea id="lokasi_depot" name="lokasi_depot" rows="2" required></textarea>
            </div>

            <div class="field-row-stacked">
                <label for="shareloc">Link Shareloc (Google Maps)</label>
                <input id="shareloc" type="url" name="shareloc" required>
            </div>

            <div class="field-row" style="justify-content: flex-end; margin-top: 10px;">
                <button type="submit">Daftar</button>
            </div>
        </form>
        <div style="margin-top: 10px; text-align: center;">
            <a href="/index.php?page=auth/register-user">Daftar sebagai Konsumen</a>
        </div>
    </div>
</div>
