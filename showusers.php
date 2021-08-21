<?php
//error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'api/db.php';
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  { global $designation;
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg'];
    
    if($designation == "ceo")
    {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link rel="stylesheet" type="text/css" media="screen" href="./public/css/materialize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="./public/css/materialize.min.css">
        
        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">

  <script src="./public/jquery-3.2.1.min.js"></script>
  
  <script src="./public/js/materialize.js"></script>
  <script src="./public/js/materialize.min.js"></script>
  <style>
#loader {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.96)  url(loader2.gif)  no-repeat center center !important;
  z-index: 10000;
}
#loader > #txt{
        font-size:23px;
        margin-left:23% !important;
        margin-top:18% !important; 
} 

@media screen and (min-width: 800px)
{
  #megblock, #selectedrow{
width: 100%;
}
#deptchoice{
  width: 19%;
} 

#zonechoice{
  width: 19%;
}



}

@media screen and (max-width: 800px)
{
#megblock, #selectedrow{
width: 350%;
}


#fileformatmodal
{
  margin-top:5%;
}

#deptchoice{
  width: 70%;
} 

#zonechoice{
  width: 70%;
}
}
</style>

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

<!-- No data modal starts here -->
  <!-- Modal Structure -->
  <div id="nodatamodal" class="modal">
    <div class="modal-content">
      <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
      <br>
      
      <center><h2>No Data Available</h2></center>
      
    </div>
    <div class="modal-footer">
      <center>
      <a class="modal-close waves-effect green btn" href="http://localhost/hrms/ceodash.php" >OK<i class="material-icons left" >check_box</i></a>
      </center>
    </div>
  </div>

  <div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000;overflow-y:hidden">
<!--    
<h3 class="w3-bar-item white"> <center><a href="http://localhost/hrms/">Home</a>
<i id="remin" class="material-icons" style="float: right;cursor: pointer;">close</i></center>   
</a></h3> <br><br>-->
</div>

<div id="remin">
<nav> 
  <div class="nav-wrapper blue darken-1">
  <a href="http://localhost/hrms/">
      <button class="btn waves-effect blue darken-1" style="float:left;margin-top: 18px;margin-right: 18px "> <- BACK</button>
      </a> 
  <a href="http://localhost/hrms/" class="brand-logo center">thyssenkrupp Elevators</a>
  </div>
</nav>
<br><br>
<!-- nav and side menu ended -->

 <div class="row" id="megblock">

<div class="col s12  blue lighten-4" >
  <table class="striped">
    <thead>
      <tr>
          <th>User Id</th>
          <th>Password</th>
          <th>Name</th>
          <th>Mail</th>
          <th>Department</th>
          <th>Designation</th>
          <th>Region</th>
          <th>Update</th>
          <th>Delete</th>
          <!-- <th>Withdraw</th> -->
      </tr>
    </thead>

    <tbody id='rawdata'>
      
    </tbody>
  </table>
</div> 
</div>

<div class="row" id="userupdate">
  <div class="col s12 m12" style="border: solid 5p">
        <div class="card white">
        <div class="card-content blue-text">
        <div class="row">
        <div class="input-field col s4 m4 " >
       <strong> Name:<input id="uname" type="text" class="text" required>
       </strong> </div>           
        <div class="input-field col s4 m4" >
        <strong>  Mail:<input id="umail" type="text" required readonly>
        </strong>   </div> 
        <div class="input-field col s4 m4 " >
        <strong>  User Id:<input id="urole" type="text" class="text" required>
        </strong>  </div>
        </div>
        <div class="row">
        <div class="input-field col s4 m4 " >
        <strong> Region:<input id="uregion" type="text" class="text" required>
        </strong>  </div>
             
       
      <div class="input-field col s4 m4 " >
      <strong>Department: <input id="udept" type="text" class="text" required>
      </strong>    </div>                                    
      <div class="input-field col s4 m4 " >
      <strong>  Designation: <input id="udsg" type="text" class="text" required>
      </strong>   </div>
    </div>   
    <div class="row">
    
    <div class="input-field col s4 m4 " >
      <strong>Update Password: <input id="upass" type="text" class="text" required>
      </strong>    </div> 

    </div>       

                                
          <div class="row">
          <button class="btn waves-effect blue darken-1 col m3 s3 offset-m4" id='allocatesubmit' onclick="subupdate()">Update
          <i class="material-icons right">send</i>
          </button>
                                            
    </div>
   </div>
    </div>
    </div>
  </div>

<br>
          
<script>

// function for opening dialouge box
function openmodal(cid)
{
  $("#appending_id").empty()
  $("#appending_id").append("<b id='bid' name='"+cid+"'></b>")
  $("#modal2").modal("open")
}




$('#kindlybtn').hide();
$('#selectedrow').hide();


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

var id;

function xyz(x)
{

  $('#kindlybtn').show();
  $('#selectedrow').show();
  $("#ordiv").show();
  $(document.getElementById(x)).attr("disabled","disabled")
  j=x
  // alert(j)
  var res = j.split("*");
  id='#'+res[0];
  // alert("Here - "+res[0])
  window.prf = res[0]
  window.position = res[1]
  window.zone = res[2]
  window.dept = res[3]
  window.pos =res[4]
  window.status = res[5]
 
  console.log("position  - ",window.position );

 
  // <td id="oniid">one</td>
  //   <td id="onpos">one</td>
  //   <td id="onzone">one</td>
  //   <td id="ondept">one</td>
  //   <td id="onnpos">one</td>
  //   <td id="onsts">one</td>

    $("#oniid").html(res[0])
    $("#onpos").html(res[1])
    $("#onzone").html(res[2])
    $("#ondept").html(res[3])
    $("#onnpos").html(res[4])
    $("#onsts").html(res[5])

  // data = {'prf':prf,'dept':dept,'pos':pos,'zone':zone,'posno':posno,'status':status}
  // alert(window.prf)
  $('#dumpdiv').fadeIn();
  $('#submitmaildump').fadeIn();
  $('#emailcollection').fadeIn();
  $('#submitmail').fadeIn();
  $(document).scrollTop($(document).height());
  positionapp = encodeURIComponent(window.position.trim())
  // document.getElementById('forms').action = 'uploademails.php?prf='+window.prf+'&'+'position='+window.position+'&'+'pos='+window.pos+"&"+'dept='+window.dept;

  }
