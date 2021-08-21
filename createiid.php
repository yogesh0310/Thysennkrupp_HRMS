<?php
error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'api/db.php';
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg'];
    
    if($designation == "hr" || $designation == "ceo" || $designation == "hod" || $designation == "rghead" )
    {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <script src="public/jquery-3.2.1.min.js"></script>
  
  <script src="public/js/materialize.js"></script>
  <script src="public/js/materialize.min.js"></script>

</head>
    <style>
    .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}</style>

<body>

  <nav>
  <div class="nav-wrapper blue darken-1">
  <a href="http://localhost/hrms/">
      <button class="btn waves-effect blue darken-1" style="float:left;margin-top: 18px;margin-right: 18px "> <- BACK</button>
      </a> 

      <a href="#!" class="brand-logo center">thyssenkrupp Elevators</a>
      <div id="logoutuser" class="row">
    <button class="btn waves-effect blue darken-1" type="submit" name="action" style="float:right;margin-top: 18px;margin-right: 18px ">LOGOUT</button>
  </div>
    </div>
  </nav>

<br><br>
  <div class="row" id='row' >
    <div class="col m4 offset-m4">
      <div class="card  white">
        <div class="card-content white-text">
          
          <div class="col s12 ">
        
          <div class="input-field col s1 blue-text">
          <i class="material-icons prefix ">location_city</i>
          </div>

          
          <div class="input-field col s11 blue-text">
                     <select id='rgchoice' class="dropdown-trigger btn blue darken-1" >
              <option value="" disabled selected style="color: white">Select Region</option>
            </select>
            </div>

            <div class="input-field col s1 blue-text">
          <i class="material-icons prefix ">account_balance</i>
          </div>

          
          <div class="input-field col s11 blue-text">
          <select id='deptchoice' class="dropdown-trigger btn blue darken-1" >
              <option value="" disabled selected style="color: white">Select Department</option>
            </select>
            </div>


            <div class="input-field col s1 blue-text">
          <i class="material-icons prefix ">assignment</i>
          </div>

          
          <div class="input-field col s11 blue-text">
          <select id='prfno' class="dropdown-trigger btn blue darken-1" >
              <option value="" disabled selected style="color: white">Select PRF</option>
            </select>
            </div>

            <div class="input-field col s1 blue-text">
          <i class="material-icons prefix ">group</i>
          </div>

          
          <div class="input-field col s11 blue-text">
          <select id='pos' class="dropdown-trigger btn blue darken-1" >
              <option value="" disabled selected style="color: white">Select Position</option>
            </select>
            </div>

      
          </div>  
          
          </div>
          
          <div id="exist">
            <center></center>
          

          <div class="row">
            <div class="row">
              <div class="input-field col s6 offset-m1">
<button id = 'groupcreation' class="btn waves-effect blue darken-1" type="submit" name="action">Create Instance
<i class="material-icons left">add_circle</i>
</button> 
</div>

<div class="input-field col s4" id="histbtn">
<button class="btn waves-effect blue darken-1"  onclick="gethistory()">See History 
<i class="material-icons left">history</i> 
</button>

</div>

</div>
</div>

<div class="row" >
<center>
<p style="color: green" id="creatinggrp"> Creating Group.... </p>
<p style="color: green" id="groupcreated"> Group Created Successfully </p>
<p style="color: red" id="groupnotcreated"> Unable to create group </p>
</center>
</div>

</div>



</div>

</div>
</div>


<!-- Create Group -->
<div class="row" id="newgroup">
<div class="col m4 offset-m4  center">
<div class="card  white">
<div class="card-content white-text">



<div class="col s6 " style="opacity: 0;">
<select disabled class="dropdown-trigger btn blue darken-1" >
<option value="" disabled selected style="color: white">Designation</option>
<option value="1">Sales Department</option>
<option value="2">HR Department</option>
<option value="3">Warehouse Department</option>
</select>
<br><br>
</div>

<div class="col s6 " style="opacity: 0">
<select disabled class="dropdown-trigger btn blue darken-1" >
<option value="" disabled selected style="color: white">Designation</option>
<option value="1">Sales Department</option>
<option value="2">HR Department</option>
<option value="3">Warehouse Department</option>
</select>
<br><br>
</div> 








<div class="row" id="emailcollection">
<div class="input-field col s11  blue-text" >
<i class="material-icons prefix">email</i>
<input id="email" onfocus="addText(this)" type="text" class="validate" placeholder="Enter Email">
</div>

</div> 


</div>






<div class="row">




<div class="input-field col s6 offset-s3 center">
<button  class="btn waves-effect waves-light blue darken-1" id="submitmail" >Submit Mail
<i class="material-icons right">send</i>
</button>
</div>



</div>



</div>

</div>
</div>
<div id="logout">
<h1>Successfully Logged Out</h1>
</div>





</body>
</html>
<!-- end create group -->




<script>
var groupStatus;
var department
var prfno
var pos

var prfno
var ctr = 0
function addText(x)
{
ctr = ctr+1
var str = 'email'+ctr

var txt="<div class='row'><div class='input-field col s11  blue-text' ><i class='material-icons prefix'>email</i>  <input id='"+str+"' onfocus='addText(this)' type='text' class='validate' placeholder='Enter Email'></div></div>"
$("#emailcollection").append(txt);
}

