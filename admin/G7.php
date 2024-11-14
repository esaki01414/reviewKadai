<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー削除完了画面</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- CSSファイルのリンク -->
</head>
<body>
    <?php
     $pdo = new PDO(
        'mysql:host=mysql310.phy.lolipop.lan;
        dbname=LAA1554917-system;charset=utf8',
        'LAA1554917',
         'PassSD2D'
    );
    $id=$_POST['D_id'];
    $stmt= $pdo->prepare('DELETE FROM user WHERE user_id = ?');
    $stmt->execute([$id]);
    $count=$stmt->rowCount();
    if(!($count==1)){
        echo '正常にユーザーが削除されませんでした';
    }else{
        echo '<h1>削除完了</h1>';
    }
    $pdo=null;
    ?>
    <a href="G2.php">ホームへ戻る</a>
    <script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->
    </body>
</html>