<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品更新確認画面</title>
</head>
<body>
<?php
$id=$_POST['U'] ?? null;
if(!($id)){
    $id = $_SESSION['id'] ?? null;
}
?>
<a href="G10.php">戻る</a><br><br>
<h1>商品更新確認</h1>
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
if(!empty($_POST['file'])){
    $flg='false';
    if(is_uploaded_file($_FILES['file']['tmp_name'])){
        if(!file_exists('upload_img')){
            mkdir('upload_img');
        }
        $newfile ='upload_img/'.basename($_FILES['file']['name']);
        $imag=$newfile;
        $flg=move_uploaded_file($_FILES['file']['tmp_name'],$newfile);
    }
}else{
    $sql='SELECT image_type,image_content FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $imag = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($imag as $row){
        echo '<img src="data:'.htmlspecialchars($row['image_type']).';base64,'
        .base64_encode($row['image_content']).'"width="200" height="auto""><br>';
        }
}

if(!empty($_POST['name'])){
      $name =$_POST['name'];
      echo $name;
}else{
    $sql='SELECT product_name FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $name=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($name as $row){
        echo $row['product_name'];
        }
}

if(!empty($_POST['size'])){
      $size=$_POST['size'];
      echo $size;
}else{
    $sql='SELECT product_size FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $size=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($size as $row){
        echo $row['product_size'];
        }
}

if(!empty($_POST['stock'])){
      $stock=$_POST['stock'];
      echo $stock;
}else{
    $sql='SELECT inventory_stock FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $stock=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($stock as $row){
        echo $row['inventory_stock'];
        }
}
if(!empty($_POST['color'])){
      $color=$_POST['color'];
      echo $color;
}else{
    $sql='SELECT product_color FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $color=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($color as $row){
        echo $row['product_color'];
        }
}
if(!empty($_POST['body'])){
      $body=$_POST['body'];
      echo $body;
}else{
    $sql='SELECT product_body FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $body=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($size as $row){
        echo $row['product_body'];
        }
}
if(!empty($_POST['price'])){
      $price=$_POST['price'];
      echo $price;
}else{
    $sql='SELECT product_price FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $price=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($price as $row){
        echo $row['product_price'];
        }
}
    ?>
</body>
</html>