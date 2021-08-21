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
    $name = $cursor['name'];
    
    if($designation == "inv")
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
  <script src="./public/js/logout.js"></script>


  <script src="./public/js/materialize.js"></script>
  <script src="./public/js/materialize.min.js"></script>

<style>
.datepicker-controls .select-month input {
    width: 100px;
}
@media screen and (min-width: 800px)
{
  #firsttb{
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
#firsttb{
width: 350%;
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
      <!-- <a class="modal-close waves-effect green btn" href="http://localhost/hrms/invdash.php" >OK<i class="material-icons left" >check_box</i></a> -->
      </center>
    </div>
  </div>
<!-- no data modal ends here -->
<div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000;overflow-y:hidden">

<h3 class="w3-bar-item white"> <center><a href="http://localhost/hrms/">Home</a>
<i id="remin" class="material-icons" style="float: right;cursor: pointer;">close</i></center>   
</a></h3> <br><br>
<a href="http://localhost/hrms/" class="w3-bar-item w3-button">To Do List <span class="new badge green" data-badge-caption="New Task(s)" id="badge_todo">4</span></a> <br>  
<a href="http://localhost/hrms/invhistory.php" class="w3-bar-item w3-button">See History  </a> <br>  
<a href="http://localhost/hrms/rejecedinvhistory.php" class="w3-bar-item w3-button">Rejected Interviews</a> <br>
<a href="#" id="logoutuser" class="w3-bar-item w3-button">Logout</a> <br>

</div>

<div id="remin">
<nav> 
    <div class="nav-wrapper blue darken-1">
      <a href="#!" class="brand-logo left" style="margin-left: 2%;"><i id="showsidenbutton" class="material-icons">menu</i>
    </a>
    <a href="http://localhost/hrms/" class="brand-logo center">thyssenkrupp Elevators</a>
    <ul style="float:right;">
          <li>
            <select id="logout"class="dropdown-trigger btn blue darken-1">
              <option value=""><?php echo($name) ?></option>
              <option value="profile">Profile</option>
              <option value="logout">Logout</option>
            </select>
          </li>
        </ul> 
    </div>
</nav>
<br><br>
<!-- nav and side menu ended -->

 <!-- Filter Added  End-->
 <select id='deptchoice' class="dropdown-trigger btn blue darken-1 " >
          <option value="" disabled selected style="color: white">Select Department</option>
        </select>
        <select id='zonechoice' class="dropdown-trigger btn blue darken-1 ">
          <option value="" disabled selected style="color: white">Select Zone</option>
 </select>
<!-- Filter Added End-->
<br><br>
<div style="color:white;width:18%;background-color:green;border-radius:2px;font-weight:bold;"> 
        Showing <p id="result" style="display:inline;"> </p> PRF of <p id="result1" style="display:inline;"> </p> PRF</div><br>

 <div class="row" id="firsttb">
<div class="col s12  blue lighten-4">
  <table class="striped">
    <thead>
      <tr>
          <th>PRF</th>
          
          <th>Position Details</th>
          <th>Zone</th>
          <th>Department</th>
          <th>No. of Positions</th>
          <th>Instance ID</th>
          <th>Round</th>
          <th>VIEW DETAILS</th>

      </tr>
      </thead>

    <tbody id='rawdata'>
      
    </tbody>
  </table>
</div> 
</div>

<div class="row" id="emailcollection">
  
  <div class="input-field col s4 offset-m4  blue-text" >
    <i class="material-icons prefix">email</i>
    <input id="email" onfocus="addText(this)" type="text" class="validate" placeholder="Enter Email">
  </div>
</div>

  
  <div class="input-field col s6 offset-s3 center">
    <button  class="btn waves-effect waves-light blue darken-1" id="submitmail" >Submit Mail
      <i class="material-icons right">send</i>
    </button>
  </div>



  <div class="row" >
      <center>
      <p style="color: green" id="creatinggrp">Creating Group...! </p>
      <p style="color: green" id="groupcreated">Group Created Successfully </p>
      <p style="color: red" id="groupnotcreated">Unable to create group </p>
      </center>
  </div>

  <div class="row">
      <div class="col s12 m12 ">
      <div class="">
      <div class="card-content blue-text">
      <br><br>
  
      <div class="card  col m12 s12">
      <div class="col m2">
      </div>
      </div>
  
                  <div class="row" id="allocatingcandidate" >
                    <div class="col s12 m12">
                      <div class="card  white">
                        <div class="card-content blue-text">
                          <p id='rid'><b></b></p>
                          <div class="row" id="allocation" >
                            <div class="col s12 m12" style="border: solid 5p">
                              <div class="card white">
                                <div class="card-content blue-text">
                                  <div class="row">
                                
                                  <div class="input-field col s3 m3 " >
                                      <input id="iname" type="text" class="text">
                                      <label class="active" for="iname" id="iname" required>Interviewer Name</label>
                                    </div>  

                                    <div class="input-field col s3 m3 white-text" >
                                      <input id="imail" type="text" >
                                      <label class="active" for="iname" required>Interwiever Mail ID</label>
                                    </div>

                                    <div class="input-field col s3 m3 white-text" >
                                      <input id="iloc" type="text" >
                                      <label class="active" for="iloc" required>Interview Location</label>
                                    </div>

                                    <div class="input-field col s3 m3 white-text" >
                                      <input id="iperson" type="text" >
                                      <label class="active" for="iperson" required>Contact Person</label>
                                    </div>        
                                  </div>
                                    
                                    <div class="row">
                                        <div class="input-field col s3 m3">
                                          <input id="idate" type="text" class="datepicker" required>
                                          <label  for="idate">Date</label>
                                        </div>
                                        <div class="input-field col s3 m3 " >
                                          <input id="itime" type="text" class="timepicker" required>
                                          <label class="active" for="itime">Time</label>
                                        </div>
                                        <div class="input-field col s3 m3 " >
                                          <input id="idept" type="text" class="text">
                                          <label class="active" for="idept" id="idept" required>Interviewer Department</label>
                                        </div>                                    
                                        <div class="input-field col s3 m3 " >
                                          <input id="idesg" type="text" class="text">
                                          <label class="active" for="idesg" id="idesg" required>Interviewer Designation</label>
                                        </div>
                                    </div>          
                                  

                                  <div class="row">
                                    <button class="btn waves-effect blue darken-1 col m3 s3 offset-m4" type="submit" id='allocatesubmit'>Submit
                                    <i class="material-icons right">send</i>
                                    </button>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                          </div>
  
      <div id="mytabs" >
      <table class="responsive-table">
      <tr id="prfdata">
      </tr>
      </table>
      <br><br><br>
      <ul class="tabs" >
      <li id="select"  class="tab col s2">  <a> <b style="color: green;cursor: pointer;" >Selected</b></a></li>
      <li id="reject" class="tab col s2"><a ><b style="color: red;cursor: pointer;" >Rejected</b></a></li>
      <li id="hld" class="tab col s2"><a ><b style="color: orangered;cursor: pointer;" >Hold</b></a></li>  
      </ul>
  
      <div class="row" id="selected">
      <div class="col s12 ">
      <div class="card white">
      <div class="card-content ">
  
      <table class="striped">
        <thead >
          <tr>
              <th>Full Name</th>
              <th>Email ID</th>
              <th>View Evaluation Sheet</th>
              <th>View CV</th>
              
          </tr>
        </thead>
  
        <tbody id="tabledataselect">
          
        </tbody>
      </table>
      </div>
      </div>
      </div>
  
      </div>
  
      </div>
      <div class="row" id="rejected">
      <div class="col s12 ">
      <div class="card white">
      <div class="card-content ">
  
      <table class="striped">
        <thead>
          <tr>
              <th>Full Name</th>
              <th>Email ID</th>
              <th>View Evaluation Sheet</th>
              <th>View CV</th>
              
          </tr>
        </thead>
  
        <tbody id="tabledatareject">
          
        </tbody>
      </table>
      </div>
      </div>
      </div>
  
      </div>
  
  
      <div class="row" id="hold">
      <div class="col s12 ">
      <div class="card white">
      <div class="card-content">
  
      <table class="striped">
      <thead>
      <tr>
      <th>Full Name</th>
      <th>Email ID</th>
      <th>View Evaluation Sheet</th>
      <th>View CV</th>
     
      </tr>
      </thead>
  
      <tbody id="tabledatahold">  
         
      </tbody>
      </table>
      </div>
      </div>
      </div>
  
      </div>
  
  
  
  
      </div>
      </div>
      </div>
</body>
<style>
  html{
    scroll-behaviour:smooth;
  }
</style>
  <style>
    .tabs .indicator {
            background-color:#1e88e5;
            height: 7px;
        } /*Color of underline*/
      
  </style>
    <script src="public/js/common.js"></script>

<script>
var roundid;
var selectedmail = []
$('#submithold').click(function(){
  if(selectedmail.length <= 0)
    {
      alert("Please Select Atleast 1 Member")
    }
    else
    {
      for(let i=0;i<selectedmail.length;i++)
      {
        $('#allocation').fadeIn();

        console.log(selectedmail[i])
      }
    }                      

})


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


        $('#rejected').hide()
      $('#hold').hide()
      // $('#mytabs').hide()

    $('.tabs').tabs();
   $('#roundchoice').hide();    

$('#emailcollection').hide();
$('#submitmail').hide();
$('#groupcreated').hide()
$('#groupnotcreated').hide()
$('#creatinggrp').hide()

$('#select').click(function(){
        $('#rejected').hide()
        $('#hold').hide()

      $('#selected').show()
  
    })



    
    $('#reject').click(function(){
        
      $('#hold').hide()

      $('#selected').hide()
      $('#rejected').show()
  
    })
    


    
    $('#hld').click(function(){
        $('#rejected').hide()
     

      $('#selected').hide()
      $('#hold').show()
  
    })
var id;
var flag0 = 0

function xyz(x)
{
  $('#prfdata').empty()


  roundid = x.split("*");
  
      console.log(roundid)

      $('#tabledataselect').empty()
      $('#tabledatareject').empty()
      $('#tabledatahold').empty()


      $.ajax({

              url : 'http://localhost/hrms/api/getdetailsinvhistory.php',
              type : 'POST',
              data : {
                'prf':roundid[0],
                'pos':roundid[1],
                'iid':roundid[2],
                'rid':roundid[3]
                  },

              success:function(para)
              {
                
                $("#select").click()
               console.log( "hii : ",JSON.parse(para))
              if(para != "no data")
              {
                parseddata = JSON.parse(para)
                var prfdata = parseddata.prfdata
                console.log(prfdata)
                var str_prf = "<td><b style='color:green;'>PRF</b> : "+prfdata[0]+"</td>"+"<td><b style='color:green;'>Position</b> : "+prfdata[1]+"</td>"+"<td><b style='color:green;'>Zone</b> : "+prfdata[2]+"</td>"+"<td><b style='color:green;'>Department</b> : "+prfdata[3]+"</td>"+"<td><b style='color:green;'>No. of Positions</b> : "+prfdata[4]+"</td><td><b style='color:green;'>Round</b> : "+prfdata[5]
                $('#prfdata').append(str_prf)
                var element = parseddata.selected
                if(element != null)
                {
                  for (let i = 0; i < element.length; i++) 
                  {
                    var str = "<tr><td><p>"+element[i][1]+"</p></td><td>"+element[i][0]+"</td><td> <a class='waves-effect waves-light btn' href='http://localhost/hrms/documentcheck.php?aid="+element[i][0]+"&prf="+roundid[0]+"&iid="+roundid[2]+"&rid="+roundid[3]+"&s=1' target='_blank'>Evaluation Sheet</a></td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+element[i][0]+"' target='_blank'>View CV</a></td></tr>"
                    
                    $('#tabledataselect').append(str)
                      
                  } 
                }
                var element = parseddata.rejected
                if(element != null)
                {
                  console.log(element)
                  for (let i = 0; i < element.length; i++) 
                  {
                    if(element[i][0][1] == "Aborted")
                    {
                      var str = "<tr><td><p>"+element[i][1]+"</p></td><td>"+element[i][0][0]+"</td><td>Aborted</td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+element[i][0]+"' target='_blank'>View CV</a></td></tr>"
                      $('#tabledatareject').append(str)
                    }
                    else
                    {
                      var str = "<tr><td><p>"+element[i][1]+"</p></td><td>"+element[i][0]+"</td><td> <a class='waves-effect waves-light btn' href='http://localhost/hrms/documentcheck.php?aid="+element[i][0]+"&prf="+roundid[0]+"&iid="+roundid[2]+"&rid="+roundid[3]+"&s=1' target='_blank'>Evaluation Sheet</a></td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+element[i][0]+"' target='_blank'>View CV</a></td></tr>"
                    
                    $('#tabledatareject').append(str)
                    }
                    
                      
                  }
                } 
                if(parseddata.onhold != null)
                {
                  var element = parseddata.onhold
                console.log("element: ",element)
                elemail = element[0][0].split(",")
                // var arr=[["Tanmay Kulkarni","tvkulkarni@mitaoe.ac.in"]]
                for (let i = 0; i < element.length; i++) 
                {
                  mailidonly = element[i][0].split(",")
                  if(mailidonly[1] == "absent")
                  {
                    var str = "<tr><td><p>"+element[i][1]+"</p></td><td><p id='"+i+"mail'>"+mailidonly[0]+"</p></td><td><p>Absent</p>&nbsp;&nbsp;</td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+mailidonly[0]+"' target='_blank'>View CV</a></td></tr>"
                  $('#tabledatahold').append(str)
                  }
                  else
                  {
                    var str = "<tr><td><p>"+element[i][1]+"</p></td><td><p id='"+i+"mail'>"+mailidonly[0]+"</p></td><td> <a class='waves-effect waves-light btn' href='http://localhost/hrms/documentcheck.php?aid="+mailidonly[0]+"&prf="+roundid[0]+"&iid="+roundid[2]+"&rid="+roundid[3]+"&s=1' target='_blank'>Evaluation Sheet</a>&nbsp;&nbsp;</td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+mailidonly[0]+"' target='_blank'>View CV</a></td></tr>"
                  $('#tabledatahold').append(str)
                  }
                  
                    
                } 
                }
                

              }

                
                
                $('#mytabs').fadeIn(900); 
                $('#select').click()
                flag0 = 1
              },
              error:function(err)
              {

              }
              });
  }
  var ctr = 0
function addText(x)
{
ctr = ctr+1
var str = 'email'+ctr
var txt="<div class='row'><div class='input-field col s4 offset-m4  blue-text' ><i class='material-icons prefix'>email</i>  <input id='"+str+"' onfocus='addText(this)' type='text' class='validate' placeholder='Enter Email'></div></div>"
$("#emailcollection").append(txt);
}
var arr=[]
$(document).ready(function(){
  $('.modal').modal();
$('#zonechoice').hide();

  $('#allocation').hide();
  $('.datepicker').datepicker
  ({
      minDate:new Date(),
  })
  $('.timepicker').timepicker();

  $('.filled-in').on('change', function() {
		    $('.filled-in').not(this).prop('checked', false);  

	}); 

//Gives unique values from set
function removeusingSet(arr) { 
            let outputArray = Array.from(new Set(arr)) 
            return outputArray 
        } 

//Added by Sarang - 03/14/2020
var dept=[]
$.ajax({

  url:"http://localhost/hrms/api/getdepartments.php",
  type:"POST",
  success:function(arr)
  {
    arr = JSON.parse(arr)
       dept[0]="All"
      for(let i =1 ;i<arr.length;i++)
      {
        dept[i] = arr[i-1]
      }
      uniquedept = removeusingSet(dept);
      console.log(uniquedept)

      for(i=0;i<uniquedept.length;i++)
      {
        var str = '<option value="'+uniquedept[i]+'"  style="color: white">'+uniquedept[i]+'</option>'
         $('#deptchoice').append(str);
      }
  }

})


//get filtered department
$('#deptchoice').change(function(){
  
$('#rawdata').empty();
//Sarang Yesterday  13/03/2020
$.ajax({
url:"http://localhost/hrms/api/invhisfiltereddept.php",
type:"POST",
data: {"dept": $('#deptchoice').val()},
success:function(arr)
{ 
  console.log(arr)
  if(arr == 'No Data')
  {
    $('#nodata').fadeIn(300);
    $("#nodatamodal").modal("open");
    document.getElementById("result").innerHTML = 0;
    document.getElementById("result1").innerHTML = 0;

  }
  else
  {
    
    // console.log("This is my data : "+arr)
    $('#nodata').hide();
    
    arr=JSON.parse(arr);
    console.log("this are prflist = ",arr)

    document.getElementById("result").innerHTML = arr.length;
    document.getElementById("result1").innerHTML = arr.length;

    for(let j=0;j<arr.length;j++)
    {
      var x='<tr id="rows"><td id="prf" value="'+arr[j][0]+'">'+arr[j][0]+'</td><td id="position">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="iid">'+arr[j][6]+'</td><td id="status">'+arr[j][5]+'</td><td width="25%"><a id="'+arr[j][0]+"*"+arr[j][4]+"*"+arr[j][5]+"*"+arr[j][6]+'" class="btn small green darken-1" onclick="xyz(this.id)">View Details</a></td></tr>'
      $('#rawdata').append(x);
    }
    $('#zonechoice').fadeIn(300);

   //Added by Sarang - 03/14/2020
    //---------------------------------Sarang -------------get unique zones
      $.ajax({
          url:'http://localhost/hrms/api/getzones.php',
          type:'POST',
          // data:{'arr1':arr1},
          success : function(para)
          {
             zone=[]
            para = JSON.parse(para)

            zone[0] = "All"
            for(let i =0 ;i<para.length;i++)
            {
              zone[i] = para[i]
            }
            $("#zonechoice").empty();
            $("#zonechoice").empty();
            $("#zonechoice").append('<option value="" disabled selected style="color: white">Select Zone</option>')
            uniquezone = removeusingSet(zone);

            for(i=0;i<uniquezone.length;i++)
            {
              var str = '<option value="'+uniquezone[i]+'"  style="color: white">'+uniquezone[i]+'</option>'
              $('#zonechoice').append(str);
            }
          },
        })

    //end unique zones 




  }


}

})

})


//-------------------------------------------Get Filtered Zones -------------------------------------------------

//get filtered department
$('#zonechoice').change(function(){
  
  $('#rawdata').empty();
  //Sarang Yesterday  13/03/2020
  $.ajax({
  url:"http://localhost/hrms/api/invhisfilteredzone.php",
  type:"POST",
  data: {
    "dept": $('#deptchoice').val(),
    "zone": $('#zonechoice').val()
    },
  success:function(arr)
  { 
    if(arr == 'No Data')
    {
      $('#nodata').fadeIn(300);
      $("#nodatamodal").modal("open");
      document.getElementById("result").innerHTML = 0;
      document.getElementById("result1").innerHTML = 0;

    }
    else
    {
     

      $('#nodata').hide();
      console.log("This is my data : "+arr)
      arr=JSON.parse(arr);
      console.log("ARr length - "+arr)
      document.getElementById("result").innerHTML = arr.length;
      document.getElementById("result1").innerHTML = arr.length;
      console.log("this are prflist = ",arr)
  
      for(let j=0;j<arr.length;j++)
      {
        var x='<tr id="rows"><td id="prf" value="'+arr[j][0]+'">'+arr[j][0]+'</td><td id="position">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="iid">'+arr[j][6]+'</td><td id="status">'+arr[j][5]+'</td><td width="25%"><a id="'+arr[j][0]+"*"+arr[j][4]+"*"+arr[j][5]+"*"+arr[j][6]+'" class="btn small green darken-1" onclick="xyz(this.id)">View Details</a></td></tr>'
        $('#rawdata').append(x);
      }
      $('#zonechoice').fadeIn(300);
    }
  
  
  }
  
  })
  
  })

//----------------------------------------------END---------------------------------------------------------------






 $("#mytabs").hide()
 $.ajax({
    url:'http://localhost/hrms/api/getprfsinvhistory.php',
    type:'POST',
    // data:{'arr1':arr1},
    success : function(para)
    {
      console.log(para);
      if(para == "No Data")
      {
        $("#nodatamodal").modal("open");
        document.getElementById("result").innerHTML =0;
        document.getElementById("result1").innerHTML = 0;

      }
      else
      {
        // console.log(para+"<br>")
        para=JSON.parse(para)
        // window.data=para
        // para=['1001','Developer','North','Sales','5','ongoing']
        console.log("This is the data came from backend = ",para)
        console.log("this is length : "+para.length)
        for(let i=0;i<para.length;i++)
        {
          arr[i]=para[i];
        }
      
          document.getElementById("result").innerHTML = para.length;
          document.getElementById("result1").innerHTML = para.length;

        for(let j=0;j<arr.length;j++)
        {
          var x='<tr id="rows"><td id="prf" value="'+arr[j][0]+'">'+arr[j][0]+'</td><td id="position">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="iid">'+arr[j][5]+'</td><td id="status">'+arr[j][6]+'</td><td width="25%"><a id="'+arr[j][0]+"*"+arr[j][4]+"*"+arr[j][5]+"*"+arr[j][6]+'" class="btn small green darken-1" onclick="xyz(this.id)">View Details</a></td></tr>'
        $('#rawdata').append(x);
        }
      }

     
    },
  })
})

$('#allocatesubmit').click(function()
{
  $("#waiting").fadeIn(600);
  var groupid=window.groupid
  var iname = $('#iname').val();
  var idate = $('#idate').val();
  var itime = $('#itime').val();
  var idept = $('#idept').val();
  var idesg = $('#idesg').val();
  var imail = $('#imail').val();
  var iloc = $('#iloc').val();
  var iperson = $('#iperson').val();

  $('#allocation').hide(600);


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