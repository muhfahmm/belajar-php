<!-- <?php
require 'functions.php';
if (isset($_POST['add'])) {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $nomor = $_POST['nomor'];

    // proses tambah
    $tambah = "INSERT INTO tb_siswa (nama,kelas,nomor)
    VALUES
    ('$nama', '$kelas', '$nomor')";
    mysqli_query($db, $tambah);

    header("Location: table.php");
    exit;
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
    <form action="" method="post">
        <input type="text" name="nama" placeholder="nama">
        <br>
        <input type="text" name="kelas" placeholder="kelas">
        <br>
        <input type="text" name="nomor" placeholder="nomor">
        <br>
        <button name="add" type="submit">tambah</button>
    </form>
</body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require 'functions.php';
    if (isset($_POST['add'])) {
        $nama = htmlspecialchars(strtolower($_POST['nama']));
        $kelas = htmlspecialchars(strtolower($_POST['kelas']));
        $nomor = htmlspecialchars(strtolower($_POST['nomor']));

        $tambah = "INSERT INTO tb_siswa (nama,kelas,nomor)
        VALUES ('$nama', '$kelas', '$nomor')";
        mysqli_query($db, $tambah);

        Header("Location: table.php");
    }
    ?>
        <form action="" method="post">
        <input type="text" name="nama" placeholder="nama">
        <br>
        <input type="text" name="kelas" placeholder="kelas">
        <br>
        <input type="text" name="nomor" placeholder="nomor">
        <br>
        <button name="add" type="submit">tambah</button>
    </form>
</body>
</html>