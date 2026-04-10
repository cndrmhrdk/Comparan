<?php 
    require '../server.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $password = $_POST['password'];

        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

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