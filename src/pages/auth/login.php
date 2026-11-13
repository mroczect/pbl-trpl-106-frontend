<div class="window">
    <div class="title-bar">
        <div class="title-bar-text">Masuk &mdash; Galonku</div>
    </div>
    <div class="window-body" style="padding: 16px;">
        <form action="/index.php" method="GET">
            <div class="field-row-stacked" style="margin-bottom: 10px;">
                <label for="role">Masuk Sebagai</label>
                <select id="role" name="page">
                    <option value="customer/dashboard">Konsumen</option>
                    <option value="agent/dashboard">Agent Depot</option>
                    <option value="admin/dashboard">Admin</option>
                </select>
            </div>
            <div class="field-row-stacked" style="margin-bottom: 10px;">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required>
            </div>
            <div class="field-row-stacked" style="margin-bottom: 14px;">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>
            <div class="field-row" style="justify-content: space-between; gap: 8px;">
                <a class="button" href="/index.php?page=home">Batal</a>
                <button type="submit" class="default">Masuk</button>
            </div>
        </form>
    </div>
</div>
