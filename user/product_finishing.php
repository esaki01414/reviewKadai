<?php
session_start();
// ログイン状態の確認
if (!isset($_SESSION['user_id'])) {
    echo 'ログインしてください。';
    exit;
}

// データベース接続
try {
    $pdo = new PDO(
        'mysql:host=mysql310.phy.lolipop.lan;dbname=LAA1554917-system;charset=utf8',
        'LAA1554917',
        'PassSD2D',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die('データベース接続失敗: ' . $e->getMessage());
}

// ユーザーIDと商品IDを取得
$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'] ?? null;

$_SESSION['user_id'] = $user_id;
$_SESSION['product_id'] = $product_id;

// 登録種別の判定
$is_favorite = isset($_POST['favorite']);
$is_cart = isset($_POST['cart']);

// 入力データの検証
if (!$product_id) {
    echo '商品IDが選択されていません。';
    exit;
}

try {
    if ($is_favorite) {
        // 商品がすでにお気に入りに登録されているか確認
        $checkSql = "SELECT COUNT(*) FROM favorite WHERE user_id = :user_id AND product_id = :product_id";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([
            ':user_id' => $user_id,
            ':product_id' => $product_id,
        ]);
        $count = $checkStmt->fetchColumn();

        if ($count > 0) {
            // すでにお気に入りに登録されている場合
            echo 'この商品はすでにお気に入りに登録されています。';
        } else {
            // お気に入りに追加
            $sql = "INSERT INTO favorite (user_id, product_id) VALUES (:user_id, :product_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':user_id' => $user_id,
                ':product_id' => $product_id,
            ]);
            echo '商品がお気に入りに登録されました！';
        }
    } elseif ($is_cart) {
        // カートに同じ商品が登録されているか確認
        $checkSql = "SELECT COUNT(*) FROM cart WHERE user_id = :user_id AND product_id = :product_id";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([
            ':user_id' => $user_id,
            ':product_id' => $product_id,
        ]);
        $count = $checkStmt->fetchColumn();

        if ($count > 0) {
            // すでにカートに登録されている場合
            echo 'カートに既に登録してあります。';
        } else {
            // カートに追加
            $sql = "INSERT INTO cart (user_id, product_id) VALUES (:user_id, :product_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':user_id' => $user_id,
                ':product_id' => $product_id,
            ]);
            echo '商品がカートに登録されました！';
        }
    } else {
        echo '登録種別が指定されていません。';
    }
} catch (PDOException $e) {
    // エラーハンドリング
    echo 'エラーが発生しました: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1..0">
    <title>商品登録完了</title>
</head>
<body>
    <br>
    <a href="./product.php">商品詳細画面に遷移</a>
</body>
</html>

    