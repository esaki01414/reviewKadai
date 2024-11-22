<?php

session_start();

// セッションからユーザーIDを取得
$user_id = $_SESSION['user_id'];

if (!isset($_POST['quantity']) || empty($_POST['quantity'])) {
    echo "購入データが正しく送信されていません。";
    exit;
}

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

// トランザクション開始
$pdo->beginTransaction();

try {
    // フォームから送られたデータを取得
    $quantities = $_POST['quantity']; // 商品IDをキー、購入数量を値として取得
    $pay = $_POST['pay']; // 決済情報の取得

    foreach ($quantities as $product_id => $quantity) {
        // 商品情報を取得
        $sql = "SELECT product_name, product_price, inventory_stock FROM product WHERE product_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product === false) {
            throw new Exception("商品ID {$product_id} が存在しません。");
        }

        $product_name = $product['product_name'];
        $product_price = $product['product_price'];
        $current_inventory_stock = $product['inventory_stock'];

        if ($current_inventory_stock < $quantity) {
            throw new Exception("商品ID {$product_id} の在庫が不足しています。在庫数: {$current_inventory_stock}, 購入数量: {$quantity}");
        }

        // 合計金額を計算
        $total_price = $product_price * $quantity;

        // 注文商品テーブルにデータを登録
        $sql = "INSERT INTO order_product (user_id, product_id, product_name, total_price, inventory_stock, pay) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id, $product_id, $product_name, $total_price, $quantity, $pay]);

        // 在庫数を減少させる
        $sql = "UPDATE product SET inventory_stock = inventory_stock - ? WHERE product_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$quantity, $product_id]);

        // カートから削除
        $sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id, $product_id]);
    }

    // トランザクションをコミット
    $pdo->commit();

    echo "注文が確定しました。";
    echo '<a href="./home.php">ホームに戻る</a>';
} catch (Exception $e) {
    // エラーが発生したらロールバック
    $pdo->rollBack();
    echo "エラーが発生しました: " . htmlspecialchars($e->getMessage());
    exit;
}
?>
