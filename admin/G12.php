<?php
       session_start();
       if($_SESSION['admin_login'] == false){
           header("Location:./G1.php");
           exit;
      }
      $maneger_id=$_SESSION['maneger_id'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品更新完了画面</title>
    <link rel="stylesheet" href="css/G12.css"> <!-- CSSファイルのリンク -->
</head>
<body>
<?php
$id=$_POST['product_update'] ?? null;
if(!($id)){
    $id = $_SESSION['id'] ?? null;
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id=$_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_size = $_POST['product_size'];
    $product_color = $_POST['product_color'];
    $inventory_stock = $_POST['inventory_stock'];
    $product_price = $_POST['product_price'];
    $product_body = $_POST['product_body'];
    
    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name']; // アップロードされたファイル名
        $image_type = $_FILES['image']['type']; // アップロードされたファイルタイプ
        $image_content = file_get_contents($_FILES['image']['tmp_name']); // ファイルの内容を取得
        $image_size = $_FILES['image']['size']; // ファイルサイズ
    } else {
        $sql='SELECT * FROM product WHERE product_id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // フォームを表示
        foreach($result as $row){
        $image_content = $row['image_content'];
        $image_type = $row['image_type'];
        $image_name = $row['image_name'];
        $image_size = $row['image_size'];

        }
        
    }
    
    // データベースに登録
    try {
        $sql = "UPDATE product SET maneger_id = ?,product_name = ?, product_size = ?, product_color = ?, inventory_stock = ?,
              product_body = ?, product_price = ?,image_name = ?,image_type = ?,image_content = ?,
              image_size = ? WHERE product_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $maneger_id,
            $product_name,
            $product_size,
            $product_color,
            $inventory_stock,
            $product_body,
            $product_price,
            $image_name,
            $image_type,
            $image_content,
            $image_size,
            $product_id
        ]);
        $pdo=null;

        echo '<div class="message success">';
        echo "<h1>更新完了</h1>";
        echo "商品の更新が完了しました！";
        echo '</div>';
    } catch (PDOException $e) {
        echo '<div class="message error">';
        echo "データベースエラー: " . $e->getMessage();
        echo '</div>';
    }
}else {
    echo '画像データが見つかりません。';
}
?>

<div class="link-container">
    <p><a href="./G8.php">商品管理ページへ</a></p>
    <p><a href="G9.php?id=<?= $id ?>"> 
        <i class="fa-solid fa-cube icon"></i>    
            商品詳細ページへ</a></p>
        </div>

<script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->

</body>
</html>