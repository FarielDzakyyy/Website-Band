<?php
session_start();
if (!isset($_SESSION['username'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

require_once 'db.php';

header('Content-Type: application/json');

// Dapatkan input JSON
$input = json_decode(file_get_contents('php://input'), true);

if (!is_array($input)) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

$results = [];

foreach ($input as $item) {
    $name = $conn->real_escape_string($item['name']);
    $price = floatval($item['price']);
    $image = $conn->real_escape_string($item['image'] ?? '');
    
    if (isset($item['id']) && $item['id']) {
        // Update existing
        $id = intval($item['id']);
        $sql = "UPDATE merchandise SET name='$name', price=$price, image='$image' WHERE id=$id";
    } else {
        // Insert new
        $sql = "INSERT INTO merchandise (name, price, image) VALUES ('$name', $price, '$image')";
    }
    
    if ($conn->query($sql)) {
        $results[] = ['success' => true];
    } else {
        $results[] = ['success' => false, 'error' => $conn->error];
    }
}

echo json_encode(['success' => true, 'message' => 'Data saved successfully']);
$conn->close();
?>