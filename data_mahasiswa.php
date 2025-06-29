<?php

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


$query = "SELECT * FROM mahasiswa";
$mhs = tampildata($query);
// File: datamahasiswa.php
echo "hello world";
$nama1 ="Nyssa Flavia";
$nama2 = "Javelin";


$koneksi = mysqli_connect("localhost", "root", "", "informatik");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
else {
    echo "Koneksi berhasil";
}
// mysqli_f($koneksi, "SELECT * FROM mahasiswa");
//echo $nama;
//mysqli_fetch_assoc($query);
//mysqli_fetch_array($query);
//mysqli_fetch_row($query);
//mysqli_num_object($query);
//mysqli_fetch_field($query);
$i = 1;

?>
<br>
<a href = "tambah_data.php"<button style= "background- color: blue;" 
cursor: pointer; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Tambah Data</button></a>
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <th>No</th>
        <th>Nim</th>
        <th>Nama</th>
        <th>Jurusan</th>
        <th>Alamat</th>
        <th>Foto</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        <?php foreach ($mhs as $index => $mhs): ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= $mhs['nim']; ?></td>
                <td><?= $mhs['nama']; ?></td>
                <td><?= $mhs['jurusan']; ?></td>
                <td><?= $mhs['alamat']; ?></td>
                <td><img width="100" src="<?= './img/'. $mhs['foto']; ?>" alt="<?= 'Foto ' . $mhs['nama']; ?>"></td>
                <td>
                    <button>Edit</button>
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?= $mhs['id']; ?>">
                        <button name="hapus" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>





