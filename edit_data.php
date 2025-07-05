<?php

require 'function.php';
if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];
    $query = "SELECT * FROM mahasiswa WHERE id = '$id'";
    $mhs = tampildata($query)[0];
    $namafile = $mhs['foto']; // Tetap gunakan foto lama jika tidak ada upload baru
    // Cek apakah ada file foto yang diupload
    if(!empty($_FILES["foto"]['name'])){
       $file = $_FILES["foto"]['name'];
        $namafile = date('YmdHis') . '_'. $file;
        $tmp  = $_FILES['foto']['tmp_name'];
        $folder = 'img/';
        
        // Pastikan folder img sudah ada dan bisa ditulisi
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        
        $path = $folder . $namafile;
        if(file_exists($path)) {
            // Jika file sudah ada, hapus file lama
            unlink($path);
        }
        if($mhs['foto'] && file_exists($folder . $mhs['foto'])) {
            // Hapus foto lama jika ada
            unlink($folder . $mhs['foto']);
        }
        
        move_uploaded_file($tmp, $path);
    }
    // Update data mahasiswa
    $query = "UPDATE mahasiswa SET foto='$namafile', nim='$nim', nama='$nama', jurusan='$jurusan', alamat='$alamat' WHERE id='$id'";
    if(mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data berhasil disimpan!');
                window.location.href = 'data_mahasiswa.php';
            </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
    
}

$id = $_GET['id'];
$query = "SELECT * FROM mahasiswa WHERE id = '$id'";
$mhs = tampildata($query)[0];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
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
    <h2>Edit Data Mahasiswa</h2>
    <form action="" enctype="multipart/form-data" method="post">
        <input type="hidden" name="id" value="<?= $mhs['id'] ?>">
        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" required value="<?= $mhs['nim'] ?>"><br><br>

        <label for="name">Nama:</label>
        <input type="text" id="nama" name="nama" required value="<?= $mhs['nama'] ?>"><br><br>

        <label for="jurusan">Jurusan:</label>
        <input type="text" id="jurusan" name="jurusan" required value="<?= $mhs['jurusan'] ?>"><br><br>

        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" required value="<?= $mhs['alamat'] ?>"><br><br>
        <img width="200" src="<?= './img/'. $mhs['foto'] ?>" alt="<?= 'Gambar ' . $mhs['nama'] ?>"> <br> <br>
        <label for="foto">Foto:</label>
        <input type="file" style="cursor: pointer;" id="foto" name="foto" accept="image/*" ><br><br>
        
        <button type="submit" name="edit">Simpan Data</button> <button type="reset">Reset</button>
</body>
</html>