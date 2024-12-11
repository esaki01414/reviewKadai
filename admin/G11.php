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
    <title>商品更新確認画面</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- CSSファイルのリンク -->
</head>
<body>
<?php
$id=$_POST['product_update'] ?? null;
if(!($id)){
    $id = $_SESSION['id'] ?? null;
}
?>
<h1>商品更新確認</h1>
<form action="G12.php" method="POST" enctype="multipart/form-data">
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $test_product_id=$_POST['product_id'];
        $test_product_name = $_POST['product_name'];
        $test_product_size = $_POST['product_size'];
        $test_product_color = $_POST['product_color'];
        $test_inventory_stock = $_POST['inventory_stock'];
        $test_product_price = $_POST['product_price'];
        $test_product_body = $_POST['product_body'];

    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name']; // アップロードされたファイル名
        $image_type = $_FILES['image']['type']; // アップロードされたファイルタイプ
        $image_content = $_FILES['image']['tmp_name']; // ファイルの内容を取得
        $image_size = $_FILES['image']['size']; // ファイルサイズ
    } else {
        echo '<div class="message error">';
        echo '<a href="./G8.php">商品管理に遷移</a><br>';
        echo 'データが正しく送信されていません。';
        echo '</div>';
        exit;
    }
}
    echo '<p><img src="data:', htmlspecialchars($image_type),
    ';base64,', base64_encode($image_content),
    '" class="mr-3"></p>';
    echo '商品名:',$test_product_name,'<br>';
    echo 'サイズ:',$test_product_size,'<br>';
    echo 'カラー:',$test_product_color,'<br>';
    echo '在庫数:',$test_inventory_stock,'<br>';
    echo '商品説明:',$test_product_body,'<br>';
    echo '価格:',$test_product_price,'<br>';
    echo '<input type="hidden" name="product_id" value="'.$test_product_id.'">';
    echo '<input type="hidden" name="product_name" value="'.$test_product_name.'">';
    echo '<input type="hidden" name="product_size" value="'.$test_product_size.'">';
    echo '<input type="hidden" name="product_color" value="'.$test_product_color.'">';
    echo '<input type="hidden" name="inventory_stock" value="'.$test_inventory_stock.'">';
    echo '<input type="hidden" name="product_price" value="'.$test_product_price.'">';
    echo '<input type="hidden" name="product_body" value="'.$test_product_body.'">';
    echo '<input type="hidden" name="image_name" value="', $image_name ,'">';
    echo '<input type="hidden" name="image_type" value="',$image_type,'">';
    echo '<input type="hidden" name="image_content" value="', $image_content ,'">';
    echo '<input type="hidden" name="image_size" value="', $image_size ,'">';
    ?>
    <input type="button" value="戻る" onclick="history.back()">
    <input type="submit" value="更新">
</form>
<script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->
</body>
</html>