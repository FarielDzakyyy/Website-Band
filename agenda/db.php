<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "dua_serupa"; // Ganti ke nama database yang benar

// Tambahkan timeout dan setting tambahan
$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set timeout yang lebih panjang
mysqli_options($conn, MYSQLI_OPT_CONNECT_TIMEOUT, 30);
mysqli_options($conn, MYSQLI_OPT_READ_TIMEOUT, 30);
mysqli_real_query($conn, "SET SESSION wait_timeout=300");
mysqli_real_query($conn, "SET SESSION interactive_timeout=300");

// Cek koneksi masih aktif
if (!mysqli_ping($conn)) {
    // Coba reconnect
    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
        die("Koneksi database terputus dan tidak dapat dipulihkan");
    }
}
?>