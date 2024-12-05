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
    <title>ユーザー一覧管理画面</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- CSSファイルのリンク -->
    <link rel="stylesheet" href="css/G5.css"> <!-- CSSファイルのリンク -->

</head>
<body>
<a href="G2.php">戻る</a><br><br>
    <h1>ユーザー管理</h1>
   <form action="G6.php" method="get">   
    <button type="submit">ユーザー削除</button>
   </form>
   <br>
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
   echo '<div class="bl_media_container">';
echo   '<div class="bl_media_itemWrapper">';
foreach($stmt as $row){
    echo '<div class="user-card">'; 
    echo '<div class="user-info">';
    echo '<strong>ユーザーID：</strong>','<br>', $row['user_id'], '<br>';
    echo '<strong>ユーザー氏名：</strong>','<br>', $row['user_first_name'].$row['user_last_name'], '<br>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';
echo '</div>';
   $pdo=null;
    ?>
    <script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->
</body>
</html>

            
                