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
    <title>商品削除画面</title>
    <link rel="stylesheet" href="css/G3.css">
</head>
<body>
<?php
$id=$_POST['D'] ?? null;
if(!($id)){
    $id = $_SESSION['id'] ?? null;
}
?>
<a href="G9.php?id=<?= $id ?>"><i class="fa-solid fa-cube icon"></i>    
戻る
</a><br>
<div class="label">
<h1>商品削除画面</h1>
</div>
<?php
try {
    $pdo = new PDO(
        'mysql:host=mysql310.phy.lolipop.lan;dbname=LAA1554917-system;charset=utf8',
        'LAA1554917',
        'PassSD2D'
    );
}catch (PDOException $e) {
    echo 'データベース接続に失敗しました: ' . htmlspecialchars($e->getMessage());
    exit;
}
$sql='SELECT image_type,image_content,product_size FROM product WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
    echo '<img src="data:'.htmlspecialchars($row['image_type']).';base64,'.base64_encode($row['image_content']).'"width="400" height="auto""><br>';
    }
?>


</body>
</html>