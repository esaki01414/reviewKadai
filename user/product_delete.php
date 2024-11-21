<?php

session_start();

// セッションからユーザーIDを取得
$user_id = $_SESSION['user_id'];

if (!$user_id) {
    echo 'ユーザーがログインしていません。';
    exit;
}

// データ削除処理関数
function deleteItem($user_id, $product_id, $table_name, $redirect_page) {
    try {
        // データベース接続
        $pdo = new PDO(
            'mysql:host=mysql310.phy.lolipop.lan;dbname=LAA1554917-system;charset=utf8',
            'LAA1554917',
            'PassSD2D'
        );
    } catch (PDOException $e) {
        echo 'データベース接続に失敗しました: ' . htmlspecialchars($e->getMessage());
        exit;
    }

    // 削除処理
    $sql = "
        DELETE FROM 
            $table_name 
        WHERE 
            user_id = ? 
            AND product_id = ?
    ";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$user_id, $product_id]);

    if ($result) {
        // 成功時の処理
        header("Location: $redirect_page");
        exit;
    } else {
        echo '削除に失敗しました。';
    }
}

// favorite_delete または cart_delete のリクエストを処理
if (isset($_POST['favorite_delete'])) {
    deleteItem($user_id, $_POST['favorite_delete'], 'favorite', './favorite.php');
} elseif (isset($_POST['cart_delete'])) {
    deleteItem($user_id, $_POST['cart_delete'], 'cart', './cart.php');
} else {
    echo '無効なリクエストです。';
}
?>
