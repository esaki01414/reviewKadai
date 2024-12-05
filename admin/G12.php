<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品更新完了画面</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- CSSファイルのリンク -->
</head>
<body>
<h1>更新完了</h1>
<?php
$id=$_POST['U'] ?? null;
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

if (isset($_POST['U']) && !empty($_POST['U'])) {
    $data = [
        $_POST['name'],
        $_POST['size'],
        $_POST['color'],
        $_POST['stock'],
        $_POST['body'],
        $_POST['price'],
    ];
    if(isset($_POST['imag']) && !empty($_POST['imag'])){
        $image_name = $_POST['imag']['name']; // アップロードされたファイル名
        $image_type = $_POST['imag']['type']; // アップロードされたファイルタイプ
        $image_content = file_get_contents($_POST['imag']['tmp_name']); // ファイルの内容を取得
        $image_size = $_POST['imag']['size']; // ファイルサイズ
        echo 'ok';
    }elseif(isset($_POST['image_type']) && !empty($_POST['image_type']) && isset($_POST['image_content']) && !empty($_POST['image_content'])){
        $image_type= $_POST['image_type'];
        $image_content= $_POST['image_content'];
        $sql='UPDATE product SET product_name = ?, product_size = ?, product_color = ?, inventory_stock = ?,
              product_body = ?, product_price = ? WHERE product_id = ?';
    $stmt = $pdo->prepare($sql);
    $result=$stmt->execute([$data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$id]);
    $row_count=$stmt->rowCount();
        if($row_count==1){
            echo '<h1>更新完了</h1>';
            echo 'データが正常に更新されました。';
        }else{
            echo '<h1>更新失敗</h1>';
            echo 'データの更新に失敗しました。';
        }

    }else{
        echo '<p>データが正常ではありません。</p>';

    }
        
} else {
    echo '<p>データが送信されていません。</p>';
}
?>


<p><a href="G9.php?id=<?= $id ?>">
    <i class="fa-solid fa-cube icon"></i>    
    商品詳細ページへ戻る
</a></p>
<script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->

</body>
</html>