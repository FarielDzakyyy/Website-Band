<?php
require_once 'db.php';

header('Content-Type: application/json');

try {
    // Cek apakah tabel exists
    $tableCheck = mysqli_query($conn, "SHOW TABLES LIKE 'history'");
    
    if (mysqli_num_rows($tableCheck) > 0) {
        // Tabel exists, cek kolom
        $columnCheck = mysqli_query($conn, "SHOW COLUMNS FROM history LIKE 'image'");
        
        if (mysqli_num_rows($columnCheck) > 0) {
            // Kolom image exists, query data
            $query = "SELECT image, intro, content FROM history ORDER BY id DESC LIMIT 1";
            $result = mysqli_query($conn, $query);
            
            if ($result && mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result);
                echo json_encode(['success' => true, 'data' => $data]);
            } else {
                echo json_encode(['success' => true, 'data' => null]);
            }
        } else {
            // Kolom image tidak exists
            echo json_encode(['success' => true, 'data' => null]);
        }
    } else {
        // Tabel tidak exists
        echo json_encode(['success' => true, 'data' => null]);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>