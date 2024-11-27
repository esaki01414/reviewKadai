<?php
// データベース接続関数を呼び出して使用する
require_once('functions.php');
$pdo = connectDB(); // データベース接続

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // 画像を取得 (POSTリクエスト以外の場合)
    $sql = 'SELECT * FROM product_images ORDER BY created_at DESC'; // 登録された画像を新しい順に取得
    $stmt = $pdo->prepare($sql); // クエリを準備
    $stmt->execute(); // クエリを実行
    $images = $stmt->fetchAll(); // 結果を配列で取得

} else {
    // 画像を保存 (POSTリクエストの場合)
    if (!empty($_FILES['image']['name'])) { // ファイルが選択されているか確認
        $name = $_FILES['image']['name']; // アップロードされたファイル名
        $type = $_FILES['image']['type']; // アップロードされたファイルタイプ
        $content = file_get_contents($_FILES['image']['tmp_name']); // ファイルの内容を取得
        $size = $_FILES['image']['size']; // ファイルサイズ

        // データベースに画像データを保存
        $sql = 'INSERT INTO product_images(image_name, image_type, image_content, image_size, created_at)
                VALUES (:image_name, :image_type, :image_content, :image_size, now())';
        $stmt = $pdo->prepare($sql); // クエリを準備
        $stmt->bindValue(':image_name', $name, PDO::PARAM_STR); // 名前をバインド
        $stmt->bindValue(':image_type', $type, PDO::PARAM_STR); // タイプをバインド
        $stmt->bindValue(':image_content', $content, PDO::PARAM_STR); // 内容をバインド
        $stmt->bindValue(':image_size', $size, PDO::PARAM_INT); // サイズをバインド
        $stmt->execute(); // クエリを実行
    }
    header('Location:./list.php'); // 保存完了後、リストページにリダイレクト
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Image Test</title>
    <!-- Bootstrap CSSの読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Font Awesomeの読み込み -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <!-- 左側: 画像一覧表示エリア -->
        <div class="col-md-8 border-right">
            <ul class="list-unstyled">
                <!-- 取得した画像を1つずつ表示 -->
                <?php for ($i = 0; $i < count($images); $i++): ?>
                    <li class="media mt-5">
                        <!-- 画像をクリックするとモーダルで拡大表示 -->
                        <a href="#lightbox" data-toggle="modal" data-slide-to="<?= $i; ?>">
                            <img src="image.php?id=<?= $images[$i]['image_id']; ?>" width="100" height="auto" class="mr-3">
                        </a>
                        <div class="media-body">
                            <h5><?= $images[$i]['image_name']; ?> (<?= number_format($images[$i]['image_size']/1000, 2); ?> KB)</h5>
                            <!-- 削除リンク: 確認アラート表示後に削除を実行 -->
                            <a href="javascript:void(0);" 
                               onclick="var ok = confirm('削除しますか？'); if (ok) location.href='delete.php?id=<?= $images[$i]['image_id']; ?>'">
                              <i class="far fa-trash-alt"></i> 削除</a>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
        <!-- 右側: 画像アップロードエリア -->
        <div class="col-md-4 pt-4 pl-4">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>画像を選択</label>
                    <input type="file" name="image" required> <!-- ファイル選択 -->
                </div>
                <button type="submit" class="btn btn-primary">保存</button> <!-- 保存ボタン -->
            </form>
        </div>
    </div>
</div>

<!-- モーダル (Lightbox機能) -->
<div class="modal carousel slide" id="lightbox" tabindex="-1" role="dialog" data-ride="carousel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <!-- モーダル内の画像切り替え用インジケーター -->
        <ol class="carousel-indicators">
        <?php for ($i = 0; $i < count($images); $i++): ?>
                <li data-target="#lightbox" data-slide-to="<?= $i; ?>" <?php if ($i == 0) echo 'class="active"'; ?>></li>
            <?php endfor; ?>
        </ol>

        <!-- 画像スライダー -->
        <div class="carousel-inner">
        <?php for ($i = 0; $i < count($images); $i++): ?>
                <div class="carousel-item <?php if ($i == 0) echo 'active'; ?>">
                    <!-- 画像一覧表示エリア -->
                <img src="image.php?id=<?= $images[$i]['image_id']; ?>" class="d-block w-100">
                </div>
            <?php endfor; ?>
        </div>

        <!-- スライダーの前後ボタン -->
        <a class="carousel-control-prev" href="#lightbox" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#lightbox" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</div>
<!-- 必要なJavaScriptを読み込む -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
