<?php
session_start();
if (isset($_SESSION["login"])) {
    header("Location: table.php");
    exit;
}

require 'db.php';

if (isset($_POST['register'])) {
    $username  = $_POST['username'];
    $password1 = mysqli_real_escape_string($db, $_POST['password1']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);

    // cek username sudah ada atau belum
    $result = mysqli_query($db, "SELECT nama FROM tb_admin WHERE nama = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('username sudah terdaftar');
        </script>";
    } elseif ($password1 !== $password2) {
        // cek konfirmasi password
        echo "<script>
            alert('password tidak sama');
        </script>";
    } else {
        // enkripsi password
        $password1 = password_hash($password1, PASSWORD_DEFAULT);

        // masukkan user baru ke database
        mysqli_query($db, "INSERT INTO tb_admin VALUES ('', '$username', '$password1')");

        if (mysqli_affected_rows($db) > 0) {
            echo "<script>
                alert('user berhasil mendaftar');
                document.location.href='login.php';
            </script>";
        } else {
            echo "<script>
                alert('gagal mendaftar');
            </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="username" placeholder="username" required><br>
        <input type="password" name="password1" placeholder="password 1" required><br>
        <input type="password" name="password2" placeholder="password 2" required><br>
        <button type="submit" name="register">daftar</button>
        <p>sudah punya akun? <a href="login.php">Login</a></p>
    </form>
</body>

</html>