<?php
require 'db.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Cek apakah password 1 dan 2 sama
    if ($password !== $password2) {
        $error = "Password dan konfirmasi password tidak cocok!";
    } else {
        // Cek username sudah ada atau belum
        $cek = mysqli_query($db, "SELECT * FROM tb_user WHERE username = '$username'");
        if (mysqli_num_rows($cek) > 0) {
            $error = "Username sudah dipakai!";
        } else {
            // Hash password
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            // Simpan ke database
            mysqli_query($db, "INSERT INTO tb_user
            (username, password)
            VALUES
            ('$username', '$password_hash')");
            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>

<body>
    <h2>Register</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="" method="POST">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="password" name="password2" placeholder="Konfirmasi Password" required><br><br>
        <button type="submit" name="register">Register</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
</body>

</html>