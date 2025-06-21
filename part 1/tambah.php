<?php
session_start();
require 'db.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $sekolah = $_POST['sekolah'];
    $nomor_absen = $_POST['nomor_absen'];

    // Upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];

    // Simpan gambar ke folder "img/"
    if ($gambar !== "") {
        move_uploaded_file($tmp_name, 'img/' . $gambar);
    }

    // Tambahkan ke database
    $query = "INSERT INTO tb_siswa (nama, kelas, sekolah, nomor_absen, gambar) 
              VALUES ('$nama', '$kelas', '$sekolah', '$nomor_absen', '$gambar')";
    mysqli_query($db, $query);

    // Redirect kembali ke halaman utama
    header("Location: home.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Data Siswa</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Siswa</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas</label>
            <input type="text" name="kelas" id="kelas" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="sekolah" class="form-label">Sekolah</label>
            <input type="text" name="sekolah" id="sekolah" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nomor_absen" class="form-label">Nomor Absen</label>
            <input type="number" name="nomor_absen" id="nomor_absen" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>