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

if (isset($_POST['U'])) {
    $U = json_decode($_POST['U'], true);    // Now you can use the $result array
}
for($i=0;$i<=7;$i++){
  echo $U['data'][$i];
}
?>
<a href="G9.php?id=<?= $id ?>">
<i class="fa-solid fa-cube icon"></i>    
戻る
</a>
</body>
</html>