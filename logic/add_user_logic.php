<?php 
    require '../server.php';
    
    // Proses tambah user
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $password = $_POST['password'];

        // hash password sebelum disimpan ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Simpan data user baru ke database
        $sql = "INSERT INTO users (username, nama, password) VALUES ('$username', '$name', '$hashed_password')";
        
        if (mysqli_query($connect, $sql)) {
            echo "New user added successfully";
            header("Location: ../home.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
    }
?>