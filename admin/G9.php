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
    <link rel="stylesheet" href="css/styles.css"> <!-- CSSファイルのリンク -->
</head>
<body>
    <?php
    $id=$_GET['id'];
    ?>
    <a href="G8.php">戻る</a><br>
    <h1>商品詳細</h1>
    <br>
    <form action="G10.php" method="post">
        <button type="submit" name="U" value="<?= $id ?>">商品更新</button>
    </form>
    <br><br>
    <form action="G16.php" method="post">
        <button type="submit" name="D" value="<?= $id ?>">商品削除</button>
    </form>
    <br>
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
        echo '<img src="data:'.htmlspecialchars($row['image_type']).';base64,'.base64_encode($row['image_content']).'"width="200" height="auto""><br>';
        echo '<p>商品ID:</p>';
        echo '<p>',htmlspecialchars($row['product_id']),'</p>';
        echo '<p>商品名:</p>';
        echo '<p>',htmlspecialchars($row['product_name']),'</p>';
        echo '<p>在庫数</p>';
        echo '<p>',htmlspecialchars($row['inventory_stock']),'</p>';
       }
       $pdo=null;
    ?>
        <script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->
</body>
</html>

