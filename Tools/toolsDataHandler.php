<?php
include_once('../connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the values of the checkboxes based on their names
    $loginUp = isset($_POST['loginToggle']) ? 1 : 0;
    $signup = isset($_POST['signupToggle']) ? 1 : 0;
    $contactUs = isset($_POST['contactUsToggle']) ? 1 : 0;

    // Prepare the SQL query to update multiple rows
    $sql = "UPDATE `pagecontrol` SET `val` = CASE `pagefunction`
                WHEN 'loginauth' THEN ?
                WHEN 'signupauth' THEN ?
                WHEN 'contactus' THEN ?
            END
            WHERE `pagefunction` IN ('loginauth', 'signupauth', 'contactus')";

    // Assuming you have a database connection established ($conn)
    if ($conn) {
        // Prepare the statement
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind the parameters in the order they appear in the CASE statement
            $stmt->bind_param("iii", $loginUp, $signup, $contactUs);

            if ($stmt->execute()) {
                header('location:./toolsmanage.php');
            } else {
                echo "Error updating records: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Database connection not established.";
    }
}

?>