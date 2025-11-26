<?php
// delete_gallery.php
session_start();
include 'db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'Login required']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$id = isset($input['id']) ? intval($input['id']) : 0;

if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
    exit;
}

// Get image path first
$stmt = $conn->prepare("SELECT image_path FROM gallery WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($imagePath);
$stmt->fetch();
$stmt->close();

// Delete from database
$stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Delete physical file
    if ($imagePath && file_exists($imagePath)) {
        unlink($imagePath);
    }
    echo json_encode(['success' => true, 'message' => 'Gambar dihapus']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal menghapus']);
}

$stmt->close();
$conn->close();
?>