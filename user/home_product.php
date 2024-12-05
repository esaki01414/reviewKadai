<?php
$pdo = new PDO(
    'mysql:host=mysql310.phy.lolipop.lan;dbname=LAA1554917-system;charset=utf8',
    'LAA1554917',
    'PassSD2D'
);


// 画像情報を取得
$sql = 'SELECT image_name,image_type,image_content,image_size FROM product'; 
$stmt = $pdo->prepare($sql); // クエリを準備
$stmt->execute(); // クエリを実行
$images = $stmt->fetchAll();

$search_keyword = $_GET['search'] ?? ''; // 検索キーワード

if ($search_keyword) {
    // 検索キーワードを使って商品を検索
    $sql = 'SELECT * FROM product WHERE product_name LIKE ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['%' . $search_keyword . '%']);
} else {
    // 検索キーワードがない場合、すべての商品を表示
    $sql = 'SELECT * FROM product';
    $stmt = $pdo->query($sql);
}
$images = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/guest.css">
    <title>Document</title>
</head>
<body>
    <p><a href="./home.php">ホームへ</a></p>
    <form action="./product.php" method="post">
    <div class="product-list">
    <?php
    // 商品情報の表示
    foreach ($images as $row) {
        echo '<div class="product_all" style="margin-right: 20px; margin-bottom: 20px; display: inline-block;">';
        echo '<button type="submit" name="product_id" value="', htmlspecialchars($row['product_id']), '">', htmlspecialchars($row['product_name']), '</button>';
        echo '<p><img src="data:', htmlspecialchars($row['image_type']),
            ';base64,', base64_encode($row['image_content']),
            '" width="200" height="auto" class="mr-3"></p>';
        echo '</div>';
    }

    ?>
    </div>
    </form>
</body>
</html>