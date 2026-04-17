<?php 
    session_start();
    require_once 'server.php';
    require_once 'function/product_function.php';

    $id_user = $_SESSION["id_user"];
    $produk = tampilSemuaProduk($connect, $id_user);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Blooming – Plant Shop</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->

    <style>
    .modal-konten {
    background: white;
    width: 400px;
    margin: 100px auto;
    padding: 20px;
    border-radius: 8px;
    position: relative; /* Tambahkan ini */
    z-index: 1001;
}
    /* placeholder plant images via emoji/css */
    .plant-emoji {
      font-size: 2.2rem;
      width: 56px; height: 56px;
      display: flex; align-items: center; justify-content: center;
    }
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

<h2>Beranda</h2>

    <?php if (count($produk) === 0): ?>
        <p>Belum ada produk tersedia.</p>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($produk as $p): ?>
                <div class="card" onclick="bukaModal(
                    '<?= $p['gambar'] ?>',
                    '<?= htmlspecialchars(addslashes($p['nama_produk'])) ?>',
                    '<?= $p['harga'] ?>',
                    '<?= $p['stok'] ?>',
                    '<?= $p['kategori'] ?>',
                    '<?= htmlspecialchars(addslashes(preg_replace('/\s+/', ' ', $p['deskripsi']))) ?>',
                    '<?= $p['status'] ?>',
                    '<?= $p['id_produk'] ?>'
                )">
                    <img src="uploads/produk/<?= $p["gambar"] ?>">
                    <b><?= $p["nama_produk"] ?></b><br>
                    Rp <?= number_format($p["harga"], 0, ',', '.') ?><br>
                    Stok: <?= $p["stok"] ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Modal -->
    <div class="overlay" id="overlay" onclick="tutupModal()">
        <div class="modal-konten" onclick="event.stopPropagation()">
            <span class="tutup" onclick="tutupModal()">✕</span>
            <img id="m-gambar" src="" class="img-fluid"><br><br>
            <b id="m-nama"></b><br>
            Harga    : Rp <span id="m-harga"></span><br>
            Stok     : <span id="m-stok"></span><br>
            Kategori : <span id="m-kategori"></span><br>
            Status   : <span id="m-status"></span><br>
            Deskripsi: <span id="m-deskripsi"></span><br><br>

            <label>Jumlah:</label><br>
            <input type="number" id="m-jumlah" value="1" min="1"><br><br>

            <div class="tombol-group">
                <button class="btn btn-warning" onclick="tambahKeranjang()">+ Keranjang</button>
                <button class="btn btn-primary" onclick="beliSekarang()">Beli Sekarang</button>
            </div>
        </div>
    </div>

    <a href="logout.php"><button class="btn btn-secondary">Logout</button></a>

    <script>
        let idProdukDipilih = null;
        let stokTersedia    = 0;

        function bukaModal(gambar, nama, harga, stok, kategori, deskripsi, status, id_produk) {
            idProdukDipilih = id_produk;
            stokTersedia    = parseInt(stok);

            document.getElementById("m-gambar").src          = "uploads/produk/" + gambar;
            document.getElementById("m-nama").innerText      = nama;
            document.getElementById("m-harga").innerText     = parseInt(harga).toLocaleString("id-ID");
            document.getElementById("m-stok").innerText      = stok;
            document.getElementById("m-kategori").innerText  = kategori;
            document.getElementById("m-deskripsi").innerText = deskripsi;
            document.getElementById("m-status").innerText    = status;
            document.getElementById("m-jumlah").max          = stok;
            document.getElementById("overlay").style.display = "block";
        }

        function tutupModal() {
            document.getElementById("overlay").style.display = "none";
        }

        function tambahKeranjang() {
            let jumlah = document.getElementById("m-jumlah").value;
            window.location.href = "logic/cart_logic.php?id_produk=" + idProdukDipilih + "&jumlah=" + jumlah;
        }

        function beliSekarang() {
            let jumlah = document.getElementById("m-jumlah").value;
            window.location.href = "checkout.php?id_produk=" + idProdukDipilih + "&jumlah=" + jumlah;
        }
    </script>


</body>
</html>