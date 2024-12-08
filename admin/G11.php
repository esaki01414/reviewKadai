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
$id=$_POST['U'] ?? null;
if(!($id)){
    $id = $_SESSION['id'] ?? null;
}
?>
<h1>商品更新確認</h1>
<form action="G12.php" method="POST" enctype="multipart/form-data">
<?php

if(is_uploaded_file($_FILES['image']['tmp_name'])){
    $uploadDir = 'uploads/'.basename($_FILES['image']['name']);
    if(move_uploaded_file($_FILES['image']['tmp_name'],$uploadDir)){
        echo $uploadDir;
    }
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])){
    // 画像ファイルをBase64エンコード
    $imageData = base64_encode(file_get_contents($_FILES['image']['tmp_name']));
    // エンコードされたデータを次のページに送信
    header('Location:G12.php?image_data=' . urlencode($imageData));
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'post'){
    echo '<img src=""><br>';
    echo '商品名:'.$_POST['product_name'];
    echo 'サイズ:'.$_POST['product_size'];
    echo 'カラー:'.$_POST['product_color'];
    echo '在庫数:'.$_POST['inventory_stock'];
    echo '商品説明:'.$_POST['product_body'];
    echo '価格:'.$_POST['product_price'];
    echo '<a href="G10.php?id=' . htmlspecialchars($id) . '">戻る</a>';
}
    ?>
    
    <input type="submit" value="更新">
</form>
<script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->
</body>
</html>