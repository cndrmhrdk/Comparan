<?php 
    function tambahKeranjang($connect, $id_cart, $id_produk, $jumlah){
        $sql = "SELECT * FROM cart_items WHERE id_cart = '$id_cart' AND id_produk = '$id_produk'";
        $cek = $connect->query($sql);

        if($cek->num_rows > 0){
            $item = $cek->fetch_assoc();
            $jumlahBaru = $item["jumlah"] + $jumlah;
            $add = "UPDATE cart_items SET jumlah = '$jumlahBaru' WHERE id_cart = '$id_cart' AND id_produk = '$id_produk'";
            $connect->query($add);
        }else {
             // Belum ada, insert baru
            $add = "INSERT INTO cart_items (id_cart, id_produk, jumlah) VALUES ('$id_cart', '$id_produk', '$jumlah')";
            $connect->query($add);
        }
    }

    function tampilKeranjang($connect, $id_cart){
        $sql = "SELECT cart_items.*, products.nama_produk, products.harga, products.gambar 
                            FROM cart_items 
                            JOIN products ON cart_items.id_produk = products.id_produk 
                            WHERE cart_items.id_cart = '$id_cart'";
        $result = $connect->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function hapusItemKeranjang($connect, $id_item){
        $sql = "DELETE FROM cart_items WHERE id_item = '$id_item'";
        $connect->query($sql);
    }
?>