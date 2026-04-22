<?php 
    session_start();
    require_once "server.php";
    require_once "function/user_function.php";

    $id_user = $_SESSION["id_user"];
    $user = tampilDataUser($connect, $id_user);
    $pesan   = $_GET["pesan"] ?? "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <style>
        .foto {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h2>Profil</h2>
    <?php if ($pesan === "berhasil"): ?>
        <p style="color:green;">Profil berhasil diupdate!</p>
    <?php endif; ?>
    <!-- Data Diri -->

    <h3>Edit Profil</h3>
    <form method="POST" action="logic/edit_profil_logic.php" enctype="multipart/form-data">
        <input type="text" name="nama" value="<?= $user["nama"] ?>" placeholder="Nama"><br><br>
        <input type="text" name="username" value="<?= $user["username"] ?>" placeholder="Username"><br><br>
        <input type="password" name="password" placeholder="Password baru (kosongkan jika tidak diubah)"><br><br>
        <input type="file" name="foto"><br><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>