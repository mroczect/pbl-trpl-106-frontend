<div class="w3-container w3-padding-32 w3-center">
    <div class="w3-card w3-white w3-padding w3-left-align" style="max-width:400px; margin:0 auto;">
        <h2>Daftar Konsumen</h2>
        <form action="/index.php" method="GET">
            <input type="hidden" name="page" value="customer/dashboard">

            <label>Username</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="username" required>

            <label>Email</label>
            <input class="w3-input w3-border w3-margin-bottom" type="email" name="email" required>

            <label>Password</label>
            <input class="w3-input w3-border w3-margin-bottom" type="password" name="password" required>

            <label>No. HP</label>
            <input class="w3-input w3-border w3-margin-bottom" type="tel" name="no_hp" required>

            <label>Alamat Lengkap</label>
            <textarea class="w3-input w3-border w3-margin-bottom" name="lokasi" rows="3" required></textarea>

            <button class="w3-button w3-black w3-block" type="submit">Daftar</button>
        </form>
        <div class="w3-center w3-margin-top w3-padding-top">
            <p>Mau jual galon? <a href="/index.php?page=auth/register-agent" class="w3-text-blue">Daftar sebagai Agent</a></p>
        </div>
    </div>
</div>
