<?php
// upload_gallery.php
session_start();
include 'db.php';

// Set header JSON
header('Content-Type: application/json');

// Cek login
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'Login required']);
    exit;
}

// Cek file
if (!isset($_FILES['images'])) {
    echo json_encode(['success' => false, 'message' => 'No files selected']);
    exit;
}

$uploadDir = 'uploads/gallery/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$results = [];

foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
    if ($_FILES['images']['error'][$key] !== UPLOAD_ERR_OK) {
        $results[] = ['success' => false, 'message' => 'File error'];
        continue;
    }

    $fileName = $_FILES['images']['name'][$key];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (!in_array($fileExt, $allowedExt)) {
        $results[] = ['success' => false, 'message' => 'Invalid file type: ' . $fileName];
        continue;
    }

    // Generate unique name
    $newFileName = uniqid() . '_' . time() . '.' . $fileExt;
    $uploadPath = $uploadDir . $newFileName;

    if (move_uploaded_file($tmpName, $uploadPath)) {
        // Save to database
        $imagePath = $uploadPath; // Relative path
        $stmt = $conn->prepare("INSERT INTO gallery (image_name, image_path) VALUES (?, ?)");
        $stmt->bind_param("ss", $fileName, $imagePath);
        
        if ($stmt->execute()) {
            $results[] = ['success' => true, 'message' => 'Uploaded: ' . $fileName];
        } else {
            $results[] = ['success' => false, 'message' => 'Database error: ' . $fileName];
            unlink($uploadPath); // Delete file if DB fail
        }
        $stmt->close();
    } else {
        $results[] = ['success' => false, 'message' => 'Upload failed: ' . $fileName];
    }
}

// Count results
$successCount = count(array_filter($results, function($r) { return $r['success']; }));
$totalCount = count($results);

if ($successCount > 0) {
    echo json_encode([
        'success' => true, 
        'message' => "Berhasil upload $successCount dari $totalCount gambar"
    ]);
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Gagal upload semua gambar: ' . implode(', ', array_column($results, 'message'))
    ]);
}

$conn->close();
?>