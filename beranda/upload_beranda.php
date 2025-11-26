<?php
header('Content-Type: application/json');
require_once 'db.php';

// Fungsi untuk convert Base64 ke File Gambar
function saveBase64Image($base64_string, $prefix) {
    // Cek apakah string adalah base64 (data:image...)
    if (strpos($base64_string, 'data:image') !== 0) {
        // Jika bukan base64, berarti ini adalah path file lama, kembalikan aslinya
        return $base64_string;
    }

    // Buat folder uploads jika belum ada
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Pisahkan metadata dari data base64
    list($type, $data) = explode(';', $base64_string);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);

    // Generate nama file unik
    $extension = explode('/', $type)[1];
    $filename = $prefix . '_' . time() . '_' . rand(100, 999) . '.' . $extension;
    $file_path = $target_dir . $filename;

    // Simpan file
    file_put_contents($file_path, $data);

    // Return path relatif agar bisa diakses dari dashboard maupun beranda
    // Kita gunakan "../beranda/uploads/" agar path-nya valid dari folder dashboard
    return "../beranda/" . $file_path; 
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'No data received']);
    exit;
}

$sections = ['hero', 'gallery', 'history', 'news', 'merch'];
$success = true;
$error_msg = "";

foreach ($sections as $section) {
    if (isset($input[$section])) {
        $data = $input[$section];
        
        $title = $conn->real_escape_string($data['title'] ?? '');
        $content = $conn->real_escape_string($data['content'] ?? '');
        $btn_text = $conn->real_escape_string($data['button_text'] ?? '');
        $btn_link = $conn->real_escape_string($data['button_link'] ?? '');
        
        // Handle Single Image (Hero, News, Merch)
        $image_path = '';
        if (isset($data['image']) && !empty($data['image'])) {
            $image_path = saveBase64Image($data['image'], $section);
        }

        // Handle Gallery Images (Array)
        $gallery_json = '[]';
        if ($section === 'gallery' && isset($data['gallery_images'])) {
            $raw_images = json_decode($data['gallery_images'], true);
            $processed_images = [];
            if (is_array($raw_images)) {
                foreach ($raw_images as $idx => $img) {
                    $processed_images[] = saveBase64Image($img, 'gallery_' . $idx);
                }
            }
            $gallery_json = $conn->real_escape_string(json_encode($processed_images));
        }

        // SQL Insert/Update
        // Logika: Jika section sudah ada, update. Jika belum, insert.
        $sql = "INSERT INTO beranda (section_type, title, content, image, button_text, button_link, gallery_images) 
                VALUES ('$section', '$title', '$content', '$image_path', '$btn_text', '$btn_link', '$gallery_json')
                ON DUPLICATE KEY UPDATE 
                title='$title', 
                content='$content', 
                button_text='$btn_text', 
                button_link='$btn_link',
                gallery_images='$gallery_json'";
        
        // Hanya update image jika ada gambar baru/gambar ada isinya
        if (!empty($image_path)) {
            $sql .= ", image='$image_path'";
        }

        if (!$conn->query($sql)) {
            $success = false;
            $error_msg = $conn->error;
            break;
        }
    }
}

echo json_encode(['success' => $success, 'message' => $error_msg]);
$conn->close();
?>