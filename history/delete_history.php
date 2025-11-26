<?php
require_once 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method tidak diizinkan']);
    exit;
}

$query = "DELETE FROM history";
if (mysqli_query($conn, $query)) {
    echo json_encode(['success' => true, 'message' => 'Data history berhasil dihapus']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . mysqli_error($conn)]);
}
?>