<?php 
    require_once '../server.php';
    require_once '../function/order_function.php';

    session_start();
    $id_user = $_SESSION["id_user"];
    $orders = detailOrder($connect, $id_user);
?>