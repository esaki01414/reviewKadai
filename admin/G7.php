<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー削除完了画面</title>
</head>
<body>
    <?php
    $id=$_POST['D_id'];
    $stmt= $pdo->prepare('DELETE FROM user WHERE user_id = ?');
    $stmt->execute([$id]);
    $count=$stmt->rowCount();
    if(!($count==1)){
        echo '正常にユーザーが削除されませんでした';
    }else{
        echo '<h1>削除完了</h1>';
    }
    ?>
    <a href="G2.php">ホームへ戻る</a>
    </body>
</html>