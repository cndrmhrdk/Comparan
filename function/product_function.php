<?php
function tambahProduk($connect, $id_user, $nama_produk, $harga, $stok, $deskripsi, $kategori, $gambar) {
    $sql = "INSERT INTO products (id_user, nama_produk, harga, stok, deskripsi, kategori, gambar, status) 
                VALUES ('$id_user', '$nama_produk', '$harga', '$stok', '$deskripsi', '$kategori', '$gambar', 'open')";
    $connect->query($sql);
    
    return $connect->insert_id;
}