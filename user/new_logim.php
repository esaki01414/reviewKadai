<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home2.css">
    <title>新規登録画面</title>
</head>
<header>
    <h1>自分好みのコーデを見つけよう！</h1>
</header>
<body>
    
    <div class="container">
        <div class="back"><a href="./index.html">←戻る</a></div>

        <div class="profile-icon"></div>

        <div class="tabs">
           <a href="home.html" class="login_tab">Login</a>
            <div class="new_login_tab">新規登録</div>
        </div>

        <form class="login-form" action="home_login.html" method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="user_email" placeholder="23000@s.asojuku.ac.jp" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="user_pass" placeholder="英数字含む8文字以上" required>

            <div class="name-inputs">
                <div>
                    <label for="last-name">姓</label>
                    <input type="text" id="last-name" placeholder="姓を入力" required>
                </div>
                <div>
                    <label for="first-name">名</label>
                    <input type="text" id="first-name" placeholder="名を入力" required>
                </div>
            </div>
            <div class="kana-inputs">
                <div>
                    <label for="last-name-kana">姓(カタカナ)</label>
                    <input type="text" id="last-name-kana" placeholder="セイを入力" required>
                </div>
                <div>
                    <label for="first-name-kana">名(カタカナ)</label>
                    <input type="text" id="first-name-kana" placeholder="メイを入力" required>
                </div>
            </div>
            <label for="address">お届け先住所</label>
            <div class="address-inputs">
                <span>〒</span>
                <input type="text" id="postal-code-1" placeholder="123" maxlength="3" required>
                <span>ー</span>
                <input type="text" id="postal-code-2" placeholder="4567" maxlength="4" required>
            </div>
            <input type="text" id="address" placeholder="住所を入力" required>
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>
</body>
</html>
