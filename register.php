<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-image: url(../asset/bg.png);
            background-size: cover;
            background-repeat: no-repeat;
        }

        .wrapper {
            text-align: left;
            max-width: 400px;
            margin: 200px auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .login-header {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .input-box {
            margin-bottom: 15px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .logo img {
            display: block;
            margin: 0 auto 20px auto;
        }

        .message {
            text-align: center;
            font-size: 14px;
            margin-top: 10px;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }
    </style>
    <title>Registrasi</title>
</head>

<body>
    <form class="login-form" action="" method="post">
        <div class="wrapper">
            <div class="logo">
                <img width="50" height="50" src="https://img.icons8.com/ios-glyphs/50/user-male--v1.png" alt="user-icon" />
            </div>
            <div class="login-header">Silakan buat akun baru Anda</div>
            <div class="input-box">
                <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" class="input-field" required>
            </div>
            <div class="input-box">
                <input type="text" id="username" name="username" placeholder="Username" class="input-field" required>
            </div>
            <div class="input-box">
                <input type="text" id="notel" name="notel" placeholder="Nomor Telepon" class="input-field" required>
            </div>
            <div class="input-box">
                <input type="password" id="sandi" name="sandi" placeholder="Password" class="input-field" required>
            </div>
            <div class="input-box">
                <button name="submit" type="submit">Registrasi</button>
            </div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
                $username = htmlspecialchars($_POST['username']);
                $notel = htmlspecialchars($_POST['notel']);
                $sandi = $_POST['sandi'];

                // Validasi tambahan di sisi server
                if (!preg_match('/^\d{10,15}$/', $notel)) {
                    echo "<div class='message error'>Nomor telepon harus berupa angka dengan panjang 10-15 digit.</div>";
                } elseif (strlen($sandi) < 6) {
                    echo "<div class='message error'>Password harus memiliki minimal 6 karakter.</div>";
                } else {
                    // Hash password
                    $sandi_hashed = password_hash($sandi, PASSWORD_DEFAULT);

                    // Koneksi ke database
                    $conn = pg_connect("host=localhost dbname=tes user=postgres password=290807");

                    if (!$conn) {
                        echo "<div class='message error'>Koneksi ke database gagal: " . pg_last_error() . "</div>";
                    } else {
                        // Query untuk menyimpan data
                        $query = "INSERT INTO users (nama_lengkap, username, notel, sandi) VALUES ($  1, $2, $3, $4)";
                        $result = pg_query_params($conn, $query, array($nama_lengkap, $username, $notel, $sandi));

                        if ($result) {
                            echo "<div class='message success'>Registrasi berhasil. Selamat datang, " . htmlspecialchars($nama_lengkap) . "!</div>";
                        } else {
                            echo "<div class='message error'>Terjadi kesalahan: " . pg_last_error($conn) . "</div>";
                        }

                        pg_close($conn);
                    }
                }
            }
            ?>
        </div>
    </form>
</body>

</html>
