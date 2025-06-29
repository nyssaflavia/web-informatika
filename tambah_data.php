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
    <a href = "tambah data.php"<button style= "background- color: blue;" 
cursor: pointer; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Tambah Data</button></a>


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