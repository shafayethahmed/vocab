<?php
// Include the database connection file
include("../connection.php");

if (isset($_POST['submitRecruit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];

    // Validate name and email
    if (empty($name) || empty($email)) {
        echo "Please fill in all fields.<br>";
        exit;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.<br>";
        exit;
    }
    $cvURL = '';   // Initialize
    
    //Handaling CV FILE Stored by Unique ID.

 // Enhanced version with validation and security
 $targetDir = "Upload/";
 if (!file_exists($targetDir)) {
     mkdir($targetDir, 0755, true);
 }
 
 $allowedExtensions = ['pdf', 'doc', 'docx', 'odt', 'rtf', 'txt'];
 $maxFileSize = 2 * 1024 * 1024; // 5MB
 
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
     //Cv updated Successflly.
 } else {
    header('location:recruit.php?status=sizeLimit');
     //echo "Upload failed. Check permissions or file size limits.";
 }
    
    // Store data into the database
    $cv_review = 'pending';

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM cv WHERE cv_Email = ?"; //Check By the email if it's already exist.
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        header('location:recruit.php?status=already_applied');
        exit;
    }
        $sql = "INSERT INTO cv (cv_name,  cv_Email, cv_pdf) VALUES (?, ?, ?)";
         $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $name,  $email,  $cvURL);
        if ($stmt->execute()) {
              header('location:recruit.php?status=applied');
        } else {
            echo "Error storing data: " . $stmt->error . "<br>";
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error . "<br>";
    }
    
    // Close the database connection (if it's not already closed in connection.php)
    // $conn->close(); // Uncomment this if the connection is not closed in connection.php
}
elseif (isset($_POST['submitCheck'])) {
    $checkEmail = strtolower(trim($_POST['checkEmail']));

    // Validate email
    if (empty($checkEmail) || !filter_var($checkEmail, FILTER_VALIDATE_EMAIL)) {
        header('location:recruit.php'); // Code = 300.
        exit;
    }

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT cv_id, cv_name, cv_review, cv_pdf FROM cv WHERE cv_Email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $checkEmail); // "s" indicates a string
        if (!$stmt->execute()) {
            echo "Error executing query: " . $stmt->error . "<br>";
        } else {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                // Fetch the data
                $row = $result->fetch_assoc();
                $status = htmlspecialchars($row['cv_review']);

                // Display the details
                echo "<p><strong>Applicant ID:</strong> AN-" . htmlspecialchars($row['cv_id']) . "</p>";
                echo "<p><strong>Name:</strong> " . htmlspecialchars($row['cv_name']) . "</p>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($checkEmail) . "</p>"; // Display the email entered
                //If Selected displayed the Email and pass for Login.
                if ($status == 1) {
                    echo "<p style='color:green;'><strong>Status:</strong> Selected</p>";
                    echo "<p><strong>Login Details:</strong></p>";
                    echo "<p><strong>Email:</strong> " . htmlspecialchars($checkEmail) . "</p>";
                    echo "<p><strong>Password:</strong> 11223344</p>";
                    echo "<p><strong>Login Link:</strong> <a href='#'>Login Here</a></p>"; // Replace # with actual link

                } elseif ($status == 2) {
                    echo "<p style='color: orange;'><strong>Status:On Hold (You are under Observation, Please Check Status Again After 2 Days.)</strong></p>";
                }  
                elseif ($status == 0) {
                    echo "<p style='color: red;'><strong>Status:</strong>Rejected -(Try Again in next Circular.Thank You!)</p>";
                } else {
                    echo "<p><strong>Status:</strong> " . $status . "</p>"; // Pending or other statuses
                }

            } else {
                echo "No application found with the email address: " . htmlspecialchars($checkEmail) . "<br>";
            }
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error . "<br>";
    }

}
else {
    echo "Form not submitted."; // Only shown if the script is accessed directly without submitting the form.
}
?>

