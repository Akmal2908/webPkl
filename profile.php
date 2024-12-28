<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: black;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-header img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 3px solid #007BFF;
        }

        .profile-header h1 {
            font-size: 24px;
            margin: 10px 0;
        }

        .profile-header p {
            font-size: 18px;
            color: #555;
        }

        .profile-content h2 {
            font-size: 20px;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .input-box {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            position: relative;
        }
    </style>
</head>

<body>
    <?php
    // Koneksi ke database PostgreSQL
    $conn = pg_connect("host=localhost dbname=tes user=postgres password=290807");

    if (!$conn) {
        echo "<p style='color: red;'>Koneksi ke database gagal: " . pg_last_error() . "</p>";
        exit;
    }

    // Query untuk mendapatkan data pengguna
    $result = pg_query($conn, "SELECT * FROM users");

    if (!$result) {
        echo "<p style='color: red;'>Query gagal: " . pg_last_error($conn) . "</p>";
        pg_close($conn);
        exit;
    }

    // Loop melalui data pengguna
    while ($row = pg_fetch_assoc($result)) {
    ?>
        <div class="container">
            <div class="profile-header">
                <img src="https://img.icons8.com/ios-glyphs/150/user-male--v1.png" alt="Foto Profil">
                <h1>| Nama Saya |</h1>
                <p><?php echo htmlspecialchars($row['nama_lengkap']); ?></p>
                <h1>| Username | </h1>
                <p><?php echo htmlspecialchars($row['username']); ?></p>
                <h1>| Nomor Telepon |</h1>
                <p><?php echo htmlspecialchars($row['notel']); ?></p>
                <div class="input-box">
                    <a href="update.php?id=<?php echo $row['userid']; ?>">Edit Profil</a>
                </div>
            </div>
        </div>
    <?php
    }

    // Tutup koneksi
    pg_close($conn);
    ?>
</body>

</html>
