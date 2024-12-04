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

if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {    
    $flg='false';
    if(is_uploaded_file($_FILES['file']['tmp_name'])){
        if(!file_exists('upload_img')){
            mkdir('upload_img');
        }
        $newfile ='upload_img/'.basename($_FILES['file']['name']);
        $imag=$newfile;
        $flg=move_uploaded_file($_FILES['file']['tmp_name'],$newfile);
        echo '<img src="' . $imag.'"height="200">','<br>';
        if (!empty($_FILES['file']['name'])) {
            $image_name = $_FILES['file']['name']; // アップロードされたファイル名
            $image_type = $_FILES['file']['type']; // アップロードされたファイルタイプ
            $image_content = file_get_contents($_FILES['file']['tmp_name']); // ファイルの内容を取得
            $image_size = $_FILES['file']['size']; // ファイルサイズ
            $image=[$image_name,$image_type,$image_content,$image_size];
        } else {
            echo '<div class="message error">';
            echo '<a href="./G8.php">商品管理に遷移</a><br>';
            echo 'データが正しく送信されていません。';
            echo '</div>';
            exit;
        }
    }  
}else{
    $sql='SELECT image_type,image_content FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
        echo '<img src="data:'.htmlspecialchars($row['image_type']).';base64,'
        .base64_encode($row['image_content']).'"width="200" height="auto""><br>';
        $imag=[
            'image_type' => $row['image_type'],
            'image_content' => $row['image_content']
        ];
        }
    }

    echo '<p>商品ID：</p>';
    echo '<p>',$id,'</p>';
if(!empty($_POST['name'])){
      $name =$_POST['name'];
      echo '<p>商品名：</p>';
      echo $name;
}else{
    $sql='SELECT product_name FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
        echo '<p>商品名：</p>';
        echo $row['product_name'];
        $name=$row['product_name'];
        }
}

if(!empty($_POST['size'])){
      $size=$_POST['size'];
      echo '<p>サイズ：</p>';
      echo $size;
}else{
    $sql='SELECT product_size FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
        echo '<p>サイズ：</p>';
        echo $row['product_size'];
        $size=$row['product_size'];
        }
}

if(!empty($_POST['stock'])){
      $stock=$_POST['stock'];
      echo '<p>在庫数：</p>';
      echo $stock;
}else{
    $sql='SELECT inventory_stock FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
        echo '<p>在庫数：</p>';
        echo $row['inventory_stock'];
        $stock=$row['inventory_stock'];
        }
}
if(!empty($_POST['color'])){
      $color=$_POST['color'];
      echo '<p>カラー：</p>';
      echo $color;
}else{
    $sql='SELECT product_color FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
        echo '<p>カラー：</p>';
        echo $row['product_color'];
        $color=$row['product_color'];
        }
}
if(!empty($_POST['body'])){
      $body=nl2br($_POST['body']);
      echo '<p>商品説明：</p>';
      echo $body;
}else{
    $sql='SELECT product_body FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
        echo '<p>商品説明：</p>';
        echo $row['product_body'];
        $body=$row['product_body'];
        }
}
if(!empty($_POST['price'])){
      $price=$_POST['price'];
      echo '<p>価格：</p>';
      echo $price;
}else{
    $sql='SELECT product_price FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
        echo '<p>価格：</p>';
        echo $row['product_price'];
        $price=$row['product_price'];
        }
}

    ?>
   <form action="G12.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="name" value="<?= htmlspecialchars($name) ?>">
    <input type="hidden" name="size" value="<?= htmlspecialchars($size) ?>">
    <input type="hidden" name="stock" value="<?= htmlspecialchars($stock) ?>">
    <input type="hidden" name="color" value="<?= htmlspecialchars($color) ?>">
    <input type="hidden" name="body" value="<?= htmlspecialchars($body) ?>">
    <input type="hidden" name="price" value="<?= htmlspecialchars($price) ?>">
    <input type="hidden" name="image_type0" value="<?= htmlspecialchars($imag['image_type']) ?? null ?>">
    <input type="hidden" name="image_content0" value="<?= htmlspecialchars($imag['image_content']) ?? null ?>">
    <input type="hidden" name="imag" value="<?= $image ?? null ?>">
    <p><button type="submit" name="U" value="<?= $id ?>">更新</button></p>
</form>
</body>
</html>