<?php
require_once 'db.php';

header('Content-Type: application/json');

// Query untuk mendapatkan data merchandise
$sql = "SELECT id, name, price, image FROM merchandise ORDER BY id DESC";
$result = $conn->query($sql);

$merchData = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $merchData[] = [
            'id' => (int)$row['id'],
            'name' => $row['name'],
            'price' => (float)$row['price'],
            'image' => $row['image'] ? $row['image'] : ''
        ];
    }
}

echo json_encode($merchData);
$conn->close();
?>