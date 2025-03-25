<?php 
include_once('../connection.php');

if(isset($_POST['sub'])){
    $targetDir = "up/";
    $uniqueId = uniqid(); // Generate a unique ID
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION)  );
    $targetFile = $targetDir . $uniqueId . "." . $imageFileType; // Save with unique ID

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $imageUrl = $targetFile;
        $sql = "INSERT INTO images (image_url) VALUES ('$imageUrl')";

        if ($conn->query($sql) === TRUE) {
            echo "Image uploaded successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
        $conn->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
