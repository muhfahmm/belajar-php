<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'db.php';

if (isset($_POST['add'])) {
    // Ambil data dari tiap elemen form
    $nama  = htmlspecialchars($_POST['nama']);
    $kelas = htmlspecialchars($_POST['kelas']);
    $nomor = htmlspecialchars($_POST['nomor']);

    // Query INSERT DATA langsung tanpa function
    $query = "INSERT INTO tb_siswa VALUES ('', '$nama', '$kelas', '$nomor')";
    mysqli_query($db, $query);

    // Cek apakah data berhasil ditambahkan
    if (mysqli_affected_rows($db) > 0) {
        echo "<script>
                alert('Data berhasil ditambah');
                document.location.href='table.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambah data');
              </script>";
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
    <form action="" method="post">
        <input type="text" name="nama" placeholder="nama" required>
        <br>
        <input type="text" name="kelas" placeholder="kelas" required>
        <br>
        <input type="text" name="nomor" placeholder="nomor absen" required>
        <br>
        <button type="submit" name="add">tambah</button>
    </form>
</body>
</html>
