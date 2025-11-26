<?php
require_once 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method tidak diizinkan']);
    exit;
}

// Buat tabel jika belum ada
createAgendaTable($conn);

$tanggal = mysqli_real_escape_string($conn, $_POST['tanggal'] ?? '');
$judul_acara = mysqli_real_escape_string($conn, $_POST['judul_acara'] ?? '');
$lokasi = mysqli_real_escape_string($conn, $_POST['lokasi'] ?? '');
$gambar = '';

// Handle image upload
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
    // Validasi tipe file
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $fileType = $_FILES['gambar']['type'];
    
    if (!in_array($fileType, $allowedTypes)) {
        echo json_encode(['success' => false, 'message' => 'Tipe file tidak diizinkan. Hanya JPEG, PNG, GIF, dan WebP.']);
        exit;
    }
    
    // Validasi ukuran file (max 5MB)
    if ($_FILES['gambar']['size'] > 5 * 1024 * 1024) {
        echo json_encode(['success' => false, 'message' => 'Ukuran file terlalu besar. Maksimal 5MB.']);
        exit;
    }
    
    $imageData = file_get_contents($_FILES['gambar']['tmp_name']);
    $gambar = 'data:' . $fileType . ';base64,' . base64_encode($imageData);
} elseif (isset($_POST['gambar_base64']) && !empty($_POST['gambar_base64'])) {
    $gambar = mysqli_real_escape_string($conn, $_POST['gambar_base64']);
}

// Insert data baru
$query = "INSERT INTO agenda (tanggal, judul_acara, lokasi, gambar) VALUES ('$tanggal', '$judul_acara', '$lokasi', '$gambar')";

if (mysqli_query($conn, $query)) {
    echo json_encode(['success' => true, 'message' => 'Agenda berhasil disimpan']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error database: ' . mysqli_error($conn)]);
}

// Fungsi untuk membuat tabel
function createAgendaTable($conn) {
    $tableCheck = mysqli_query($conn, "SHOW TABLES LIKE 'agenda'");
    if (mysqli_num_rows($tableCheck) == 0) {
        $createTable = "
            CREATE TABLE agenda (
                id INT PRIMARY KEY AUTO_INCREMENT,
                tanggal DATE,
                judul_acara VARCHAR(255),
                lokasi VARCHAR(255),
                gambar LONGTEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ";
        mysqli_query($conn, $createTable);
    }
}
?>