<?php
// Koneksi ke database PostgreSQL
$conn = pg_connect("host=localhost dbname=tes user=postgres password=290807");

if (!$conn) {
    echo "Koneksi gagal: " . pg_last_error();
    exit;
}

// Ambil data dari form
$UserID = $_POST['UserID'];
$nama_lengkap = $_POST['nama_lengkap'];
$username = $_POST['username'];
$notel = $_POST['notel'];

// Query untuk update data user
$query = "UPDATE users SET nama_lengkap = $1, username = $2, notel = $3 WHERE userid = $4";

// Jalankan query dengan parameter
$result = pg_query_params($conn, $query, array($nama_lengkap, $username, $notel, $UserID));

if ($result) {
    // Redirect ke halaman profile jika berhasil
    header("Location: profile.php");
    exit;
} else {
    echo "Error saat mengupdate data: " . pg_last_error($conn);
}

// Tutup koneksi
pg_close($conn);
?>
