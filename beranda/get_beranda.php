<?php
header('Content-Type: application/json');
require_once 'db.php';

$sql = "SELECT * FROM beranda";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[$row['section_type']] = $row;
    }
}

echo json_encode($data);
$conn->close();
?>