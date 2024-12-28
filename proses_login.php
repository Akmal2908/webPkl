<?php
// Koneksi ke database PostgreSQL
$conn = pg_connect("host=localhost dbname=tes user=postgres password=290807");

// Periksa koneksi
if (!$conn) {
    die("Koneksi ke database gagal: " . pg_last_error());
}

// Ambil data dari form
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// Validasi apakah input kosong
if (empty($username) || empty($password)) {
    header("Location: login.php?error=invalid"); // Redirect ke halaman login dengan error invalid
    exit;
}

// Query untuk memeriksa username dan password
$query = "SELECT * FROM users WHERE username = $1 AND sandi = $2";
$result = pg_query_params($conn, $query, array($username, $password));

// Periksa hasil query
if (pg_num_rows($result) > 0) {
    // Login berhasil, ambil data user
    session_start();
    $user = pg_fetch_assoc($result);
    $_SESSION['username'] = $user['username']; // Simpan username di sesi
    $_SESSION['nama_lengkap'] = $user['nama_lengkap']; // Simpan nama lengkap di sesi
    header("Location: profile.php"); // Redirect ke halaman dashboard
} else {
    // Login gagal, redirect dengan pesan error
    header("Location: login.php?error=login");
    exit;
}

// Tutup koneksi database
pg_close($conn);
?>
