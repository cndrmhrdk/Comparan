<?php

    function checkout($connect, $id_user, $id_cart, $alamat, $items, $total){

    //buat order baru
    $sql = "INSERT INTO orders (id_user, id_cart, alamat_pengiriman, total_harga, diskon, total_bayar, status) 
                VALUES ('$id_user', '$id_cart', '$alamat', '$total', '0', '$total', 'pending')";
    $connect->query($sql);
    $id_order = $connect->insert_id;

    foreach ($items as $item){

    $subtotal    = $item["harga"] * $item["jumlah"];
        $harga       = $item["harga"];
        $jumlah      = $item["jumlah"];
        $id_produk   = $item["id_produk"];

        // 2. Simpan ke order_items
        $connect->query("INSERT INTO order_items (id_order, id_produk, jumlah, harga_satuan, subtotal) 
                    VALUES ('$id_order', '$id_produk', '$jumlah', '$harga', '$subtotal')");

        // 3. Kurangi stok
        $connect->query("UPDATE products SET stok = stok - '$jumlah' WHERE id_produk = '$id_produk'");

        // 4. Kalau stok habis ubah status jadi sold
        $connect->query("UPDATE products SET status = 'sold' WHERE id_produk = '$id_produk' AND stok <= 0");
    }

    // 5. Tambah poin ke user (1 poin per 1000 rupiah)
    $poin = intval($total / 1000);
    $connect->query("UPDATE users SET poin = poin + '$poin' WHERE id_user = '$id_user'");

    // 6. Catat ke point_logs
    $connect->query("INSERT INTO point_logs (id_user, id_order, poin_didapat) 
                VALUES ('$id_user', '$id_order', '$poin')");

    // 7. Kosongkan keranjang
    $connect->query("DELETE FROM cart_items WHERE id_cart = '$id_cart'");

    return $id_order;
    }
?>