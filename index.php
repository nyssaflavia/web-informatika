<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home - Aplikasi Pemesanan Tiket</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <style>
        body {
            background-color: rgb(72, 109, 152);
        }

        h1 {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            text-align: center;
        }

        nav {
            padding: 10px;
            /* text-align: center; */
        }

        nav ul {
            display: flex;
            justify-content: center;
            gap: 20px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;

        }

        nav ul li {
            list-style: none;
            color: white;
        }

        .text-white {
            color: #fff;
        }

        p {
            text-align: center;
        }

        li a {
            /* text-decoration: none; */
            color: inherit;
        }
    </style>

<body>
    <header>
        <h1>Selamat Datang di Aplikasi Pemesanan Tiket</h1>
        <!-- <br> -->
        <nav>
            <ul>

                <li><a href="index.php">Home</a></li>
                <li><a href="services.html">layanan</a></li>
                <li><a href="data_mahasiswa.php">Data Mahasiswa</a></li>
                <li><a href="login.php">Masuk</a></li>
                <li><a href="register.php">Daftar</a></li>
                <?php if (isset($_SESSION['login'])) : ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>


    </header>
    <div style="display: flex; justify-content: center; flex-direction: column; align-items: center;">
        <img src="https://img.lovepik.com/free-template/01/42/54/758pIkbEsTcQf.jpg_master.jpg!wh650" alt="banner tiket"
            width="300">
        <p>
            <strong class="text-white">Selamat datang di Aplikasi Pemesanan Tiket!</strong> <br>
            Di sini, Anda dapat dengan mudah memesan tiket untuk berbagai acara dan perjalanan. Nikmati kemudahan
            dalam mengatur rencana perjalanan Anda.
        </p>
    </div>
</body>

</html>