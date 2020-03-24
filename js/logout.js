$("#btn_logout").click(function() {
    $("#btn_logout").css({"display":"none"});
    $.ajax
    ({
        type:'post',
        url: '../backend/logout.php',
        data:{
            do_logout:"do_logout"
           },
        success: function(response){
            if(response=="success")
            {
            setTimeout(function() {
                swal({
                    title: "Nice!",
                    text: "Logout Successful! \n Please wait, You will be redirect in 5 second.",
                    type: "success",
                    showConfirmButton: false,
                    timer: 5000
                }, function() {
                    window.location = "../"; //หน้าที่ต้องการให้กระโดดไป
                });
            }, 1000);
            }
            else
            {
            $("#btn_logout").css({"display":"block"});
            swal("Oops!","Something went wrong!","error")
            }
        }
    });
});