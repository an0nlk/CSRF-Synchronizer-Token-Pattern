function do_login(){
 var user=$("#username").val();
 var pass=$("#password").val();
 var csrf=$("#csrf").val();
 $.ajax({
  url:'login_check.php',
  type:'POST',
  dataType: 'json',
  data:{
    username:user,
    password:pass,
    csrf:csrf
  },
  success:function(response) {
    $('#user_err').html(response.user_error);
    $('#pass_err').html(response.pass_error);

    if(response.user_error == "" && response.pass_error == ""){
      window.location.replace("./transfer.php");
    }
  }
  });
 return false;
}