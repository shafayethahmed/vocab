<?php 
 //This page work with the saving new word or customize word in main part of web By customizing & data add by limited user.
 session_start();
 include_once('connection.php');
 $userId = $_SESSION['id'];
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $word = trim(filter_input(INPUT_POST,'word',FILTER_SANITIZE_STRING));
    $meaning = trim(filter_input(INPUT_POST,'meaning',FILTER_SANITIZE_STRING));
    $banglaMean= trim(filter_input(INPUT_POST,'bangla',FILTER_SANITIZE_STRING));
    $example = trim(filter_input(INPUT_POST,'example',FILTER_SANITIZE_STRING));
    $synonym= trim(filter_input(INPUT_POST,'synonym',FILTER_SANITIZE_STRING));
  //Inputed data into DB.
 $query = "INSERT INTO `vocab`(`user_id`, `word`, `meaning` , `bangla` , `synonym` , `example`) VALUES ('{$userId}','{$word}','{$meaning}','{$banglaMean}','{$synonym}','{$example}')";
 mysqli_query($conn,$query);
 header('location:dashboard.php?valofmenu=words&status=1'); 
 }
