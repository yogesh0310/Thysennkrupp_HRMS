$(function(){
  $('#logout').change(function(){
    if($(this).val()=="logout"){
  

  $.ajax({
    url:"http://localhost/hrms/api/logout.php",
    type:"POST",
    success:function(para){

    if(para=="success")
    {
   
    document.location.replace("http://localhost/hrms/index.php")
    }
  
    } 

})	  }

else if($(this).val()=="profile")
{
  document.location.replace("http://localhost/hrms/getcurrentuser.php")
}
   
  });
});
