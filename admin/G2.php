<?php
session_start();
       if($_SESSION['admin_login'] == false){
           header("Location:./G1.php");
           exit;
      }

      $pdo = new PDO(
        'mysql:host=mysql310.phy.lolipop.lan;dbname=LAA1554917-system;charset=utf8',
        'LAA1554917',
        'PassSD2D'
    );

    // 管理者IDを取得
    $maneger_id=$_SESSION['maneger_id'];

    $stmt = $pdo->prepare("SELECT * FROM maneger WHERE maneger_id = :id");
    $stmt->bindParam(':id', $maneger_id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ダッシュボード</title>
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/46129fa547.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/dashboard.css"> <!-- CSSファイルのリンク -->
</head>
<body>
    <header>
        <div class="container">
            <div class="header-logo">
                <h1><a href="G2.php">管理画面</a></h1>
            </div>

            <nav class="menu-right menu">
                <a href="logout.php">ログアウト</a>
            </nav>
        </div>
    </header>
    <main>
        <div class="wrapper">
            <div class="container">
                <div class="wrapper-title">
                    <h3>管理者ホーム</h3>
                    <!-- ここにログイン情報 -->
                    <?php
                    foreach ($results as $row) {
                        echo '<b>ログインアカウント：'.$row['maneger_name'].'さん</b>';
                    }
                    ?>
                </div>
                <div class="boxs">
                    <a href="G8.php" class="box">
                    <i class="fa-solid fa-cube icon"></i><!-- fontawesome利用部分 -->
                        <p>商品管理</p>
                    </a>
                    <a href="G5.php" class="box">
                    <i class="fa-solid fa-users icon"></i><!-- fontawesome利用部分 -->
                        <p>ユーザー管理</p>
                    </a>
                    <a href="G3.php" class="box">
                    <i class="fa-solid fa-user-plus icon"></i><!-- fontawesome利用部分 -->
                        <p>新規登録</p>
                    </a>
                </div>
                    
                </div>
            </div>
        </div>
    </main>
</body>
</html>