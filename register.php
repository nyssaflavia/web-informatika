<?php

    require_once 'function.php';
    if(isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
        $massage = register ("Register");

        alert("$massage");
        echo "<script>
        alert('addslashes ($massages');

        </script>";

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if($password === $confirm_password) {
            if(register($username, $email, $password)) {
                echo "<script>alert('Registration successful!');</script>";
            } else {
                echo "<script>alert('Registration failed. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Passwords do not match. Please try again.');</script>";
        }
    }

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register web informatika</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/v4-shims.min.css">

</head>
<body> 
    <div class="container">
        <div class="header">
            <h1>Web Informatika</h1>
        </div>
        <div class="card mb3">
            <div class="card-body">
            <h1>Register</h1>
            <form action="register.php" method="post">
                <div class="card mb3">
                    <div class="card-body">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="card mb3">
                    <label for="name">Name</label>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="card mb3">
                    <label for="password">Password</label>
                    <input type="password" id="password" class= "form control" id="password" 
                    name="password" placeholder="Enter your password" required>
                </div>
                <div class="card mb3">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                </div>
                <div class="card mb3">
                <button type="submit">Register</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
<?php
    function register($data)
    {
        global $koneksi;

        if(!isset($data['username']) || !isset($data['email']) || !isset($data['password']) || !isset($data['confirm_password'])) {
            return "Semua field harus diisi!";
        }

        $username = stripslashes(trim($data['username']));
        $email    = trim($data['email']);
        $password1 = trim($data['password']);
        $password2 = trim($data['confirm_password']);

        $queryusername = "SELECT id FROM users WHERE username = '$username'";

        $usernamecheck = mysqli_query($koneksi, $queryusername);
        if(mysqli_num_rows($usernamecheck) > 0)
         {
            return "Username Sudah Terdaftar!";
        }

        if(preg_match('/^[a-zA-Z0-9._-]+$/', $username) === 0) {
            return "Username Tidak Valid!";
        }

        if($password1 !== $password2)
         {
            return "Konfirmasi Password Tidak Cocok!";
        }

            $hash_password = password_hash($password1, PASSWORD_DEFAULT);
    
            $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hash_password')";
            if(mysqli_query($koneksi, $query_insert))
            {
                return "Registrasi berhasil!";
            } else 
            {
                return "Registrasi gagal. Silakan coba lagi.";
            }
        }