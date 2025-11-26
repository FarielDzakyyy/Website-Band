<?php
// get_gallery.php
include 'db.php';

header('Content-Type: application/json');

$sql = "SELECT id, image_name, image_path FROM gallery ORDER BY id DESC";
$result = $conn->query($sql);

$gallery = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $gallery[] = $row;
    }
}

echo json_encode($gallery);
$conn->close();
?>