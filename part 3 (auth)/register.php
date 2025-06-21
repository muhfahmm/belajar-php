<?php
require 'db.php';

if (isset($_POST['register'])) {
    $username = htmlspecialchars(strtolower($_POST['username']));
    $password1 = htmlspecialchars(strtolower($_POST['password1']));
    $password2 = htmlspecialchars(strtolower($_POST['password2']));

    if ($password1 !== $password2) {
        echo 'password tidak sama';
    } elseif ($username || $password1 || $password2 == "") {
        echo "input kosong harus diisi";
    } else {
        $check = mysqli_query($db, "SELECT * FROM tb_admin WHERE nama = '$username' ");
        if (mysqli_num_rows($check) > 0) {
            echo "username sudah digunakan";
        } else {
            $hash_pass = password_hash($password1, PASSWORD_BCRYPT);

            mysqli_query($db, "INSERT INTO tb_admin
            (nama, password)
            VALUES
            ('$username', '$hash_pass')");
            header("location: login.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: arial;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .wrapper {
            backdrop-filter: blur(30px);
            box-shadow: 0px 0px 30px rgba(227, 228, 237, 0.37);
            border: 2px solid rgba(225, 255, 255, 0.18);
            padding: 30px 25px;
        }

        h1 {
            padding-bottom: 10px;
            text-align: center;
        }

        .input-box input {
            padding: 10px;
            margin: 10px 0;
            outline: none;
            width: 300px;
        }

        .input-box button {
            width: 100%;
            padding: 10px;
        }

        .register {
            padding-top: 5px;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <div class="container">
            <div class="wrapper">
                <h1>register</h1>
                <div class="input-box">
                    <input type="text" placeholder="username" name="username">
                </div>
                <div class="input-box">
                    <input type="password" placeholder="password" name="password1">
                </div>
                <div class="input-box">
                    <input type="password" placeholder="konfirmasi password" name="password2">
                </div>
                <div class="input-box">
                    <button name="register" class="button">
                        register
                    </button>
                </div>
                <div class="register">
                    <p>sudah punya akun? <a href="login.php">login</a></p>
                </div>
                <div style="border-bottom: 1px solid;"></div>
                <div class="theme" style="margin-top: 5px;">
                    <div onclick="darkmode()" class="btn btn-primary"><i class="bi bi-moon"></i> darkmode</div>
                </div>
            </div>
        </div>
    </form>
    <style>
        body {
            background-color: white;
            color: black;
        }

        .dark {
            background-color: #333;
        }
        .dark h1 {
            color: white;
        }
        .theme:hover {
            cursor: pointer;
        }
        .dark .theme {
            color: white;
        }
        .dark .register {
            color: white;
        }
        .dark .register a {
            color: white;
        }
    </style>
    <script>
        let body = document.body;

        function darkmode() {
            body.classList.toggle("dark");
        }
    </script>
</body>

</html>