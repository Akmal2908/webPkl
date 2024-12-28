<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* General body styles */
        body {
            background-image: url(../asset/bg.png);
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Center the wrapper */
        .wrapper {
            text-align: left;
            margin: auto;
            width: 350px;
            margin-top: 150px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Logo styles */
        .logo {
            text-align: center;
        }

        .logo img {
            width: 50px;
            height: 50px;
        }

        /* Login header styles */
        .login-header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        /* Input box container */
        .input-box {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            position: relative;
        }

        /* Input fields styling */
        .input-field {
            width: 100%;
            padding: 10px 15px;
            padding-left: 40px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .input-field:focus {
            border-color: #4CAF50;
            outline: none;
        }

        /* Icon inside input fields */
        .input-box i {
            position: absolute;
            left: 10px;
            color: #888;
        }

        /* Button styling */
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Link styling (for registration) */
        p {
            text-align: center;
            font-size: 14px;
        }

        p a {
            color: #4CAF50;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        /* Error message styling */
        .error-message {
            margin-top: 10px;
            padding: 10px;
            background-color: #f44336;
            color: white;
            font-size: 14px;
            border-radius: 5px;
            text-align: center;
        }

        /* Responsive design */
        @media (max-width: 400px) {
            .wrapper {
                width: 90%;
                margin-top: 100px;
            }
        }
    </style>
    <title>Login</title>
</head>

<body>
    <form class="login-form" action="proses_login.php" method="post">
        <div class="wrapper">
            <div class="logo">
                <img width="50" height="50" src="https://img.icons8.com/ios-glyphs/30/user-male--v1.png" alt="user-icon" />
            </div>
            <div class="login-box">
                <div class="login-header">
                    <span>Login</span>
                </div>
                <br>
                <div class="input-box">
                    <input type="text" id="username" name="username" placeholder="Username" class="input-field" required>
                    <i class="bx bx-user icon"></i>
                </div>
                <br>
                <div class="input-box">
                    <input type="password" id="password" name="password" placeholder="Password" class="input-field" required>
                    <i class="bx bx-lock icon"></i>
                </div>
                <p>Belum memiliki akun? <a href="register.php">Registrasi</a></p>
                <br>
                <div class="input-box">
                    <button name="submit" type="submit">Login</button>
                </div>
                <br>
                <?php
                $error = '';
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                }
                $pesan = '';
                if ($error == 'login') {
                    $pesan = 'Username atau Password salah';
                } else if ($error == 'invalid') {
                    $pesan = 'Username dan password harus diisi';
                }
                if ($pesan != '') {
                    echo "<div class='error-message'>$pesan</div>";
                }
                ?>
            </div>
        </div>
    </form>
</body>

</html>
