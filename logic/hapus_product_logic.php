<?php 
    session_start();
    require_once '../server.php';
    require_once '../function/product_function.php';

    $id_produk = $_GET["id_produk"];
    hapusProduk($connect, $id_produk);
    header("Location: ../my_product.php");
    exit;
?>