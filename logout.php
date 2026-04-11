<?php 
    session_start();
    require_once 'server.php';

    if (!isset($_SESSION["id_user"])) {
        header("Location: login.php");
        exit;
    }

    session_destroy();
    header("Location: login.php");
    exit;
?>