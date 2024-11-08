<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規ログイン完了画面</title>
</head>
<body>
    <?php
    // データベース接続
    $pdo = new PDO(
        'mysql:host=mysql310.phy.lolipop.lan;dbname=LAA1554917-system;charset=utf8',
        'LAA1554917',
        'PassSD2D'
    );

    // ユーザーの入力データ
    $user_email = $_POST['user_email'];
    $user_pass= $_POST['user_pass'];
    $user_first_name= $_POST['user_first_name'];
    $user_last_name= $_POST['user_last_name'];
    $user_first= $_POST['user_first'];
    $user_last= $_POST['user_last'];
    $user_postal_code1= $_POST['user_postal_code1'];
    $user_postal_code2= $_POST['user_postal_code2'];
    $user_prefecture= $_POST['user_prefecture'];
    $user_address= $_POST['user_address'];
    $user_home_number= $_POST['user_home_number'];
    $user_tell= $_POST['user_tell'];

    // 重複チェック（電話番号、都道府県、郵便番号、市区町村、住所）
    $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM user 
        WHERE user_tell = :user_tell 
        OR (user_prefecture = :user_prefecture AND user_postal_code1 = :user_postal_code1 AND user_postal_code2 = :user_postal_code2 AND user_address = :user_address)
    ");
    $stmt->execute([
        ':user_tell' => $user_tell,
        ':user_prefecture' => $user_prefecture,
        ':user_postal_code1' => $user_postal_code1,
        ':user_postal_code2' => $user_postal_code2,
        ':user_address' => $user_address
    ]);
    $exists = $stmt->fetchColumn();

    if ($exists > 0) {
        // 重複がある場合、エラーメッセージを表示
        echo '<p>入力された情報（電話番号、住所など）はすでに登録されています。</p>';
    } else {
        // 重複がない場合、ユーザー情報をデータベースに挿入
        $sql = $pdo->prepare('
            INSERT INTO user(
                user_first_name, user_last_name, user_first, user_last,
                user_mail, user_pass, user_tell, user_prefecture, 
                user_home_number, user_postal_code1, user_postal_code2, user_address
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');

        $result = $sql->execute([
            $user_first_name, $user_last_name, $user_first, $user_last,
            $user_email, $user_pass, $user_tell, $user_prefecture, 
            $user_home_number, $user_postal_code1, $user_postal_code2, $user_address
        ]);

        if ($result) {
            echo '<p>新規登録に成功しました。</p>';
        } else {
            echo '<p>新規登録に失敗しました。</p>';
            echo '<p>もう一度お試しください。</p>';
        }
    }
    ?>
    <a href="./login.php">ホーム画面に遷移します</a>
</body>
</html>
