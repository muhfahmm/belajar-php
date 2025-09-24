<?php
session_start();
if (isset($_SESSION["login"])) {
    header("Location: table.php");
    exit;
}

require 'db.php';
if (isset($_POST['register'])) {
    if (register($_POST) > 0 ) {
        echo "<script>
        alert ('user berhasil mendaftar');
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
        <input type="text" name="username" placeholder="username"><br>
        <input type="password" name="password1" placeholder="password 1"><br>
        <input type="password" name="password2" placeholder="password 2"><br>
        <button type="submit" name="register">daftar</button>
        <p>sudah punya akun? <a href="login.php">Login</a></p>
    </form>
</body>
</html>