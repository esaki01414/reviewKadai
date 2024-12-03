<?php
       session_start();
       if($_SESSION['admin_login'] == false){
           header("Location:./G1.php");
           exit;
      }
?>
<?php
// データベース接続
try {
    $pdo = new PDO(
        'mysql:host=mysql310.phy.lolipop.lan;dbname=LAA1554917-system;charset=utf8',
        'LAA1554917',
        'PassSD2D'
    );
} catch (PDOException $e) {
    echo '<div class="message error">';
    echo '<a href="./G8.php">商品管理に遷移</a><br>';
    echo "データベース接続に失敗しました: " . $e->getMessage();
    echo '</div>';
    exit;
}

// POSTデータを取得
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maneger_id = $_POST['maneger_id'];
    $product_name = $_POST['product_name'];
    $product_size = $_POST['product_size'];
    $product_color = $_POST['product_color'];
    $inventory_stock = $_POST['inventory_stock'];
    $product_price = $_POST['product_price'];
    $product_body = $_POST['product_body'];
    
    if (!empty($_FILES['imag']['name'])) {
        $image_name = $_FILES['imag']['name']; // アップロードされたファイル名
        $image_type = $_FILES['imag']['type']; // アップロードされたファイルタイプ
        $image_content = file_get_contents($_FILES['imag']['tmp_name']); // ファイルの内容を取得
        $image_size = $_FILES['imag']['size']; // ファイルサイズ
    } else {
        echo '<div class="message error">';
        echo '<a href="./G8.php">商品管理に遷移</a><br>';
        echo 'データが正しく送信されていません。';
        echo '</div>';
        exit;
    }
    
    // データベースに登録
    try {
        $sql = "INSERT INTO product
                (maneger_id, product_name, product_size, product_color, inventory_stock,product_price,product_body,created_at,image_name,image_type,image_content,image_size) 
                VALUES (?, ?, ?, ?, ?, ?, ?, now(), ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $maneger_id,
            $product_name,
            $product_size,
            $product_color,
            $inventory_stock,
            $product_price,
            $product_body,
            $image_name,
            $image_type,
            $image_content,
            $image_size
        ]);

        echo '<div class="message success">';
        echo '<a href="./G8.php">商品管理に遷移</a><br>';
        echo "商品が正常に登録されました。";
        echo '</div>';
    } catch (PDOException $e) {
        echo '<div class="message error">';
        echo "データベースエラー: " . $e->getMessage();
        echo '</div>';
    }
}
?>
<style>
body {
    display: flex;
    justify-content: center;  /* 水平中央揃え */
    align-items: center;      /* 垂直中央揃え */
    height: 100vh;            /* ビューポートの高さを100%に設定 */
    margin: 0;                /* ページのデフォルトマージンをリセット */
}

/* メッセージ全体のスタイル */
.message {
    padding: 10px 20px;
    border-radius: 5px;
    text-align: center;
    font-size: 16px;
    max-width: 500px; /* メッセージの最大幅を設定（必要に応じて調整） */
    width: 100%; /* メッセージが最大幅を持つように設定 */
}

/* 成功メッセージのスタイル (薄い灰色の背景) */
.success {
    background-color: #d3d3d3; /* 薄い灰色 */
    color: black; /* 文字色を黒に変更 */
    border: 1px solid #a9a9a9; /* 薄い灰色のボーダー */
}

/* エラーメッセージのスタイル */
.error {
    background-color: #f44336; /* 赤色 */
    color: white;
    border: 1px solid #d32f2f;
}



</style>
