<?php 
    require_once 'server.php';
    require_once 'function/user_function.php';
    
    $pesan = "";

    // Proses login
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        //panggil fungsi loginUser untuk memeriksa kredensial
        $user = loginUser($connect, $username, $password);

        if($user){
            session_start();
            $_SESSION["id_user"] = $user["id_user"];
            $_SESSION["nama"] = $user["nama"];
            $_SESSION["role"] = $user["role"];
            header("Location: home.php");
            exit();
        } else {
            $pesan = "Login gagal. Periksa username dan password.";
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
    <h1>Login</h1>
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>