<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
    // ambil data di url
    $id = $_GET ['id'];

    // query data berdasarkan id
    $siswa = table ("SELECT * FROM tb_siswa WHERE id = $id ")[0];
    
// cek apakah tombol submit ditekan atau belum
if (isset ($_POST['confirm'])) {
    // cek apakah data berhasil di ubah atau tidak
    if (update ($_POST) > 0) {
        echo "
        <script>
            alert ('data berhasil di ubah');
            document.location.href = 'table.php';
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
    <title>Ubah</title>
</head>
<body>
    <a href="main.php">Kembali</a>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $siswa['id'] ?>">
        <br>
        <input type="text" name="nama" placeholder="nama" required value="<?php echo $siswa['nama']?>">
        <br>
        <input type="text" name="kelas" placeholder="kelas" required value="<?php echo $siswa['kelas']?>">
        <br>
        <input type="text" name="nomor" placeholder="nomor absen" required value="<?php echo $siswa['nomor']?>">
        <br>
        <input type="text" name="gender" placeholder="gender" required value="<?php echo $siswa['gender']?>">
        <br>
        <input type="text" name="email" placeholder="email" required value="<?php echo $siswa['email']?>">
        <br>
        <button type="submit" name="confirm">Konfirmasi</button>
    </form>
</body>
</html>