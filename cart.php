<?php 
    session_start();
    require_once 'server.php';
    require_once 'function/cart_function.php';

    $id_user = $_SESSION["id_user"];
    $sql = "SELECT id_cart FROM cart WHERE id_user = '$id_user'";
    $result = $connect->query($sql);
    $cart = $result->fetch_assoc();
    $id_cart = $cart["id_cart"];

    $items = tampilKeranjang($connect, $id_cart);

    $totalBelanja = 0;
    foreach ($items as $item) {
        $totalBelanja += $item["harga"] * $item["jumlah"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Keranjang Belanja</h2>
    <?php if(count($items) === 0): ?>
        <p>Keranjang Anda kosong.</p>
    <?php else: ?>
        <?php foreach ($items as $item): ?>
            <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; display: flex; gap: 10px;">
                <img src="uploads/produk/<?= $item["gambar"] ?>" width="80" height="80" style="object-fit: cover;">
                <div>
                    <b><?= $item["nama_produk"] ?></b><br>
                    Harga  : Rp <?= number_format($item["harga"], 0, ',', '.') ?><br>
                    Jumlah : <?= $item["jumlah"] ?><br>
                    Subtotal: Rp <?= number_format($item["harga"] * $item["jumlah"], 0, ',', '.') ?><br>
                    <a href="logic/hapus_item.php?id_item=<?= $item["id_item"] ?>">Hapus</a>
                </div>
            </div>
        <?php endforeach; ?>
        <h3>Total Belanja: Rp <?= number_format($totalBelanja, 0, ',', '.') ?></h3>
        <a href="./checkout.php">Checkout</a>
    <?php endif; ?>

</body>
</html>