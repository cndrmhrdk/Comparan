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
    $checkout_semua = $_POST["checkout_semua"];

    $sql = "SELECT id_cart FROM cart WHERE id_user = '$id_user'";
    $result  = $connect->query($sql);
    $cart    = $result->fetch_assoc();
    $id_cart = $cart["id_cart"];

    if($checkout_semua == 1){
        //checkout semua item
        $items = tampilKeranjang($connect, $id_cart);
    }else {
        //checkout per item
        $id_produk = $_POST["id_produk"];
        $jumlah = $_POST["jumlah"];
        $id_item = $_POST["id_item"];

        $sql = "SELECT cart_items.*, products.nama_produk, products.harga, products.gambar 
                            FROM cart_items 
                            JOIN products ON cart_items.id_produk = products.id_produk 
                            WHERE cart_items.id_item = '$id_item'";
        $result = $connect->query($sql);
        $items = $result->fetch_all(MYSQLI_ASSOC);
    }

    $total = 0;
    foreach($items as $item){
        $total += $item["harga"] * $item["jumlah"];
    }
    $id_order = checkout($connect, $id_user, $id_cart, $alamat, $items, $total, $id_vouchers, $checkout_semua);

    header("Location: ../cart.php?id_order=" . $id_order);
    exit;
?>