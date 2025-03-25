<?php 
  // error_reporting(0);
$db_host = 'localhost';
$db_username ='root';
$db_password ='';
$db_name = 'vocasphere';
$conn = mysqli_connect($db_host,$db_username,$db_password,$db_name);
/*
if($conn){
    print("Database Connected Successfully");
}
else{
    print error_reporting();
}*/