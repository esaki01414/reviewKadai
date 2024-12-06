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
    <title>商品登録画面</title>
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <!-- CSSファイルのリンク -->
        <link rel="stylesheet" href="css/G13.css">
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
            <a href="G8.php">戻る</a><br>
                <div class="wrapper-title">
                    <h3>新規作成</h3>
                </div>
                <form class="edit-form" method="POST" action="G15.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <p>管理者ID</p>
                        <?php
                        
                        $pdo = new PDO(
                            'mysql:host=mysql310.phy.lolipop.lan;
                            dbname=LAA1554917-system;charset=utf8',
                            'LAA1554917',
                             'PassSD2D'
                        );
                        $sql='SELECT maneger_id FROM maneger';
                        $stmt = $pdo->query($sql);
                        $rows = $stmt->fetchAll();
                        echo '<select id="maneger_id" name="maneger_id" required>';
                        foreach($rows as $row){
                            echo '<option value=',$row["maneger_id"],'>',$row["maneger_id"],'</option>';
                        }
                        echo '</select>';
                        ?>
                    </div>
                    <div class="form-group">
                        <p>商品名</p>
                        <input type="text" name="product_name" required>
                    </div>
                    <div class="form-group">
                        <p>サイズ</p>
                        <select id="product_size" name="product_size" required>
                        <optgroup label="メンズ"></optgroup>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        <optgroup label="レディース"></optgroup>
                            <option value="S(7号)">S(7号)</option>
                            <option value="M(9号)">M(9号)</option>
                            <option value="L(11号)">L(11号)</option>
                            <option value="LL(13号)">LL(13号)</option>
                        <optgroup label="キッズ"></optgroup>
                            <option value="100">100</option>
                            <option value="110">110</option>
                            <option value="110">120</option>
                            <option value="130">130</option>
                        <optgroup label="その他"></optgroup>
                            <option value="サイズ表記なし">サイズ表記なし</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <p>カラー</p>
                        <input type="text" name="product_color" required>
                    </div>
                    <div class="form-group">
                        <p>在庫数</p>
                        <input type="number" name="inventory_stock" required>
                    </div>
                    <div class="form-group">
                        <p>商品説明</p>
                        <textarea name="product_body" maxlength="255"></textarea>
                    </div>
                    <div class="form-group">
                        <p>価格</p>
                        <input type="number" name="product_price" required>
                    </div>
                    
                    <div class="form-group">
                        <p>商品画像</p>
                        <input type="file" name="imag" class="imgform">
                    </div>
                    <button type="submit" class="btn btn-blue">登録</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>