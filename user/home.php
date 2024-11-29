<?php
session_start();

$user_mail = $_POST['user_email'] ?? null;
$user_pass = $_POST['user_pass'] ?? null;

if($user_mail){
    if($user_pass){
        
    }else{
        $user_mail= $_SESSION['user_mail'];
        $user_pass = $_SESSION['user_pass'];
    }
}


$pdo = new PDO(
    'mysql:host=mysql310.phy.lolipop.lan;dbname=LAA1554917-system;charset=utf8',
    'LAA1554917',
    'PassSD2D'
);

$sql='select * from user where user_mail = ? AND user_pass = ?';
$sql_login=$pdo->prepare($sql);
$sql_login->execute([$user_mail,$user_pass]);
 
foreach($sql_login as $row){
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['user_first_name'] = $row['user_first_name'];
    $_SESSION['user_last_name'] = $row['user_last_name'];
    $_SESSION['user_mail'] = $row['user_mail'];
    $_SESSION['user_pass'] = $row['user_pass'];
    
}
// 画像情報を取得
$sql = 'SELECT image_name,image_type,image_content,image_size FROM product'; 
$stmt = $pdo->prepare($sql); // クエリを準備
$stmt->execute(); // クエリを実行
$images = $stmt->fetchAll();

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECサイト</title>
    <link rel="stylesheet" href="css/guest.css"> <!-- CSSファイルのリンク -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>
<body>
    <header>
        <h1>ECサイトのタイトル</h1>
        <div class="header-info">
            <div class="user-section">
        <img src="./images/ユーザーアイコン.jpg" alt="ユーザーアイコン" class="user-icon"> <!-- ユーザーアイコン -->
        <?php
        if (isset($_SESSION['user_first_name'], $_SESSION['user_last_name'])) {
            echo '<div class="guest-status">', htmlspecialchars($_SESSION['user_first_name']), ' ', htmlspecialchars($_SESSION['user_last_name']), 'さんようこそ</div>';
        } else {
            echo '<div class="guest-status">ゲストさんようこそ</div>';
        }
        ?>
            </div>
        </div>

        <div class="search-container">
        <div class="search-bar">
            <input type="text" placeholder="🔎洋服を検索" id="search-input">
        </div>
            <button class="search-button" onclick="searchProducts()">検索</button>
        </div>

        <div class="hamburger-menu" onclick="toggleMenu()">
            &#9776; <!-- ハンバーガーアイコン -->
        </div>
        <nav id="nav-menu" class="hidden">
            <ul>
                <li><i class="fas fa-sign-in-alt"></i><a href="login.php">：ログイン画面</a></li>
                <?php

                if(isset($_SESSION['user_first_name'],$_SESSION['user_last_name'])){
                    echo '<hr>';
                    echo '<li><i class="far fa-file-alt"></i><a href="osirase.php">：お知らせ</a></li>';
                    echo '<hr>';
                    echo '<li><i class="fas fa-shopping-cart"></i><a href="cart.php">：カート</a></li>';
                    echo '<hr>';
                    echo '<li><i class="fas fa-heart"></i><a href="favorite.php">：お気に入り　</a></li>';
                    echo '<hr>';
                    echo '<li><i class="fas fa-user-cog"></i><a href="profile.php">：プロフィール</a></li>';
                    echo '<hr>';
                    echo '<li><i class="fas fa-yen-sign"></i><a href="order_history">：購入履歴　　</a></li>';
                    echo '<hr>';
                    echo '<li><i class="fas fa-sign-out-alt"></i><a href="logout.php">：ログアウト　</a></li>';
                }

                ?>
                        <script src="js/toggleMenu.js"></script>
            </li>
            </ul>
        </nav>
    </header>
    
    
    <main>
    <div id="main-content">
        <section id="slideshow">
            <div class="slideshow">
                <div class="slides" id="slides">
                    <div class="slide"><img src="./images/冬コーデ1.jpg" alt="画像1"></div>
                    <div class="slide"><img src="./images/冬コーデ2.jpg" alt="画像1"></div>
                    <div class="slide"><img src="./images/冬コーデ3.jpg" alt="画像1"></div>
                    <div class="slide"><img src="./images/冬コーデ4.jpg" alt="画像1"></div>
                    <div class="slide"><img src="./images/冬コーデ5.jpg" alt="画像1"></div>
                    <div class="slide"><img src="./images/冬コーデ6.jpg" alt="画像1"></div>
                    <div class="slide"><img src="./images/冬コーデ7.jpg" alt="画像1"></div>
                </div>
            </div>
        </section>
        <script src="js/home.js"></script>
                <br><br>               <br><br>
                <b><marquee>季節限定商品のキャンペーン開催中</marquee></b>
                
    <b><p style="text-decoration:underline; text-align: center;" >商品</p></b>
        <section id="product-list">
            <div class="product-list" id="product-list-container">
                <!-- 商品リストがここに表示される -->
                <form action="./product.php" method="post">
                <div class="product-list">
                <?php
                foreach ($pdo->query('SELECT * FROM product') as $row) {
                    echo '<div class="product_all" style="margin-right: 20px; margin-bottom: 20px; display: inline-block;">';
                    echo '<button type="submit" name="product_id" value="', htmlspecialchars($row['product_id']), '">';
                    echo htmlspecialchars($row['product_name']);
                    echo '</button>';
                    
                    // 画像データを表示
                    echo '<p><img src="data:', htmlspecialchars($row['image_type']), 
                            ';base64,', base64_encode($row['image_content']), 
                            '" width="200" height="auto" class="mr-3"></p>';

                    echo '</div>';
                }
                ?>

                </div>
                </form>              
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 ECサイト</p>
    </footer>
    <script>
        const productListContainer = document.getElementById('product-list-container');
        let currentSlideIndex = 0;
        const totalSlides = 7;

        // 商品を表示する関数
        function displayProducts() {
            products.forEach(product => {
                const productItem = document.createElement('div');
                productItem.classList.add('product-item');

                const productImage = document.createElement('img');
                productImage.src = product.image;
                productImage.alt = product.name;

                const productName = document.createElement('div');
                productName.textContent = product.name;

                productItem.appendChild(productImage);
                productItem.appendChild(productName);
                productListContainer.appendChild(productItem);
            });
        }

        // スライドショーの自動再生

        // ページが読み込まれた時に商品を表示
        window.onload = () => {
            displayProducts();
            setInterval(showSlides, 3000); // 3秒ごとにスライドを切り替え
        };

        window.onload = () => {
            displayProducts();
            setInterval(showSlides, 3000);
        };
        // 省略
        function toggleMenu() {
            const navMenu = document.getElementById('nav-menu');
            navMenu.classList.toggle('hidden'); // hiddenクラスをトグル
        }

        window.onload = () => {
            displayProducts();
            setInterval(showSlides, 3000);
        };
    </script>
</body>
</html>
