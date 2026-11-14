<div class="window">
    <div class="title-bar">
        <div class="title-bar-text">Masuk</div>
    </div>
    <div class="window-body">
        <form action="/index.php" method="GET">
            <div class="field-row-stacked">
                <label for="role">Masuk Sebagai</label>
                <select id="role" name="page">
                    <option value="customer/dashboard">Konsumen</option>
                    <option value="agent/dashboard">Agent Depot</option>
                    <option value="admin/dashboard">Admin</option>
                </select>
            </div>
            <div class="field-row-stacked mt-3">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required>
            </div>
            <div class="field-row-stacked mt-3">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>
            <div class="form-actions split">
                <a class="btn btn-ghost" href="/index.php?page=home">Batal</a>
                <button type="submit">Masuk</button>
            </div>
        </form>
    </div>
</div>
