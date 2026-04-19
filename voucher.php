<?php 
    session_start();
    require_once "server.php";
    require_once "function/voucher_function.php";

    $id_user = $_SESSION["id_user"];
    $pesan = $_GET["pesan"] ?? "";
    $vouchers  = daftarVoucher($connect);
    $milik = voucherSaya($connect, $id_user);

    $sql = "SELECT poin FROM users WHERE id_user = '$id_user'";
    $result = $connect->query($sql);
    $user = $result->fetch_assoc();
    $poin = $user["poin"];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Voucher</title>
</head>
<body>
    <h2>Voucher</h2>
    <p>Poin kamu: <b><?= $poin ?></b></p>

    <?php if ($pesan === "berhasil"): ?>
        <p style="color:green;">Voucher berhasil ditukar!</p>
    <?php elseif ($pesan === "poin_kurang"): ?>
        <p style="color:red;">Poin kamu tidak cukup.</p>
    <?php endif; ?>

    <h3>Voucher Tersedia</h3>
    <?php if (count($vouchers) === 0): ?>
        <p>Belum ada voucher tersedia.</p>
    <?php else: ?>
        <?php foreach ($vouchers as $v): ?>
            <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                <b><?= $v["nama"] ?></b><br>
                Potongan : Rp <?= number_format($v["nilai"], 0, ',', '.') ?><br>
                Poin     : <?= $v["poin_diperlukan"] ?> poin<br>
                <a href="logic/tukar_voucher_logic.php?id_voucher=<?= $v["id_voucher"] ?>"
                    onclick="return confirm('Tukar voucher ini dengan <?= $v["poin_diperlukan"] ?> poin?')">Tukar</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <h3>Voucher Saya</h3>
    <?php if (count($milik) === 0): ?>
        <p>Belum punya voucher.</p>
    <?php else: ?>
        <?php foreach ($milik as $v): ?>
            <div style="border: 1px solid green; padding: 10px; margin-bottom: 10px;">
                <b><?= $v["nama"] ?></b><br>
                Potongan : Rp <?= number_format($v["nilai"], 0, ',', '.') ?><br>
                Status   : <?= $v["status"] ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>