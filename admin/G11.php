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
if(!empty($_POST['file'])){
    $flg='false';
    if(is_uploaded_file($_FILES['file']['tmp_name'])){
        if(!file_exists('upload_img')){
            mkdir('upload_img');
        }
        $newfile ='upload_img/'.basename($_FILES['file']['name']);
        $img_file_path=$newfile;
        $flg=move_uploaded_file($_FILES['file']['tmp_name'],$newfile);
    }
}
if(!empty($_POST['name'])){
      $name =$_POST['name'];
}
if(!empty($_POST['size'])){
      $size=$_POST['size'];
}
if(!empty($_POST['stock'])){
      $stock=$_POST['stock'];
}
if(!empty($_POST['color'])){
      $color=$_POST['color'];
}
if(!empty($_POST['body'])){
      $body=$_POST['body'];
}
if(!empty($_POST['price'])){
      $price=$_POST['price'];
}
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
    }
    
    ?>
</body>
</html>