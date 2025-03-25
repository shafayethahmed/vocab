<?php 
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VocaSphere</title>
    <link rel="website icon" href="asset/Contexts/logo.png" >
    <!-- Link to Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@400;500&display=swap">
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Main container for centering the login card on the screen -->
<!--- php added here For collecting the data if it's for Signup ---> 
<?php 
   $tasks = $_GET['task'] ?? '';
   if('create_account' == $tasks){
    ?>
   <!-- Main container for centering the login card on the screen -->
   <div class="container">
       <!-- Login card containing both the image and the form -->
       <div class="login-card">
           <!-- Left side of the card containing the decorative image -->
           <div class="card-left">
               <div class="image-cover">
                   <img src="asset/Contexts/vocab.jpg">
               </div>
           </div>
           <!-- Right side of the card containing the login form -->
           <div class="card-right">
               <!-- Title of the login form -->
               <h1 class="title">VocaSphere</h1>
               <!-- Subtitle welcoming the user -->
               <h2 class="welcome">SignUp Here</h2>
               <!--text Area for Warning -->
               <blockquote>
                 <?php 
                 error_reporting(0);
                    if( 'create_account' == $tasks && 'existEmail' == $_GET['email']){
                        include_once('warnings/emailwarn.php');
                    }
                    elseif( 'create_account' == $tasks && 'mismatch' == $_GET['passStatus']){
                        include_once('warnings/passwordwarn.php');
                    }
                    elseif('wrong'== $_GET['login_status']){
                        //email or password wrong in login.
                        include_once('warnings/loginwarn.php');
                    }
                     
                 ?>
               </blockquote>
               <!-- Form for user input -->
               <form action="form_handle.php" method="POST">
                   <!-- Input group for username or email -->
                   <div class="input-group">
                       <label for="username">Email</label>
                       <input type="email" id="email" name="email" required  placeholder="anonymous@example.com">
                   </div>
                   <!-- Input group for password -->
                   <div class="input-group">
                       <label for="password">Password</label>
                       <input type="password" id="password" name="password" required placeholder="Enter Your Password">
                   </div>
                   <div class="input-group">
                       <label for="cpassword">Confirm Password</label>
                       <input type="password" id="cpassword" name="cpassword" required placeholder="Re-type Password">
                   </div>
                   <!-- Actions section containing the Sign In button and forgot password link -->
                   <div class="actions">
                       <button type="submit" class="btn" name="sub" value="signup">Sign Up</button>
                   </div>
                   <!-- Divider text for alternative login options -->
                   <div class="or-divider">or</div>
                   <!-- Google Sign In button -->
                   <div class="google-signin">
                       <button type="button" class="btn google-btn">
                           <!-- SVG icon for Google -->
                           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="24px" height="24px" class="google-icon"><path fill="#4285F4" d="M44.5,20H24v8.5h11.7c-1.1,3.2-3.6,5.7-6.7,6.9l6.7,5.2c3.9-3.6,6.3-8.8,6.3-14.6C44.7,24.9,44.6,22.4,44.5,20z"/><path fill="#34A853" d="M24,44c5.9,0,10.8-1.9,14.4-5.1l-6.7-5.2c-2,1.3-4.6,2-7.7,2c-5.9,0-10.8-4-12.6-9.4l-7.2,5.6C8.9,39.7,15.9,44,24,44z"/><path fill="#FBBC05" d="M11.4,26.3c-0.5-1.3-0.8-2.7-0.8-4.3s0.3-3,0.8-4.3l-7.2-5.6C2.3,15.6,1,19.1,1,22.8s1.3,7.2,3.2,10.7L11.4,26.3z"/><path fill="#EA4335" d="M24,9.5c3.2,0,6.1,1.1,8.4,3.2l6.3-6.3C34.8,2.9,29.9,1,24,1c-8.1,0-15.1,4.3-19.2,10.7l7.2,5.6C13.2,13.5,18.1,9.5,24,9.5z"/><path fill="none" d="M0,0h48v48H0V0z"/></svg>
                           Sign in with Google
                       </button>
                   </div>
                   <!-- Section for account creation -->
                   <div class="create-account">
                       <p>Already Have Account? <a href="?task="><b>Login Here</b></a></p>
                   </div>
               </form>
           </div>
       </div>
   </div>
   <?php
   }
   else{
    ?>
    <!-- Main container for centering the login card on the screen -->
    <div class="container">
        <!-- Login card containing both the image and the form -->
        <div class="login-card">
            <!-- Left side of the card containing the decorative image -->
            <div class="card-left">
                <div class="image-cover">
                    <img src="asset/Contexts/vocab.jpg">
                </div>
            </div>
            <!-- Right side of the card containing the login form -->
            <div class="card-right">
                <!-- Title of the login form -->
                <h1 class="title">VocaSphere</h1>
                <!-- Subtitle welcoming the user -->
                <h2 class="welcome">Welcome to VocaSphere</h2>
                  <!--text Area for Warning -->
               <blockquote>
                 <?php 
                 error_reporting(0);
                       if('102'== $_GET['login_status']){
                        //email or password wrong in login.
                        include_once('warnings/102.php'); 
                         }
                         elseif('103'== $_GET['login_status']){
                            //Technical Problem in Signin.
                            include_once('warnings/103.php');   
                         }
                         elseif('101'== $_GET['login_status']){
                            //Id deactivated Alert.
                            include_once('warnings/101.php');
                         }
                        elseif('complete' == $_GET['registration']){
                            //Registration Successfull Message:
                            include_once('warnings/regdone.php');
                        }
                  ?>
               </blockquote>

                <!-- Form for user input -->
                <form action="form_handle.php" method="POST">
                    <!-- Input group for username or email -->
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required placeholder="anonymous@example.com">
                    </div>
                    <!-- Input group for password -->
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required placeholder="********">
                    </div>
                    <!-- Actions section containing the Sign In button and forgot password link -->
                    <div class="actions">
                        <button type="submit" class="btn" name="sub" value="signin">Sign in</button>
                        <a href="#" class="forgot-password">Forgot password?</a>
                    </div>
                    <!-- Divider text for alternative login options -->
                    <div class="or-divider">or</div>
                    <!-- Google Sign In button -->
                    <div class="google-signin">
                        <button type="button" class="btn google-btn">
                            <!-- SVG icon for Google -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="24px" height="24px" class="google-icon"><path fill="#4285F4" d="M44.5,20H24v8.5h11.7c-1.1,3.2-3.6,5.7-6.7,6.9l6.7,5.2c3.9-3.6,6.3-8.8,6.3-14.6C44.7,24.9,44.6,22.4,44.5,20z"/><path fill="#34A853" d="M24,44c5.9,0,10.8-1.9,14.4-5.1l-6.7-5.2c-2,1.3-4.6,2-7.7,2c-5.9,0-10.8-4-12.6-9.4l-7.2,5.6C8.9,39.7,15.9,44,24,44z"/><path fill="#FBBC05" d="M11.4,26.3c-0.5-1.3-0.8-2.7-0.8-4.3s0.3-3,0.8-4.3l-7.2-5.6C2.3,15.6,1,19.1,1,22.8s1.3,7.2,3.2,10.7L11.4,26.3z"/><path fill="#EA4335" d="M24,9.5c3.2,0,6.1,1.1,8.4,3.2l6.3-6.3C34.8,2.9,29.9,1,24,1c-8.1,0-15.1,4.3-19.2,10.7l7.2,5.6C13.2,13.5,18.1,9.5,24,9.5z"/><path fill="none" d="M0,0h48v48H0V0z"/></svg>
                            Sign in with Google
                        </button>
                    </div>
                    <!-- Section for account creation -->
                    <div class="create-account">
                        <p>New to VocaSphere? <a href="?task=create_account">Create Account</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
   }
?>
    <!-- Image credit at the bottom of the page -->
    <div class="image-credit">
        Designed by Shafayeth Ahmed Chowdhury</a> Contact on <a href="https://gitlab.com/shafayethahmed">GITLAB</a>
    </div>
    <script>
        //Login Status Changed After 4 Sec.
       document.addEventListener("DOMContentLoaded", function() {
         setTimeout(() => {
            const url = new URL(window.location);
            if (url.searchParams.has('login_status')) { 
                url.searchParams.delete('login_status'); // "status" URL removes
                window.history.replaceState({}, document.title, url); // URL update
            }
        }, 4000); //Change After 4 sec.
    });
    </script>
</body>
</html>