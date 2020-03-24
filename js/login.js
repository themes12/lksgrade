function do_login()
{
 var email=$("#ID").val();
 var pass=$("#password").val();
 if(email!="" && pass!="")
 {
  $("#loading_spinner").css({"display":"block"});
  $("#submit").css({"display":"none"});
  $.ajax
  ({
  type:'post',
  url:'../backend/login.php',
  data:{
   do_login:"do_login",
   email:email,
   password:pass
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
            window.location = "show_data.php"; //หน้าที่ต้องการให้กระโดดไป
        });
      }, 1000);
    }
    else
    {
      $("#loading_spinner").css({"display":"none"});
      $("#submit").css({"display":"block"});
      swal("Oops!","Something went wrong!","error")
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