<div style="padding: 15px; min-height: calc(100vh - 80px); display: flex; align-items: center; justify-content: center; box-sizing: border-box;">

    <div class="window" style="width: 100%; max-width: 380px; margin: 0;">

        <div class="title-bar">
            <div class="title-bar-text">Login - GALONKU</div>
            <div class="title-bar-controls">
                <button aria-label="Close" onclick="window.location.href='/index.php?page=home'"></button>
            </div>
        </div>

        <div class="window-body" style="padding: 24px;">
            <form action="/index.php" method="GET">

                <!-- Pilihan Role -->
                <div class="field-row-stacked" style="margin-bottom: 12px;">
                    <label for="role">Masuk Sebagai</label>
                    <select id="role" name="page" style="width: 100%; padding: 4px;">
                        <option value="customer/dashboard">Konsumen</option>
                        <option value="agent/dashboard">Agent Depot</option>
                        <option value="admin/dashboard">Admin Sistem</option>
                    </select>
                </div>

                <div class="field-row-stacked" style="margin-bottom: 12px;">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" required style="width: 100%; box-sizing: border-box; padding: 6px;">
                </div>

                <div class="field-row-stacked" style="margin-bottom: 20px;">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required style="width: 100%; box-sizing: border-box; padding: 6px;">
                </div>

                <div class="field-row" style="justify-content: flex-end; gap: 8px;">
                    <button type="button" onclick="window.location.href='/index.php?page=home'" style="width: 85px; padding: 5px;">Batal</button>
                    <button type="submit" style="width: 85px; padding: 5px; font-weight: bold;">Masuk</button>
                </div>
            </form>

            <!-- ... (bagian garis dan daftar biarkan sama seperti sebelumnya) ... -->
