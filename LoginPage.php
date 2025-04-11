<?php 
session_start();
session_destroy();
?>
<?php 
error_reporting(0);
   // Include database connection
   include_once('connection.php');
   
   // Query to fetch both signupauth and loginauth data
   $sqlquery = "SELECT `pagefunction`, `val` FROM `pagecontrol` WHERE `pagefunction` IN ('signupauth', 'loginauth')";
   $resultOfQuery = mysqli_query($conn, $sqlquery);
   
   // Initialize variables to track values
   $signupAuth = false;
   $loginAuth = false;
   
   // Process query results
   while ($row = mysqli_fetch_assoc($resultOfQuery)) {
       if ($row['pagefunction'] == 'signupauth' && $row['val'] == 0) {
           $signupAuth = true;
       }
       if ($row['pagefunction'] == 'loginauth' && $row['val'] == 0) {
           $loginAuth = true;
       }
   }
   
   // Redirect if both conditions are met
   if ($signupAuth && $loginAuth) {
       header("Location: ./mainDashboard/index.php"); // Replace 'dashboard.php' with the desired URL
       exit();
   } 

   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VocaSphere</title>
    <link rel="website icon" href="asset/Contexts/logo.png">
    <!-- Link to Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@400;500&display=swap">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Global reset for consistent margin, padding, and box-sizing across browsers */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styling the body to center content with a background gradient */
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color:skyblue;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        /* Container to center the login card on the page */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 900px;
            padding: 20px;
        }

        /* Login card that holds both the image and the form */
        .login-card {
            display: flex;
            flex-direction: row;
            width: 100%;
            background-color: rgb(251, 251, 251);
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Left side of the login card containing the image */
        .card-left {
            width: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Styling the image to cover the entire left side */
        .card-left .image-cover img {
            width: 90%;
            height: auto;
            object-fit: cover;
            display: block;
            margin: 40px;
        }

        /* Right side of the login card containing the form */
        .card-right {
            width: 50%;
            padding: 40px 60px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            position: relative;
        }

        .card-right .back-home-box {
            margin-bottom: 20px;
        }

        .card-right .back-to-home {
            display: inline-block;
            padding: 8px 12px;
            background-color: #f0f0f0;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            font-size: 0.9em;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .card-right .back-to-home:hover {
            background-color: #ddd;
            color: #000;
        }

        /* Title of the form */
        .title {
            font-family: 'Poppins', sans-serif;
            font-size: 48px;
            color: #1d68a5;
            text-align: center;
        }

        /* Welcome message below the title */
        .welcome {
            font-size: 20px;
            margin-top: -10px;
            margin-bottom: 20px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        /* Warning blockquote styling */
        blockquote {
            padding: 10px 15px;
            margin-bottom: 20px;
            border-left: 4px solid #ff9800;
            background-color: #fff3e0;
            border-radius: 4px;
            font-size: 14px;
            color: #e65100;
            transition: all 0.3s ease;
            max-height: 0;
            overflow: hidden;
            opacity: 0;
        }

        blockquote.show {
            max-height: 100px;
            opacity: 1;
            margin-bottom: 20px;
        }

        /* Grouping label and input fields together */
        .input-group {
            margin-bottom: 16px;
            position: relative;
        }

        /* Styling the labels above input fields */
        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #898989;
            font-family: 'Poppins', sans-serif;
        }

        /* Styling the input fields */
        .input-group input {
            width: 100%;
            padding: 10px;
            padding-right: 35px; /* Space for the icon */
            border-radius: 5px;
            border: 1px solid #ccc;
            font-family: 'Roboto', sans-serif;
        }

        /* Password toggle icon */
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 32px;
            cursor: pointer;
            color: #898989;
        }

        /* Actions section containing buttons and links */
        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Primary button styling */
        .actions .btn {
            padding: 10px 20px;
            background-color: #2e31bb;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        /* Hover effect for buttons */
        .actions .btn:hover {
            background-color: #b66a4c;
            transform: scale(1.05);
        }

        /* Styling for the forgot password link */
        .actions .forgot-password {
            font-size: 14px;
            color: #007BFF;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        /* Hover effect for the forgot password link */
        .actions .forgot-password:hover {
            color: #0056b3;
        }

        /* Divider text for alternative login options */
        .or-divider {
            text-align: center;
            margin: 20px 0;
            font-size: 14px;
            color: #999;
            position: relative;
        }

        .or-divider::before,
        .or-divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background-color: #ddd;
        }

        .or-divider::before {
            left: 0;
        }

        .or-divider::after {
            right: 0;
        }

        /* Google Sign-In button styling */
        .google-signin .google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 10px;
            background-color: #303030;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        /* Margin between the Google icon and the text */
        .google-signin .google-btn .google-icon {
            margin-right: 10px;
        }

        /* Hover effect for the Google Sign-In button */
        .google-signin .google-btn:hover {
            background-color: #3367d6;
            transform: scale(1.05);
        }

        /* Styling the Create Account section */
        .create-account {
            font-size: 12px;
            text-transform: uppercase;
            text-align: center;
            margin-top: 20px;
        }

        /* Styling the Create Account link */
        .create-account a {
            color: #007BFF;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        /* Hover effect for the Create Account link */
        .create-account a:hover {
            color: #0056b3;
        }

        /* Styling for the image credit section */
        .image-credit {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-bottom:12px;
        }

        .image-credit a {
            color: #007BFF;
            text-decoration: none;
        }

        .image-credit a:hover {
            text-decoration: underline;
        }

        /* Media Query for responsiveness on smaller screens */
        @media (max-width: 768px) {
            /* Stacking the login card vertically on small screens */
            .login-card {
                flex-direction: column;
            }

            /* Adjust the left side image on small screens */
            .card-left {
                width: 100%;
                max-height: 200px;
            }

            .card-left .image-cover img {
                width: 50%;
                margin: 20px;
            }

            /* Making the right side form full-width */
            .card-right {
                width: 100%;
                padding: 30px 20px;
            }

            /* Adjusting title size for smaller screens */
            .title {
                font-size: 32px;
            }

            /* Adjusting welcome text size for smaller screens */
            .welcome {
                font-size: 18px;
                margin-bottom: 20px;
            }

            /* Adjusting input padding for smaller screens */
            .input-group input {
                padding: 8px;
                padding-right: 35px;
            }

            /* Adjusting button padding and font size for smaller screens */
            .actions .btn,
            .google-signin .google-btn {
                padding: 10px;
                font-size: 14px;
            }

            /* Adjust actions layout on small screens */
            .actions {
                flex-direction: column;
                gap: 10px;
                align-items: stretch;
            }

            .actions .forgot-password {
                text-align: center;
                margin-top: 10px;
            }
        }

        /* Extra small devices */
        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }

            .card-right {
                padding: 20px 15px;
            }

            .title {
                font-size: 28px;
            }

            .welcome {
                font-size: 16px;
            }

            .card-left {
                max-height: 150px;
            }
        }
        /* Design For My Loader */
.loader-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    display: none;
}
.loader {
    transform: rotateZ(45deg);
    perspective: 1000px;
    border-radius: 50%;
    width: 70px;
    height: 70px;
    color: #fff;
    position: relative;
}
.loader:before,
.loader:after {
    content: '';
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    width: inherit;
    height: inherit;
    border-radius: 50%;
    transform: rotateX(70deg);
    animation: spin 1s linear infinite;
}
.loader:after {
    color:rgb(0, 68, 255);
    transform: rotateY(70deg);
    animation-delay: .4s;
}
@keyframes spin {
    0%, 100% {
        box-shadow: .2em 0px 0 0px currentcolor;
    }
    12% {
        box-shadow: .2em .2em 0 0 currentcolor;
    }
    25% {
        box-shadow: 0 .2em 0 0px currentcolor;
    }
    37% {
        box-shadow: -.2em .2em 0 0 currentcolor;
    }
    50% {
        box-shadow: -.2em 0 0 0 currentcolor;
    }
    62% {
        box-shadow: -.2em -.2em 0 0 currentcolor;
    }
    75% {
        box-shadow: 0px -.2em 0 0 currentcolor;
    }
    87% {
        box-shadow: .2em -.2em 0 0 currentcolor;
    }
}
    </style>
