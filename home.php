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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> -->
    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
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
        .productCard {
            border: 1px solid #ccc;
            padding: 10px;
            width: 180px;
            cursor: pointer;
        }
        .productCard img {
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
<body class="mx-4 m-0 p-0" style="background-color: rgb(242, 255, 223);">
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: rgb(242, 255, 223);">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center mx-3" href="#">
                <img src="assets/logo-fix.png" alt="logo" class="logoNav" style="width: 120px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="row w-100 align-items-center">
                    <div class="col-11 d-flex justify-content-center">
                        <div class="containerItemNav navbar-nav d-flex justify-content-center">
                            <a class="nav-link rounded-start-pill px-3" aria-current="page" href="#dashboard">Dashboard</a>
                            <a class="nav-link px-3" href="#about">About</a>
                            <a class="nav-link rounded-end-pill px-3" href="#shop">Shop</a>
                        </div>
                    </div>
                    <div class="col-1 text-lg-end">
                        <a class="nav-link" aria-disabled="true" href="cart.php" id="navbarNavAltMarkup">
                            <i class="cartIcon bi bi-cart"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <section id="dashboard" class="bg-black rounded-4 m-1 mx-4 d-flex justify-content-center align-items-center">
        <div class="col position-relative">
            <video autoplay muted loop class="w-100 rounded-4 z-2" style="height: 640px; object-fit: cover; display: block;">
                <source src="assets/Animasi_Foto_Menjadi_Video_Tangan copy.mp4" type="video/mp4">
            </video>
            <div class="dashText position-absolute top-50 start-50 translate-middle z-1">
                <h1 class="dashTitle m-0 p-0">Nuture, Nature, Restore The Earth</h1>
                <h1 class="dashTagline m-0 p-0">choose and buy your sustainable products</h1>
            </div>
        </div>
    </section>
    <br><hr><br>
    <section id="about" class="bg- text-center d-flex justify-content-center align-items-center">
        <div class="row px-0 w-100 justify-content-center">
            <div class="row-100 px-0">
                <a href="#about" class="aboutTitle btn text-light fw-semibold">About Comparan</a>
                <h2 class="taglineAboutContent  text-start">Solution for your <span  style="font-family: Belgiano; font-style: italic; letter-spacing: -1px; color: black;">sustainable</span> living</h2>
                <div class="row w-100 m-0 my-4">
                    <div class="kolomKiri col-12 col-md-6 m-0">
                        <video autoplay muted loop class="vidKemasBibit opacity-100 rounded-4 p-0">
                            <source src="assets/kemasBibit.mp4" type="video/mp4">
                        </video>
                    </div>
                    <div class="kolomKanan col-12 col-md-6 m-0">
                        <h3 class="titleKemas text-start m-0">Help you live sustainably</h3>
                        <h4 class="subTitleKemas text-start">"E-<span class="comparanMeans">Co</span>mmerce <span class="comparanMeans">P</span>encint<span class="comparanMeans">a</span> Tandu<span class="comparanMeans">ran</span>"<hr></h4>
                        <p class="explainComparan text-start">We call it "<span style="font-family: 'Alphazet', sans-serif; color: #5d9300; font-weight: 600;">COMPARAN</span>", an online platform for plant lovers who care about nature and sustainability. It provides a variety of plant seedlings and eco-friendly products to support a greener lifestyle. Through this platform, users can easily purchase plants while also contributing to environmental conservation and supporting local farmers.  We provide eco-friendly products and solutions to help you live a more sustainable lifestyle.</p>
                    </div>
                </div>
            </div>
            <!-- this is card -->
            <h3 class="text-center mt-5 mb-3 fw-semibold" style="font-family: 'Alphazet', sans-serif; color:#5d9300;">Why Choose Comparan?</h3>
            <div class="row px-0 w-100 justify-content-center">
                <div class="iconCard card col-12 col-md-4 mb-3 border-0" style=" padding-left: 0;">
                    <div class="row g-0">
                        <div class="iconBody card-body text-start">
                            <h5 class="iconTitle card-title"><i class="bi bi-leaf-fill"></i> Sustainable Products</h5>
                            <p class="explainIcon card-text">Eco-friendly products for a greener lifestyle.</p>
                        </div>
                    </div>
                </div>
                <div class="iconCard card col-12 col-md-4 mb-3 border-0" style="">
                    <div class="row g-0">
                        <div class="iconBody card-body text-start">
                            <h5 class="iconTitle card-title"><i class="bi bi-truck"></i> Safe and Fast Delivery</h5>
                            <p class="explainIcon card-text">Safe and fast delivery for your plants.</p>
                        </div>
                    </div>
                </div>
                <div class="iconCard card col-12 col-md-4 mb-3 border-0" style=" padding-right: 0;">
                    <div class="row g-0">
                        <div class="iconBody card-body text-start">
                            <h5 class="iconTitle card-title"><i class="bi bi-person-heart"></i> Support Local Farmers</h5>
                            <p class="explainIcon card-text">Supporting local farmers and communities.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of card -->
            
            <!-- this is vision -->
            <div class="w-100 mt-5 mt-md-5">
                <h2 class="vision text-center">We have vision to <span style="color: #b5bc00;">Save The Earth</span></h2>
            </div>
            <div class="containerCard row px-0 w-100 m-0 my-4">
                <div class="col-md-3 visionCard bg-transparent border-0 rounded- m-0" style="padding-left: 0; padding-right: 3rem;">
                    <div class="visionBody position-relative">
                        <img src="assets/image-1.png" class="imageVisionCard card-img-top rounded-5" alt="Image 1">
                        <p class="visionText card-text">Sustainability</p>
                    </div>
                </div>
                <div class="col-md-3 visionCard bg-transparent border-0 rounded-5 m-0" style="padding-left: 1rem; padding-right: 2rem;">
                    <div class="visionBody position-relative">
                        <img src="assets/image-3.png" class="imageVisionCard card-img-top rounded-5" alt="Image 3">
                        <p class="visionText card-text">Conservation</p>
                    </div>
                </div>
                <div class="col-md-3 visionCard bg-transparent border-0 rounded- m-0" style="padding-left: 2rem; padding-right: 1rem;">
                    <div class="visionBody position-relative">
                        <img src="assets/image-2.png" class="imageVisionCard card-img-top rounded-5" alt="Image 2">
                        <p class="visionText card-text">Greening The Earth</p>
                    </div>
                </div>
                <div class="col-md-3 visionCard bg-transparent border-0 rounded-5 m-0" style="padding-right: 0; padding-left: 3rem;">
                    <div class="visionBody position-relative">
                        <img src="assets/image-4.png" class="imageVisionCard card-img-top rounded-5" alt="Image 4">
                        <p class="visionText card-text">Reforestation</p>
                    </div>
                </div>
                <!-- card end -->
            </div>
            <!-- <h3>Let's see, choose, buy our plant, and get <span style="color: ;">an exclusive voucher</span>!</h3> -->
        </div>
    </section class="bg-black">

    <section id="shop" class="bg-black mx-4">
        <?php if (count($produk) === 0): ?>
            <p>Belum ada produk tersedia.</p>
            <?php else: ?>
                <div class="col p-0 bg-primary mx-4">
                    <div class="row">
                        <?php foreach ($produk as $p): ?>
                            <div class="productCard" onclick="bukaModal(
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
    
        <a href="logout.php">
            <button class="btn btn-secondary">Logout</button>
        </a>
    </section>

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