<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品更新画面</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- CSSファイルのリンク -->
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/G13.css">

</head>
<body>
    <?php
$id=$_POST['U'] ?? null;
if(!($id)){
    $id = $_SESSION['id'] ?? null;
}
?>
<a href="G9.php?id=<?= $id ?>">
<i class="fa-solid fa-cube icon"></i>    
戻る
</a><br>
        <div class="wrapper">
            <div class="container">
                <div class="wrapper-title">
    <h1>商品更新</h1>
             </div>
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
    $sql='SELECT image_type,image_content,product_size FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
    echo '<img src="data:'.htmlspecialchars($row['image_type']).';base64,'.base64_encode($row['image_content']).'"width="200" height="auto""><br>';
    }
    ?>
    <form action="G11.php" method="post" enctype="multipart/form-data">
        <p>商品名：</p>
        <input type="text" name="name">
        <p>サイズ</p>
            <select name="size">
            <?php foreach($result as $row): ?>
                <option value="" selected disabled><?= htmlspecialchars($row['product_size']) ?></option>
                <optgroup label="メンズ"></optgroup>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                <optgroup label="レディース"></optgroup>
                    <option value="S(7号)">S(7号)</option>
                    <option value="M(9号)">M(9号)</option>
                    <option value="L(11号)">L(11号)</option>
                    <option value="LL(13号)">LL(13号)</option>
                <optgroup label="キッズ"></optgroup>
                    <option value="100">100</option>
                    <option value="110">110</option>
                    <option value="110">120</option>
                    <option value="130">130</option>
                <optgroup label="その他"></optgroup>
                    <option value="サイズ表記なし">サイズ表記なし</option>
            </select>
            <?php endforeach; ?>
        <p>在庫数：</p>
        <input type="text" name="stock">
        <p>カラー</p>
        <input type="text" name="color">     
        <p>商品説明</p>
        <input type="text" name="body" maxlength="255">
        <p>価格</p>
        <input type="number" name="price">
        <div class="form-group">
        <p>商品画像</p>
        <input type="file" name="file" class="imgform"><br><br>
        </div>
        <p><button type="submit" name="U" value="<?= $id ?>" class="btn btn-blue">>確認</button></p>
    </form>
    </div>
    </div>
    <script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->
</body>
</html>