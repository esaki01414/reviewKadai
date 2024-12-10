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
    <title>商品詳細画面</title>
    <link rel="stylesheet" href="./css/G9.css"> <!-- CSSファイルのリンク -->
</head>
<body>
    <?php
    $id=$_GET['id'];
    ?>
    <a href="G8.php">戻る</a>
    <h1>商品詳細</h1>
    <div class="container">
    <?php
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
    $sql='SELECT * FROM product WHERE product_id = ?';
       $stmt = $pdo->prepare($sql);
       $stmt->execute([$id]);
       $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){     

        echo '<div class="product-image" style="float:left; margin-right:20px; margin-top:20px;">';
        echo '<img src="data:'.htmlspecialchars($row['image_type']).';base64,'.base64_encode($row['image_content']).'"width="200" height="auto"">';
        echo '</div>';
        
        echo '<div class="product-details">';
        echo '<span class="detail-item"><strong>商品作成日:</strong> ' . htmlspecialchars($row['created_at']) . '</span>';
        echo '<p><strong>商品作成日:</strong> ' . htmlspecialchars($row['created_at']) . '</p>';
        echo '<p><strong>商品画像名:</strong> ' . htmlspecialchars($row['image_name']) . '</p>';
        echo '<p><strong>商品画像サイズ:</strong> ' . htmlspecialchars($row['image_size']) . '</p>';
        echo '<p><strong>商品ID:</strong> ' . htmlspecialchars($row['product_id']) . '</p>';
        echo '<p><strong>商品名:</strong> ' . htmlspecialchars($row['product_name']) . '</p>';
        echo '<p><strong>商品価格:</strong> ' . htmlspecialchars(number_format($row['product_price'])) . '</p>';
        echo '<p><strong>商品サイズ:</strong> ' . htmlspecialchars($row['product_size']) . '</p>';
        echo '<p><strong>商品カラー:</strong> ' . htmlspecialchars($row['product_color']) . '</p>';
        echo '<p><strong>在庫数:</strong> ' . htmlspecialchars($row['inventory_stock']) . '</p>';
        echo '<p><strong>商品説明:</strong> ' . htmlspecialchars($row['product_body']) . '</p>';

        echo '<div class="button-group">';
                // 商品更新ボタン
                echo '<form action="G10.php" method="post">';
                echo '<button type="submit" name="product_update" value="' . $row['product_id'] . '" class="admin-button update-button">';
                echo '<i class="fa fa-edit"></i> 商品更新';
                echo '</button>';
                echo '</form>';
        
                // 商品削除ボタン
                echo '<form action="G16.php" method="post">';
                echo '<button type="submit" name="product_delete" value="' . $row['product_id'] . '" class="admin-button delete-button">';
                echo '<i class="fa fa-trash"></i> 商品削除';
                echo '</button>';
                echo '</form>';
        echo '</div>';

            echo '</div>';
        
       }
       $pdo=null;
    ?>
    </div>
    </div>
        <script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->
</body>
</html>

