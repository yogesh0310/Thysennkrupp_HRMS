<?php
//error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'api/db.php';
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg'];
    $name = $cursor['name'];
    
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

  <link rel="stylesheet" type="text/css" media="screen" href="./public/css/materialize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="./public/css/materialize.min.css">

        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">

  <script src="./public/jquery-3.2.1.min.js"></script>
  
  <script src="./public/js/materialize.js"></script>
  <script src="./public/js/materialize.min.js"></script>
  <script src="./public/js/logout.js"></script>


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
          font-size:25;
          margin-left:35% !important;
          margin-top:18% !important; 
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
      <a class="modal-close waves-effect green btn" href="http://localhost/hrms/hrdash.php" >OK<i class="material-icons left" >check_box</i></a>
      </center>
    </div>
  </div>
<!-- no data modal ends here -->
<div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000;overflow-y:hidden">

  <h3 class="w3-bar-item white"> <center><a href="http://localhost/hrms/">Home</a>
  <i id="remin" class="material-icons" style="float: right;cursor: pointer;">close</i></center>   
  </a></h3> <br><br>

  <a href="http://localhost/hrms/csvupload.php" class="w3-bar-item w3-button">Create new Department and PRF</a> <br>
  <a href="http://localhost/hrms/hrnew.php" class="w3-bar-item w3-button">Create New Instance</a> <br>
  <a href="http://localhost/hrms/initiateround.php" class="w3-bar-item w3-button">Initiate rounds for instances</a> <br>
  <a href="http://localhost/hrms/allocateround.php" class="w3-bar-item w3-button"> <span class="new badge green" data-badge-caption="New Round(s)" id="badge_ongoing">4</span>On going rounds</a> <br>
  <a href="http://localhost/hrms/history.php" class="w3-bar-item w3-button">See History</a> <br>
  <a href="http://localhost/hrms/allocateround2.php" class="w3-bar-item w3-button">Rescheduling<span class="new badge green" data-badge-caption="Request(s)" id="badge_rescheduling">4</span></a> <br>
  <a href="http://localhost/hrms/interview.php" class="w3-bar-item w3-button">Update Interviews</a> <br>
  <a href="http://localhost/hrms/offerletter.php" class="w3-bar-item w3-button">Offer Letter<span class="new badge green" data-badge-caption="Request(s)" id="badge_letter">4</span></a> <br>
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
<div class="col s12 blue lighten-4">
  <table class="striped">
    <thead>
      <tr>
          <th>PRF</th>
          
          <th>Position Details</th>
          <th>Zone</th>
          <th>Department</th>
          <th>No. of Positions</th>
          <th>Instance ID</th>
          <th>Status</th>
          <th>Completion Date</th>
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
      <li id="exp_eval"  class="tab col s2"> <button class="btn btn-primary" onclick="location.href='excel/final_excel_evaluationForm.php'">Export Evaluations</button></li>
      <li id="exp_app"  class="tab col s2"> <button class="btn btn-primary" onclick="location.href='excel/final_excel_applicationBlank.php'">Export Applications </button></li>
      <li id="exp"  class="tab col s2"> <button class="btn btn-primary" onclick="location.href='excel/final_selected_rejected_onhold.php'">Export </button></li>  
      
      
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
              <th>Progress</th>
              <th>View Evaluation Sheet</th>
              <th>View CV</th>
              <th>Print Evaluation Sheet</th>
              <th>Print Application</th>
              
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
              <th>Remark</th>
              <th>View Evaluation Sheet</th>
              <th>View CV</th>
              <th>Print Evaluation Sheet</th>
              <th>Print Application</th>
           
              
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
      <th>Email ID</th>
      <th>Full Name</th>
      <th>Remark</th>
      <th>View Evaluation Sheet</th>
      <th>View CV</th>
      <th>Date</th>
      <th>Time</th>
      <th>Select</th>
     
      </tr>
      </thead>
  
      <tbody id="tabledatahold">  
         
      </tbody>
      <a class="green btn right" id="submithold">Assign Interviewer</a> 
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

