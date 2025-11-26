<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "dua_serupa";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    // Untuk production, jangan tampilkan error detail
    die("Connection failed");
}
?>