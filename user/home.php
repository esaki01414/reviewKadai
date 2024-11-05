<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECサイト</title>
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
        <div class="guest-status">ゲストでログイン中</div> <!-- 追加 -->
        </div>
        <div class="search-bar">
            <input type="text" placeholder="🔎洋服を検索" id="search-input">
            <button onclick="searchProducts()">検索</button>
        </div>
        <div class="category-selection" style="background-color: #aeaeae; padding: 10px; display: flex; justify-content: center;">
            <div class="category-item" style="margin: 10px 60px; cursor: pointer;">すべて</div>
            <div class="category-item" style="margin: 10px 60px; cursor: pointer;">コスメ</div>
            <div class="category-item" style="margin: 10px 60px; cursor: pointer;">シューズ</div>
        </div>
        <div class="hamburger-menu" onclick="toggleMenu()">
            &#9776; <!-- ハンバーガーアイコン -->
        </div>
        <nav id="nav-menu" class="hidden">
            <ul>
                <li><a href="login.php">ログイン画面</a></li>
            <br><br><br><br><br></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section id="gender-selection">
            <div class="gender-selection">
                <div class="gender-button" onclick="selectGender('男性')">
                    <img src="./images/男.jpeg" alt="男性" class="gender-icon" id="male-icon"> <!-- 男性アイコン -->
                </div>
                <div class="gender-button" onclick="selectGender('女性')">
                    <img src="./images/女.jpg" alt="女性" class="gender-icon" id="female-icon"> <!-- 女性アイコン -->
                </div>
                <div class="gender-button" onclick="selectGender('子供')">
                    <img src="./images/子供.jpg" alt="子供" class="gender-icon" id="child-icon"> <!-- 子供アイコン -->
                </div>
            </div>
        </section>

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

        <section id="product-list">
            <div class="product-list" id="product-list-container">
                <!-- 商品リストがここに表示される -->
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 ECサイト</p>
    </footer>
    <script>
        const products = [
            {
                "name": "商品1",
                "image": "./images/画像1.jpg"
            },
            {
                "name": "商品2",
                "image": "./images/画像2.jpg"
            },
            {
                "name": "商品3",
                "image": "./images/画像3.jpg"
            }
        ];

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