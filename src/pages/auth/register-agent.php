<div class="window" style="width: 100%; max-width: 500px;">
    <div class="title-bar">
        <div class="title-bar-text">Pendaftaran Mitra Vendor Depot</div>
    </div>
    <div class="window-body" style="padding: 20px;">
        <form action="/index.php" method="GET">
            <input type="hidden" name="page" value="agent/dashboard">

            <!-- FIELD 1: LEGALITAS USAHA -->
            <fieldset style="margin-bottom: 15px;">
                <legend>1. Legalitas Perusahaan</legend>
                <div class="field-row-stacked" style="margin-bottom: 8px;">
                    <label for="nama_usaha">Nama Badan Usaha / Depot</label>
                    <input id="nama_usaha" type="text" name="nama_usaha" required placeholder="PT. Air Jaya / Depot Makmur">
                </div>
                <div class="field-row-stacked" style="margin-bottom: 8px;">
                    <label for="nib">Nomor Induk Berusaha (NIB)</label>
                    <input id="nib" type="text" name="nib" required placeholder="1234567890">
                </div>
                <div class="field-row-stacked">
                    <label for="npwp">Nomor NPWP</label>
                    <input id="npwp" type="text" name="npwp" placeholder="00.000.000.0-000.000">
                </div>
            </fieldset>

            <!-- FIELD 2: OPERASIONAL -->
            <fieldset style="margin-bottom: 15px;">
                <legend>2. Kapasitas & Operasional</legend>
                <div class="field-row-stacked" style="margin-bottom: 8px;">
                    <label for="kapasitas">Kapasitas Produksi Harian (Galon)</label>
                    <input id="kapasitas" type="number" name="kapasitas" required placeholder="Contoh: 500">
                </div>
                <div class="field-row-stacked" style="margin-bottom: 8px;">
                    <label for="armada">Jumlah Armada Pengantaran</label>
                    <input id="armada" type="number" name="armada" required placeholder="Contoh: 3">
                </div>
                <div class="field-row-stacked">
                    <label for="jam_ops">Jam Operasional</label>
                    <input id="jam_ops" type="text" name="jam_ops" required placeholder="08:00 - 20:00">
                </div>
            </fieldset>

            <!-- FIELD 3: AKUN & KONTAK -->
            <fieldset style="margin-bottom: 20px;">
                <legend>3. Akun Akses & PIC</legend>
                <div class="field-row-stacked" style="margin-bottom: 8px;">
                    <label for="pic_nama">Nama Penanggung Jawab (PIC)</label>
                    <input id="pic_nama" type="text" name="pic_nama" required>
                </div>
                <div class="field-row-stacked" style="margin-bottom: 8px;">
                    <label for="email">Email Bisnis</label>
                    <input id="email" type="email" name="email" required>
                </div>
                <div class="field-row-stacked" style="margin-bottom: 8px;">
                    <label for="password">Password Akun</label>
                    <input id="password" type="password" name="password" required>
                </div>
                <div class="field-row-stacked">
                    <label for="shareloc">Link Shareloc Gudang (Maps)</label>
                    <input id="shareloc" type="url" name="shareloc" required>
                </div>
            </fieldset>

            <div class="field-row" style="justify-content: flex-end; gap: 8px;">
                <button type="button" onclick="window.location.href='/index.php?page=home'">Batal</button>
                <button type="submit" style="font-weight: bold;">Kirim Pendaftaran</button>
            </div>
        </form>
    </div>
</div>
