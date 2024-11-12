<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
   $pdo = new PDO(
    'mysql:host=mysql310.phy.lolipop.lan;
    dbname=LAA1554917-system;charset=utf8',
    'LAA1554917',
     'PassSD2D'
   );

   $maneger_id = $_POST['userid'];
   $maneger_name = $_POST['username'];
   $maneger_pass = $_POST['password']
    ?>
    <div class="label">
        <h1>登録完了</h1>
    </div>
    <div class="back"><a href="./dashboard.php">ホームに戻る</a></div>
</body>
</html>