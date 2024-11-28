<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品更新画面</title>
</head>
<body>
<a href="G9.php">戻る</a><br><br>
    <h1>商品更新</h1>
    <?php
    $id=$_POST['U'];
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
    $sql='SELECT image_type,image_content FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
    echo '<img src="data:'.htmlspecialchars($row['image_type']),';base64,',base64_encode($row['image_content']),'"width="200" height="auto""><br>';
    }
    ?>
    <form action="G11.php" method="post">
        <label>商品名：</label>
        <input type="text" name="name">
        <label>在庫数：</label>
        <input type="text" name="stock">
        <button type="submit" name="C" value="<?= $id ?>">確認</button>
    </form>

</body>
</html>