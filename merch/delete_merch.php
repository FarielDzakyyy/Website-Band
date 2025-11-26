<?php
session_start();
if (!isset($_SESSION['username'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

require_once 'db.php';

header('Content-Type: application/json');

$id = intval($_GET['id']);

$sql = "DELETE FROM merchandise WHERE id = $id";

if ($conn->query($sql)) {
    echo json_encode(['success' => true, 'message' => 'Deleted successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Delete failed: ' . $conn->error]);
}

$conn->close();
?>