<?php
    session_start();
    $_SESSION['admin_login'] = false;

    header('location:./G1.php');
?>