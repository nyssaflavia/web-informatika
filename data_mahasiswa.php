<?php
session_start();

if (!$_SESSION['login']) {
    header("Location: login.php");
    exit();
}

require 'function.php';
$query = "SELECT * FROM mahasiswa";
$mhs = tampildata($query);
// File: datamahasiswa.php
// echo "hello world";
// $nama1 ="Nyssa Flavia";
// $nama2 = "Javelin";


// $koneksi = mysqli_connect("localhost", "root", "", "informatik");
// if (!$koneksi) {
//     die("Koneksi gagal: " . mysqli_connect_error());
// }
// else {
//     echo "Koneksi berhasil";
// }
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
<a href="tambah_data.php"> <button style="background-color: blue; cursor: pointer; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Tambah Data</button></a>
<a href="logout.php"> <button style="background-color: red; cursor: pointer; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Logout</button></a>
<table border="1" cellpadding="10" cellspacing="0" style="margin-top: 20px;">
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
                <td><img width="100" src="<?= './img/' . $mhs['foto']; ?>" alt="<?= 'Foto ' . $mhs['nama']; ?>"></td>
                <td>
                    <a href="edit_data.php?id=<?= $mhs['id']; ?>">
                        <button>Edit</button>
                    </a>
                    <form action="hapus_data.php" method="POST">
                        <input type="hidden" name="id" value="<?= $mhs['id']; ?>">
                        <button name="hapus" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>