</head>
<body>
     <!-- Loader Container -->
     <div id="loader-container" class="loader-container">
                    <div class="loader"></div>
     </div>
    <!-- Main container for centering the login card on the screen -->
    <div class="container">
        <!-- Login card containing both the image and the form -->
        <div class="login-card">
            <!-- Left side of the card containing the decorative image -->
            <div class="card-left">
                <div class="image-cover">
                    <img src="asset/Contexts/vocab.jpg" alt="VocaSphere">
                </div>
            </div>
            <!-- Right side of the card containing the form -->
            <div class="card-right">
                <div class="back-home-box">
                    <a href="./mainDashboard/index.php" class="back-to-home">
                        <i class="fas fa-home"></i> Back To The HomePage
                    </a>
                </div>
                <!-- Title of the form -->
                <h1 class="title">VocaSphere</h1>
                <!-- Subtitle welcoming the user -->
                <h2 class="welcome" id="welcomeMessage">Welcome to VocaSphere</h2>
                
                <!-- Warning blockquote -->
                <blockquote id="warningBlock"></blockquote>
                
                <!-- Form for user input -->
                <form action="form_handle.php" method="POST" id="authForm">
                    <!-- Input group for email -->
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required placeholder="anonymous@example.com">
                    </div>
                    
                    <!-- Input group for password -->
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required placeholder="Enter your password">
                        <i class="password-toggle fas fa-eye-slash" id="togglePassword"></i>
                    </div>
                    
                    <!-- Confirm password (only shown in signup mode) -->
                    <div class="input-group" id="confirmPasswordGroup" style="display: none;">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" id="cpassword" name="cpassword" placeholder="Re-type Password">
                        <i class="password-toggle fas fa-eye-slash" id="toggleConfirmPassword"></i>
                    </div>
                    
                    <!-- Actions section containing the Sign In button and forgot password link -->
                    <div class="actions" id="loginActions">
                        <button type="submit" class="btn" name="sub" value="signin" id="submitBtn">Sign in</button>
                        <a href="#" class="forgot-password">Forgot password?</a>
                    </div>
                    
                    <!-- Signup button (only shown in signup mode) -->
                    <div class="actions" id="signupActions" style="display: none;">
                        <button type="submit" class="btn" name="sub" value="signup">Sign Up</button>
                    </div>
                    
                    <!-- Divider text for alternative login options -->
                    <div class="or-divider">or</div>

                    <!-- Account switching section -->
                    <div class="create-account" id="createAccountSection">
                        <p>New to VocaSphere? <a href="#" id="switchToSignup">Create Account</a></p>
                    </div>
                    
                    <div class="create-account" id="loginAccountSection" style="display: none;">
                        <p>Already Have Account? <a href="#" id="switchToLogin">Login Here</a></p>
                    </div>
                </form>
            </div>
        </div>

           <!-- Image credit at the bottom of the page -->
    <div class="image-credit">
        This Website developed by Shafayeth Ahmed Chowdhury | Contact on <a href="https://gitlab.com/shafayethahmed">GITLAB</a>
    </div>

    </div>
    
 
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const task = urlParams.get('task');
            const loginStatus = urlParams.get('login_status');
            const registration = urlParams.get('registration');
            const passStatus = urlParams.get('passStatus');
            const emailStatus = urlParams.get('email');
            
            // Elements
            const welcomeMessage = document.getElementById('welcomeMessage');
            const confirmPasswordGroup = document.getElementById('confirmPasswordGroup');
            const loginActions = document.getElementById('loginActions');
            const signupActions = document.getElementById('signupActions');
            const createAccountSection = document.getElementById('createAccountSection');
            const loginAccountSection = document.getElementById('loginAccountSection');
            const warningBlock = document.getElementById('warningBlock');
            const submitBtn = document.getElementById('submitBtn');
            const authForm = document.getElementById('authForm');
            // Password toggle functionality
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
            
            // Confirm password toggle
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const cpassword = document.getElementById('cpassword');
            
            if (toggleConfirmPassword && cpassword) {
                toggleConfirmPassword.addEventListener('click', function() {
                    const type = cpassword.getAttribute('type') === 'password' ? 'text' : 'password';
                    cpassword.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            }
            
            // Switch to signup mode
            const switchToSignup = document.getElementById('switchToSignup');
            switchToSignup.addEventListener('click', function(e) {
                e.preventDefault();
                welcomeMessage.textContent = 'SignUp Here';
                confirmPasswordGroup.style.display = 'block';
                loginActions.style.display = 'none';
                signupActions.style.display = 'flex';
                createAccountSection.style.display = 'none';
                loginAccountSection.style.display = 'block';
                authForm.querySelector('button[name="sub"]').value = 'signup';
                warningBlock.textContent = '';
                warningBlock.classList.remove('show');
                
                // Update URL without refreshing
                const newUrl = new URL(window.location);
                newUrl.searchParams.set('task', 'create_account');
                window.history.pushState({}, '', newUrl);
            });
            
            // Switch to login mode
            const switchToLogin = document.getElementById('switchToLogin');
            switchToLogin.addEventListener('click', function(e) {
                e.preventDefault();
                welcomeMessage.textContent = 'Welcome to VocaSphere';
                confirmPasswordGroup.style.display = 'none';
                loginActions.style.display = 'flex';
                signupActions.style.display = 'none';
                createAccountSection.style.display = 'block';
                loginAccountSection.style.display = 'none';
                authForm.querySelector('button[name="sub"]').value = 'signin';
                warningBlock.textContent = '';
                warningBlock.classList.remove('show');
                
                // Update URL without refreshing
                const newUrl = new URL(window.location);
                newUrl.searchParams.delete('task');
                window.history.pushState({}, '', newUrl);
            });
            
            // Handle warnings based on URL parameters
            function showWarning(message) {
                warningBlock.innerHTML = message;
                warningBlock.classList.add('show');
                
                // Auto-hide warning after 4 seconds
                setTimeout(() => {
                    warningBlock.classList.remove('show');
                }, 4000);
            }
            
            // Check URL parameters and set initial state
            if (task === 'create_account') {
                welcomeMessage.textContent = 'SignUp Here';
                confirmPasswordGroup.style.display = 'block';
                loginActions.style.display = 'none';
                signupActions.style.display = 'flex';
                createAccountSection.style.display = 'none';
                loginAccountSection.style.display = 'block';
                
                // Show signup-related warnings
                if (emailStatus === 'existEmail') {
                    showWarning('<i class="fas fa-exclamation-triangle"></i> This email is already registered. Please use a different email or login.');
                } else if (passStatus === 'mismatch') {
                    showWarning('<i class="fas fa-exclamation-triangle"></i> Passwords do not match. Please try again.');
                }
            } else {
                // Handle login-related warnings
                if (loginStatus === '102') {
                    showWarning('<i class="fas fa-exclamation-triangle"></i> Invalid email or password. Please try again.');
                } else if (loginStatus === '103') {
                    showWarning('<i class="fas fa-exclamation-triangle"></i> Technical problem in signing in. Please try again later.');
                } else if (loginStatus === '101') {
                    showWarning('<i class="fas fa-exclamation-triangle"></i> Your account has been deactivated. Please contact support.');
                } else if (registration === 'complete') {
                    showWarning('<i class="fas fa-check-circle" style="color: green;"></i> Registration successful! You can now log in with your credentials.');
                }
            }
            
            // Remove status parameters after 4 seconds
            setTimeout(() => {
                const url = new URL(window.location);
                if (url.searchParams.has('login_status')) {
                    url.searchParams.delete('login_status');
                    window.history.replaceState({}, document.title, url);
                }
                if (url.searchParams.has('registration')) {
                    url.searchParams.delete('registration');
                    window.history.replaceState({}, document.title, url);
                }
                if (url.searchParams.has('passStatus')) {
                    url.searchParams.delete('passStatus');
                    window.history.replaceState({}, document.title, url);
                }
                if (url.searchParams.has('email')) {
                    url.searchParams.delete('email');
                    window.history.replaceState({}, document.title, url);
                }
            }, 4000);

            // Add form submission event to show loader
            authForm.addEventListener('submit', function(e) {
                // Show the loader when the form is submitted
                document.getElementById('loader-container').style.display = 'flex';
                // Wait for 2 seconds before submitting the form
                setTimeout(() => {
                    this.submit(); // Submit the form after 2 seconds
                }, 7000);
             });
            
            // Add click event listeners to all submit buttons to show loader
            const loginButton = document.querySelector('button[value="signin"]');
            const signupButton = document.querySelector('button[value="signup"]');
            
            if (loginButton) {
                loginButton.addEventListener('click', function() {
                    document.getElementById('loader-container').style.display = 'flex';
                });
            }
            
            if (signupButton) {
                signupButton.addEventListener('click', function() {
                    document.getElementById('loader-container').style.display = 'flex';
                });
            }

        });
    </script>
</body>
</html>