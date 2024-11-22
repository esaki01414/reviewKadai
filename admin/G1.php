<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ログイン画面</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- CSSファイルのリンク -->
</head>
<body>
    <div class="login-wrapper" id="login">
        <div class="container">
            <div class="login">
                <div class="login-wrapper-title">
                    <h3>ログイン</h3>
                </div>
                <form class="login-form" action="check.php" method="POST">
                    <div class="form-group">
                        <p>管理者ID</p>
                        <input type="text" name="sid" required>
                    </div>
                    <div class="form-group">
                        <p>パスワード</p>
                        <input type="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-submit">ログイン</button>
                </form>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->
</body>
</html>
