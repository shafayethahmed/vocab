<?php
session_start();
session_destroy();
?>
<?php
    // Include database connection
    include_once('../connection.php');

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
    <title>VocaSphere - Authentication</title>
    <link rel="website icon" href="asset/Contexts/logo.png" >
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@400;500&display=swap">
    <link rel="stylesheet" href="redesigned_styles.css">
</head>
<body>
    <a href="./mainDashboard/index.php" class="back-home-button">Back To The HomePage</a>

    <?php
    $tasks = $_GET['task'] ?? '';
    if('create_account' == $tasks){
     ?>
    <div class="auth-container">
        <div class="auth-card signup-card">
            <div class="card-banner">
                <div class="banner-content">
                    <img src="asset/Contexts/logo.png" alt="VocaSphere Logo" class="logo">
                    <h2>Create Your VocaSphere Account</h2>
                    <p>Unlock a world of vocabulary learning.</p>
                </div>
            </div>
            <div class="card-form">
                <h1 class="form-title">Sign Up</h1>
                <blockquote class="alert-container">
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
                <form action="form_handle.php" method="POST">
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required   placeholder="anonymous@example.com">
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required placeholder="Enter Your Password">
                    </div>
                    <div class="input-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" id="cpassword" name="cpassword" required placeholder="Re-type Password">
                    </div>
                    <?php
                    include_once('connection.php');
                    $query = "SELECT `val` FROM `pagecontrol` WHERE `pagefunction` = 'signupauth' ";
                    $resultOfQuery = mysqli_query($conn,$query);
                    while($row = mysqli_fetch_assoc($resultOfQuery)){
                        if($row['val'] == 1){ //Come From DB.
                            ?>
                    <div class="actions">
                        <button type="submit" class="btn primary-btn" name="sub" value="signup">Sign Up</button>
                    </div>
                    <?php
                        }
                    }
                    mysqli_close($conn);
                    ?>
                    <div class="or-divider"><span>or</span></div>
                    <div class="auth-switch">
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
     <div class="auth-container">
        <div class="auth-card login-card">
            <div class="card-banner">
                <div class="banner-content">
                    <img src="asset/Contexts/logo.png" alt="VocaSphere Logo" class="logo">
                    <h2>Welcome Back to VocaSphere</h2>
                    <p>Continue your vocabulary journey.</p>
                </div>
            </div>
            <div class="card-form">
                <h1 class="form-title">Login</h1>
                <blockquote class="alert-container">
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

                 <form action="form_handle.php" method="POST">
                     <div class="input-group">
                         <label for="email">Email</label>
                         <input type="email" id="email" name="email" required placeholder="anonymous@example.com">
                     </div>
                     <div class="input-group">
                         <label for="password">Password</label>
                         <input type="password" id="password" name="password" required placeholder="********">
                     </div>
                     <?php
                     include_once('connection.php');
                     $query = "SELECT `val` FROM `pagecontrol` WHERE `pagefunction` = 'loginauth' ";
                     $resultOfQuery = mysqli_query($conn,$query);
                     while($row = mysqli_fetch_assoc($resultOfQuery)){
                      if($row['val'] == 1){ //Come From DB.
                          ?>

                      <div class="actions">
                          <button type="submit" class="btn primary-btn" name="sub" value="signin">Sign in</button>
                          <a href="#" class="forgot-password">Forgot password?</a>
                      </div>
                      <?php
                      } }
                      mysqli_close($conn) ;?>
                      <div class="or-divider"><span>or</span></div>

                      <div class="auth-switch">
                          <p>New to VocaSphere? <a href="?task=create_account">Create Account</a></p>
                      </div>
                  </form>
              </div>
          </div>
      </div>
      <?php
     }
?>
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