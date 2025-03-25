<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruitment Portal</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #1f4037, #99f2c8);
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            text-align: center;
        }
        .menu-container {
            background: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
        }
        .menu-container button {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: white;
            border: none;
            padding: 15px 30px;
            margin: 10px;
            border-radius: 30px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }
        .menu-container button:hover {
            transform: scale(1.1);
            box-shadow: 0px 5px 15px rgba(119, 20, 3, 0.93);
        }
        .form-container {
            display: none;
            width: 50%;
            background: rgba(255, 255, 255, 0.2);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(15px);
            margin-top: 20px;
        }
        .form-container input,
        .form-container select,
        .form-container button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            font-size: 16px;
            border: none;
            border-radius: 5px;
        }
        .form-container input, .form-container select {
            border: 2px solid #ff4b2b;
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            font-weight: bold;
        }
        .form-container input::placeholder {
            color: #777;
        }
        .form-container button {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: white;
            cursor: pointer;
            font-weight: bold;
        }
        .form-container button:hover {
            transform: scale(1.05);
        }
        .back-btn {
            margin-top: 20px;
            background: linear-gradient(135deg, #007bff, #00c6ff);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 30px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        .back-btn:hover {
            transform: scale(1.1);
        }

        /* Popup Styles */
        .popup {
            display:flex;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .popup-content {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.5);
            color: #333;
            width: 60%;
            max-width: 800px;
            position: relative;
            text-align: left;
        }
        .popup-content .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
            color: #777;
        }
        .popup-content h2 {
            color: #ff4b2b;
            margin-bottom: 20px;
        }
        .popup-content p {
            margin: 10px 0;
        }

        @media (max-width: 768px) {
            .popup-content {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="menu-container">
    <button id="applyNow">Apply Now</button>
    <button id="checkApplication">Check Application</button>
</div>

<div id="applyForm" class="form-container">
    <h2>Recruitment Form</h2>
    <form method="POST"  action="recruitmanage.php"  id="recruitmentForm" enctype="multipart/form-data">
        <input type="text" id="name" name="name" placeholder="Full Name" required>
        <input type="email" id="email" name="email" placeholder="Email" required>
        <label for="CV-Collect" style="text-align: left;">CV:</label><input type="file" id="cv" name="cv" accept=".pdf, .doc, .docx" required>
        <select name="position" id="position" required>
            <option value="#">Select Position</option>
        </select>
        <button type="submit" name="submitRecruit">Submit Application</button>
    </form>
</div>

<div id="checkForm" class="form-container">
    <h2>Check Application Status</h2>
    <form method="POST" action="recruitmanage.php" id="checkStatusForm">
        <input type="email" id="checkEmail" name="checkEmail" placeholder="Enter Your Email" required>
        <button type="submit" name="submitCheck">Check Status</button>
    </form>
</div>

<a href="index.php">
    <button class="back-btn">Back to Main Page</button>
</a>

<!-- Popup -->
<div class="popup" id="statusPopup">
    <div class="popup-content">
        <span class="close-btn">&times;</span>
        <h2 id="popupTitle" style="text-align: center;">Applicant Details:</h2>
        <div id="popupDetails">
            <!-- Application details will be loaded here -->
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $("#applyNow").click(function() {
        $("#applyForm").slideDown();
        $("#checkForm").slideUp();
    });

    $("#checkApplication").click(function() {
        $("#checkForm").slideDown();
        $("#applyForm").slideUp();
    });


    $("#checkStatusForm").submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting in the traditional way

        var checkEmail = $("#checkEmail").val();

        $.ajax({
            type: "POST",
            url: "recruitmanage.php", // Same PHP file for processing
            data: {
                checkEmail: checkEmail,
                submitCheck: true // Ensure the PHP knows it's from the check form
            },
            success: function(response) {
                // Load the response into the popup
                $("#popupDetails").html(response);

                // Display the popup
                $("#statusPopup").fadeIn();
            },
            error: function() {
                $("#popupDetails").html("Error fetching application status.");
                $("#statusPopup").fadeIn();
            }
        });
    });

    // Close the popup
    $(".close-btn").click(function() {
        $("#statusPopup").fadeOut();
    });
     $("#statusPopup").hide();  // hide the popup on document ready

});
</script>

</body>
</html>
