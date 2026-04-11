<?php 
    session_start();
    require_once '../server.php';
    require_once '../function/cart_function.php';

    $id_item = $_GET["id_item"];
    hapusItemKeranjang($connect, $id_item);
    header("Location: ../cart.php");
    exit;
?>