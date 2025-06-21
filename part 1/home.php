<?php
session_start();
require 'db.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Mengambil semua data dari tabel tb_siswa
$result = mysqli_query($db, "SELECT * FROM tb_siswa");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<h1>Selamat Datang <?php echo $_SESSION['username'] ?></h1>
<a href="logout.php">logout</a>
<div class="container mt-5">
    <a href="tambah.php">Tambah</a>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%;">
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Sekolah</th>
            <th>Nomor Absen</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>

        <?php $no = 1; ?>
        <!-- Perulangan untuk menampilkan setiap baris data -->
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['kelas']; ?></td>
            <td><?php echo $row['sekolah']; ?></td>
            <td><?php echo $row['nomor_absen']; ?></td>
            <td><img src="img/<?php echo $row['gambar']; ?>" alt="" style="height: 100px;"></td>
            <td>
                <a href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('yakin hapus?')">Hapus</a> |
                <a href="edit.php?id=<?php echo $row['id']; ?>" onclick="return confirm('yakin edit?')">Edit</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
