<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品削除完了画面</title>
    <link rel="stylesheet" href="css/G4.css">
</head>
<body>
<div class="label">
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
     $id=$_POST['product_id'];
     $stmt= $pdo->prepare('DELETE  FROM product WHERE product_id = ?');
     $stmt->execute([$id]);
     $count=$stmt->rowCount();
     if(!($count==1)){
         echo '正常にユーザーが削除されませんでした';
     }else{
         echo '<h1>削除完了</h1>';
     }
     $pdo=null;
    ?>
</div>
    <div class="back">
    <p><a href="G8.php">商品管理へ戻る</a></p>
    </div>
<script src="js/script.js"></script>
</body>
</html>