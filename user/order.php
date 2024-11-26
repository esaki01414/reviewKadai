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

// カートの商品を取得
$sql = '
    SELECT 
        product.product_id, 
        product.product_name, 
        product.image_type,
        product.image_content,
        product.product_price, 
        product.inventory_stock
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

// 合計金額を計算
$total_price = 0;
foreach ($carts as $row) {
    $total_price += $row['product_price']; // 初期値はすべて1個購入と仮定
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/order.css">
    <title>注文内容確認</title>
</head>
<body>
    <a href="./cart.php">カートに戻る</a>
    <div class="container">
    <h1>注文内容の確認</h1>
    <p class="warning">※まだ購入はできていません</p>
    <?php if (!empty($carts)): ?>
        <form action="./order_finishing.php" method="post">
            <ul>
                <?php foreach ($carts as $row): ?>
                    <div class="product">
                    <li>
                        <p>商品名: <?= htmlspecialchars($row['product_name']) ?></p>
                        <p>価格: <?= htmlspecialchars(number_format($row['product_price'])) ?>円</p>
                        <p>在庫: <?= htmlspecialchars($row['inventory_stock']) ?> 個</p>
                        <p>
                        <img src="data:<?= htmlspecialchars($row['image_type']); ?>;base64,<?= base64_encode($row['image_content']); ?>" width="200" height="auto">
                        </p>
                        <p>購入数量:</p>
                        <select name="quantity[<?= htmlspecialchars($row['product_id']) ?>]" onchange="updateTotal()">
                            <?php for ($i = 1; $i <= $row['inventory_stock']; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </li>
                    </div>
                    <hr>
                <?php endforeach; ?>
            </ul>
            <p>合計金額: <span id="totalPrice"><?= number_format($total_price) ?>円</span></p>
            <br>
            <p>決済方法を選択してください:</p>
            <input type="radio" id="red" name="pay" value="PayPay" required>
            <label for="red">PayPay</label><br>

            <input type="radio" id="blue" name="pay" value="LINEPay" required>
            <label for="blue">LINEPay</label><br>

            <input type="radio" id="green" name="pay" value="ｄ払い" required>
            <label for="green">ｄ払い</label><br>
               
            <input type="radio" id="green" name="pay" value="amPAY" required> 
            <label for="green">amPAY</label><br>

            <input type="radio" id="green" name="pay" value="クレジットカード" required>
            <label for="green">クレジットカード</label><br>

            <br><br>
            <button type="submit" name="pay_order" value="1">注文を確定する</button>
            
        </form>
    <?php else: ?>
        <p>カートには商品がありません。</p>
    <?php endif; ?>

    <script>
        function updateTotal() {
            const prices = <?= json_encode(array_column($carts, 'product_price', 'product_id')) ?>;
            const quantities = document.querySelectorAll('select[name^="quantity"]');
            let total = 0;

            quantities.forEach(select => {
                const productId = select.name.match(/\d+/)[0];
                const quantity = parseInt(select.value, 10);
                total += prices[productId] * quantity;
            });

            document.getElementById('totalPrice').textContent = new Intl.NumberFormat('ja-JP').format(total) + '円';
        }
    </script>
    </div>
</body>
</html>
