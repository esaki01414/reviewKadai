<?php
session_start();
$user_id = $_SESSION['user_id'];

$pdo = new PDO(
    'mysql:host=mysql310.phy.lolipop.lan;dbname=LAA1554917-system;charset=utf8',
    'LAA1554917',
    'PassSD2D'
);

// 更新処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_pass'];
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_first = $_POST['user_first'];
    $user_last = $_POST['user_last'];
    $user_postal_code1 = $_POST['user_postal_code1'];
    $user_postal_code2 = $_POST['user_postal_code2'];
    $user_prefecture = $_POST['user_prefecture'];
    $user_address = $_POST['user_address'];
    $user_home_number = $_POST['user_home_number'];
    $user_tell = $_POST['user_tell'];

    $sql = "UPDATE user 
            SET user_mail = ?, 
                user_pass = ?, 
                user_first_name = ?, 
                user_last_name = ?, 
                user_first = ?, 
                user_last = ?, 
                user_postal_code1 = ?, 
                user_postal_code2 = ?, 
                user_prefecture = ?, 
                user_address = ?, 
                user_home_number = ?, 
                user_tell = ? 
            WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $user_email,
        $user_pass,
        $user_first_name,
        $user_last_name,
        $user_first,
        $user_last,
        $user_postal_code1,
        $user_postal_code2,
        $user_prefecture,
        $user_address,
        $user_home_number,
        $user_tell,
        $user_id,
    ]);

    echo "<p>プロフィールが更新されました！</p>";
}

// ユーザー情報取得
$sql = 'SELECT * FROM user WHERE user_id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);

