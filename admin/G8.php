<?php
       session_start();
       if($_SESSION['admin_login'] == false){
           header("Location:./G1.php");
           exit;
      }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品管理画面</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- CSSファイルのリンク -->
    <link rel="stylesheet" href="css/dashboard.css"> <!-- CSSファイルのリンク -->
    <link rel="stylesheet" href="css/G8.css">
</head>
<body>
<a href="G2.php">戻る</a><br><br>
    <h1>商品管理</h1>
    <header>
    <form action="G13.php" method="get">
        <button class="register-botton" type="submit">商品登録</button>
    </header>
</form>
<?php
         try {
            $pdo = new PDO(
                'mysql:host=mysql310.phy.lolipop.lan;dbname=LAA1554917-system;charset=utf8',
                'LAA1554917',
                'PassSD2D'
            );
        } catch (PDOException $e) {
            echo 'データベース接続に失敗しました: ' . htmlspecialchars($e->getMessage());
            exit;
        }  
$sql='SELECT product_id, product_name FROM product';
   $stmt = $pdo->query($sql);
   ?>
   <main class="product-guid">
   <div class="product-card">
   <div class="boxs">
    <span>
<?php foreach($stmt as $row){
    echo '<a href="G9.php?id=',$row['product_id'],'" class="box">';
    echo '<i class="fa-solid fa-cube icon"></i>';
    echo '<p>商品ID:</p>';
    echo '<p>',$row['product_id'],'</p>';
    echo '<p>商品名:</p>';
    echo '<p>',$row['product_name'],'</p>';
    echo '</a>';
     }
     ?>
    </span>
    </div>
    </div>
    </div>
    <?php
   $pdo=null;
    ?>
    <script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->
</body>
</html>

