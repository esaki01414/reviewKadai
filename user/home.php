<?php
session_start();

$pdo = new PDO(
    'mysql:host=mysql310.phy.lolipop.lan;dbname=LAA1554917-system;charset=utf8',
    'LAA1554917',
    'PassSD2D'
);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['user_email'], $_POST['user_pass'])) {
    $sql = 'SELECT * FROM user WHERE user_mail = ? AND user_pass = ?';
    $sql_login = $pdo->prepare($sql);
    $sql_login->execute([$_POST['user_email'], $_POST['user_pass']]);

    $row = $sql_login->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $_SESSION['user_email'] = $row['user_email'] ?? null;
        $_SESSION['user_pass'] = $row['user_pass']  ?? null;
        $_SESSION['user_first_name'] = $row['user_first_name']  ?? null;
        $_SESSION['user_last_name'] = $row['user_last_name']  ?? null;
    } else {
        echo 'ログインに失敗しました。';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECサイト</title>
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="css/guest.css"> <!-- CSSファイルのリンク -->
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center; /* 中央揃え */
            margin-top: 50px; /* 上部の余白 */
        }
        .gender-selection {
            display: flex; /* フレックスボックスを使用 */
            justify-content: center; /* 中央に配置 */
            margin-top: 20px; /* 上部の余白 */
        }
        .gender-button {
            display: inline-block;
            width: 100px; /* ボタンの幅 */
            height: 100px; /* ボタンの高さ */
            margin: 10px;
            cursor: pointer; /* マウスカーソルをポインターに */
        }
        .gender-icon {
            width: 100%; /* アイコンの幅 */
            height: 100%; /* アイコンの高さ */
            border-radius: 10px; /* 角を丸くする */
            transition: opacity 0.3s; /* オパシティの変化をスムーズに */
        }
        .inactive {
            opacity: 0.5; /* 非アクティブ時の不透明度 */
        }
        .product-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px; /* 上部の余白 */
        }
        .product-item {
            margin: 10px;
            text-align: center; /* テキストを中央揃え */
        }
        .product-item img {
            width: 100px; /* 商品画像の幅 */
            height: 100px; /* 商品画像の高さ */
            border: 1px solid #ccc; /* 枠線 */
            border-radius: 5px; /* 角を丸くする */
        }
        .slideshow {
            position: relative;
            width: 300px; /* スライドショーの幅 */
            height: 200px; /* スライドショーの高さ */
            overflow: hidden; /* はみ出した部分を隠す */
            margin-top: 20px; /* 上部の余白 */
        }
        .slides {
            display: flex;
            transition: transform 0.5s ease;
        }
        .slide {
            min-width: 100%; /* 各スライドの幅 */
            height: 100%; /* 各スライドの高さ */
        }
        .hamburger-menu {
            cursor: pointer;
            font-size: 30px; /* アイコンのサイズ */
            position: absolute;
            right: 20px; /* 右端からの距離 */
            top: 20px; /* 上端からの距離 */
        }

        nav {
            position: absolute;
            top: 70px; /* ハンバーガーメニューの下に配置 */
            right: 20px;
            background-color: white; /* メニューの背景色 */
            border: 1px solid #ccc; /* 枠線 */
            border-radius: 5px; /* 角を丸くする */
            box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* 影を追加 */
        }

        nav.hidden {
            display: none; /* 非表示にするクラス */
        }

        nav ul {
            list-style-type: none; /* リストマーカーを削除 */
            padding: 0;
            margin: 0;
        }

        nav li {
            padding: 10px; /* リスト項目の余白 */
        }

        nav li a {
            text-decoration: none; /* 下線を削除 */
            color: black; /* テキストカラー */
        }
    </style>
