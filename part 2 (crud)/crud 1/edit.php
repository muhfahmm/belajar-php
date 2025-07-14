<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require 'db.php';

    $id = $_GET['id'];
    $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM tb_siswa WHERE id = '$id' "));
    if (isset($_POST['edit'])) {
        $nama = htmlspecialchars(strtolower($_POST['nama']));
        $kelas = htmlspecialchars(strtolower($_POST['kelas']));
        $nomor = htmlspecialchars(strtolower($_POST['nomor']));

        mysqli_query($db, "UPDATE tb_siswa SET
        nama = '$nama',
        kelas = '$kelas',
        nomor = '$nomor' WHERE id = '$id'
        ");

        header("Location: table.php");
        exit;
    }
    ?>
    <form action="" method="post">
        <input type="text" name="nama" placeholder="nama" value="<?php echo $data['nama']?>">
        <br>
        <input type="text" name="kelas" placeholder="kelas" value="<?php echo $data['kelas']?>">
        <br>
        <input type="text" name="nomor" placeholder="nomor" value="<?php echo $data['nomor']?>">
        <br>
        <button name="edit" type="submit">edit</button>
    </form>
</body>

</html>