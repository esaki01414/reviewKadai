<?php
// データベース接続を行うためだけのクラス
function connectDB(){
    $param ='mysql:host=mysql310.phy.lolipop.lan;dbname=LAA1554917-system;charset=utf8';
    try {
        $pdo = new PDO(
            $param,
            'LAA1554917',
            'PassSD2D'
        );
        return $pdo;
       
    } catch (PDOException $e) {
        echo 'データベース接続に失敗しました';
        exit($e->getMessage());
    }
    
}
?>