<?php

        $sid = isset($_POST['sid'])? htmlspecialchars($_POST['sid'], ENT_QUOTES, 'utf-8') : '';
        $password = isset($_POST['password'])? htmlspecialchars($_POST['password'], ENT_QUOTES, 'utf-8'): '';


        if ($sid == '') {
            header("Location:./index.php");
            exit;
        }
        if ($password == '') {
            header("Location:./index.php");
            exit;
        }

        if ($sid=='222' && $password=='Pass0708') {
            //ログイン許可
            header("Location:./https://aso2301180.pinoko.jp/system/admin/dashboard.php");
        } else {
            //間違っているのでログイン不可
            header("Location:./index.php");
            exit;
        }
?>