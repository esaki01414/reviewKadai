<?php
session_start();

session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/logout.css">
    <title>ログアウト完了画面</title>
</head>
<body>
    <div class="container">
        <div class="content">
            <h3>ログアウト完了</h3>
            <p>ログアウトしました。</p>
        </div>
        <div class="footer">
            <a href="./home.php">ホームへ</a>
        </div>
    </div>
</body>
</html>
