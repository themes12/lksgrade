<?php
session_start();
$email=$_POST['email'];
$pass=$_POST['password'];

if(isset($_POST['do_login'])) {
  if(isset($_POST['email']) && isset($_POST['password'])){
    $_SESSION['ID'] = $email;
    $_SESSION['password'] = $pass;
    echo "success";
  }else{
    echo "fail";
  }
  exit();
} 
mysqli_close($db);
?>