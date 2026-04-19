<?php 
    require_once "../server.php";
    require_once "../function/voucher_function.php";

    $id_user = $_SESSION["id_user"];
    $id_voucher = $_GET["id_voucher"];

    $hasil = tukarVoucher($connect, $id_user, $id_voucher);

    header("Location: ../voucher.php?pesan=". $hasil);
    exit;
?>