<?php
       session_start();
       if($_SESSION['admin_login'] == false){
           header("Location:./G1.php");
           exit;
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者登録完了画面</title>
    <link rel="stylesheet" href="css/G4.css"> <!-- パスの確認 --><!-- CSSファイルのリンク -->
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
   $maneger_mail = $_POST['maneger_mail'];
   $maneger_pass = $_POST['maneger_pass'];
   
   $sql = $pdo->prepare(
    'INSERT INTO  maneger(
        maneger_id , maneger_name , maneger_mail , maneger_pass
    )VALUES (?,?,?,?)'
    );    
    $sql->execute([$maneger_id, $maneger_name, $maneger_mail, $maneger_pass]); 
   ?>
     <div class="container">
    <div class="label">
    <h1>登録完了</h1>
    </div>
        <h2>登録が完了しました！</h2>
    <div class="back"><a href="./G2.php">ホームに戻る</a></div>
    </div>
</body>
</html>