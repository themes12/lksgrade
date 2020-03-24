<?php 
session_start();
$email=$_SESSION['ID'];
$pass=$_SESSION['password'];

if(isset($_POST['do_logout'])) {
  if(isset($email) && isset($pass)){
    session_destroy();
    echo "success";
  }else{
    echo "fail";
  }
  exit();
} 
?>