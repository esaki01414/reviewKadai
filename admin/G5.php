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
    <h1>ユーザー管理</h1>
   <a href="dashboard.php">戻る</a>
   <form action="G6.php" method="get">   
    <button type="submit">ユーザー削除</button>
   </form>
   <br>
   <?php
   $pdo = new PDO(
    'mysql:host=mysql310.phy.lolipop.lan;
    dbname=LAA1554917-system;charset=utf8',
    'LAA1554917',
     'PassSD2D'
);
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

            
                