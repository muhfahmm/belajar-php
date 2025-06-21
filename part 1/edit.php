<?php
session_start();
require 'db.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data lama dari database
$data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM tb_siswa WHERE id = $id"));

// Proses update jika form disubmit
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $sekolah = $_POST['sekolah'];
    $nomor_absen = $_POST['nomor_absen'];

    // Cek apakah ada gambar baru diupload
    if ($_FILES['gambar']['name'] != '') {
        $gambar_baru = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];

        // Hapus gambar lama
        if (!empty($data['gambar']) && file_exists('img/' . $data['gambar'])) {
            unlink('img/' . $data['gambar']);
        }

        // Pindahkan gambar baru
        move_uploaded_file($tmp_name, 'img/' . $gambar_baru);
    } else {
        $gambar_baru = $data['gambar'];
    }

    // Update ke database
    mysqli_query($db, "UPDATE tb_siswa SET 
        nama = '$nama',
        kelas = '$kelas',
        sekolah = '$sekolah',
        nomor_absen = '$nomor_absen',
        gambar = '$gambar_baru'
        WHERE id = $id
    ");

    // Redirect ke index
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Data Siswa</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Siswa</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas</label>
            <input type="text" name="kelas" id="kelas" class="form-control" value="<?= htmlspecialchars($data['kelas']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="sekolah" class="form-label">Sekolah</label>
            <input type="text" name="sekolah" id="sekolah" class="form-control" value="<?= htmlspecialchars($data['sekolah']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="nomor_absen" class="form-label">Nomor Absen</label>
            <input type="number" name="nomor_absen" id="nomor_absen" class="form-control" value="<?= htmlspecialchars($data['nomor_absen']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label><br>
            <img src="img/<?= htmlspecialchars($data['gambar']) ?>" alt="gambar" style="height: 100px;"><br><br>
            <input type="file" name="gambar" id="gambar" class="form-control">
            <small>Kosongkan jika tidak ingin mengganti gambar</small>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
