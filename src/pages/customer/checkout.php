<h2>Checkout Pesanan</h2>
<div class="w3-card w3-padding w3-margin-top" style="max-width:500px;">
    <form action="/index.php?page=customer/orders" method="GET">
        <input type="hidden" name="page" value="customer/orders">

        <label>Alamat Pengiriman</label>
        <textarea class="w3-input w3-border w3-margin-bottom" required>Jl. Ahmad Yani No. 12</textarea>

        <label>Jadwal Kirim</label>
        <input class="w3-input w3-border w3-margin-bottom" type="date" required>

        <button class="w3-button w3-black w3-block" type="submit">Buat Pesanan</button>
    </form>
</div>
