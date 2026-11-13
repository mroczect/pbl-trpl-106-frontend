<div class="w3-container w3-padding-32 w3-center">
    <div class="w3-card w3-white w3-padding w3-left-align" style="max-width:400px; margin:0 auto;">
        <h2>Daftar Agent Depot</h2>
        <form action="/index.php" method="GET">
            <input type="hidden" name="page" value="agent/dashboard">

            <label>Username (Nama Depot)</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="username" required>

            <label>Email</label>
            <input class="w3-input w3-border w3-margin-bottom" type="email" name="email" required>

            <label>Password</label>
            <input class="w3-input w3-border w3-margin-bottom" type="password" name="password" required>

            <label>No. HP</label>
            <input class="w3-input w3-border w3-margin-bottom" type="tel" name="no_hp" required>

            <label>Lokasi Depot</label>
            <textarea class="w3-input w3-border w3-margin-bottom" name="lokasi_depot" rows="2" required></textarea>

            <label>Link Shareloc (Google Maps)</label>
            <input class="w3-input w3-border w3-margin-bottom" type="url" name="shareloc" placeholder="https://maps.app.goo.gl/..." required>

            <button class="w3-button w3-black w3-block" type="submit">Daftar Agent</button>
        </form>
        <div class="w3-center w3-margin-top w3-padding-top">
            <p>Mau beli galon? <a href="/index.php?page=auth/register-user" class="w3-text-blue">Daftar sebagai Konsumen</a></p>
        </div>
    </div>
</div>
