<?php
include 'function.php';

if ($conn) {
    echo "✅ Koneksi ke database dua_serupa BERHASIL!";
} else {
    echo "❌ Gagal konek: " . mysqli_connect_error();
}
?>
