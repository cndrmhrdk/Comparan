<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once 'server.php';
    require_once 'function/product_function.php';

    // Proteksi Login
    if (!isset($_SESSION["id_user"])) {
        header("Location: login.php");
        exit;
    }

    $id_user = $_SESSION["id_user"];
    $produk = tampilSemuaProduk($connect, $id_user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Comparan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        /* Overlay */
        .overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 9999; 
        }

        /* Kotak Modal */
        .modal-konten {
            background: white;
            width: 95%;
            max-width: 450px;
            margin: 50px auto;
            padding: 25px;
            border-radius: 15px;
            position: relative;
            z-index: 10000;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            border: 1px solid #ddd;
            width: 220px;
            border-radius: 12px;
            background: white;
            overflow: hidden;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }

        .card-img-container {
            width: 100%;
            height: 180px;
            overflow: hidden;
        }

        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .modal-konten img {
            width: 100%;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .tutup {
            float: right;
            cursor: pointer;
            font-size: 28px;
            line-height: 20px;
            color: #999;
        }

        .tutup:hover { color: #333; }

        .tombol-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h2 class="fw-bold text-success">CompasTv</h2>
        <a href="logout.php"><button class="btn btn-outline-danger btn-sm">Logout</button></a>
    </div>

    <?php if (empty($produk)): ?>
        <div class="alert alert-warning text-center">Stok tanaman sedang kosong.</div>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($produk as $p): ?>
                <div class="card">
                    <div class="card-img-container">
                        <img src="uploads/produk/<?= $p["gambar"] ?>" alt="<?= $p["nama_produk"] ?>">
                    </div>
                    <div class="p-3 text-center">
                        <b class="d-block mb-1 text-truncate"><?= $p["nama_produk"] ?></b>
                        <p class="text-success fw-bold mb-2">Rp <?= number_format($p["harga"], 0, ',', '.') ?></p>
                        
                        <button class="btn btn-success btn-sm w-100" onclick="bukaModal(
                            '<?= $p['gambar'] ?>',
                            '<?= htmlspecialchars(addslashes($p['nama_produk'])) ?>',
                            '<?= $p['harga'] ?>',
                            '<?= $p['stok'] ?>',
                            '<?= $p['kategori'] ?>',
                            '<?= htmlspecialchars(addslashes(preg_replace('/\s+/', ' ', $p['deskripsi']))) ?>',
                            '<?= $p['status'] ?>',
                            '<?= $p['id_produk'] ?>'
                        )">Detail Produk</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<div class="overlay" id="overlay" onclick="tutupModal()">
    <div class="modal-konten" onclick="event.stopPropagation()">
        <span class="tutup" onclick="tutupModal()">&times;</span>
        
        <img id="m-gambar" src="" class="shadow-sm">
        <h4 id="m-nama" class="fw-bold text-success mb-3"></h4>
        
        <div class="small">
            <div class="d-flex justify-content-between border-bottom py-1">
                <span>Harga</span>
                <span class="fw-bold text-primary">Rp <span id="m-harga"></span></span>
            </div>
            <div class="d-flex justify-content-between border-bottom py-1">
                <span>Stok</span>
                <span id="m-stok"></span>
            </div>
            <div class="d-flex justify-content-between border-bottom py-1">
                <span>Kategori</span>
                <span id="m-kategori"></span>
            </div>
            <div class="d-flex justify-content-between border-bottom py-1">
                <span>Status</span>
                <span id="m-status" class="badge bg-success"></span>
            </div>
            <div class="mt-3">
                <strong>Deskripsi:</strong>
                <p id="m-deskripsi" class="text-muted" style="font-size: 0.85rem;"></p>
            </div>
        </div>

        <div class="mt-3">
            <label class="form-label fw-bold small">Jumlah Beli:</label>
            <input type="number" id="m-jumlah" class="form-control form-control-sm" value="1" min="1">
        </div>

        <div class="tombol-group">
            <button class="btn btn-warning w-100" onclick="tambahKeranjang()">+ Keranjang</button>
            <button class="btn btn-primary w-100" onclick="beliSekarang()">Beli Sekarang</button>
        </div>
    </div>
</div>

<script>
    let idProdukDipilih = null;
    let stokTersedia    = 0;

    function bukaModal(gambar, nama, harga, stok, kategori, deskripsi, status, id_produk) {
        idProdukDipilih = id_produk;
        stokTersedia    = parseInt(stok);

        document.getElementById("m-gambar").src          = "uploads/produk/" + gambar;
        document.getElementById("m-nama").innerText       = nama;
        document.getElementById("m-harga").innerText      = parseInt(harga).toLocaleString("id-ID");
        document.getElementById("m-stok").innerText       = stok;
        document.getElementById("m-kategori").innerText   = kategori;
        document.getElementById("m-deskripsi").innerText  = deskripsi;
        document.getElementById("m-status").innerText     = status;
        document.getElementById("m-jumlah").max           = stok;
        document.getElementById("overlay").style.display  = "block";
    }

    function tutupModal() {
        document.getElementById("overlay").style.display = "none";
    }

    function tambahKeranjang() {
        let jumlah = document.getElementById("m-jumlah").value;
        if(parseInt(jumlah) > stokTersedia) {
            alert("Maaf, stok tidak mencukupi!");
            return;
        }
        window.location.href = "logic/cart_logic.php?id_produk=" + idProdukDipilih + "&jumlah=" + jumlah;
    }

    function beliSekarang() {
        let jumlah = document.getElementById("m-jumlah").value;
        if(parseInt(jumlah) > stokTersedia) {
            alert("Maaf, stok tidak mencukupi!");
            return;
        }
        window.location.href = "checkout.php?id_produk=" + idProdukDipilih + "&jumlah=" + jumlah;
    }
</script>

</body>
</html>