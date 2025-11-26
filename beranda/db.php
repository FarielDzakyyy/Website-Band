<?php
$host = "localhost";
$user = "root";
$pass = ""; // Sesuaikan password database Anda
$db   = "dua_serupa"; // Sesuaikan nama database Anda

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>