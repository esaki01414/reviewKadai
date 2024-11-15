<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者登録完了画面</title>
</head>
<body>
<?php
   $pdo = new PDO(
    'mysql:host=mysql310.phy.lolipop.lan;
    dbname=LAA1554917-system;charset=utf8',
    'LAA1554917',
     'PassSD2D'
   );

   $maneger_id = $_POST['maneger_id'];
   $maneger_name = $_POST['maneger_name'];
   $maneger_pass = $_POST['maneger_pass'];
   
   $sql = $pdo->prepare(
    'INSERT INTO  maneger(
        maneger_id , maneger_name , maneger_pass
    )VALUES (?,?,?)'
    );    
    $sql->execute([$maneger_id, $maneger_name, password_hash($maneger_pass, PASSWORD_DEFAULT)]); 
   ?>
    <div class="label">
    <h1>登録完了</h1>
    </div>
    <div class="back"><a href="./dashboard.php">ホームに戻る</a></div>
</body>
</html>