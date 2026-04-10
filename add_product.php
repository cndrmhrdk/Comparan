<?php 
    session_start();
    require_once 'server.php';
    require_once 'function/product_function.php';

    $pesan = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id_user     = $_SESSION["id_user"];
        $nama_produk = $_POST["nama_produk"];
        $harga       = $_POST["harga"];
        $stok        = $_POST["stok"];
        $deskripsi   = $_POST["deskripsi"];
        $kategori    = $_POST["kategori"];

        //upload gambar
        $gambar = $_FILES["gambar"]["name"];
        $tempFile = $_FILES["gambar"]["tmp_name"];
        move_uploaded_file($tempFile, "uploads/produk/" . $gambar);

        $id_produk = tambahProduk($connect, $id_user, $nama_produk, $harga, $stok, $deskripsi, $kategori, $gambar);
        if ($id_produk) {
            $pesan = "Produk berhasil ditambahkan.";
        } else {
            $pesan = "Gagal menambahkan produk.";
        }
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
    <h2>tambah produk</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="nama_produk" placeholder="Nama Produk"><br><br>
        <input type="number" name="harga" placeholder="Harga"><br><br>
        <input type="number" name="stok" placeholder="Stok"><br><br>
        <input type="text" name="kategori" placeholder="Kategori"><br><br>
        <textarea name="deskripsi" placeholder="Deskripsi"></textarea><br><br>
        <input type="file" name="gambar"><br><br>
        <button type="submit">Tambah Produk</button>
    </form>
</body>
</html>