<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
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
    <?php
    require 'db.php';

    if (isset($_POST['register.php'])) {
            $username = htmlspecialchars(strtolower($_POST['username']));
                $password = htmlspecialchars(strtolower($_POST['password']));
                
                $sql = "SELECT * FROM tb_admin WHERE username = '$username' AND password = '$password'";
                $result = mysqli_query($db, $sql);

                if (mysqli_num_rows($result) > 0) {
                    header("Location: home.php");
                }
    }
    ?>
    <form action="" method="post">
        <div class="container">
            <div class="wrapper">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" placeholder="username" name="username">
                </div>
                <div class="input-box">
                    <input type="password" placeholder="password" name="password">
                </div>
                <div class="input-box">
                    <button name="login" class="button">
                        login
                    </button>
                </div>
                <div class="register">
                    <p>belum punya akun? <a href="register.php">daftar</a></p>
                </div>
            </div>
        </div>
    </form>
</body>

</html>