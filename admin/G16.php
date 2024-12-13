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
    <title>商品削除画面</title>
    <link rel="stylesheet" href="css/G16.css">
</head>
<body>
<?php
$id=$_POST['product_delete'] ?? null;
if(!($id)){
    $id = $_SESSION['id'] ?? null;
}
?>
<a href="G9.php?id=<?= $id ?>"><i class="fa-solid fa-cube icon"></i>    
戻る</a>
<h1>商品削除画面</h1>
<div class="container">
<?php
try {
    $pdo = new PDO(
        'mysql:host=mysql310.phy.lolipop.lan;dbname=LAA1554917-system;charset=utf8',
        'LAA1554917',
        'PassSD2D'
    );
}catch (PDOException $e) {
    echo 'データベース接続に失敗しました: ' . htmlspecialchars($e->getMessage());
    exit;
}
$sql='SELECT * FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
        echo '<div class="product-image" style="float:left; margin-right:20px; margin-top:20px;">';
        echo '<form action="G17.php" method="post">';
        echo '<img src="data:'.htmlspecialchars($row['image_type']).';base64,'.base64_encode($row['image_content']).'"width="400" height="auto"" name="img">';
        echo '</div>';

        echo '<div class="product-details">';
        echo '<p class="detail-item">商品作成日: ' . htmlspecialchars($row['created_at']) . '</p>';
        echo '<p>商品画像名: ' . htmlspecialchars($row['image_name']) . '</p>';
        echo '<p>商品画像サイズ: ' . htmlspecialchars($row['image_size']) . '</p>';
        echo '<p>商品ID:',htmlspecialchars($row['product_id']),'</p>';
        $product_id = htmlspecialchars($row['product_id']);
        echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
        echo '<p>商品名:',htmlspecialchars($row['product_name']),'</p>';
        echo '<p>商品サイズ:',htmlspecialchars($row['product_size']),'</p>';
        echo '<p>商品カラー:',htmlspecialchars($row['product_color']),'</p>';
        echo '<p>在庫数:',htmlspecialchars($row['inventory_stock']),'</p>';
        echo '<p>価格:',htmlspecialchars($row['product_price']),'</p>';
        echo '<p>商品説明:',htmlspecialchars($row['product_body']),'</p>';
        echo '<div class = delete-button-wrapper>';
        echo '<p><button type="submit" class="delete-button">削除</button></p>';
        echo '</div>';
        echo '</div>';
        echo '</form>';
       }
       $pdo=null;
?>
</div>
<script src="js/script.js"></script>
</body>
</html>