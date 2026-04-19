<?php 
    require_once '../server.php';
    require_once '../function/order_function.php';

    session_start();
    $id_user = $_SESSION["id_user"];
    $id_order = $_GET["id_order"];

    $sql = "SELECT * FROM orders WHERE id_order = '$id_order' AND id_user = '$id_user'";
    $cek = $connect->query($sql);

    if($cek->num_rows === 0){
        echo json_encode([]);
        exit;
    }

    $orders = detailOrder($connect, $id_user);
    header("Content-Type: application/json");
    echo json_encode($orders);
?>