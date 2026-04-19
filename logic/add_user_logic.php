<?php 
    require '../server.php';
    
    // Proses tambah user
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // hash password sebelum disimpan ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Simpan data user baru ke database
        $sql = "INSERT INTO users (username, nama, password, email) VALUES ('$username', '$name', '$hashed_password', '$email')";
        
        if (mysqli_query($connect, $sql)) {
            echo "New user added successfully";
            header("Location: ../home.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
    }
?>