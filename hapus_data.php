<?php
session_start();

if (!isset($_SESSION['login'])) 
{
    header("Location: datamahasiswa.php");
    exit();
}
require 'function.php';

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    // Ambil data mahasiswa berdasarkan id
    $queryMahasiswa = "SELECT * FROM mahasiswa WHERE id = '$id'";
    $result = mysqli_query($koneksi, $queryMahasiswa);
    if ($result && $row = mysqli_fetch_assoc($result)) {
        $fotoPath = './img/' . $row['foto'];
        if (file_exists($fotoPath) && is_file($fotoPath)) {
            unlink($fotoPath);
        }
    }
    $query = "DELETE FROM mahasiswa WHERE id = '$id'";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href = 'data_mahasiswa.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
    // Mahassiswa::where('id', $id)->delete();
}
