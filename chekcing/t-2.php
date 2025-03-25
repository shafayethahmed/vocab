
<?php
include_once('../connection.php');
$sql = "SELECT * FROM images WHERE id='6'";
$result = $conn->query($sql);
echo "<h2>Your Uploaded Images</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<img src='" . $row['image_url'] . "' width='200'><br>";
}

$conn->close();
?>
