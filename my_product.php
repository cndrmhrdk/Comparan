<?php 
    session_start();
    require_once 'server.php';
    require_once 'function/product_function.php';

    $id_user = $_SESSION["id_user"];
    $produk_saya = produkSaya($connect, $id_user);
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <h2>my produk</h2>

    <? if(empty($produk_saya)): ?>
        <p>Belum ada produk yang ditambahkan.</p>
    <? else: ?>
        <?php foreach($produk_saya as $produk): ?>
            <div class="card" style="width: 18rem;">
                <img src="uploads/produk/<?= $produk['gambar'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $produk['nama_produk'] ?></h5>
                    <p class="card-text"><?= $produk['harga'] ?></p>
                    <p class="card-text"><?= $produk['stok'] ?></p>
                    <p class="card-text"><?= $produk['deskripsi'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <? endif; ?>

</body>
</html>