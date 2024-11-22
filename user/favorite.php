<?php

session_start();
// セッションからユーザーIDを取得
$user_id = $_SESSION['user_id'];

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

// favorite と product を結合して、必要なデータを取得
$sql = '
    SELECT 
        product.product_id, 
        product.product_name, 
        product.product_photo 
    FROM 
        favorite 
    INNER JOIN 
        product 
    ON 
        favorite.product_id = product.product_id 
    WHERE 
        favorite.user_id = ?
';
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);

$favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/favorite.css">
    <title>お気に入り商品</title>
</head>
<body class="special-page">
    <a href="./home.php">ホームに遷移</a>
    <h1>お気に入り商品</h1>
    <?php if (!empty($favorites)): ?>
        <?php foreach ($favorites as $row): ?>
            <div class="product_all">
            <form action="./product.php" method="post">
                <h2>商品名：<button type="submit" name="product_id" value="<?= htmlspecialchars($row['product_id']) ?>" class="link-button">
                    <?= htmlspecialchars($row['product_name']) ?>
                </button></h2>
            </form>
            <div class="image-container">
                <p>
                    <img src="<?= htmlspecialchars($row['product_photo']) ?>" alt="Product Image" class="product-image">
                </p>
                <form action="./product_delete.php" method="post">
                    <button type="submit" name="favorite_delete" value="<?= htmlspecialchars($row['product_id']) ?>" class="favorite-button">商品をお気に入りから外す</button>
                </form>
            </div>
                <hr>
                <style>
                    hr{
                        border: none;
                        height: 1px;
                        background-image:
                        linear-gradient(
                            to right,
                            transparent,
                            #888 50%,
                            transparent
                        ) 
                        ;
                    }
                </style>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>保存しているお気に入り商品がありません。</p>
    <?php endif; ?>
    
    
</body>
</html>
