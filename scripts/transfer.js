function do_transfer(){
  var amount = $("#amount").val();
  var csrf = $("#csrf").val();
  $.ajax({
   url:'transfer_check.php',
   type:'POST',
   data:{
     amount:amount,
     csrf:csrf
   },
   success:function(response) {
     $('#msg').html(response);
   }
   });
  return false;
 }
 