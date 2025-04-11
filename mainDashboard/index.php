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
     <link rel="stylesheet" href="index.css">
</head>
<body>

    <header>
        <div class="logo">VocaSphere</div>
        <nav>
              <!-- Loader Container -->
                <div id="loader-container" class="loader-container">
                    <div class="loader"></div>
                </div>
                <!--Loding Container end --> 
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
                              <li><a href="recruit.php" style="color:red" onclick="showLoader(event, this.href)">Apply Now <sup  style="color:yellow">Ongoing</sup></a></li> <!--Adding Loader -->
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
                     <a href="../LoginPage.php" onclick="showLoader(event, this.href)"><i class="fas fa-sign-in-alt"></i> Login</a> <!--Adding Loader -->
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
                          <a href="../LoginPage.php?task=create_account" onclick="showLoader(event, this.href)"><i class="fas fa-user-plus"></i> Sign Up</a><!--Adding Loader -->
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

        //Function for loading Bar : 
            function showLoader(event, url) {
            event.preventDefault();
            document.getElementById('loader-container').style.display = 'flex';
            setTimeout(() => {
                window.location.href = url;
            }, 2000);
        }
    </script>

</body>
</html>