<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品更新完了画面</title>
</head>
<body>
<h1>更新完了</h1>
<?php
 try {
    $pdo = new PDO(
        'mysql:host=mysql310.phy.lolipop.lan;dbname=LAA1554917-system;charset=utf8',
        'LAA1554917',
        'PassSD2D'
    );
} catch (PDOException $e) {
    echo 'データベース接続に失敗しました: ' . htmlspecialchars($e->getMessage());
    exit;
}  

if (isset($_POST['U'])) {
    $data = json_decode($_POST['U'][0], true);
    // $dataを使って、次のページでデータを処理します
    var_dump($data);  // これでデータが配列として取得できているか確認できます
}
if (!empty($data)) {
    echo '<p>商品ID: ' . htmlspecialchars($data['data'][0]) . '</p>';
    echo '<p>商品名: ' . htmlspecialchars($data['data'][1]) . '</p>';
    echo '<p>サイズ: ' . htmlspecialchars($data['data'][2]) . '</p>';
    echo '<p>在庫数: ' . htmlspecialchars($data['data'][3]) . '</p>';
    echo '<p>カラー: ' . htmlspecialchars($data['data'][4]) . '</p>';
    echo '<p>商品説明: ' . nl2br(htmlspecialchars($data['data'][5])) . '</p>';
    echo '<p>価格: ' . htmlspecialchars($data['data'][6]) . '</p>';
    // 画像の表示（画像データがある場合）
    if (isset($data['data'][7]) && !empty($data['data'][7])) {
        echo '<img src="data:' . htmlspecialchars($data['data'][7]['image_type']) . ';base64,' . base64_encode($data['data'][7]['image_content']) . '" width="200" height="auto"><br>';
    }
} else {
    echo '<p>データが正しくありません。</p>';
}

?>
<a href="G9.php?id=<?= htmlspecialchars($data['data'][0]) ?>">
    <i class="fa-solid fa-cube icon"></i>    
    戻る
</a>
</body>
</html>