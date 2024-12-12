<?php
session_start();

// セッションからユーザーIDを取得
$user_id = $_SESSION['user_id'] ?? null;

// POSTデータから商品IDを取得
$product_id = $_POST['product_id'] ?? null;
if(!($product_id)){
    $product_id = $_SESSION['product_id'] ?? null;
}


if (!$product_id) {
    echo '商品が選択されていません。';
    exit;
}

// データベース接続
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

// 商品情報を取得
$sql = "SELECT * FROM product WHERE product_id = :product_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo '商品が見つかりませんでした。';
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/product.css">
    <script src="./js/product.js"></script>
    <title>商品詳細</title>
</head>
<body>
    <header></header>
    <a href="./home.php">戻る</a>
    <div class="container">
    <img src="data:<?= htmlspecialchars($product['image_type']); ?>;base64,<?= base64_encode($product['image_content']); ?>">
    <div class="product-details">
    <h2>商品名: <?= htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8') ?></h2>
    <h2>サイズ: <?= htmlspecialchars($product['product_size'], ENT_QUOTES, 'UTF-8') ?></h2>
    <h2>カラー: <?= htmlspecialchars($product['product_color'], ENT_QUOTES, 'UTF-8') ?></h2>
    <h2>商品価格: ￥<?= number_format((float)$product['product_price']) ?></h2>
    <h2>在庫数: <?= htmlspecialchars($product['inventory_stock'], ENT_QUOTES, 'UTF-8') ?></h2>
    <h2>商品詳細:<?= nl2br(htmlspecialchars($product['product_body'], ENT_QUOTES, 'UTF-8')) ?>
    </h2>
    <?php if(isset($_SESSION['user_id'])){?>
    <form action="./product_finishing.php" method="post">
        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_id, ENT_QUOTES, 'UTF-8') ?>">
        <button type="submit" name="favorite" id="favorite-button">お気に入りに登録</button>
        <button type="submit" name="cart" id="cart-button">カートに登録</button>
        </div>
        </div>
    </form>
    <?php }else{?>
        <p>※お気に入り・カートへの登録はログイン後使用可能です。</p>
    <?php }?>
</body>
</html>

