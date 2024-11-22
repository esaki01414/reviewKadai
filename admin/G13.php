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
                <div class="wrapper-title">
                    <h3>新規作成</h3>
                </div>
                <form class="edit-form" method="POST" action="store_product.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <p>管理者ID</p>
                        <?php
                        echo '<select id="maneger_id" name="maneger_id" required>';
                        $pdo = new PDO(
                            'mysql:host=mysql310.phy.lolipop.lan;
                            dbname=LAA1554917-system;charset=utf8',
                            'LAA1554917',
                             'PassSD2D'
                        );
                        $sql='SELECT maneger_id FROM maneger';
                        $stmt = $pdo->query($sql);
                        $rows = $stmt->fetchAll();
                        foreach($rows as $row){
                            echo '<option value="maneger_id">',$row["maneger_id"],'</option>';
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
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
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
                        <input type="text" name="product_body" maxlength="255">
                    </div>
                    <div class="form-group">
                        <p>価格</p>
                        <input type="number" name="product_price" required>
                    </div>
                    
                    <div class="form-group">
                        <p>商品画像</p>
                        <input type="file" name="img" class="imgform">
                    </div>
                    <button type="submit" class="btn btn-blue">登録</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>