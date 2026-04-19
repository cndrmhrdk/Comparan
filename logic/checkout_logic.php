<?php 
    // if (session_status() === PHP_SESSION_NONE) {
        session_start();
    // }

    require_once '../server.php';
    require_once '../function/cart_function.php';
    require_once '../function/order_function.php';
    require_once '../function/voucher_function.php';

    $id_user = $_SESSION["id_user"];
    $alamat  = $_POST["alamat"];
    $id_vouchers  = $_POST["id_vouchers"] ?? [];

    $sql = "SELECT id_cart FROM cart WHERE id_user = '$id_user'";
    $result  = $connect->query($sql);
    $cart    = $result->fetch_assoc();
    $id_cart = $cart["id_cart"];

    $items = tampilKeranjang($connect, $id_cart);
    $total = 0;
    foreach ($items as $item) {
        $total += $item["harga"] * $item["jumlah"];
    }
    $id_order = checkout($connect, $id_user, $id_cart, $alamat, $items, $total, $id_vouchers);

    header("Location: ../cart.php?id_order=" . $id_order);
    exit;
?>