<div class="window" style="width: 300px;">
    <div class="title-bar">
        <div class="title-bar-text">Login</div>
    </div>
    <div class="window-body">
        <form action="/index.php" method="GET">
            <input type="hidden" name="page" value="customer/dashboard">

            <div class="field-row-stacked">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required>
            </div>

            <div class="field-row-stacked">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>

            <div class="field-row" style="justify-content: flex-end; margin-top: 10px;">
                <button type="submit">Masuk</button>
            </div>
        </form>
    </div>
</div>
