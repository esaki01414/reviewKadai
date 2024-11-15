<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="./home.php">戻る</a>
    <?php
    // データベース接続
    $pdo = new PDO(
        'mysql:host=mysql310.phy.lolipop.lan;dbname=LAA1554917-system;charset=utf8',
        'LAA1554917',
        'PassSD2D'
    );

    // product_idがPOSTで送信されている場合
    if (isset($_POST['product_id'])) {
        // 準備されたステートメントを使用
        $sql = $pdo->prepare('SELECT * FROM product WHERE product_id = ?');
        $sql->execute([$_POST['product_id']]);  // プレースホルダーに値をバインド
        $product = $sql->fetch();
        
        // productが存在する場合に表示
        if ($product) {
            echo '<h2>商品名: ' . htmlspecialchars($product['product_name']) . '</h2>';
            echo '<h2>サイズ: ' . htmlspecialchars($product['product_size']) . '</h2>';
            echo '<h2>カラー: ' . htmlspecialchars($product['product_color']) . '</h2>';
            echo '<h2>商品価格: ' . htmlspecialchars($product['product_price']) . '</h2>';
            echo '<h2>在庫数: ' . htmlspecialchars($product['imventory_stock']) . '</h2>';
            echo '<h2>商品詳細: ' . htmlspecialchars($product['product_body']) . '</h2>';
            echo '<img src="' . htmlspecialchars($product['product_photo']) . '" alt="Product Image">';
            // 他のプロダクト情報をここで表示することもできます
        } else {
            echo '<p>Product not found.</p>';
        }
    }
    ?>
</body>
</html>
