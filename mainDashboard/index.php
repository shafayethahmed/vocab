<?php 
 //Connecting the DataBase From here :
 include_once('../connection.php'); //DB
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VocaSphere - Expand Your Vocabulary</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header Styling */
        header {
            background: #2c3e50;
            color: #fff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #ecf0f1;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li:first-child {
            margin-left: 0;
        }

        nav a {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #3498db;
        }

        .auth-buttons a {
            background-color: #3498db;
            color: #fff;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 15px;
            transition: background-color 0.3s ease;
        }

        .auth-buttons a:hover {
            background-color: #2980b9;
        }

        /* Marquee Styling */
        .announcement-bar {
            width: 100%;
            background: #3498db;
            color: #fff;
            padding: 10px 0;
            font-size: 16px;
            text-align: center;
            overflow: hidden;    
        }

        .marquee-content {
            white-space: nowrap;
            animation: marquee 30s linear infinite;  /* Here Design Animated Slowly Fixing The Time. */
        }

        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        /* Notice Bar */
        .notice-bar {
            width: 100%;
            background: #f9f9f9;
            color: #e74c3c;
            padding: 8px 0;
            font-size: 14px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .notice-bar a {
            color: #c0392b;
            font-weight: bold;
            text-decoration: none;
        }

        .notice-bar a:hover {
            text-decoration: underline;
        }

        /* Main Content */
        .main-content {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .dictionary-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
            width: 70%;
            max-width: 800px;
        }

        h1 {
            font-size: 36px;
            color: #3498db;
            margin-bottom: 30px;
        }

        .search-box {
            width: 100%;
            padding: 15px;
            font-size: 18px;
            border: 2px solid #3498db;
            border-radius: 8px;
            outline: none;
            margin-bottom: 25px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .search-box:focus {
            border-color: #2980b9;
            box-shadow: 0 0 12px rgba(52, 152, 219, 0.5);
        }

        .result-container {
            margin-top: 30px;
            padding: 20px;
            background: #ecf0f1;
            border-radius: 8px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
            text-align: left;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.4s ease-in-out, transform 0.4s ease-in-out;
        }

        .show-result {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }

        .word-title {
            font-size: 22px;
            font-weight: bold;
            color: #3498db;
            margin-bottom: 10px;
        }

        .definition {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }

        /* Features Section */
        .features-section {
            background: #e6f7ff;
            padding: 50px 20px;
            text-align: center;
        }

        .features-section h2 {
            font-size: 28px;
            color: #3498db;
            margin-bottom: 30px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 20px;
        }

        .feature-card {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .feature-card h3 {
            font-size: 20px;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: 16px;
            color: #777;
            line-height: 1.5;
        }

        .feature-icon {
            font-size: 30px;
            color: #3498db;
            margin-bottom: 15px;
        }

        /* Call to Action Section */
        .cta-section {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: #fff;
            padding: 60px 20px;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .cta-section p {
            font-size: 18px;
            margin-bottom: 30px;
            opacity: 0.8;
        }

        .cta-button {
            display: inline-block;
            background-color: #fff;
            color: #3498db;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #ecf0f1;
            color: #2980b9;
        }

        /* Footer Styling */
        footer {
            background: #2c3e50;
            color: #ecf0f1;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }

        footer a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #fff;
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">VocaSphere</div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#cta">Get Started</a></li>
                <!-- Access Controled from Management Tools Of Vocasphere--->
                <?php 
                $query = "SELECT `val` FROM `pagecontrol` WHERE `pagefunction` = 'applynow' ";
                $resultOfQuery = mysqli_query($conn,$query);
                while($row = mysqli_fetch_assoc($resultOfQuery)){
                    if($row['val'] == 1){
                    ?>  <!-- It's Only Displayed When Access is On . Connected with Applynow -->
                              <li><a href="recruit.php" style="color:red">Apply Now <sup  style="color:yellow">Ongoing</sup></a></li>
                    <?php
                    }
                }
                ?>
            </ul>
        </nav>
        <div class="auth-buttons">
                    <!-- Hide Login button from backend to Adjust Maintainance --> 

        <?php 
                $query = "SELECT `val` FROM `pagecontrol` WHERE `pagefunction` = 'loginauth' ";
                $resultOfQuery = mysqli_query($conn,$query);
                while($row = mysqli_fetch_assoc($resultOfQuery)){
                    if($row['val'] == 1){
                    ?>  <!-- It's Only Displayed When Access is On . Connected with loginauth -->
                     <a href="../LoginPage.php"><i class="fas fa-sign-in-alt"></i> Login</a>
            <?php
                    }
                }
                ?>
            <!-- Hide Sign Up button from backend to Adjust User Load Balance --> 
            <?php 
                $query = "SELECT `val` FROM `pagecontrol` WHERE `pagefunction` = 'signupauth' ";
                $resultOfQuery = mysqli_query($conn,$query);
                while($row = mysqli_fetch_assoc($resultOfQuery)){
                    if($row['val'] == 1){
                    ?>  <!-- It's Only Displayed When Access is On . Connected with signupauth -->
                          <a href="../LoginPage.php?task=create_account"><i class="fas fa-user-plus"></i> Sign Up</a>
                    <?php
                    }
                }
                ?>
                        </div>
    </header>
<!--- Main Notice Bar Also Included For Tools it's connected with mainnotice--->
<?php 
                $query = "SELECT `val`,`functionstatus` FROM `pagecontrol` WHERE `pagefunction` = 'mainnotice' ";
                $resultOfQuery = mysqli_query($conn,$query);
                while($row = mysqli_fetch_assoc($resultOfQuery)){
                    if($row['val'] == 1){
                    ?>  <!-- It's Only Displayed When Access is On . Connected with mainnotice -->
                       <div class="announcement-bar">
                            <div class="marquee-content">
                            <?php print($row['functionstatus']);?> <!-- Main Notice Bar 2nd From DB-->
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>
<!--- Notice Bar Also Included For Tools it's connected with Applynow --->
            <?php 
                $query = "SELECT `val`,`functionstatus` FROM `pagecontrol` WHERE `pagefunction` = 'applynow' ";
                $resultOfQuery = mysqli_query($conn,$query);
                while($row = mysqli_fetch_assoc($resultOfQuery)){
                    if($row['val'] == 1){
                    ?>  <!-- It's Only Displayed When Access is On . Connected with Applynow -->
                               <div class="notice-bar">
                                <marquee behavior="scroll" direction="left" scrollamount="4">
                                    <?php print($row['functionstatus']);?> <!-- Notice Bar 2nd From DB-->
                                </marquee>
                                 </div>
                    <?php
                    }
                }
                ?>
 

    <div class="main-content">
        <div class="dictionary-container">
            <h1>Explore the World of Words</h1>
            <input type="text" id="search-box" class="search-box" placeholder="Type a word to discover its meaning..." autocomplete="off">
            <div id="result" class="result-container"></div>
        </div>
    </div>

    <section id="features" class="features-section">
        <h2>Unlock the Power of Vocabulary</h2>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-search feature-icon"></i>
                <h3>Instant Word Definitions</h3>
                <p>Get clear and concise definitions for any word you search, helping you understand its meaning and usage.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-lightbulb feature-icon"></i>
                <h3>Enhance Your Knowledge</h3>
                <p>Expand your vocabulary and improve your communication skills with our comprehensive dictionary.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-chart-line feature-icon"></i>
                <h3>Track Your Progress</h3>
                <p>Login to test your vocabulary skills and track your learning journey over time.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-users feature-icon"></i>
                <h3>Join Our Community</h3>
                <p>Connect with other language enthusiasts and share your passion for words.</p>
            </div>
        </div>
    </section>

    <section id="cta" class="cta-section">
        <h2>Ready to Expand Your Lexicon?</h2>
        <p>Join VocaSphere today and embark on a journey of linguistic discovery!</p>
                    <!-- Hide Sign Up button from backend to Adjust User Load Balance --> 
                    <?php 
                    $query = "SELECT `val` FROM `pagecontrol` WHERE `pagefunction` = 'signupauth' ";
                    $resultOfQuery = mysqli_query($conn,$query);
                    while($row = mysqli_fetch_assoc($resultOfQuery)){
                    if($row['val'] == 1){
                    ?>  <!-- It's Only Displayed When Access is On . Connected with signupauth -->
                     <a href="../LoginPage.php?task=create_account" class="cta-button"><i class="fas fa-user-plus"></i> Sign Up Now</a>
                <?php
                    }
                }
                ?>
    </section>

    <footer>
        <p>&copy; 2025 VocaSphere. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>

    <script>
        $(document).ready(function(){
            $("#search-box").on("keyup", function(){
                let query = $(this).val();
                if (query.length > 0) {
                    $.ajax({
                        url: "search.php",
                        type: "POST",
                        data: { search: query },
                        success: function(data) {
                            $("#result").html(data);
                            $("#result").addClass("show-result");
                        }
                    });
                } else {
                    $("#result").removeClass("show-result").html("");
                }
            });
        });
    </script>

</body>
</html>