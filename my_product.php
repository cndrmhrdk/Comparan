<?php
    session_start();
    require_once "server.php";
    require_once "function/product_function.php";

    $id_user = $_SESSION["id_user"];
    $produk  = produkSaya($connect, $id_user);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Produk Saya</title>
    <style>
        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }
        .card {
            border: 1px solid #ccc;
            padding: 10px;
            width: 180px;
            cursor: pointer;
        }
        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        /* Modal */
        .overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
        }
        .modal {
            background: white;
            width: 400px;
            margin: 100px auto;
            padding: 20px;
            border-radius: 8px;
        }
        .modal img {
            width: 100%;
        }
        .tutup {
            float: right;
            cursor: pointer;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <h2>Produk Saya</h2>
    <a href="add_product.php">+ Tambah Produk</a><br><br>

    <?php if (count($produk) === 0): ?>
        <p>Belum ada produk.</p>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($produk as $p): ?>
                <div class="card" onclick="bukaModal(
                    '<?= $p['gambar'] ?>',
                    '<?= $p['nama_produk'] ?>',
                    '<?= $p['harga'] ?>',
                    '<?= $p['stok'] ?>',
                    '<?= $p['kategori'] ?>',
                    '<?= $p['status'] ?>',
                    '<?= $p['deskripsi'] ?>'
                )">
                    <img src="uploads/produk/<?= $p['gambar'] ?>">
                    <b><?= $p['nama_produk'] ?></b><br>
                        Rp <?= number_format($p['harga'], 0, ',', '.') ?><br>
                        Stok: <?= $p['stok'] ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Modal -->
    <div class="overlay" id="overlay" onclick="tutupModal()">
        <div class="modal" onclick="event.stopPropagation()">
            <span class="tutup" onclick="tutupModal()">✕</span>
            <img id="m-gambar" src=""><br><br>
            <b id="m-nama"></b><br>
            Harga    : Rp <span id="m-harga"></span><br>
            Stok     : <span id="m-stok"></span><br>
            Kategori : <span id="m-kategori"></span><br>
            Status   : <span id="m-status"></span><br>
            Deskripsi: <span id="m-deskripsi"></span>
        </div>
    </div>

    <script>
        function bukaModal(gambar, nama, harga, stok, kategori, status, deskripsi) {
            document.getElementById("m-gambar").src       = "uploads/produk/" + gambar;
            document.getElementById("m-nama").innerText      = nama;
            document.getElementById("m-harga").innerText     = parseInt(harga).toLocaleString("id-ID");
            document.getElementById("m-stok").innerText      = stok;
            document.getElementById("m-kategori").innerText  = kategori;
            document.getElementById("m-status").innerText    = status;
            document.getElementById("m-deskripsi").innerText = deskripsi;
            document.getElementById("overlay").style.display = "block";
        }

        function tutupModal() {
            document.getElementById("overlay").style.display = "none";
        }
    </script>

</body>
</html>