<?php
require_once 'db.php';

header('Content-Type: application/json');

try {
    // Cek apakah tabel agenda exists
    $tableCheck = mysqli_query($conn, "SHOW TABLES LIKE 'agenda'");
    
    if (mysqli_num_rows($tableCheck) > 0) {
        $query = "SELECT id, tanggal, judul_acara, lokasi, gambar FROM agenda ORDER BY tanggal ASC";
        $result = mysqli_query($conn, $query);
        
        $agendaData = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $agendaData[] = $row;
            }
        }
        
        echo json_encode(['success' => true, 'data' => $agendaData]);
    } else {
        echo json_encode(['success' => true, 'data' => []]);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>