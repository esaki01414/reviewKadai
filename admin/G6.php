<?php
       session_start();
       if($_SESSION['admin_login'] == false){
           header("Location:./G1.php");
           exit;
      }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー削除画面</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- CSSファイルのリンク -->
</head>
<body>
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
    $sql='SELECT user_id, user_first_name, user_last_name FROM user';
     $stmt = $pdo->query($sql);
    ?>
<a href="G5.php">戻る</a><br><br>
    <h1>ユーザー削除</h1><br><br>
    <form action="G7.php" method="post">   
    ユーザーID<br>
    <select name="D_id">
        <?php
        foreach($stmt as $row){
     echo '<option value="',$row['user_id'],'">',$row['user_id'],' ',$row['user_first_name'].$row['user_last_name'],'</option>';
        }
        ?>
    </select><br><br><br>
    <p><button type="submit">削除</button></p>
   </form>
   <script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->
    </body>
</html>