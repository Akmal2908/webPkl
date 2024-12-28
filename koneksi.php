<?php
$host = "localhost";
$dbname = "tes";
$user = "postgres";
$password = "290807";

$db = pg_connect("host=localhost dbname=tes user=postgres password=290807");

if (!$db) {
    die("Koneksi gagal: " . pg_last_error());
}
?>