$(document).ready(function(){

//onload ajax call to populate regions.
$.ajax({
type:'GET',
url:'getdata.php',
success:function(para){
//demodata
console.log(para)
for(let i=0;i<para.length;i++)
{
  var str = '<option value="'+para[i]+'"  style="color: white">'+para[i]+'</option>'
  $('#rgchoice').append(str);
  console.log('appended')
}


}
})
$("#notlogout").hide()
$("#logout").hide()
$('#histbtn').hide()
$('#hide').hide()
$('#hide2').hide()
$('#Exist').hide();
$('#groupcreated').hide()
$('#groupnotcreated').hide()
$('#creatinggrp').hide()

$('#groupcreation').hide();


$('#newgroup').hide();
$('#notexist').hide();

$('#groupcreation').click(function(){

$('#newgroup').show(600);
});


//retrive depts
$.ajax({
url:"http://localhost/hrms/api/deptlist.php",
type:"GET",
success:function(para)
{
  console.log("this are deptlist = ",para)
  var deptlist = JSON.parse(para);
  var olddept = []

  for (let i = 0; i < deptlist.length; i++) 
  {
    const element = deptlist[i];

    if(olddept.indexOf(element) == -1)
    {
      olddept.push(element)
      var ap1 =  "<option value='"+element+"'>"+element+" Department</option>"
    $("#deptchoice").append(ap1)    
    }
    else{
      console.log("its being repeted...")

    }
  }


} 

})


$('#deptchoice').change(function(){

  $("#prfno").empty()   
  var ap1 = "<option disabled selected style='color: white'>Select PRF</option>"
  $("#prfno").append(ap1)    


$.ajax({
url:"http://localhost/hrms/api/prflist.php",
type:"POST",
data: {"dept": $('#deptchoice').val()},
success:function(para)
{
  console.log("this are prflist = ",para)
  
  var prflist = JSON.parse(para);
  var olddept = [];
  console.log("this are prflist = ",prflist)
 
  for (let i = 0; i < prflist.length; i++) 
  {
    const element = prflist[i];

if(olddept.indexOf(element) == -1)
{
  olddept.push(element)
  var ap1 =  "<option value='"+element+"'>"+element+"</option>"
$("#prfno").append(ap1)    
}
else{
  console.log("its being repeted...")

}

  }



} 

})

})

// getting the position

$('#prfno').change(function()
{

$("#pos").empty()   

var ap1 = "<option disabled selected style='color: white'>Select Position</option>"
$("#pos").append(ap1)    

$.ajax({
url:"http://localhost/hrms/api/poslist.php",
type:"POST",
data: {"dept": $('#deptchoice').val(),"prf":$('#prfno').val()},
success:function(para)
{
console.log("this are prflist = ",para)

var prflist = JSON.parse(para);
console.log("this are prflist = ",prflist)

for (let i = 0; i < prflist.length; i++) 
{
  const element = prflist[i];
var ap1 =  "<option value='"+element+"'>"+element+"</option>"
$("#pos").append(ap1)    

}

}




})

})





//checking PRF Number


$('#pos').change(function(){
$('#groupcreation').fadeIn(600);
$('#histbtn').fadeIn(600);


});


//submitting mails      


$('#submitmail').click(function(){
$('#newgroup').hide(600);
$('#creatinggrp').fadeIn(600)
// alert($('#email').val())
var arr = []
var arr2 = []
var j=0

arr[0]= $('#email').val()
for(let i =1;i<ctr;i++)
{
var x = '#email'+i
arr[i] = $(x).val()


arr= arr.filter(function(entry) { return entry.trim() != ""; });
}





  var data = {'emails':arr,'prf': $("#prfno").val(),'dept':$("#deptchoice").val(),'pos':$("#pos").val()}


console.log(data)
$.ajax({
url : 'http://localhost/hrms/api/sendmail.php',
type : 'POST',
data:(data),
success : function(para){
console.log(para)
if(para == 'sent')
{
$('#creatinggrp').hide()
$('#groupcreated').fadeIn(600)
}
else if(para=='notsent')
{
$('#creatinggrp').hide()
$('#groupnotcreated').fadeIn(600)
}
},

error : function(err){

}


});

});


});


//getting history

function gethistory()
{
localStorage.setItem("dept",$("#deptchoice").val());
localStorage.setItem("prf",$("#prfno").val());
localStorage.setItem("pos",$("#pos").val());

document.location.replace('history.php')
}

$('#logoutuser').click(function(){

$.ajax({
url:"http://localhost/hrms/api/logout.php",
type:"POST",
success:function(para){

if(para=="success")
{
$("#row").hide()
$("#logout").show()
document.location.replace("http://localhost/hrms/index.php")
}
else
{
$("#notlogout").show()
document.location.replace("http://localhost/hrms/")
}
} 

})

});


</script>

</body>
</html>









<?php
            }
            else
            {
                header("refresh:0;url=notfound.php");
            }
        }
        else
        {
            header("refresh:0;url=notfound.php");
        }
    }
    else
    {
        header("refresh:0;url=notfound.php");
    }  
?>