</head>
<body>
    <header>
        <h1>ECサイトのタイトル</h1>
        <div class="header-info">
        <img src="./images/ユーザーアイコン.jpg" alt="ユーザーアイコン" class="user-icon"> <!-- ユーザーアイコン -->
        <?php
        if(isset($_SESSION['user_first_name'],$_SESSION['user_last_name'])){
            echo '<div class="guest-status">',$_SESSION['user_first_name'].$_SESSION['user_last_name'],'さんようこそ</div>';
        }else{
            echo '<div class="guest-status">ゲストさんようこそ</div>';
        }
        ?>
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
                <li><a href="login.php">ログイン画面</a></li>
                <?php

                if(isset($_SESSION['user_first_name'],$_SESSION['user_last_name'])){
                    echo '<hr>';
                    echo '<li><a href="osirase.php">お知らせ</a></li>';
                    echo '<hr>';
                    echo '<li><a href="#">カート</a></li>';
                    echo '<hr>';
                    echo '<li><a href="#">お気に入り</a></li>';
                    echo '<hr>';
                    echo '<li><a href="profile.php">プロフィール</a></li>';
                    echo '<hr>';
                    echo '<li><a href="#">購入履歴</a></li>';
                    echo '<hr>';
                    echo '<li><a href="logout.php">ログアウト画面</a></li>';
                }

                ?>
            </li>
            </ul>
        </nav>
    </header>
    <marquee>洋服ショッピングサイト開発途中</marquee>
    
    <main>
    <div id="main-content">
        <section id="slideshow">
            <div class="slideshow">

                <div class="slides" id="slides">
                    <div class="slide"><img src="./images/冬コーデ1.jpg" alt="画像1"></div>
                    <div class="slide"><img src="./images/冬コーデ2.jpg" alt="画像2"></div>
                    <div class="slide"><img src="./images/冬コーデ3.jpg" alt="画像3"></div>
                    <div class="slide"><img src="./images/冬コーデ4.jpg" alt="画像4"></div>
                    <div class="slide"><img src="./images/冬コーデ5.jpg" alt="画像5"></div>
                    <div class="slide"><img src="./images/冬コーデ6.jpg" alt="画像6"></div>
                    <div class="slide"><img src="./images/冬コーデ7.jpg" alt="画像7"></div>
                </div>
            </div>
        </section>
                <br><br>               <br><br>
        <p style="text-decoration:underline;" ><b>商品</b></p>
        <section id="product-list">
            <div class="product-list" id="product-list-container">
                <!-- 商品リストがここに表示される -->
                <?php
                    $pdo = new PDO(
                        'mysql:host=mysql310.phy.lolipop.lan;dbname=LAA1554917-system;charset=utf8',
                        'LAA1554917',
                        'PassSD2D'
                    );
                    echo '<form action="./product.php" method="post">';
                    echo '<p>';
                    foreach ($pdo->query('SELECT * FROM product') as $row) {
                        echo '<div class="product_all">';
                        echo '<button style="outline: none;" type="submit" name="product_id" value="', $row['product_id'], '">', htmlspecialchars($row['product_name']), '</button>';
                        echo '<p><img src="', htmlspecialchars($row['product_photo']), '" alt="Product Image"></p>';
                        echo '</div>';
                    }
                    echo '</p>';
                    echo '</form>';
                    ?>                
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

        // 性別を選択する関数
        function selectGender(gender) {
            const maleIcon = document.getElementById('male-icon');
            const femaleIcon = document.getElementById('female-icon');
            const childIcon = document.getElementById('child-icon');

            maleIcon.classList.add('inactive');
            femaleIcon.classList.add('inactive');
            childIcon.classList.add('inactive');

            if (gender === '男性') {
                maleIcon.classList.remove('inactive');
            } else if (gender === '女性') {
                femaleIcon.classList.remove('inactive');
            } else if (gender === '子供') {
                childIcon.classList.remove('inactive');
            }
        }

        // スライドショーの自動再生
        function showSlides() {
            const slides = document.getElementById('slides');
            currentSlideIndex++;
            if (currentSlideIndex >= totalSlides) {
                currentSlideIndex = 0;
            }
            slides.style.transform = `translateX(-${currentSlideIndex * 100}%)`;
        }

        // ページが読み込まれた時に商品を表示
        window.onload = () => {
            displayProducts();
            setInterval(showSlides, 3000); // 3秒ごとにスライドを切り替え
        };
        function toggleMenu() {
            const navMenu = document.getElementById('nav-menu');
            navMenu.classList.toggle('open'); // メニューの開閉をトグル
        }

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
