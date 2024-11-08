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
    <title>Document</title>
</head>
<body>
    <h3>ログアウト完了画面</h3>
    <p>ログアウトしました。</p>
    <a href="./home.php">ホーム画面に遷移</a>
</body>
</html>