<?php
       session_start();
       if($_SESSION['admin_login'] == false){
           header("Location:./G1.php");
           exit;
      }
?>
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

    <div class="back"><a href="./G2.php">←戻る</a></div>
    <div class="background">
    <div class="label">
        <h1>新規登録画面</h1>
    </div>
    <form id="registrationForm" action="G4.php" method="post">
        <div class="form1">
            <label for="maneger_id">社員ID</label>
            <input type="text" id="maneger_id" name="maneger_id" required>
        </div>
        <br>
        <div class="form2">
            <label for="maneger_name">氏名</label>
            <input type="text" id="maneger_name" name="maneger_name" required>
        </div>
        <br>
        <div class="form3">
            <label for="maneger_mail">メールアドレス</label>
            <input type="mail" id="maneger_mail" name="maneger_mail" required>
        </div>
        <br>
        <div class="form4">
            <label for="maneger_pass">パスワード</label>
            <input type="password" id="maneger_pass" name="maneger_pass" required>
        </div>
        <br>
        <br>
            <button type="submit" class="botton" href="./G4.php">登録</button>
    </form>
    <div id="message"></div>
    </div>
    <script src="js/script.js"></script>
    
</body>
</html>