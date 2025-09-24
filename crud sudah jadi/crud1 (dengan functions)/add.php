<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
if (isset($_POST['add'])) {
    if(add($_POST) > 0) {
        echo "<script>
        alert ('data berhasil ditambah');
        document.location.href='table.php';
        </script>";
    }
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
    <input type="text" name="nama" placeholder="nama" required>
            <br>
            <input type="text" name="kelas" placeholder="kelas" required>
            <br>
            <input type="text" name="nomor" placeholder="nomor absen" required>
            <br>
            <input type="text" name="gender" placeholder="gender" required>
            <br>
            <input type="text" name="email" placeholder="email" required>
            <br>
            <button type="submit" name="add">tambah</button>
    </form>
</body>
</html>