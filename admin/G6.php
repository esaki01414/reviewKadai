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
    <link rel="stylesheet" href="css/G6.css"> <!-- CSSファイルのリンク -->
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
    <header class="main-header">
        <a href="G5.php" class="back-link">戻る</a>
        <h1>ユーザー削除</h1>
            </form>
    </header>
    <main>
    <div class="center-container"> 
    <form action="G7.php" method="post">  
    <label for="D_id">ユーザーID：</label>
    <select name="D_id"id="D_id">
        <?php
        foreach($stmt as $row){
     echo '<option value="',$row['user_id'],'">',$row['user_id'],' ',$row['user_first_name'].$row['user_last_name'],'</option>';
        }
        ?>
    </select><br>
    <p><button type="submit">削除</button></p>
   </form>
    </div>
    </main>
   <script src="js/script.js"></script> <!-- JavaScriptファイルのリンク -->
    </body>
</html>