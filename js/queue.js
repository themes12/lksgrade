function do_queue()
{
 var email=$("#studentID").val();
 if(email!="")
 {
  $("#loading_spinner").css({"display":"block"});
  $("#submit").css({"display":"none"});
  $.ajax
  ({
  type:'post',
  url:'backend/queue.php',
  data:{
   do_login:"do_queue",
   email:email
  },
  success:function(response) {
  if(response=="success")
  {
    $("#loading_spinner").css({"display":"none"});
    $("#submit").css({"display":"block"});
    setTimeout(function() {
      swal({
          title: "Nice!",
          text: "Login Successful! \n Please wait, You will be redirect in 5 second.",
          type: "success",
          showConfirmButton: false,
          timer: 5000
      }, function() {
          window.location = "login/"; //หน้าที่ต้องการให้กระโดดไป
      });
    }, 1000);
  }
  else
  {
    $("#loading_spinner").css({"display":"none"});
    $("#submit").css({"display":"block"});
    swal("Oops!","Your ID is not exist!","error")
  }
  }
  });
 }

 else
 {
  swal("Oops!","Please complete form!","error")
 }

 return false;
}