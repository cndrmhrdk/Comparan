<?php 
    session_start();
    require_once '../server.php';
    require_once '../function/user_function.php';

    $id_user  = $_SESSION["id_user"];
    $nama     = $_POST["nama"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $foto = null;
    if($_FILES["foto"]["name"] != ""){
        $foto_profile = $_FILES["foto"]["name"];
        $tempFile = $_FILES["foto"]["tmp_name"];
        move_uploaded_file($tempFile, "../uploads/profil/". $foto_profile);
    }

    editProfil($connect, $id_user, $nama, $username, $password, $foto_profile);

    //update session nama
    $_SESSION["nama"] = $nama;
    header("Location: ../profil.php?pesan=berhasil");
    exit;
?>