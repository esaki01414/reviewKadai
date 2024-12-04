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
    $data = $_POST['data'];
        var_dump($data);  
    if (is_array($data)) {
        echo '<p>商品ID: ' . $id . '</p>';
        echo '<p>商品名: ' . htmlspecialchars($data[0]) . '</p>';
        echo '<p>サイズ: ' . htmlspecialchars($data[1]) . '</p>';
        echo '<p>在庫数: ' . htmlspecialchars($data[2]) . '</p>';
        echo '<p>カラー: ' . htmlspecialchars($data[3]) . '</p>';
        echo '<p>商品説明: ' . htmlspecialchars(nl2br($data[4])) . '</p>';
        echo '<p>価格: ' . htmlspecialchars($data[5]) . '</p>';

        if (isset($data[6]) && !empty($data[6])) {
            echo '<img src="data:' .$data[6]['image_type'] . ';base64,' . base64_encode($data[6]['image_content']) . '" width="200" height="auto"><br>';
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