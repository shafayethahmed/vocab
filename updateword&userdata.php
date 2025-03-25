<?php 
     include_once('connection.php');
     if(isset($_POST['updateword'])){
      $WordId =  filter_input(INPUT_POST,'wid',FILTER_SANITIZE_STRING);
      $word =  filter_input(INPUT_POST,'word',FILTER_SANITIZE_STRING);
      $meaning =  filter_input(INPUT_POST,'meaning',FILTER_SANITIZE_STRING);
      $banglaMean =  filter_input(INPUT_POST,'bangla',FILTER_SANITIZE_STRING);
      $synonym =  filter_input(INPUT_POST,'synonym',FILTER_SANITIZE_STRING);
      $example =  filter_input(INPUT_POST,'example',FILTER_SANITIZE_STRING);

      $query = "UPDATE `vocab` SET `word`='{$word}', `meaning`='{$meaning}', `bangla`='{$banglaMean}', 
                  `synonym`='{$synonym}', `example`='{$example}' WHERE `wid`='{$WordId}'";
           mysqli_query($conn,$query);
         header('location:dashboard.php?valofmenu=words&status=2');
         die;
      }
      elseif(isset($_POST['updateprofile'])){
         $UserId =  filter_input(INPUT_POST,'uid',FILTER_SANITIZE_STRING);
         $Status =  filter_input(INPUT_POST,'acstatus',FILTER_SANITIZE_STRING);
         //Updating the Active Status Of the Profile: 
         $query = "UPDATE `users` SET `status`='{$Status}' WHERE `id`='{$UserId}'";
         mysqli_query($conn,$query);
         header('location:dashboard.php?valofmenu=memberlist&status=3');
      }
      elseif(isset($_POST['updatecvprofile'])){
         $applicantId =  filter_input(INPUT_POST,'cv_id',FILTER_SANITIZE_STRING);
         $applicantEmail = filter_input(INPUT_POST,'cv_Email',FILTER_SANITIZE_STRING);
         $applicantEmail = filter_input(INPUT_POST,'cv_name',FILTER_SANITIZE_STRING);
         $applicantStatus = filter_input(INPUT_POST,'cv_acstatus',FILTER_SANITIZE_STRING);
         $query = "UPDATE `cv` SET `cv_review`='{$applicantStatus}' WHERE `cv_id`='{$applicantId}'";
         mysqli_query($conn,$query);
         header('location:dashboard.php?valofmenu=recruit');
      }
  
     
?>