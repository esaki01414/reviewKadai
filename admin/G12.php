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
    $imag= $_POST['imag'];
        
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