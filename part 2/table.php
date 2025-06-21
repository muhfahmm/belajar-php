<?php
require 'functions.php';

// ambil data yang ada di database
$result = mysqli_query($db, "SELECT * FROM tb_siswa");
// simpan dalam variabel result lalu mysqli_query
// parameter pertama = variabel koneksi ke database ($db);
// parameter kedua = kode sql untuk mengambil semua data yang ada ditabel / untuk menampilkan

$rows =  [];
while ($row = mysqli_fetch_all($result)) {
    $row[] = $row;
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
    <a href="tambah.php">tambah</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Nomor Absen</th>
            <th>Aksi</th>
        </tr>

        <?php $no = 1 ?>
        <?php foreach ($result as $siswi) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $siswi['nama'] ?></td>
                <td><?= $siswi['kelas'] ?></td>
                <td><?= $siswi['nomor'] ?></td>
                <td>
                    <a href="hapus.php?id=<?= $siswi['id']?>">hapus</a>
                    |
                    <a href="edit.php"></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>