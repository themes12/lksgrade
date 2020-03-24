<?php 
require_once("config.php");
session_start();
if(isset($_POST['do_login'])){
   	$myusername = mysqli_real_escape_string($db,$_POST['email']);
    $sql = "SELECT * FROM mas_userstudent WHERE id = '$myusername' ";
	$result = mysqli_query($db,$sql);      
    $count = mysqli_num_rows($result);
      
    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count == 1) {
        $_SESSION['auth'] = "authorize";
        echo "success";
    }else{
        $_SESSION['auth'] = "unauthorize";
        echo "failed";
    }
}
mysqli_close($db);
?>