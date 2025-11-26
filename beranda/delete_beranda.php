<?php
session_start();
require_once 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input || !isset($input['section_type'])) {
        throw new Exception('Invalid input data');
    }
    
    $sectionType = $input['section_type'];
    $fieldToDelete = $input['field_to_delete'] ?? '';
    
    // Validasi section type
    $allowedSections = ['hero', 'gallery', 'history', 'news', 'merch'];
    if (!in_array($sectionType, $allowedSections)) {
        throw new Exception('Invalid section type');
    }
    
    // Check if section exists
    $checkSql = "SELECT id, image, gallery_images FROM beranda WHERE section_type = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("s", $sectionType);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    if ($checkResult->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Section not found']);
        exit;
    }
    
    $sectionData = $checkResult->fetch_assoc();
    
    if ($fieldToDelete === 'image') {
        // Delete image field only
        $updateSql = "UPDATE beranda SET image = NULL, updated_at = CURRENT_TIMESTAMP WHERE section_type = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("s", $sectionType);
        $updateStmt->execute();
        
        echo json_encode(['success' => true, 'message' => 'Image deleted successfully']);
        
    } elseif ($fieldToDelete === 'gallery_image' && isset($input['image_index'])) {
        // Delete specific gallery image
        $imageIndex = $input['image_index'];
        $galleryImages = [];
        
        if (!empty($sectionData['gallery_images']) && $sectionData['gallery_images'] !== '[]' && $sectionData['gallery_images'] !== 'null') {
            $galleryImages = json_decode($sectionData['gallery_images'], true);
        }
        
        if (isset($galleryImages[$imageIndex])) {
            array_splice($galleryImages, $imageIndex, 1);
            
            $updateSql = "UPDATE beranda SET gallery_images = ?, updated_at = CURRENT_TIMESTAMP WHERE section_type = ?";
            $updateStmt = $conn->prepare($updateSql);
            $galleryJson = json_encode($galleryImages);
            $updateStmt->bind_param("ss", $galleryJson, $sectionType);
            $updateStmt->execute();
            
            echo json_encode(['success' => true, 'message' => 'Gallery image deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Image index not found']);
        }
        
    } elseif ($fieldToDelete === 'all_gallery') {
        // Delete all gallery images
        $updateSql = "UPDATE beranda SET gallery_images = '[]', updated_at = CURRENT_TIMESTAMP WHERE section_type = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("s", $sectionType);
        $updateStmt->execute();
        
        echo json_encode(['success' => true, 'message' => 'All gallery images deleted successfully']);
        
    } else {
        // Delete entire section (reset to default)
        $deleteSql = "DELETE FROM beranda WHERE section_type = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("s", $sectionType);
        $deleteStmt->execute();
        
        echo json_encode(['success' => true, 'message' => 'Section reset to default successfully']);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>