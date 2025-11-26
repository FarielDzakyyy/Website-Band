<?php
session_start();
include 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $members = $input['members'] ?? [];

    try {
        // Hapus semua member existing (opsional, atau bisa update)
        $conn->query("DELETE FROM members");

        // Insert member baru
        $stmt = $conn->prepare("INSERT INTO members (name, role, photo) VALUES (?, ?, ?)");
        
        foreach ($members as $member) {
            if (!empty($member['name']) && !empty($member['role'])) {
                $stmt->bind_param("sss", $member['name'], $member['role'], $member['photo']);
                $stmt->execute();
            }
        }
        
        $stmt->close();
        
        echo json_encode(['success' => true, 'message' => 'Members saved successfully']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>