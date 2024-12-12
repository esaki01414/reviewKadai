<?php
session_start();
    $pdo = new PDO(
        'mysql:host=mysql310.phy.lolipop.lan;
        dbname=LAA1554917-system;charset=utf8',
        'LAA1554917',
        'PassSD2D'
    );
        $sid = isset($_POST['sid'])? htmlspecialchars($_POST['sid'], ENT_QUOTES, 'utf-8') : '';
        $password = isset($_POST['password'])? htmlspecialchars($_POST['password'], ENT_QUOTES, 'utf-8'): '';
        $stmt = $pdo->prepare("SELECT * FROM maneger WHERE maneger_id = ? and maneger_pass= ?");
        $stmt->execute([$sid, $password]);

        if ($sid == '') {
            header("Location:./G1.php");
            exit;
        }
        if ($password == '') {
            header("Location:./G1.php");
            exit;
        }

        if ($stmt->rowCount()>0) {
            //ログイン許可
            session_start();
            $_SESSION['admin_login'] = true;
            header("Location:./G2.php");
        } else {
            //間違っているのでログイン不可
            header("Location:./G1.php");
            exit;
        }
?>