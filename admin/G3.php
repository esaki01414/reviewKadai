<!--管理者新規登録画面-->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者登録画面</title>
    <link rel="stylesheet" href="css/G3.css"> <!-- パスの確認 --><!-- CSSファイルのリンク -->
</head>
<body>

    <div class="back"><a href="./dashboard.php">←戻る</a></div>
    <div class="background">
    <div class="label">
        <h1>新規登録画面</h1>
    </div>
    <form id="registrationForm" action="G4.php" method="post">
        <div class="form1">
            <label for="userid">社員ID</label>
            <input type="text" id="userid" name="userid" required>
        </div>
        <br>
        <div class="form2">
            <label for="username">氏名</label>
            <input type="text" id="username" name="username" required>
        </div>
        <br>
        <div class="form3">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" required>
            <p password=null class="error">パスワードが入力されていません</p>
        </div>
        <br>
        <div class="form4">
            <label for="confirmpassword">パスワード確認</label>
            <input type="password" id="confirmpassword" name="confirmpassword" required>
            <p confirmpassword=password class="error">パスワードが一致しません</p>
        </div>
        <br>
        <br>
            <button type="submit" class="botton">登録</button>
    </form>
    <div id="message"></div>
    </div>
    <script src="js/script.js"></script>
    
</body>