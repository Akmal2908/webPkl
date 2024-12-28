<?php
include("koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $sandi = $_POST['sandi'] ?? '';

    if (empty($nama_lengkap) || empty($username) || empty($sandi)) {
        header("Location: proses_register.php?error=empty_fields");
        exit();
    }

    // Check if the username already exists
    $query = "SELECT username FROM users WHERE username = $1";
    $result = pg_query_params($db, $query, array($username));

    if (!$result) {
        echo "Error checking username: " . pg_last_error($db);
        exit();
    }

    if (pg_num_rows($result) > 0) {
        header("Location: proses_register.php?error=username_taken");
        exit();
    }

    // Hash the password before storing it
    $hashed_password = password_hash($sandi, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $query = "INSERT INTO users (nama_lengkap, username, sandi) VALUES ($1, $2, $3)";
    $result = pg_query_params($db, $query, array($nama_lengkap, $username, $hashed_password));

    if ($result) {
        header("Location: acc.html");
        exit();
    } else {
        header("Location: proses_register.php?error=registration_failed");
        exit();
    }
} else {
    echo "Metode request tidak valid.";
}
?>
