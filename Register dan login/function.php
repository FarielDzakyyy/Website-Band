<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = ""; // kosong jika pakai XAMPP default
$database = "dua_serupa"; // database kamu

$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
