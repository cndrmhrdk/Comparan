<?php
require_once "server.php";
require_once "function/user_function.php";

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama     = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $id = tambahUser($connect, $nama, $username, $password);

    if ($id) {
        $pesan = "Registrasi berhasil!";
            header("Location: home.php");
            exit();
    } else {
        $pesan = "Registrasi gagal.";
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
    <h1>Add User</h1>
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Add User">
    </form>
</body>
</html>