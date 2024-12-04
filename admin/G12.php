<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品更新完了画面</title>
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
        $_POST['stock'],
        $_POST['color'],
        $_POST['body'],
        $_POST['price'],
    ];
    echo 'ok';
    if(isset($_POST['imag']) && !empty($_POST['imag'])){
        $imag= $_POST['imag'];
        $image_name = $_FILES['imag']['name']; // アップロードされたファイル名
        $image_type = $_FILES['imag']['type']; // アップロードされたファイルタイプ
        $image_content = file_get_contents($_FILES['imag']['tmp_name']); // ファイルの内容を取得
        $image_size = $_FILES['imag']['size']; // ファイルサイズ
        echo 'ok';
    }elseif(isset($_POST['image_type']) && !empty($_POST['image_type']) && isset($_POST['image_content']) && !empty($_POST['image_content'])){
        $image_type= $_POST['imag_type'];
        $image_content= $_POST['image_content'];
        echo 'ok';
    }
        
} else {
    echo '<p>データが送信されていません。</p>';
}
?>


<a href="G9.php?id=<?= $id ?>">
    <i class="fa-solid fa-cube icon"></i>    
    戻る
</a>
</body>
</html>