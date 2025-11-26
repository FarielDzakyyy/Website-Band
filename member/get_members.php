<?php
session_start();
include 'db.php';

header('Content-Type: application/json');

try {
    $result = $conn->query("SELECT * FROM members ORDER BY id DESC");
    $members = [];
    
    while ($row = $result->fetch_assoc()) {
        $members[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'role' => $row['role'],
            'photo' => $row['photo']
        ];
    }
    
    echo json_encode($members);
} catch (Exception $e) {
    echo json_encode([]);
}
?>