<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
$siswa = table ("SELECT * FROM tb_siswa");
if (isset($_POST['search'])) {
    $siswa = cari ($_POST['keyword']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

        <?php $i = 1; ?>
        <?php foreach ($siswa as $siswi) : ?>
            <tr>
                <th><?php echo $i ?></th>
                <td><?php echo $siswi['nama'] ?></td>
                <td><?php echo $siswi['kelas'] ?></td>
                <td><?php echo $siswi['nomor'] ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $siswi['id']?>">Edit</a>
                    <a href="delete.php?id=<?php echo $siswi['id']; ?>" onclick="return confirm ('yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>