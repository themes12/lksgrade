if(data != "")
 {
  $.ajax
  ({
  type:'post',
  url:'show_data.php',
  data:{
   do_login:"do_login",
   data:data
  },
  success:function(response) {
  if(response=="success")
  {
    window.location.href = 'show_data.php';
  }
  else
  {
    swal("Oops","Something went wrong!","error")
  }
  }
  });
 }

 else
 {
  swal("Oops","Complete form","error")
 }