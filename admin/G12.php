<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品更新完了画面</title>
</head>
<body>
<?php
if (isset($_POST['U'])) {
    $data = json_decode($_POST['U'], true);
    // Now you can use the $result array
}
?>
<h1>更新完了</h1>
<?php
echo $data;
?>
<a href="G9.php">戻る</a>
</body>
</html>