<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
</head>

<body>
    <h2>Ubah Data Barang</h2>
    <br />
    <a href="profile.php">KEMBALI</a>
    <br />
    <br />
    <?php
    // Koneksi ke database PostgreSQL
    $conn = pg_connect("host=localhost dbname=tes user=postgres password=290807");

    if (!$conn) {
        die("Koneksi ke database gagal: " . pg_last_error());
    }

    // Ambil `id_barang` dari URL
    $UserID = isset($_GET['id']) ? $_GET['id'] : null;

    if ($UserID === null) {
        echo "<p style='color: red;'>ID barang tidak ditemukan.</p>";
        exit;
    }
    // Query SQL
    $result = pg_query($conn, "SELECT * FROM users WHERE UserID = $id");

    // ... (Lanjutkan proses lainnya)
    if (!$result || pg_num_rows($result) === 0) {
        echo "<p style='color: red;'>Data barang tidak ditemukan.</p>";
        exit;
    }

    // Ambil data dari hasil query
    $t = pg_fetch_assoc($result);
    ?>
    <form method="post" action="ubah.php">
        <table>
            <tr>
                <td>NAMA LENGKAP</td>
                <td>
                    <input type="hidden" name="UserID" value="<?php echo htmlspecialchars($t['UserID']); ?>">
                    <input type="text" name="nama_lengkap" value="<?php echo htmlspecialchars($t['nama_lengkap']); ?>">
                </td>
            </tr>
            <tr>
                <td>NOMOR TELEPON</td>
                <td><input type="number" name="notel" value="<?php echo htmlspecialchars($t['notel']); ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Simpan"></td>
            </tr>
        </table>
    </form>
    <?php
    // Tutup koneksi database
    pg_close($conn);
    ?>
</body>

</html>