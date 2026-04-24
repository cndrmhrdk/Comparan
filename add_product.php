<?php 
    session_start();
    require_once 'server.php';
    require_once 'function/product_function.php';

    $pesan = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id_user     = $_SESSION["id_user"];    // Mengambil ID user dari session dan data produk dari inputan form
        $nama_produk = $_POST["nama_produk"];
        $harga       = $_POST["harga"];
        $stok        = $_POST["stok"];
        $deskripsi   = $_POST["deskripsi"];
        $kategori    = $_POST["kategori"];

        //upload gambar                                                
        $gambar = $_FILES["gambar"]["name"];                            // Mengambil nama asli file yang diunggah
        $tempFile = $_FILES["gambar"]["tmp_name"];                      // Mengambil lokasi penyimpanan sementara file di server
        move_uploaded_file($tempFile, "uploads/produk/" . $gambar);     // Memindahkan file dari lokasi sementara ke folder tujuan (uploads/produk/)
        //paggil fungsi tambah produk
        $id_produk = tambahProduk($connect, $id_user, $nama_produk, $harga, $stok, $deskripsi, $kategori, $gambar);
        if ($id_produk) {
            $pesan = "Produk berhasil ditambahkan.";
        } else {
            $pesan = "Gagal menambahkan produk.";
        }
    } 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <style>
        :root {
            --primary: #6FB400;
            --primary-dark: #5a9300;
            --bg: rgb(215, 231, 192);
            --text: #1e293b;
            --white: #ffffff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Tombol Kembali di Pojok */
        .btn-kembali {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: var(--white);
            color: var(--text);
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .btn-kembali:hover {
            background-color: #f8fafc;
            transform: translateX(-5px);
        }

        /* Container Form */
        .form-container {
            background-color: var(--white);
            width: 100%;
            max-width: 500px;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 30px;
            color: var(--text);
            font-size: 24px;
            text-align: center;
            border-bottom: 3px solid var(--primary);
            display: inline-block;
            padding-bottom: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: #475569;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            box-sizing: border-box; /* Agar padding tidak merusak lebar */
            transition: all 0.3s ease;
            outline: none;
        }

        input:focus, textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(111, 180, 0, 0.1);
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        /* Styling Input File */
        input[type="file"] {
            background: #f8fafc;
            padding: 10px;
            border: 2px dashed #cbd5e1;
            border-radius: 10px;
            width: 100%;
            cursor: pointer;
        }

        button {
            width: 100%;
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            margin-top: 10px;
        }

        button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(111, 180, 0, 0.3);
        }

        button:active {
            transform: translateY(0);
        }

        ::placeholder {
            color: #94a3b8;
        }
    </style>
</head>
<body>

    <a href="home.php" class="btn-kembali">← Kembali</a>

    <div class="form-container">
        <center><h2>Tambah Produk Baru</h2></center>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" placeholder="Contoh: Kopi Arabika">
            </div>

            <div class="form-group" style="display: flex; gap: 15px;">
                <div style="flex: 1;">
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga" placeholder="0">
                </div>
                <div style="flex: 1;">
                    <label>Stok</label>
                    <input type="number" name="stok" placeholder="0">
                </div>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="kategori" placeholder="Contoh: Minuman">
            </div>

            <div class="form-group">
                <label>Deskripsi Produk</label>
                <textarea name="deskripsi" placeholder="Jelaskan detail produk Anda..."></textarea>
            </div>

            <div class="form-group">
                <label>Foto Produk</label>
                <input type="file" name="gambar">
            </div>

            <button type="submit">🚀 Simpan Produk</button>
        </form>
    </div>

</body>
</html>