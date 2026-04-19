<?php 
    session_start();
    require_once 'server.php';
    require_once 'function/cart_function.php';

    $id_user = $_SESSION["id_user"];
    $sql = "SELECT id_cart FROM cart WHERE id_user = '$id_user'";
    $result = $connect->query($sql);
    // Ambil id_cart berdasarkan id_user
    $cart = $result->fetch_assoc();
    $id_cart = $cart["id_cart"];

    $items = tampilKeranjang($connect, $id_cart);
    $total = 0;
    foreach($items as $item){
        $total += $item["harga"] * $item["jumlah"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    <h2>Checkout</h2>
    <a href="cart.php">kembali</a>

    <?php foreach ($items as $item): ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <b><?= $item["nama_produk"] ?></b><br>
            Harga   : Rp <?= number_format($item["harga"], 0, ',', '.') ?><br>
            Jumlah  : <?= $item["jumlah"] ?><br>
            Subtotal: Rp <?= number_format($item["harga"] * $item["jumlah"], 0, ',', '.') ?>
        </div>
    <?php endforeach; ?>

    <b>Total: <?= number_format($total, 0, ',', ',') ?></b><br>

    <form method="POST" action="logic/checkout_logic.php">
        <input type="text" name="alamat" placeholder="Alamat Pengiriman" required><br><br>
        <button type="submit">Bayar</button>
    </form>
</body>
</html>