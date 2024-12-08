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
    <title>商品更新画面</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- CSSファイルのリンク -->
</head>
<body>
<?php
$id=$_POST['U'] ?? null;
if(!($id)){
    $id = $_SESSION['id'] ?? null;
}
?>
<div class="wrapper">
    <div class="container">
        <div class="wrapper-title">
    <a href="G9.php?id=<?= $id ?>">戻る</a><br>
    <h1>商品更新</h1>
    </div>
    <form action="G12.php" method="post" enctype="multipart/form-data">
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
    // データベースから編集するデータを取得
    $sql='SELECT * FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // フォームを表示
    foreach($result as $row){
    if($row){
        echo '<img src="data:'.htmlspecialchars($row['image_type']).';base64,'.base64_encode($row['image_content']).'"width="200" height="auto""><br>';
        echo '<input type="hidden" name="product_id" value="'.htmlspecialchars($row['product_id']).'">';  // idを隠しフィールドで送信
        echo '<p>商品名：</p>';
        echo '<input type="text" name="product_name">';
        echo '<p>サイズ:</p>';
        echo '<select id="product_size" name="product_size">';
        echo '<optgroup label="メンズ"></optgroup>';
        echo '<option value="S">S</option>';
        echo '<option value="M">M</option>';
        echo '<option value="L">L</option>';
        echo '<option value="XL">XL</option>';
        echo '<optgroup label="レディース"></optgroup>';
        echo '<option value="S(7号)">S(7号)</option>';
        echo '<option value="M(9号)">M(9号)</option>';
        echo '<option value="L(11号)">L(11号)</option>';
        echo '<option value="LL(13号)">LL(13号)</option>';
        echo '<optgroup label="キッズ"></optgroup>';
        echo '<option value="100">100</option>';
        echo '<option value="110">110</option>';
        echo '<option value="120">120</option>';
        echo '<option value="130">130</option>';
        echo '<optgroup label="その他"></optgroup>';
        echo '<option value="サイズ表記なし">サイズ表記なし</option>';
        echo '</select>';
    }else{
            echo 'データが見つかりませんでした';
        }
    }
            ?>
            <p>カラー:</p>
                <input type="text" name="product_color">
            <p>在庫数：</p>
                <input type="text" name="inventory_stock">
            <p>商品説明:</p>
                <textarea name="product_body" maxlength="255"></textarea>
            <p>価格:</p>
                <input type="number" name="product_price">
            <div class="form-group">
            <p>商品画像:</p>
                <input type="file" name="image" class="imgform"><br><br>
            </div>
        <p><button type="submit" name="product_update" value="<?= $id ?>" class="btn btn-blue">更新</button></p>
    </form>
        </div>
    </div>
    <script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->
</body>
</html>