$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row) {
    $user_email = $row['user_mail'];
    $user_pass = $row['user_pass'];
    $user_first_name = $row['user_first_name'];
    $user_last_name = $row['user_last_name'];
    $user_first = $row['user_first'];
    $user_last = $row['user_last'];
    $user_postal_code1 = $row['user_postal_code1'];
    $user_postal_code2 = $row['user_postal_code2'];
    $user_prefecture = $row['user_prefecture'];
    $user_address = $row['user_address'];
    $user_home_number = $row['user_home_number'];
    $user_tell = $row['user_tell'];

    
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">
    <title>プロフィール変更画面</title>
</head>
<body>

<div class="container">
    <div class="back-button"><a href="./home.php">←戻る</a></div>
    <div class="profile-container">
    <div class="profile-icon">
        <img src="./images/ユーザーアイコン.jpg" alt="Profile Icon">
    </div>
</div>
<form action="" method="post">
            <div class="login-form">
                <label for="email">Email</label>
                <input type="email" id="email" name="user_email" value="<?php echo htmlspecialchars($user_email)?>" required>
                <label for="password">Password</label>
                <input type="text" id="password" name="user_pass" value="<?php echo htmlspecialchars($user_pass)?>" required>

            </div>

            <div class="name-inputs">
                <div>
                    <label for="last-name">姓</label>
                    <input type="text" id="last-name" value="<?php echo htmlspecialchars($user_first_name)?>" name="user_first_name" required>
                </div>
                <div>
                    <label for="first-name">名</label>
                    <input type="text" id="first-name" name="user_last_name" value="<?php echo htmlspecialchars($user_last_name)?>"  required>
                </div>
            </div>

            <div class="kana-inputs">
                <div>
                    <label for="last-name-kana">姓(カタカナ)</label>
                    <input type="text" id="last-name-kana" name="user_first" value="<?php echo htmlspecialchars($user_first)?>"  required>
                </div>
                <div>
                    <label for="first-name-kana">名(カタカナ)</label>
                    <input type="text" id="first-name-kana" name="user_last" value="<?php echo htmlspecialchars($user_last)?>" required>
                </div>
            </div>

            <div class="address-inputs">
                <div><label for="address">お届け先住所</label>
                    <span>〒</span>
                    <input type="text" id="postal-code-1" name="user_postal_code1" value="<?php echo htmlspecialchars($user_postal_code1)?>" maxlength="3" required>
                    <span>ー</span>
                    <input type="text" id="postal-code-2" name="user_postal_code2" value="<?php echo htmlspecialchars($user_postal_code2)?>" maxlength="4" required>
                </div>
            </div>

            <div class="todohu-ken">
                <div><label for="todohuken">都道府県</label>
                    <select id="prefecture" name="user_prefecture" required>
                    <option value="" disabled selected>選択してください</option>
                        <optgroup label="北海道地方"></optgroup>
                        <option value="北海道">北海道</option>
                        <hr>
                        <optgroup label="東北地方"></optgroup>
                        <option value="青森県">青森県</option>
                        <option value="岩手県">岩手県</option>
                        <option value="宮城県">宮城県</option>
                        <option value="秋田県">秋田県</option>
                        <option value="山形県">山形県</option>
                        <option value="福島県">福島県</option>
                    <hr>
                        <optgroup label="関東地方"></optgroup>
                        <option value="茨城県">茨城県</option>
                        <option value="栃木県">栃木県</option>
                        <option value="群馬県">群馬県</option>
                        <option value="埼玉県">埼玉県</option>
                        <option value="千葉県">千葉県</option>
                        <option value="東京都">東京都</option>
                        <option value="神奈川県">神奈川県</option>
                    <hr>
                        <optgroup label="中部地方"></optgroup>
                        <option value="新潟県">新潟県</option>
                        <option value="富山県">富山県</option>
                        <option value="石川県">石川県</option>
                        <option value="福井県">福井県</option>
                        <option value="山梨県">山梨県</option>
                        <option value="長野県">長野県</option>
                        <option value="岐阜県">岐阜県</option>
                        <option value="静岡県">静岡県</option>
                        <option value="愛知県">愛知県</option>
                    <hr>
                        <optgroup label="近畿地方"></optgroup>
                        <option value="三重県">三重県</option>
                        <option value="滋賀県">滋賀県</option>
                        <option value="京都府">京都府</option>
                        <option value="大阪府">大阪府</option>
                        <option value="兵庫県">兵庫県</option>
                        <option value="奈良県">奈良県</option>
                        <option value="和歌山県">和歌山県</option>
                    <hr>
                        <optgroup label="中国地方"></optgroup>
                        <option value="鳥取県">鳥取県</option>
                        <option value="島根県">島根県</option>
                        <option value="岡山県">岡山県</option>
                        <option value="広島県">広島県</option>
                        <option value="山口県">山口県</option>
                    <hr>
                        <optgroup label="四国地方"></optgroup>
                        <option value="徳島県">徳島県</option>
                        <option value="香川県">香川県</option>
                        <option value="愛媛県">愛媛県</option>
                        <option value="高知県">高知県</option>
                    <hr>
                        <optgroup label="九州地方"></optgroup>
                        <option value="福岡県">福岡県</option>
                        <option value="佐賀県">佐賀県</option>
                        <option value="長崎県">長崎県</option>
                        <option value="熊本県">熊本県</option>
                        <option value="大分県">大分県</option>
                        <option value="宮崎県">宮崎県</option>
                        <option value="鹿児島県">鹿児島県</option>
                        <option value="沖縄県">沖縄県</option>
                </select>
            </div>
        </div>
                    
        <div class="sikutyoson">
                    <label for="sikutyoson">市区町村</label>
                    <input type="text" id="sikutyoson" name="user_address" value="<?php echo htmlspecialchars($user_address)?>">
        </div>

        <div class="street-address">
                <label for="street-address">番地・ビル名</label>
                <input type="text" id="street-address" name="user_home_number"  value="<?php echo htmlspecialchars($user_home_number)?>" required>
        </div>

        <div class="phon-number">
                <label for="phone-number">電話番号</label>
                <input type="tel" id="phone-number" name="user_tell" value="<?php echo htmlspecialchars($user_tell)?>" pattern="\d{3}-\d{4}-\d{4}" required><br>
        </div> 

        <button type="submit" class="login-btn">更新</button>
    <div id="update-modal" class="modal">
        <div class="modal-content">
        <p>プロフィールが更新されました！</p>
        <b><a href="home.php">ホーム</a></b>
        </div>
    </div>

    <style>
        .modal {
            display: none; /* 初期状態では非表示 */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        .modal-content button {
            margin-top: 10px;
            padding: 5px 10px;
        }
    </style>
    <script>
    // PHPで設定したフラグを受け取る
    const isUpdated = <?php echo isset($_POST) && !empty($_POST) ? 'true' : 'false'; ?>;

    // DOMが読み込まれた後に実行
    document.addEventListener('DOMContentLoaded', () => {
        if (isUpdated) {
            const modal = document.getElementById('update-modal');
            modal.style.display = 'flex';

            // 閉じるボタンのイベント
            document.getElementById('close-modal').addEventListener('click', () => {
                modal.style.display = 'none';
            });
        }
    });
    </script>
        
</form>            
</div>
</body>
</html>