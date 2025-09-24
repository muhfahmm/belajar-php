<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

require 'db.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($db, "SELECT * FROM tb_admin WHERE nama = '$username' ");

    // cek username atau email
    if (mysqli_num_rows($result) === 1) {
        $_SESSION['login'] = true;
        // cek password
        $pass = mysqli_fetch_assoc($result);
        if (password_verify($password, $pass['password'])) {
            header("Location: index.php");
            exit;
        }
    }
    $error = true;
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
    <?php if (isset($error)) : ?>
        <p>username atau password salah</p>
    <?php endif; ?>
    <form action="" method="post">
        <input type="text" name="username" placeholder="username"><br>
        <input type="password" name="password" placeholder="password"><br>
        <button type="submit" name="login">login</button>
        <p>belum punya akun? <a href="register.php">register</a></p>
    </form>
</body>

</html>