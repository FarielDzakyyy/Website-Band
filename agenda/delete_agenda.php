<?php
require_once 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method tidak diizinkan']);
    exit;
}

$id = mysqli_real_escape_string($conn, $_POST['id'] ?? '');

if (empty($id)) {
    echo json_encode(['success' => false, 'message' => 'ID agenda tidak valid']);
    exit;
}

$query = "DELETE FROM agenda WHERE id = '$id'";
if (mysqli_query($conn, $query)) {
    echo json_encode(['success' => true, 'message' => 'Agenda berhasil dihapus']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . mysqli_error($conn)]);
}
?>