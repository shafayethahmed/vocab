<?php    
 //Session start to take the Id:
 error_reporting(1);
  session_start();
  include_once('connection.php');
  $getKeyword = $_POST['sub'];
  if('signup' == $getKeyword){
       //Date is Making here For checking the History of the Account: 
        date_default_timezone_set("Asia/Dhaka"); //Timezone set in dhaka mode . 
       $email = filter_input(INPUT_POST,'email');
       $defaultPassword = filter_input(INPUT_POST,'password');
       $retypePassword = filter_input(INPUT_POST,'cpassword');

       //Authenticate Both Password: 
       if($retypePassword === $defaultPassword){
             $hashdefaultPassword = password_hash($defaultPassword,PASSWORD_BCRYPT);
            // print $hashdefaultPassword;//Test Done.
             //Ensuring Email Is Not Exist!
             $email_query ="SELECT * FROM `users` WHERE `email`='$email'";
             $resultEmailExist = mysqli_query($conn,$email_query);
             if(mysqli_num_rows($resultEmailExist) == 0){
                $Query = "INSERT INTO `users`(`email`, `password`) VALUES ('$email','$hashdefaultPassword')";
                 mysqli_query($conn,$Query);
                 //redirect to Dashboard
                  header('location:./Loginpage.php?registration=complete');
             }
              else{
                header('location:./LoginPage.php?task=create_account&email=existEmail');
              }
             }
            
       else{ 
        //Both Password Not Matched!
        header('location:./LoginPage.php?task=create_account&passStatus=mismatch');
       }
  }
  elseif ('signin' == $getKeyword) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $givenPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $query = "SELECT `id`,`password`,`status` FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result)>0) {
           $data = mysqli_fetch_assoc($result);
            $idUser = $data['id'];
            $idPass = $data['password'];
            $idStatus = $data['status'];
        if (($idStatus == 1) && (password_verify($givenPassword,$idPass))){
             $_SESSION['id'] = $idUser;
            header('location:dashboard.php?manumassage=dashboard'); //redirect to dashboard
            exit();
        }
        elseif($idStatus == 0){
          //Id deactivated Please Contact With Developer Team.
          header('location: ./LoginPage.php?login_status=101');
          exit();
        }
    else{
        // "Login Failed! Incorrect Email or Password.";
      // Redirect to login page if authentication fails
      header('location: ./LoginPage.php?login_status=102');
      exit(); 
    }
    
   }
   else{
      // Redirect to login page if authentication fails
      // Technical Error Marked Due to Registration  Process. 
      header('location: ./LoginPage.php?login_status=103');
      exit(); 
   }
  }
  elseif (isset($_POST['roleadd'])){
    if(isset($_POST['closerole'])){
      //After Click Close Button. 
      header('location:dashboard.php?valofmenu=team');
    }
    elseif($strLen = strlen($_POST['roleadd']) > 3){ //if length more then 3.
    $newRole = trim($_POST['roleadd']); // clean the input
       print strlen($newRole);
    // 1️⃣ **Check if role already exists**
    $newSQL = "SELECT `role` FROM `userrole` WHERE `role` = '$newRole'";
    $sqlResult = mysqli_query($conn, $newSQL);

    if (!$sqlResult) {
        die("Query Failed: " . mysqli_error($conn)); // Debugging 
    }
    
    if (mysqli_num_rows($sqlResult) > 0) {
        // **Role already exists**
        header('location:dashboard.php?valofmenu=team&status=201');
    } else {
        // 2️⃣ **Insert new role**
        $insertSQL = "INSERT INTO `userrole` (`role`) VALUES ('$newRole')";
        if (mysqli_query($conn, $insertSQL)) {
            // **Successfully added**
            header('location:dashboard.php?valofmenu=team&status=200');
        } else {
            // **Insert failed for code**
            header('location:dashboard.php?valofmenu=team&status=202');
        }
    }
  }
  else{
         //String length is Very Short! So don't Inserted.
         header('location:dashboard.php?valofmenu=team&status=203');
  }
}
  else{
    print("Error return  here!");
  }