<div id="loader">
  <div id="txt">
    <b>Please wait.. while we schedule this interview</b>
  </div>
</div>



    <script src="public/js/common.js"></script>

<script>
var mydate = new Date();
var roundid;
var selectedmail = []
var selectedmailID = []
var selecteddate = []
var selecteddate2 = []
$('#submithold').click(function(){

    for(let i = 0;i<selectedmailID.length;i++)
    {
      // console.log("id - "+$(selectedmailID[i]+"date").val())
      if($(selectedmailID[i]+"date").val()!="" || $(selectedmailID[i]+"date2").val()!="" )
      {
        flag =0;
        // alert("Data  present");
      }
      else
      {
        // alert("Data not present");
        flag =1;
        break;
      }
    }

    if(selectedmail.length <= 0)
    {
      alert("Please Select Atleast 1 Member")
    }
    else if(flag==1)
    {
      alert("Please Select date or time")
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
  

      console.log("RID"+roundid)

      $('#tabledataselect').empty()

      $.ajax({

              url : 'http://localhost/hrms/api/getprfs2.php',
              type : 'POST',
              data : {
                'prf':roundid[0],
                'pos':roundid[1], 
                'iid':roundid[2],
                'rid':roundid[3]
                  },

              success:function(para)
              {
                
                console.log("para : ",para)
                
                
                $("#select").click()
              //  console.log( JSON.parse(para))
              if(para != "no data")
              {
                parseddata = JSON.parse(para)

                var prfdata = parseddata.prfdata
                var str_prf = "<td><b style='color:green;'>PRF</b> : "+prfdata[0]+"</td>"+"<td><b style='color:green;'>Position</b> : "+prfdata[1]+"</td>"+"<td><b style='color:green;'>Zone</b> : "+prfdata[2]+"</td>"+"<td><b style='color:green;'>Department</b> : "+prfdata[3]+"</td>"+"<td><b style='color:green;'>No. of Positions</b> : "+prfdata[4]+"</td><td><b style='color:green;'>Round</b> : "
                
                var rounds_dropdown = " <select class='dropdown-trigger btn blue darken-1' id='round_selected'>"
                for(let i=prfdata[5];i>=0;i--)
                {
                  rounds_dropdown += "<option value="+i+">"+i+"</option>"
                }
                var endtag = "</select></td>"
                $('#prfdata').append(str_prf+rounds_dropdown+endtag)
                
                
                var element = parseddata.selected
                for (let i = 0; i < element.length; i++) 
                {
                  var round_evaluation = $('#round_selected').val()
                  var str = "<tr><td><p>"+element[i][1]+"</p></td><td>"+element[i][0]+"</td><td>"+element[i][2]+"</td><td> <a class='waves-effect waves-light btn' href='http://localhost/hrms/documentcheck.php?aid="+element[i][0]+"&prf="+prfdata[0]+"&iid="+roundid[2]+"&rid="+round_evaluation+"' target='_blank'>Evaluation Sheet</a></td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+element[i][0]+"' target='_blank'>View CV</a></td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/printevaluation.php?aid="+element[i][0]+"&prf="+prfdata[0]+"&iid="+roundid[2]+"&rid="+round_evaluation+"' target='_blank'>Print Evaluation</a></td><td><a  class='waves-effect waves-light btn' href='http://localhost/hrms/applicationblank_print.php?aid="+element[i][0]+"' target='_blank'>Print Application</a></td</tr>"
                  
                  $('#tabledataselect').append(str)
                    
                } 
                var element = parseddata.rejected
                console.log(element)
                for (let i = 0; i < element.length; i++) 
                {
                  if(element[i][0][1] == "Aborted")
                  {
                    var round_evaluation = $('#round_selected').val()
                    var str = "<tr><td><p>"+element[i][1]+"</p></td><td>"+element[i][0][0]+"</td><td><p>"+element[i][2]+"</p></td><td>Aborted</td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+element[i][0]+"' target='_blank'>View CV</a></td></tr>"
                    $('#tabledatareject').append(str)
                  }
                  else
                  {
                    var round_evaluation = $('#round_selected').val()
                    var str = "<tr><td><p>"+element[i][1]+"</p></td><td>"+element[i][0]+"</td><td><p>"+element[i][2]+"</p></td><td> <a class='waves-effect waves-light btn' href='http://localhost/hrms/documentcheck.php?aid="+element[i][0]+"&prf="+prfdata[0]+"&iid="+roundid[2]+"&rid="+round_evaluation+"' target='_blank'>Evaluation Sheet</a></td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+element[i][0]+"' target='_blank'>View CV</a></td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/pdf/evaluationfinal.php?aid="+element[i][0]+"&prf="+prfdata[0]+"&iid="+roundid[2]+"&rid="+round_evaluation+"' target='_blank'>Print Evaluation</a></td><td><a  class='waves-effect waves-light btn' href='http://localhost/hrms/pdf/applicationfinal.php?aid="+element[i][0]+"' target='_blank'>Print Application</a></td</tr>"
                  
                  $('#tabledatareject').append(str)
                  }
                  
                    
                } 
                if(parseddata.onhold != "")
                {
                  var element = parseddata.onhold
                console.log("element: ",element)
                elemail = element[0][0].split(",")
                console.log("element: ",element[0][2])
                // var arr=[["Tanmay Kulkarni","tvkulkarni@mitaoe.ac.in"]]
                for (let i = 0; i < element.length; i++) 
                {
                  mailidonly = element[i][0].split(",")
                  if(mailidonly[1] == "absent")
                  {
                    if(element[i][2] == 1)
                    {
                      var str = "<tr><td><p id='"+i+"mail'>"+mailidonly[0]+"</p></td><td><p>"+element[i][1]+"</p></td><td><p>"+element[i][3]+"</p></td><td><p>Absent</p>&nbsp;&nbsp;</td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+mailidonly[0]+"' target='_blank'>View CV</a></td><td></td><td><p>Already Initiated</p></td><span></span></label></p></td></tr>"
                      $('#tabledatahold').append(str)
                    }
                    else
                    {
                      var str = "<tr><td><p id='"+i+"mail'>"+mailidonly[0]+"</p></td><td><p>"+element[i][1]+"</p></td><td><p>"+element[i][3]+"</p></td><td><p>Absent</p>&nbsp;&nbsp;</td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+mailidonly[0]+"' target='_blank'>View CV</a></td><td><input id='"+i+"checkdate' class='datepicker' ></td><td><input id='"+i+"checkdate2' class='timepicker'></td><td><p><label><input type='checkbox' class='filled-in' id='"+i+"check' name='"+i+"mail' onclick='selection(this.id,this.name)' /><span></span></label></p></td></tr>"
                      $('#tabledatahold').append(str)
                    }

                   
                  }
                  else
                  {
                    if(element[i][2]==1)
                    {
                      var round_evaluation = $('#round_selected').val()
                      var str = "<tr><td><p id='"+i+"mail'>"+mailidonly[0]+"</p></td><td><p>"+element[i][1]+"</p></td><td><p>"+element[i][3]+"</p></td><td> <a class='waves-effect waves-light btn' href='http://localhost/hrms/documentcheck.php?aid="+mailidonly[0]+"&prf="+prfdata[0]+"&iid="+roundid[2]+"&rid="+round_evaluation+"' target='_blank'>Evaluation Sheet</a>&nbsp;&nbsp;</td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+mailidonly[0]+"' target='_blank'>View CV</a></td><td></td><td><p>Already Initiated</p></td><span></span></label></p></td></tr>"
                      $('#tabledatahold').append(str)
                    }
                    else
                    {
                      var round_evaluation = $('#round_selected').val()
                      var str = "<tr><td><p id='"+i+"mail'>"+mailidonly[0]+"</p> </td><td><p>"+element[i][1]+"</p></td><td><p>"+element[i][3]+"</p></td><td> <a class='waves-effect waves-light btn' href='http://localhost/hrms/documentcheck.php?aid="+mailidonly[0]+"&prf="+prfdata[0]+"&iid="+roundid[2]+"&rid="+round_evaluation+"' target='_blank'>Evaluation Sheet</a>&nbsp;&nbsp;</td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+mailidonly[0]+"' target='_blank'>View CV</a></td><td><input id='"+i+"checkdate' class='datepicker' ></td><td><input id='"+i+"checkdate2' class='timepicker'></td><td><p><label><input type='checkbox' class='filled-in' id='"+i+"check' name='"+i+"mail' onclick='selection(this.id,this.name)' /><span></span></label></p></td></tr>"
                      $('#tabledatahold').append(str)
                    }
                   
                  }
                  $('.timepicker').timepicker();
                  $('.datepicker').datepicker();
                  
                    
                } 
                }
                

              }


                $('#round_selected').change(function(){
                  console.log('0'+$('#round_selected').val())
                  
                  $.ajax({

                      url : 'http://localhost/hrms/api/getprfs2.php',
                      type : 'POST',
                      data : {
                        'prf':roundid[0],
                        'pos':roundid[1], 
                        'iid':roundid[2],
                        'rid': '0'+$('#round_selected').val()
                        },

                      success:function(para)
                      {

                        if(para != "no data")
                        {
                          $('#tabledataselect').empty()
                          $('#tabledatareject').empty()
                          $('#tabledatahold').empty()

                          parseddata = JSON.parse(para)     
                          var element = parseddata.selected
                          var prfdata = parseddata.prfdata

                          for (let i = 0; i < element.length; i++) 
                          {
                            console.log(prfdata[5])
                            console.log(prfdata[6])
                            if('0'+prfdata[5] == prfdata[6])
                            {
                              var round_evaluation = $('#round_selected').val()
                              var str = "<tr><td><p>"+element[i][1]+"</p></td><td>"+element[i][0]+"</td><td>"+element[i][2]+"</td><td> <a class='waves-effect waves-light btn' href='http://localhost/hrms/documentcheck.php?aid="+element[i][0]+"&prf="+prfdata[0]+"&iid="+roundid[2]+"&rid="+round_evaluation+"' target='_blank'>Evaluation Sheet</a></td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+element[i][0]+"' target='_blank'>View CV</a></td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/printevaluation.php?aid="+element[i][0]+"&prf="+prfdata[0]+"&iid="+roundid[2]+"&rid="+round_evaluation+"' target='_blank'>Print Evaluation</a></td><td><a  class='waves-effect waves-light btn' href='http://localhost/hrms/applicationblank_print.php?aid="+element[i][0]+"' target='_blank'>Print Application</a></td</tr>"
                              $('#tabledataselect').append(str)
                            }
                            else if(prfdata[6] == 00)
                            {
                              var round_evaluation = $('#round_selected').val()
                              var str = "<tr><td><p>"+element[i][1]+"</p></td><td>"+element[i][0]+"</td><td style='color:black;'> NA </td><td style='color:black;'> NA </td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+element[i][0]+"' target='_blank'>View CV</a></td><td style='color:black;'> NA </td><td><a  class='waves-effect waves-light btn' href='http://localhost/hrms/applicationblank_print.php?aid="+element[i][0]+"' target='_blank'>Print Application</a></td</tr>"
                              $('#tabledataselect').append(str)
                            }
                            else
                            {
                              var round_evaluation = $('#round_selected').val()
                              var str = "<tr><td><p>"+element[i][1]+"</p></td><td>"+element[i][0]+"</td><td style='color:black;'> NA </td><td> <a class='waves-effect waves-light btn' href='http://localhost/hrms/documentcheck.php?aid="+element[i][0]+"&prf="+prfdata[0]+"&iid="+roundid[2]+"&rid="+round_evaluation+"' target='_blank'>Evaluation Sheet</a></td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+element[i][0]+"' target='_blank'>View CV</a></td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/printevaluation.php?aid="+element[i][0]+"&prf="+prfdata[0]+"&iid="+roundid[2]+"&rid="+round_evaluation+"' target='_blank'>Print Evaluation</a></td><td><a  class='waves-effect waves-light btn' href='http://localhost/hrms/applicationblank_print.php?aid="+element[i][0]+"' target='_blank'>Print Application</a></td</tr>"
                              $('#tabledataselect').append(str)
                            }
                              
                          } 
                          var element = parseddata.rejected
                          console.log(element)
                          for (let i = 0; i < element.length; i++) 
                          {
                            if(element[i][0][1] == "Aborted")
                            {
                              var round_evaluation = $('#round_selected').val()
                              var str = "<tr><td><p>"+element[i][1]+"</p></td><td>"+element[i][0][0]+"</td><td><p>"+element[i][2]+"</p></td><td>Aborted</td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+element[i][0]+"' target='_blank'>View CV</a></td></tr>"
                              $('#tabledatareject').append(str)
                            }
                            else
                            {
                              var round_evaluation = $('#round_selected').val()
                              var str = "<tr><td><p>"+element[i][1]+"</p></td><td>"+element[i][0]+"</td><td><p>"+element[i][2]+"</p></td><td> <a class='waves-effect waves-light btn' href='http://localhost/hrms/documentcheck.php?aid="+element[i][0]+"&prf="+prfdata[0]+"&iid="+roundid[2]+"&rid="+round_evaluation+"' target='_blank'>Evaluation Sheet</a></td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+element[i][0]+"' target='_blank'>View CV</a></td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/pdf/evaluationfinal.php?aid="+element[i][0]+"&prf="+prfdata[0]+"&iid="+roundid[2]+"&rid="+round_evaluation+"' target='_blank'>Print Evaluation</a></td><td><a  class='waves-effect waves-light btn' href='http://localhost/hrms/pdf/applicationfinal.php?aid="+element[i][0]+"' target='_blank'>Print Application</a></td</tr>"
                            
                            $('#tabledatareject').append(str)
                            }
                            
                              
                          } 
                          if(parseddata.onhold != "")
                          {
                            var element = parseddata.onhold
                          console.log("element: ",element)
                          elemail = element[0][0].split(",")
                          console.log("element: ",element[0][2])
                          // var arr=[["Tanmay Kulkarni","tvkulkarni@mitaoe.ac.in"]]
                          for (let i = 0; i < element.length; i++) 
                          {
                            mailidonly = element[i][0].split(",")
                            if(mailidonly[1] == "absent")
                            {
                              if(element[i][2] == 1)
                              {
                                var str = "<tr><td><p id='"+i+"mail'>"+mailidonly[0]+"</p></td><td><p>"+element[i][1]+"</p></td><td><p>"+element[i][3]+"</p></td><td><p>Absent</p>&nbsp;&nbsp;</td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+mailidonly[0]+"' target='_blank'>View CV</a></td><td></td><td><p>Already Initiated</p></td><span></span></label></p></td></tr>"
                                $('#tabledatahold').append(str)
                              }
                              else
                              {
                                var str = "<tr><td><p id='"+i+"mail'>"+mailidonly[0]+"</p></td><td><p>"+element[i][1]+"</p></td><td><p>"+element[i][3]+"</p></td><td><p>Absent</p>&nbsp;&nbsp;</td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+mailidonly[0]+"' target='_blank'>View CV</a></td><td><input id='"+i+"checkdate' class='datepicker' ></td><td><input id='"+i+"checkdate2' class='timepicker'></td><td><p><label><input type='checkbox' class='filled-in' id='"+i+"check' name='"+i+"mail' onclick='selection(this.id,this.name)' /><span></span></label></p></td></tr>"
                                $('#tabledatahold').append(str)
                              }

                            
                            }
                            else
                            {
                              if(element[i][2]==1)
                              {
                                var round_evaluation = $('#round_selected').val()
                                var str = "<tr><td><p id='"+i+"mail'>"+mailidonly[0]+"</p></td><td><p>"+element[i][1]+"</p></td><td><p>"+element[i][3]+"</p></td><td> <a class='waves-effect waves-light btn' href='http://localhost/hrms/documentcheck.php?aid="+mailidonly[0]+"&prf="+prfdata[0]+"&iid="+roundid[2]+"&rid="+round_evaluation+"' target='_blank'>Evaluation Sheet</a>&nbsp;&nbsp;</td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+mailidonly[0]+"' target='_blank'>View CV</a></td><td></td><td><p>Already Initiated</p></td><span></span></label></p></td></tr>"
                                $('#tabledatahold').append(str)
                              }
                              else
                              {
                                var round_evaluation = $('#round_selected').val()
                                var str = "<tr><td><p id='"+i+"mail'>"+mailidonly[0]+"</p></td><td><p>"+element[i][1]+"</p></td><td><p>"+element[i][3]+"</p></td><td> <a class='waves-effect waves-light btn' href='http://localhost/hrms/documentcheck.php?aid="+mailidonly[0]+"&prf="+prfdata[0]+"&iid="+roundid[2]+"&rid="+round_evaluation+"' target='_blank'>Evaluation Sheet</a>&nbsp;&nbsp;</td><td><a class='waves-effect waves-light btn' href='http://localhost/hrms/viewcv.php?aid="+mailidonly[0]+"' target='_blank'>View CV</a></td><td><input id='"+i+"checkdate' class='datepicker' ></td><td><input id='"+i+"checkdate2' class='timepicker'></td><td><p><label><input type='checkbox' class='filled-in' id='"+i+"check' name='"+i+"mail' onclick='selection(this.id,this.name)' /><span></span></label></p></td></tr>"
                                $('#tabledatahold').append(str)
                              }
                            
                            }
                            $('.timepicker').timepicker();
                            $('.datepicker').datepicker();
                            
                              
                          } 
                          }
                          

                        }
                        
                      }
                  })

                  
                })

                  
                $('#mytabs').fadeIn(900); 
                $('#select').click()
                $(document).scrollTop($(document).height());

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

  // functionality for notifications start here
  $('#badge_ongoing').hide();
  $('#badge_rescheduling').hide();
  $('#badge_letter').hide();
  $('#loader').hide();
  // ajax call for getting notification details
  $.ajax({
    url:'http://localhost/hrms/api/getGeneralizedData.php',
    type:'GET',
    success:function(para)
    {
      // dummy data : give notification count, if no new notification please give 0 ex offerletter:0
      //para = {'ongoing':10,'rescheduling':5,"offerletter":0} 
      if(para.general.ongoing_round > 0)
      {
        $('#badge_ongoing').text(para.general.ongoing_round);
        $('#badge_ongoing').show();
      }
      if(para.general.schdule_count > 0)
      {
        $('#badge_rescheduling').text(para.general.schdule_count);
        $('#badge_rescheduling').show();
      }
      if(para.completeddata.olrequest+para.completeddata.completed > 0)
      {
        $('#badge_letter').text(para.completeddata.olrequest+para.completeddata.completed);
        $('#badge_letter').show();
      }
    }
  })
  // functionality for notification ends here
  
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
url:"http://localhost/hrms/api/histgetfiltereddept.php",
type:"POST",
data: {"dept": $('#deptchoice').val()},
success:function(arr)
{ 
  console.log(arr)
  if(arr == 'No data')
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
      var x='<tr id="rows"><td id="prf" value="'+arr[j][0]+'">'+arr[j][0]+'</td><td id="position">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="iid">'+arr[j][6]+'</td><td id="status">'+arr[j][5]+'</td><td>'+arr[j][7]+'</td><td width="25%"><a id="'+arr[j][0]+"*"+arr[j][4]+"*"+arr[j][6]+'" class="btn small green darken-1" onclick="xyz(this.id)">View Details</a></td></tr>'
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
  url:"http://localhost/hrms/api/histgetfilteredzones.php",
  type:"POST",
  data: {
    "dept": $('#deptchoice').val(),
    "zone": $('#zonechoice').val()
    },
  success:function(arr)
  { 
    if(arr == 'No data')
    {
      $('#nodata').fadeIn(300);
      $("#nodatamodal").modal("open");
      document.getElementById("result").innerHTML = 0;
      document.getElementById("result1").innerHTML = 0;

    }
    else
    {
      document.getElementById("result").innerHTML = arr.length;
      document.getElementById("result1").innerHTML = arr.length;

      $('#nodata').hide();
      console.log("This is my data : "+arr)
      arr=JSON.parse(arr);
      console.log("this are prflist = ",arr)
  
      for(let j=0;j<arr.length;j++)
      {
        var x='<tr id="rows"><td id="prf" value="'+arr[j][0]+'">'+arr[j][0]+'</td><td id="position">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="iid">'+arr[j][6]+'</td><td id="status">'+arr[j][5]+'</td><td>'+arr[j][7]+'</td><td width="25%"><a id="'+arr[j][0]+"*"+arr[j][4]+"*"+arr[j][6]+'" class="btn small green darken-1" onclick="xyz(this.id)">View Details</a></td></tr>'
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
    url:'http://localhost/hrms/api/getprfs.php',
    type:'POST',
    // data:{'arr1':arr1},
    success : function(para)
    {
      // console.log("Hello WOrld");
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
          var x='<tr id="rows"><td id="prf" value="'+arr[j][0]+'">'+arr[j][0]+'</td><td id="position">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="iid">'+arr[j][5]+'</td><td id="status">'+arr[j][6]+'</td><td>'+arr[j][7]+'</td><td width="25%"><a id="'+arr[j][0]+"*"+arr[j][4]+"*"+arr[j][5]+"*"+arr[j][7]+'" class="btn small green darken-1" onclick="xyz(this.id)">View Details</a></td></tr>'
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
  if(imail != "" && iname != "" &&  idept != "" && idesg != "" && iperson != "" && iloc != "")
  {
    $("#loader").show();
    for(let i=0;i<selectedmailID.length;i++)
    {
      var b = selectedmailID[i]
      b = b+'date'
      b2 = b+'2'
      console.log(b)
      console.log(b2)
      selecteddate.push($(b).val()) 
      selecteddate2.push($(b2).val()) 
      console.log("Email:",selectedmail[i]) 
      console.log("Time:",selecteddate[i])
      console.log("Date:",selecteddate2[i])
    }
    $.ajax({
      url:'http://localhost/hrms/api/assignonhold.php',
      type:'POST',
      data:{
        "emails":selectedmail,
        "cantimes" : selecteddate2,
        "candates" : selecteddate,
        "iname":iname,
        "intvmail":imail,
        "prf":groupid,
        "iloc":iloc,
        "iperson":iperson,
        "idesg":idesg,
        "dept":idept,
        "prf":roundid[0],
        'pos':roundid[1],
        'iid':roundid[2]
      },
      success:function(para){
       $("#loader").hide();
        console.log(para);
        selectedmail = []
        selecteddate = []
        selecteddate2 = []
        selectedmailID=[]
        document.location.reload();
      }
    })
  }

})

var ctr=0
function selection(umail,mail)
{
  console.log("name: ",mail)
  var b = '#'+umail
  console.log('b =' ,b)
  
  var umail="#"+umail;
  var pmail = '#'+mail
  console.log("id: ",$(umail).text())

  if($(umail).prop("checked") == true)
  {
      selectedmail.push($(pmail).text())
      selectedmailID.push(b)
      console.log(selectedmail)
      console.log('mail:'+selectedmail)
      console.log('ID:'+selectedmailID)
  }
  else
  {                                               
    for( var i = 0; i < selectedmail.length; i++)
    { 
      if ( selectedmail[i] == $(pmail).text()) 
      {
        selectedmail.splice(i, 1); 
        selectedmailID.splice(i, 1)
        i--;
      }
    }
    console.log(selectedmail)
    console.log(selectedmailID)
  }
}
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