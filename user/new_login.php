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
    <div class="back-button"><a href="./home.php">←戻る</a></div>
    <div class="profile-icon"></div>

        <div class="profile-icon"></div>

        <div class="tabs">
           <a href="login.php" class="login_tab">Login</a>
            <div class="new_login_tab">新規登録</div>
        </div>

        <form class="login-form" action="home_login.php" method="post">
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
            <label for="todohuken">都道府県</label>
                <select id="prefecture" required>
                    <option value="" disabled selected>都道府県を選択</option>
                    <option value="北海道">北海道</option>
                    <option value="青森県">青森県</option>
                    <option value="岩手県">岩手県</option>
                    <option value="宮城県">宮城県</option>
                    <option value="秋田県">秋田県</option>
                    <option value="山形県">山形県</option>
                    <option value="福島県">福島県</option>
                    <option value="茨城県">茨城県</option>
                    <option value="栃木県">栃木県</option>
                    <option value="群馬県">群馬県</option>
                    <option value="埼玉県">埼玉県</option>
                    <option value="千葉県">千葉県</option>
                    <option value="東京都">東京都</option>
                    <option value="神奈川県">神奈川県</option>
                    <option value="新潟県">新潟県</option>
                    <option value="富山県">富山県</option>
                    <option value="石川県">石川県</option>
                    <option value="福井県">福井県</option>
                    <option value="山梨県">山梨県</option>
                    <option value="長野県">長野県</option>
                    <option value="岐阜県">岐阜県</option>
                    <option value="静岡県">静岡県</option>
                    <option value="愛知県">愛知県</option>
                    <option value="三重県">三重県</option>
                    <option value="滋賀県">滋賀県</option>
                    <option value="京都府">京都府</option>
                    <option value="大阪府">大阪府</option>
                    <option value="兵庫県">兵庫県</option>
                    <option value="奈良県">奈良県</option>
                    <option value="和歌山県">和歌山県</option>
                    <option value="鳥取県">鳥取県</option>
                    <option value="島根県">島根県</option>
                    <option value="岡山県">岡山県</option>
                    <option value="広島県">広島県</option>
                    <option value="山口県">山口県</option>
                    <option value="徳島県">徳島県</option>
                    <option value="香川県">香川県</option>
                    <option value="愛媛県">愛媛県</option>
                    <option value="高知県">高知県</option>
                    <option value="福岡県">福岡県</option>
                    <option value="佐賀県">佐賀県</option>
                    <option value="長崎県">長崎県</option>
                    <option value="熊本県">熊本県</option>
                    <option value="大分県">大分県</option>
                    <option value="宮崎県">宮崎県</option>
                    <option value="鹿児島県">鹿児島県</option>
                    <option value="沖縄県">沖縄県</option>
                    <label for="city">市区町村名</label>
                    <label for="sikutyoson">市区町村</label>
                <input type="text" id="sikutyoson" placeholder="市区町村名を入力" required>

                <label for="street-address">番地・ビル名</label>
                <input type="text" id="street-address" placeholder="番地・ビル名を入力" required>
                <label for="phone-number">電話番号</label>
                <input type="tel" id="phone-number" placeholder="000-0000-0000" pattern="\d{3}-\d{4}-\d{4}" required>
            <button type="submit" class="login-btn">新規登録</button>
        </form>
    </div>
</body>
</html>