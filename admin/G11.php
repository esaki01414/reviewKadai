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

if ($_SERVER['REQUEST_METHOD'] === 'post'){
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
        $image_content = file_get_contents($_FILES['image']['tmp_name']); // ファイルの内容を取得
        $image_size = $_FILES['image']['size']; // ファイルサイズ
        if(!file_exists('upload')){
            mkdir('upload');
        }
        if(move_uploaded_file($_FILES['image']['tmp_name'], $filePath)){
            $image_file='upload/'.basename($_FILES['image']['name']);
        }
    } else {
        echo '<div class="message error">';
        echo '<a href="./G8.php">商品管理に遷移</a><br>';
        echo 'データが正しく送信されていません。';
        echo '</div>';
        exit;
    }
    echo '<img src="',$image_file,'"><br>';
    echo '商品名:'.$test_product_name;
    echo 'サイズ:'.$test_product_size;
    echo 'カラー:'.$test_product_color;
    echo '在庫数:'.$test_inventory_stock;
    echo '商品説明:'.$test_product_body;
    echo '価格:'.$test_product_price;
    echo '<a href="G10.php?id=' . htmlspecialchars($id) . '">戻る</a>';
}
    
    ?>
    
    <input type="submit" value="更新">
</form>
<script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->
</body>
</html>