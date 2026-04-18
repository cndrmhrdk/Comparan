<?php 
    session_start();
    require_once 'server.php';
    require_once 'function/order_function.php';

    $id_user = $_SESSION["id_user"];
    $orders = riwayatOrder($connect, $id_user);  
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Order</title>
    <style>
        .card {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
        }
        .modal {
            background: white;
            width: 450px;
            margin: 80px auto;
            padding: 20px;
            border-radius: 8px;
            max-height: 80vh;
            overflow-y: auto;
        }
        .tutup {
            float: right;
            cursor: pointer;
            font-size: 20px;
        }
    </style>

</head>
<body>
    <h2>Riwayat Order</h2>
    <a href="home.php">Kembali</a><br><br>

    <?php if (count($orders) === 0): ?>
        <p>Belum ada order.</p>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <div class="card" onclick="bukaDetail('<?= $order["id_order"] ?>')">
                <b>Order #<?= $order["id_order"] ?></b><br>
                Tanggal : <?= $order["tanggal_order"] ?><br>
                Alamat  : <?= $order["alamat_pengiriman"] ?><br>
                Total   : Rp <?= number_format($order["total_bayar"], 0, ',', '.') ?><br>
                Status  : <b><?= $order["status"] ?></b>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Modal -->
    <div class="overlay" id="overlay" onclick="tutupModal()">
        <div class="modal" onclick="event.stopPropagation()">
            <span class="tutup" onclick="tutupModal()">✕</span>
            <h3>Detail Order</h3>
            <div id="isi-detail"></div>
        </div>
    </div>

    <script>
        function bukaDetail(id_order) {
            fetch("logic/detail_order_logic.php?id_order=" + id_order)
                .then(res => res.json())
                .then(data => {
                    let html = "";
                    data.forEach(item => {
                        html += `
                            <div style="display:flex; gap:10px; margin-bottom:10px; border-bottom:1px solid #ccc; padding-bottom:10px;">
                                <img src="uploads/produk/${item.gambar}" width="70" height="70" style="object-fit:cover;">
                                <div>
                                    <b>${item.nama_produk}</b><br>
                                    Harga   : Rp ${parseInt(item.harga_satuan).toLocaleString("id-ID")}<br>
                                    Jumlah  : ${item.jumlah}<br>
                                    Subtotal: Rp ${parseInt(item.subtotal).toLocaleString("id-ID")}
                                </div>
                            </div>`;
                    });
                    document.getElementById("isi-detail").innerHTML = html;
                    document.getElementById("overlay").style.display = "block";
                });
        }

        function tutupModal() {
            document.getElementById("overlay").style.display = "none";
        }
    </script>

</body>
</html>