<?php
session_start();

// Ketika user itu belum login maka akan redirect ke halaman datamahasiswa.php
if (isset($_SESSION['login'])) {
    header("Location: data_mahasiswa.php");
    exit();
}
require_once 'function.php';
$eror = false;
$errorUsername = false;
// var_dump($_POST);
// die();
if (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";

    mysqli_query($koneksi, $query);

    $result = mysqli_query($koneksi, $query);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['login'] = $user['id'];
            header("Location: data_mahasiswa.php");
            exit();
        } else {
            $eror = true;
        }
    } else {
        $errorUsername = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login web informatika</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/v4-shims.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <style>
        * {
            margin: 0;
        }
    </style>
    <div class="container-fluid login-page vh-100">
        <div class="container pt-5">
            <div class="card mb-3 bg-primary text-white" style="max-width: 600px; margin: auto;">
                <div class="card-header">
                    <h1 class="text-center">Login</h1>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <label for="username">Username:</label>
                        <div class="mb-3">

                            <input type="text" id="username" class="form-control" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">

                            <input type="checkbox" value="remember" class="form-check-input">
                            <label class="form-check-label">ingatkan saya</label>
                        </div>
                        <button type="submit" name="login" class="btn btn-light">Login</button>
                        <?php if ($eror) : ?>
                            <p style="color: red; margin: 0;">Username atau Password salah!</p>
                        <?php
                        endif; ?>
                        <?php if ($errorUsername) : ?>
                            <p style="color: red; margin: 0;">Username tidak ditemukan!</p>
                        <?php
                        endif; ?>
                    </form>
                    <p>Belum punya akun? <a href="register.php" class="text-white">Daftar</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>