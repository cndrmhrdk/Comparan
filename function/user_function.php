<?php
    function tambahUser($connect, $nama, $username, $password) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (nama, username, password, role, poin) VALUES ('$nama', '$username', '$passwordHash', 'user', 0)";
        $connect->query($sql);
        
        $id_user = $connect->insert_id;
        
        $sql = "INSERT INTO cart (id_user) VALUES ('$id_user')";
        $connect->query($sql);
        
        return $id_user;
    }

    function loginUser($connect, $username, $password) {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $connect->query($sql);
        $row = $result->fetch_assoc();

        if ($row && password_verify($password, $row['password'])) {
            return $row;
        }
        return false;
    }
?>