<?php

session_start();

// セッションからユーザーIDを取得
if (!isset($_SESSION['user_id'])) {
    echo "ログインしてください。";
    exit;
}
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

// クリアボタンが押された場合、購入履歴を削除
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_history'])) {
    // 購入履歴を削除
    $sql = 'DELETE FROM order_product WHERE user_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    echo "購入履歴が削除されました。<br>";
}

// 購入履歴を取得
$sql = '
    SELECT 
        order_product.product_id, 
        order_product.product_name, 
        order_product.total_price, 
        order_product.inventory_stock, 
        order_product.pay, 
        order_product.order_day
    FROM 
        order_product
    WHERE 
        order_product.user_id = ?
    ORDER BY 
        order_product.order_day DESC
';
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);

$purchase_history = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/order_history.css">
    <title>購入履歴</title>
</head>
<body>
<a href="./home.php">戻る</a>
    <h1>購入履歴</h1>

    <?php if (!empty($purchase_history)): ?>
        <?php foreach ($purchase_history as $row): ?>
            <p><strong>商品名:</strong> <?= htmlspecialchars($row['product_name']) ?></p>
            <p><strong>価格:</strong> <?= number_format($row['total_price']) ?>円</p>
            <p><strong>購入数量:</strong> <?= htmlspecialchars($row['inventory_stock']) ?>個</p>
            <p><strong>決済方法:</strong> <?= htmlspecialchars($row['pay']) ?></p>
            <p><strong>購入日:</strong> <?= htmlspecialchars($row['order_day']) ?></p>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>購入履歴はありません。</p>
    <?php endif; ?>

    <br>
    <form method="post">
        <button type="submit" name="clear_history" onclick="return confirm('本当に購入履歴を削除しますか？')">購入履歴をクリア</button>
    </form>
    <br>
</body>
</html>