</script>



  
</body>
<style>
  html{
    scroll-behaviour:smooth;
  }
  input[type="file"]{
    display:none;
  }
</style>
<script src="public/js/common.js"></script>

<script>

function mymodalopen()
{
  
  $("#modal3").modal('open');
}

function deleteUser(){

  var id=event.toElement.id
  var name=event.toElement.name

  
$.ajax({
url:"http://localhost/hrms/api/users.php",
type:"POST",
data:{

  "action":2,
  "mail":id,
  "username":name
},
success:function(para){

  console.log(para.status)
  if(para.status=="true"){
  //  console.log('inside me')
    location.reload().delay(5000);
  }
  

} 

})


}

function updateUser(){

  //console.log("update click"+event.toElement.name);
  
  var id=event.toElement.id
  var myarr=id.split("-")
  console.log(myarr)
 // console.log(id)

 document.getElementById("userupdate").style.display="block";

 document.getElementById("uname").value=myarr[2];
 
 document.getElementById("umail").value=myarr[3];
 document.getElementById("urole").value=myarr[0];
 document.getElementById("uregion").value=myarr[6];
 document.getElementById("udept").value=myarr[4];
 document.getElementById("udsg").value=myarr[5];
 document.getElementById("upass").value=myarr[1];
 
 if(myarr[4]=="ceo"){
    document.getElementById("udsg").readOnly=true;
  }
 //document.getElementById("userupdate").visibility;


 }

 function subupdate(){
   
var name=document.getElementById("uname").value;
 
 var mail2=document.getElementById("umail").value;
 var uid=document.getElementById("urole").value;
  var region=document.getElementById("uregion").value;
  var dept=document.getElementById("udept").value;
  var dsg=document.getElementById("udsg").value;
  var pass=document.getElementById("upass").value;
  
  
  
 console.log(typeof(mail2))
   
 $.ajax({
 url:"http://localhost/hrms/api/users.php",
 type:"POST",
 data:{
 
   "action":3,
   "username":name,
   "uid":uid,
   "region":region,
   "dsg":dsg,
   "dept":dept,
   "mail":mail2,
   "pass":pass
 },
 success:function(para){
 
   console.log(para.status+" "+para.message)
   if(para.status==true){
  //  console.log('inside me')
    location.reload().delay(5000);
  }
   
   
 
 } 
 
 })
 
 
 }


 
var arr=[]
var dept=[]
$(document).ready(function(){

  $('#userupdate').hide();
  

  



 
 $.ajax({


    url:'http://localhost/hrms/api/getallusers.php',
    type:'POST',
    // data:{'arr1':arr1},
    success : function(para)
    {

      console.log(para)
      if(para == "No Data")
      {
        $("#nodatamodal").modal("open");
      }
      else
      {
        console.log(para)
        //para=JSON.parse(para)
        // window.data=para
        // para=['1001','Developer','North','Sales','5','ongoing']
        console.log("this is length : "+para.users.length)
        para=para.users
        for(let i=0;i<=para.length;i++)
        {
          arr[i]=para[i];
          
        }
       
        for(let j=0;j<arr.length-1;j++)
        {
            var usid=arr[j].email+"-"+arr[j].email;
            console.log(usid)
           var x='<tr id="rows" style=""><td id="uid" value="'+arr[j].uid+' id="'+arr[j].name+'>'+arr[j].uid+'</b></td><td id="password">'+arr[j].password+'</b></td><td id="name">'+arr[j].name+'</td><td id="zone">'+arr[j].mail+'</td><td id="dept">'+arr[j].dept+'</td><td id="posno">'+arr[j].dsg+'</td><td id="status">'+arr[j].rg+'</td>'
            if((arr[j].dsg=='ceo')){
            var btns='<td><button id="'+(arr[j].uid+"-"+arr[j].password+"-"+arr[j].name+"-"+arr[j].mail+"-"+arr[j].dept+"-"+arr[j].dsg+"-"+arr[j].rg)+'"   class="btn green darken-1" onclick="updateUser()">Update</button></td>'+'<td ><button id="'+arr[j].mail+'" name="'+arr[j].name+'"  class="btn red darken-1" onclick="deleteUser()" disabled>DELETE</button></td></tr>'
            }
            else{
              var btns='<td><button id="'+(arr[j].uid+"-"+arr[j].password+"-"+arr[j].name+"-"+arr[j].mail+"-"+arr[j].dept+"-"+arr[j].dsg+"-"+arr[j].rg)+'"  class="btn green darken-1" onclick="updateUser()">Update</button></td>'+'<td ><button id="'+arr[j].mail+'" name="'+arr[j].name+'"  class="btn red darken-1" onclick="deleteUser()">DELETE</button></td></tr>'
            
            }
           // var x="hi"
        $('#rawdata').append(x+btns);
        }
      }    
    },error:function(para){
      console.log("error"+para.users)
    },
  })

})





</script>
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