<?php
       session_start();
       if($_SESSION['admin_login'] == false){
           header("Location:./G1.php");
           exit;
      }
?>
<?php
$id=$_POST['product_update'] ?? null;
if(!($id)){
    $id = $_SESSION['id'] ?? null;
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
<div class="wrapper">
    <div class="container">
        <div class="wrapper-title">
    <a href="G9.php?id=<?= $id ?>">戻る</a><br>
    <h1>商品更新</h1>
    </div>
    <form action="G11.php" method="post" enctype="multipart/form-data">
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
        echo '<input type="text" name="product_name" value="'.htmlspecialchars($row['product_name']).'">';
        echo '<p>サイズ:</p>';
        echo '<select id="product_size" name="product_size">';
        echo '<option>'.htmlspecialchars($row['product_size']).'</option>';
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
        echo '<p>カラー:</p>';
        echo         '<input type="text" name="product_color" value="'.htmlspecialchars($row['product_color']).'">';
        echo     '<p>在庫数：</p>';
        echo         '<input type="text" name="inventory_stock" value="'.htmlspecialchars($row['inventory_stock']).'">';
        echo     '<p>商品説明:</p>';
        echo         '<textarea name="product_body" maxlength="255">'.htmlspecialchars($row['product_body']).'</textarea>';
        echo     '<p>価格:</p>';
        echo         '<input type="number" name="product_price" value="'.htmlspecialchars($row['product_price']).'">';
        echo     '<div class="form-group">';
        echo     '<p>商品画像:</p>';
        echo         '<input type="file" name="image" class="imgform"><br><br>';
        echo     '</div>';
    }else{
            echo 'データが見つかりませんでした';
        }
    }
            ?>
            
        <p><button type="submit" name="product_update" value="<?= $id ?>" class="btn btn-blue">確認</button></p>
    </form>
        </div>
    </div>
    <script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->
</body>
</html>