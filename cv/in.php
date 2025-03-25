<?php 
   if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Check if directory exists and create it if not
$targetDir = "Upload/";
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0755, true);
}

$allowedExtensions = ['pdf', 'doc', 'docx', 'odt', 'rtf', 'txt'];
$maxFileSize = 5 * 1024 * 1024; // 5MB

// Check if file was uploaded properly
if (!isset($_FILES["cv"]) || $_FILES["cv"]["error"] != UPLOAD_ERR_OK) {
    echo "Upload error: " . ($_FILES["cv"]["error"] ?? "File not submitted");
    exit;
}

// Validate file size
if ($_FILES["cv"]["size"] > $maxFileSize) {
    echo "File too large. Maximum size is " . ($maxFileSize / 1024 / 1024) . "MB";
    exit;
}

// Validate file type
$cvfileType = strtolower(pathinfo($_FILES["cv"]["name"], PATHINFO_EXTENSION));
if (!in_array($cvfileType, $allowedExtensions)) {
    echo "Invalid file type. Only " . implode(', ', $allowedExtensions) . " allowed.";
    exit;
}

// Generate unique filename
$uniqueId = uniqid();
$targetFile = $targetDir . $uniqueId . "." . $cvfileType;

// Move the uploaded file
if (move_uploaded_file($_FILES["cv"]["tmp_name"], $targetFile)) {
    $cvURL = $targetFile;
    echo "CV uploaded successfully: $cvURL";
} else {
    echo "Upload failed. Check permissions or file size limits.";
}
   }

?>