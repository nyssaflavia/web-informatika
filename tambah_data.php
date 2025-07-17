<?php
session_start();

if (!isset($_SESSION['login'])) 
{
    header("Location: datamahasiswa.php");
    exit();
}
$koneksi = mysqli_connect("localhost", "root", "", "Informatik");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    echo "Koneksi berhasil";
}
if(isset($_POST['simpan']))
{
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];

    $file = $_FILES["foto"]['name'];
    $namafile = date('YmdHis') . '_'. $file;
    $tmp  = $_FILES['foto']['tmp_name'];
    $folder = 'img/';
    // Pastikan folder img sudah ada dan bisa ditulisi
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }
    $path = $folder . $namafile;
    if(move_uploaded_file($tmp, $path)) {
        // Simpan nama file ke database
        $query = "INSERT INTO mahasiswa (foto, nama, nim, jurusan, alamat)
                  VALUES ('$namafile', '$nama', '$nim', '$jurusan', '$alamat')";
        if(mysqli_query($koneksi, $query)) {
            echo "<script>
                    alert('Data berhasil disimpan!');
                    window.location.href = 'data_mahasiswa.php';
                  </script>";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal mengupload file";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>
 <body>
    <style>
        input#file-uploud-button{
            cursor: pointer !important;
        }
        input[type=file] {
            cursor:pointer;
        }
    </style>
    <h2>Tambah Data Mahasiswa</h2>
    <form action="" enctype="multipart/form-data" method="post">
        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" required><br><br>

        <label for="name">Nama:</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="jurusan">Jurusan:</label>
        <input type="text" id="jurusan" name="jurusan" required><br><br>

        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" required><br><br>

        <label for="foto">Foto:</label>
        <input type="file" style="cursor: pointer;" id="foto" name="foto" accept="image/*" required><br><br>
        
        <button type="submit" name="simpan">Simpan Data</button> <button type="reset">Reset</button>
</body>
</html>