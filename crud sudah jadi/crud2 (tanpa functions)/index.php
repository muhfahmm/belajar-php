<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';

// default ambil semua data
$siswa = [];
$query = "SELECT * FROM tb_siswa";

// cek jika tombol search ditekan
if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    $query = "SELECT * FROM tb_siswa WHERE 
                nama LIKE '%$keyword%' OR
                kelas LIKE '%$keyword%' OR
                nomor LIKE '%$keyword%' OR
                gender LIKE '%$keyword%' OR
                email LIKE '%$keyword%'";
}

// eksekusi query
$result = mysqli_query($db, $query);

// simpan hasil ke array $siswa
while ($row = mysqli_fetch_assoc($result)) {
    $siswa[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
</head>
<body>
    <a href="logout.php">logout</a>
    <a href="register.php">daftar</a>
    <a href="add.php">tambah</a>

    <form action="" method="post">
        <input type="text" name="keyword" placeholder="cari...">
        <button type="submit" name="search">cari</button>
    </form>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Nomor</th>
            <th>Aksi</th>
        </tr>

        <?php if (!empty($siswa)) : ?>
            <?php $i = 1; ?>
            <?php foreach ($siswa as $siswi) : ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $siswi['nama']; ?></td>
                    <td><?php echo $siswi['kelas']; ?></td>
                    <td><?php echo $siswi['nomor']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $siswi['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $siswi['id']; ?>" onclick="return confirm('yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5">Data tidak ditemukan</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
