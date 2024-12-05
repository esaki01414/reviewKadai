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
    if(isset($_POST['imag1']) && !empty($_POST['imag1'])){
        $imag1 = $_POST['imag1'];
        $imag2 = $_POST['imag2'];
        $imag3 = $_POST['imag3'];
        $imag4 = $_POST['imag4'];

        $imag_name = json_decode($imag1, true); 
        $imag_type = json_decode($imag2, true); 
        $imag_size = json_decode($imag3, true); 
        $imag_content = json_decode($imag4, true); 

    
        // デコードしたデータを表示
        echo "ファイル名: " . $imag_name . "<br>";
        echo "ファイルタイプ: " . $imag_type . "<br>";
        echo "ファイルサイズ: " . $imag_size . " bytes<br>";
        echo "一時ファイルパス: " . $imag_content . "<br>";
    
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