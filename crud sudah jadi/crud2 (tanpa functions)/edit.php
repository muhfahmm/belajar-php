<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'db.php';

// ambil data dari URL
$id = $_GET['id'];

// query data berdasarkan id
$siswa = table("SELECT * FROM tb_siswa WHERE id = $id")[0];

// cek apakah tombol submit ditekan
if (isset($_POST['confirm'])) {
    // ambil data dari form
    $id    = $_POST['id'];
    $nama  = htmlspecialchars($_POST['nama']);
    $kelas = htmlspecialchars($_POST['kelas']);
    $nomor = htmlspecialchars($_POST['nomor']);

    // query UPDATE langsung tanpa function
    $query = "UPDATE tb_siswa SET 
                nama = '$nama',
                kelas = '$kelas',
                nomor = '$nomor'
              WHERE id = $id";

    mysqli_query($db, $query);

    // cek apakah data berhasil diubah
    if (mysqli_affected_rows($db) > 0) {
        echo "
        <script>
            alert('Data berhasil diubah');
            document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data gagal diubah');
            document.location.href = 'index.php';
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
</head>

<body>
    <a href="main.php">Kembali</a>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $siswa['id']; ?>">
        <br>
        <input type="text" name="nama" placeholder="nama" required value="<?php echo $siswa['nama']; ?>">
        <br>
        <input type="text" name="kelas" placeholder="kelas" required value="<?php echo $siswa['kelas']; ?>">
        <br>
        <input type="text" name="nomor" placeholder="nomor absen" required value="<?php echo $siswa['nomor']; ?>">
        <br>
        <button type="submit" name="confirm">Konfirmasi</button>
    </form>
</body>

</html>