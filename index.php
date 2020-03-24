<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Grade</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<form class="login100-form validate-form" onsubmit="return do_queue();" id="loginform" name="loginform">
					<span class="login100-form-title p-b-55">
						Grade
					</span>
					<div class="wrap-input100 validate-input m-b-16" data-validate = "studentID is required">
						<input class="input100" type="text" id="studentID" name="studentID" placeholder="Enter student ID" value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-user"></span>
						</span>
					</div>
					<div class="container-login100-form-btn p-t-25">
						<button class="login100-form-btn" id="submit" name="submit" value="submit">
							ENTER
						</button>
						<p id="loading_spinner" style="display: none;" align="middle"><img src="images/giph.gif" style="width: 30%; height: auto"></p>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="js/queue.js"></script>
<!--===============================================================================================-->

</body>
</html>
<script>
	swal("แจ้งข้อมูล", "เว็บไซต์นี้จะ update ข้อมูลตามเว็บเช็คเกรดของโรงเรียน \n นั่นหมายความว่าถ้าโรงเรียนยังไม่ประกาศเกรดเทอมที่ 2 ข้อมูลเว็บไซต์นี้ก็ยังไม่เปลี่ยนไปเป็นเกรดเทอมที่ 2", "info");
</script>