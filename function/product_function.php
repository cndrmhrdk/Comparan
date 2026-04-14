<?php
    // Fungsi buat tambah produk baru
    function tambahProduk($connect, $id_user, $nama_produk, $harga, $stok, $deskripsi, $kategori, $gambar) {
        $sql = "INSERT INTO products (id_user, nama_produk, harga, stok, deskripsi, kategori, gambar, status) 
                    VALUES ('$id_user', '$nama_produk', '$harga', '$stok', '$deskripsi', '$kategori', '$gambar', 'open')";
        $connect->query($sql);
        return $connect->insert_id;
    }

    // Fungsi buat ambil produk berdasarkan id_user
    function produkSaya($connect, $id_user){
        $sql = "SELECT * FROM products WHERE id_user = '$id_user'";
        $result = $connect->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Fungsi buat ambil semua produk kecuali produk milik user
    function tampilSemuaProduk($connect, $id_user){
        $sql = "SELECT * FROM products WHERE id_user != '$id_user'";
        $result = $connect->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
        //fetch_all() digunakan untuk mengambil semua baris hasil query. 
        // MYSQLI_ASSOC memastikan bahwa setiap baris dikembalikan sebagai array asosiatif, di mana nama kolom digunakan sebagai kunci.
    }
?>