<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品管理画面</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- CSSファイルのリンク -->
    <link rel="stylesheet" href="css/G8.css"> <!-- CSSファイルのリンク -->
</head>
<body>
    <h1>商品管理</h1>
    <a href="G2.php">戻る</a>
    <form action="G13.php" method="get">
        <button type="submit">商品登録</button>
</form>
<?php
   $pdo = new PDO(
    'mysql:host=mysql310.phy.lolipop.lan;
    dbname=LAA1554917-system;charset=utf8',
    'LAA1554917',
     'PassSD2D'
);
$sql='SELECT product_id, product_name FROM product';
   $stmt = $pdo->query($sql);
   echo '<div class="c-link-group">';
   echo '<div class="c-link">';
   foreach($stmt as $row){
    echo  '<div>';
    echo '<a href="G9.php">';
      echo   '<p>おすすめ書籍</p>';
    echo '</a>';
    echo '</div>';
   }
    echo '</div>';
   echo '</div>';
   $pdo=null;
    ?>
    <script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->
</body>
</html>