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
        cart 
    INNER JOIN 
        product 
    ON 
        cart.product_id = product.product_id 
    WHERE 
        cart.user_id = ?
';
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);

$carts = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/cart.css">
    <title>カート商品</title>
</head>
<body class="special-page">
    <a href="./home.php">ホームに遷移</a>
    <h1>カート商品</h1>
    <!-- ここ -->
    
    <div class="products-container">
    <form action="./product.php" method="post">
    <?php if (!empty($carts)): ?>
        <?php foreach ($carts as $row): ?>
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
                <button type="submit" name="cart_delete" value="<?= htmlspecialchars($row['product_id']) ?>" class="favorite-button">商品をカートから外す</button>
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
        <p>保存しているカート商品がありません。</p>
    <?php endif; ?>
    <!-- 購入ボタン: カートに商品がある場合のみ表示 -->
    <?php if (!empty($carts)): ?>
        <form action="./order.php" method="post">
            <p>購入手続きに遷移します</p>
            <button type="submit" name="order">購入</button>
        </form>
    <?php endif; ?>
</body>
</html>
