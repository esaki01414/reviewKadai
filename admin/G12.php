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
    $imag=[
        'image_type' => $_POST['image_type'],
        'image_content' => $_POST['image_content']
    ];
        var_dump($data);  
    if (is_array($data)) {
        echo '<p>商品ID: ' . $id . '</p>';
        echo '<p>商品名: ' . $data[0] . '</p>';
        echo '<p>サイズ: ' . $data[1] . '</p>';
        echo '<p>在庫数: ' . $data[2] . '</p>';
        echo '<p>カラー: ' . $data[3] . '</p>';
        echo '<p>商品説明: ' . nl2br($data[4]) . '</p>';
        echo '<p>価格: ' . $data[5] . '</p>';

        if (isset($imag['image_type']) && !empty($imag['image_content'])) {
            echo '<img src="data:' .$imag['image_type'] . ';base64,' . base64_encode($imag['image_content']) . '" width="200" height="auto"><br>';
        }
    } else {
        echo '<p>データが正しくありません。</p>';
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