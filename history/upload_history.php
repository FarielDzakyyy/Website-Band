<?php
require_once 'db.php';

header('Content-Type: application/json');

// Enable CORS jika diperlukan
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method tidak diizinkan']);
    exit;
}

// Log untuk debugging
error_log("Upload history accessed: " . date('Y-m-d H:i:s'));

// Buat tabel jika belum ada
createHistoryTable($conn);

$intro = mysqli_real_escape_string($conn, $_POST['intro'] ?? '');
$content = mysqli_real_escape_string($conn, $_POST['content'] ?? '');
$image = '';

// Handle image upload
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    error_log("File uploaded: " . $_FILES['image']['name']);
    
    // Validasi tipe file
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $fileType = $_FILES['image']['type'];
    
    if (!in_array($fileType, $allowedTypes)) {
        echo json_encode(['success' => false, 'message' => 'Tipe file tidak diizinkan. Hanya JPEG, PNG, GIF, dan WebP.']);
        exit;
    }
    
    // Validasi ukuran file (max 5MB)
    if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
        echo json_encode(['success' => false, 'message' => 'Ukuran file terlalu besar. Maksimal 5MB.']);
        exit;
    }
    
    $imageData = file_get_contents($_FILES['image']['tmp_name']);
    $image = 'data:' . $fileType . ';base64,' . base64_encode($imageData);
} elseif (isset($_POST['image_base64']) && !empty($_POST['image_base64'])) {
    error_log("Base64 image received");
    $image = mysqli_real_escape_string($conn, $_POST['image_base64']);
}

// Cek apakah data sudah ada
$checkQuery = "SELECT id FROM history ORDER BY id DESC LIMIT 1";
$checkResult = mysqli_query($conn, $checkQuery);

if ($checkResult && mysqli_num_rows($checkResult) > 0) {
    // Update data yang sudah ada
    $row = mysqli_fetch_assoc($checkResult);
    $id = $row['id'];
    
    if ($image) {
        $query = "UPDATE history SET image = '$image', intro = '$intro', content = '$content' WHERE id = $id";
    } else {
        $query = "UPDATE history SET intro = '$intro', content = '$content' WHERE id = $id";
    }
} else {
    // Insert data baru
    if ($image) {
        $query = "INSERT INTO history (image, intro, content) VALUES ('$image', '$intro', '$content')";
    } else {
        $query = "INSERT INTO history (intro, content) VALUES ('$intro', '$content')";
    }
}

error_log("Executing query: " . $query);

if (mysqli_query($conn, $query)) {
    echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan']);
} else {
    $error = mysqli_error($conn);
    error_log("Database error: " . $error);
    echo json_encode(['success' => false, 'message' => 'Error database: ' . $error]);
}

// Fungsi untuk membuat tabel
function createHistoryTable($conn) {
    $tableCheck = mysqli_query($conn, "SHOW TABLES LIKE 'history'");
    if (mysqli_num_rows($tableCheck) == 0) {
        // Buat tabel baru
        $createTable = "
            CREATE TABLE history (
                id INT PRIMARY KEY AUTO_INCREMENT,
                image LONGTEXT,
                intro TEXT,
                content TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ";
        mysqli_query($conn, $createTable);
        error_log("History table created");
    } else {
        // Cek kolom image
        $columnCheck = mysqli_query($conn, "SHOW COLUMNS FROM history LIKE 'image'");
        if (mysqli_num_rows($columnCheck) == 0) {
            // Tambah kolom image
            $alterTable = "ALTER TABLE history ADD COLUMN image LONGTEXT AFTER id";
            mysqli_query($conn, $alterTable);
            error_log("Image column added to history table");
        }
    }
}
?>