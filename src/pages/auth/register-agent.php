<div class="window" style="width: 100%; max-width: 500px;">
    <div class="title-bar">
        <div class="title-bar-text">Pendaftaran Mitra Vendor Depot</div>
    </div>
    <div class="window-body" style="padding: 20px;">
        <form action="/index.php?page=agent/dashboard" method="POST">
            <fieldset class="mt-2">
                <legend>Legalitas Perusahaan</legend>
                <div class="field-row-stacked mt-2">
                    <label for="nama_usaha">Nama Badan Usaha / Depot</label>
                    <input id="nama_usaha" type="text" name="nama_usaha" required placeholder="PT. Air Jaya / Depot Makmur">
                </div>
                <div class="field-row-stacked mt-2">
                    <label for="nib">Nomor Induk Berusaha (NIB)</label>
                    <input id="nib" type="text" name="nib" required placeholder="1234567890">
                </div>
                <div class="field-row-stacked mt-2">
                    <label for="npwp">Nomor NPWP</label>
                    <input id="npwp" type="text" name="npwp" placeholder="00.000.000.0-000.000">
                </div>
            </fieldset>

            <fieldset class="mt-3">
                <legend>Kapasitas &amp; Operasional</legend>
                <div class="field-row-stacked mt-2">
                    <label for="kapasitas">Kapasitas Produksi Harian (Galon)</label>
                    <input id="kapasitas" type="number" name="kapasitas" required placeholder="Contoh: 500">
                </div>
                <div class="field-row-stacked mt-2">
                    <label for="armada">Jumlah Armada Pengantaran</label>
                    <input id="armada" type="number" name="armada" required placeholder="Contoh: 3">
                </div>
                <div class="field-row-stacked mt-2">
                    <label for="jam_ops">Jam Operasional</label>
                    <input id="jam_ops" type="text" name="jam_ops" required placeholder="08:00 - 20:00">
                </div>
            </fieldset>

            <fieldset class="mt-3">
                <legend>Akun Akses &amp; PIC</legend>
                <div class="field-row-stacked mt-2">
                    <label for="pic_nama">Nama Penanggung Jawab (PIC)</label>
                    <input id="pic_nama" type="text" name="pic_nama" required>
                </div>
                <div class="field-row-stacked mt-2">
                    <label for="email">Email Bisnis</label>
                    <input id="email" type="email" name="email" required>
                </div>
                <div class="field-row-stacked mt-2">
                    <label for="password">Password Akun</label>
                    <input id="password" type="password" name="password" required>
                </div>
                <div class="field-row-stacked mt-2">
                    <label for="shareloc">Link Shareloc Gudang (Maps)</label>
                    <input id="shareloc" type="url" name="shareloc" required>
                </div>
            </fieldset>

            <div class="field-row mt-3" style="justify-content: flex-end; gap: 8px;">
                <a class="button" href="/index.php?page=home">Batal</a>
                <button type="submit" class="default">Kirim Pendaftaran</button>
            </div>
        </form>
    </div>
</div>
