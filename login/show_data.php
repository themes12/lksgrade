<?php 
$url = $_SERVER['REQUEST_URI']; //returns the current URL
$parts = explode('/',$url);
$dir = $_SERVER['SERVER_NAME'];
for ($i = 0; $i < count($parts) - 1; $i++) {
 $dir .= $parts[$i] . "/";
}
$server = rand(1,2);
if($server == 1){
  $file = "data.php";
  $file_name = "เซิฟเวอร์หลัก";
}elseif($server == 2){
  $file = "data2.php";
  $file_name = "เซิฟเวอร์รอง";
}else{
  $file = "data.php";
  $file_name = "เซิฟเวอร์หลัก";
}
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$dir";
error_reporting(0);
ini_set('display_errors', 0);
require_once('../backend/config.php');
session_start();
if(isset($_GET['auth']) && isset($_GET['ID']) && isset($_GET['password'])){
  $_SESSION['auth'] = "authorize";
  $_SESSION['ID'] = $_GET['ID'];
  $_SESSION['password'] = $_GET['password'];
}
if(!isset($_SESSION['auth'])) {
  $_SESSION['auth'] = "unauthorize";
  if(!isset($_SESSION['ID']) || !isset($_SESSION['password'])){
    $_SESSION['auth'] = "unauthorize";
  }
}
@$id = $_SESSION['ID'];
@$date = $_SESSION['password'];
$sql = "SELECT * FROM mas_userstudent WHERE id = '$id' ";
@$result = mysqli_query($db,$sql);  
@$url = $actual_link.$file."?id=$id&date=$date";
$htmlContent = file_get_contents($url);	
$DOM = new DOMDocument('1.0', 'UTF-8');
$internalErrors = libxml_use_internal_errors(true);
@$DOM->loadHTML(mb_convert_encoding($htmlContent, 'HTML-ENTITIES', 'UTF-8'));
libxml_use_internal_errors($internalErrors);
$xpath = new DOMXPath($DOM);
$table =$xpath->query("//*[@id='ContentPlaceHolder1_GridView1']")->item(0);
$grade =$xpath->query("//*[@id='ContentPlaceHolder1_Label10']")->item(0)->textContent;
$number =$xpath->query("//*[@id='ContentPlaceHolder1_Label11']")->item(0)->textContent;
$semester =$xpath->query("//*[@id='ContentPlaceHolder1_Label2']")->item(0)->textContent;
try { 
  if($table && $grade){
    $Header = $table->getElementsByTagName('th');
    $Detail = $table->getElementsByTagName('td');
    //#Get header name of the table
    foreach($Header as $NodeHeader) 
    {
      $aDataTableHeaderHTML[] = trim($NodeHeader->textContent);
    }
    //print_r($aDataTableHeaderHTML); die();

    //#Get row data/detail table without header name as key
    $i = 0;
    $j = 0;
    foreach($Detail as $sNodeDetail) 
    {
      $aDataTableDetailHTML[$j][] = trim($sNodeDetail->textContent);
      $i = $i + 1;
      $j = $i % count($aDataTableHeaderHTML) == 0 ? $j + 1 : $j;
    }
    //print("<pre>".print_r($aDataTableDetailHTML,true)."</pre>"); die();	
    //echo $grade;
  }else{
    throw new Exception("Error");
  }
} catch(Exception $e) {
  $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Grade</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  <style type='text/css'>

  @font-face {
    font-family: 'Petchlamoon';
    src: url('../fonts/font/Petchlamoon-Regular.eot?#iefix') format('embedded-opentype'),  url('../fonts/font/Petchlamoon-Regular.woff') format('woff'), url('../fonts/font/Petchlamoon-Regular.ttf')  format('truetype'), url('../fonts/font/Petchlamoon-Regular.svg#CSChatThaiUI') format('svg');
    font-weight: normal;
    font-style: normal;
  }

  body { font-family: 'Petchlamoon' !important; }

</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">เช็คเกรด</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

   <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    </ul>
    <button type="button" id="btn_logout" name="btn_logout" class="btn btn-danger">Logout</button>
  </div>
</nav>
&nbsp;
<div class="container">
<div class="card text-center">
  <div class="card-header">
    ข้อมูลนักเรียน
  </div>
  <div class="card-body">
    <h5 class="card-title"> เลขประจำตัวนักเรียน 
      <?php
      while ($row = mysqli_fetch_assoc($result)) {
        echo $row["id"]; 
      ?>
    </h5>
    <p class="card-text">
      <?php echo $row["prefix"]; echo $row["firstname"]. " ". $row["lastname"]; ?>
      ห้อง 
      <?php echo $row["room"]; ?>
    </p>
      <?php } ?>
  </div>
</div>
</div>
&nbsp;
<div class="container">
<B><p><center><font size="4"><?php echo $semester; ?></font></center></p></B>
<p><center><font size="3">ข้อมูลจาก : <?php echo $file_name; ?></font></center></p>
</div>
<div class="table-responsive"> 
  <div class="container">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">รหัส</th>
          <th scope="col">ชื่อวิชา</th>
          <th scope="col">หน่วยกิต</th>
          <th scope="col">กลางภาค</th>
          <th scope="col">ปลายภาค</th>
          <th scope="col">รวม</th>
          <th scope="col">เกรด</th>
          <!-- <th scope="col">แก้ตัว</th> -->
          <th scope="col">ครู</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($aDataTableDetailHTML as $gradeInfo) { ?>
        <tr>
          <td><?php echo $gradeInfo['0']; ?></td>
          <td><?php echo $gradeInfo['1']; ?></td>
          <td><?php echo $gradeInfo['3']; ?></td>
          <td><?php echo $gradeInfo['5'] ?></td>
          <td><?php echo $gradeInfo['6'] ?></td>
          <td><?php echo $gradeInfo['7'] ?></td>
          <td><?php echo $gradeInfo['8'] ?></td>
          <!-- <td><?php //echo $grade['9']; ?></td> -->
          <td><?php echo $gradeInfo['12'] ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
&nbsp;
<div class="container">
<div class="card text-center">
  <div class="card-header">
    สรุป
  </div>
  <div class="card-body">
    <h5 class="card-title"> ผลการเรียนเฉลี่ย GPA : 
      <?php echo $grade; ?>
    </h5>
    <h5 class="card-title"> ลำดับที่ห้อง/ระดับชั้น : 
    <?php echo $number; ?>
    </h5>
  </div>
</div>
</div>
&nbsp;
<div class="container">
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
      <a href="https://www.facebook.com/thiti.puttaamart/"> Thiti Phuttaamart</a>
      <p> ไม่อนุญาตให้นำไปใช้งานในเชิงพาณิชย์ และข้อมูลที่ปรากฎในเว็บไชต์นี้นำมาจากเว็บไซต์อย่างเป็นทางการของโรงเรียนลำปางกัลยาณี</p>
  </div>
</div>

</body>
</html>

<!--===============================================================================================-->	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="../js/logout.js"></script>
<!--===============================================================================================-->
<script>
  var errorMsg = '<?php echo $error; ?>';
	var auth = '<?php echo $_SESSION['auth']; ?>';
          
		if(auth === 'unauthorize' || errorMsg === 'Error' ){
      
			setTimeout(function() {
				swal({
					title: "Oops!",
					text: "Unauthorize! or Error! getting data from school \n Please wait, You will go back to previous page in 5 second.",
					type: "error",
					showConfirmButton: false,
					timer: 5000
				}, function() {
					window.location = "../"; //หน้าที่ต้องการให้กระโดดไป
				});
			}, 1000);
    }

</script>
<?php session_write_close(); mysqli_close($db);?>
