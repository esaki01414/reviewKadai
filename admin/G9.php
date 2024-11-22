<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細画面</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- CSSファイルのリンク -->
</head>
<body>
    <h1>商品詳細</h1>
    <a href="G8.php">戻る</a>
    <?php
    $id=$_GET['id'];
    ?>
    <form action="G10.php" method="post">
        <button type="submit" name="<?= $id ?>">商品更新</button>
    </form>
    <form action="G16.php" method="post">
        <button type="submit" name="<?= $id ?>">商品削除</button>
    </form>
    <?php
       $pdo = new PDO(
        'mysql:host=mysql310.phy.lolipop.lan;
        dbname=LAA1554917-system;charset=utf8',
        'LAA1554917',
         'PassSD2D'
    );
    $sql='SELECT * FROM product WHERE product_id = ?';
       $stmt = $pdo->prepare($sql);
       $stmt->execute([$id]);
       $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
       foreach($stmt as $row){
        echo '<img src="'.$row['product_photo'].'"height="200" alt="Product Image">','<br>';
        echo '<p>商品ID:</p>';
        echo '<p>',$row['product_id'],'</p>';
        echo '<p>商品名:</p>';
        echo '<p>',$row['product_name'],'</p>';
        echo '<p>在庫数</p>';
        echo '<p>',$row['inventory_stock'],'</p>';
       }
       $pdo=null;
    ?>
        <script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->
</body>
</html>