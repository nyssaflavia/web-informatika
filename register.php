<?php

require_once 'function.php';

if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        echo register([
            "name" => $name,
            "username" => $username,
            "email" => $email,
            "password" => $password,
            "confirm_password" => $confirm_password
        ]);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container-fluid login-page vh-100">
        <div class="container pt-5">
            <div class="card mb-3 bg-primary text-white">
                <div class="card-header">
                    <h1 class="text-center">Web Informatika</h1>
                </div>
                <div class="card-body">
                    <h1>Register</h1>
                    <form action="register.php" method="post">
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required placeholder="Enter your username">
                        </div>

                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" class="form control"
                                name="password" placeholder="Enter your password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                            <input type="hidden" name="submit" value="Register">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-light">Submit</button>
                            <a href="login.php" class="text-white ms-3">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="script.js"></script>
</body>

</html>
<?php
function register($data)
{
    global $koneksi;

    if (!isset($data['username']) || !isset($data['email']) || !isset($data['name']) || !isset($data['password']) || !isset($data['confirm_password'])) {
        return "Semua field harus diisi!";
    }

    $username = stripslashes(trim($data['username']));
    $email    = trim($data['email']);
    $name    = trim($data['name']);
    $password1 = trim($data['password']);
    $password2 = trim($data['confirm_password']);
    $password2 = trim($data['confirm_password']);

    $queryusername = "SELECT id FROM users WHERE username = '$username'";
    $queryemail = "SELECT id FROM users WHERE email = '$email'";

    $usernamecheck = mysqli_query($koneksi, $queryusername);
    $emailcheck = mysqli_query($koneksi, $queryemail);
    if (mysqli_num_rows($usernamecheck) > 0) {
        return "Username Sudah Terdaftar!";
    }

    if (mysqli_num_rows($emailcheck) > 0) {
        return "Email Sudah Terdaftar!";
    }

    if (preg_match('/^[a-zA-Z0-9._-]+$/', $username) === 0) {
        return "Username Tidak Valid!";
    }

    if ($password1 !== $password2) {
        return "Konfirmasi Password Tidak Cocok!";
    }

    $hash_password = password_hash($password1, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, name, email, password) VALUES ('$username','$name', '$email', '$hash_password')";
    // var_dump($query);
    // die(mysqli_error($koneksi));
    if (mysqli_query($koneksi, $query)) {
        return "Berhasil mendaftar!";
    } else {
        return "Gagal mendaftar: " . mysqli_error($koneksi);
    }
}
