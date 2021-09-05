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
  <script src="./public/js/logout.js"></script>

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
      <a class="modal-close waves-effect green btn" href="http://localhost/hrms/hrdash.php" >OK<i class="material-icons left" >check_box</i></a>
      </center>
    </div>
  </div>
<!-- no data modal ends here -->

  <!-- Modal Structure -->
  <!-- modal1 starts here -->
  <div id="modal1" class="modal" style="width:90%">
    <div class="modal-content">
        
      <table style="border-radius:5px solid black;">
        <tr id="modalheader" >
                  
          <th>Instance ID	</th>
          <th>Instance Name	</th>
          <th>Submissiong Date	</th>
          <th>Requester	</th>
          <th>Position Details</th>	
          <th>Production Line	</th>
          <th>Hiring Type	</th>
          <th>Classification 100</th>	
          <th>Classification 110	</th>
          <th>Classification 111	</th>
          <th>Zone	</th>
          <th>Branch	</th>
          <th>Cost Center Name</th>	
          <th>Cost Center Code	</th>
          <th>Department	</th>
          <th>Location	</th>
          <th>Number of Position Open </th>	
          <th>Workforce Classification	</th>
          <th>Request Type	</th>
          <th>Employee Code & 8ID	</th>
          <th>Employee Name	</th>
          <th>New Joiner 8 ID	</th>
          <th>New Joiner Name	</th>
          <th>Required Date	</th>
          <th>Reporting To	</th>
          <th>Budget CTC in INR </th>	
          <th>Internal Posting Recommended	</th>
          <th>Status	</th>
          <th>Next Handler</th>
        </tr>
        
        <tr  id="modalrow">
        <!-- td will go here -->
        </tr>
      </table>
      
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect green btn" style="float:left;color:white">Close</a>
    </div>

  </div>
  <!-- modal1 ends here -->

  <!-- modal2 starts here -->
  <!-- <div id="modal2" class="modal">
    <div class="modal-content">
      <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
      <br>
      
      <center><h2>Are You Sure ?</h2></center>
      <center><p>This Position Will Be Withdrawn.</p></center>
      <div id="appending_id"></div>
    </div>
    <div class="modal-footer">
      <center>
      <a onclick="withdraw(true)" class="modal-close waves-effect green btn" >Confirm<i class="material-icons left" >check_box</i></a>
      <a onclick="withdraw(false)" class="modal-close waves-effect red btn">Cancel<i class="material-icons left">highlight_off</i></a>
      </center>
    </div>
  </div> -->
  <!-- modal2 ends here -->

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

          <select id='deptchoice' class="dropdown-trigger btn blue darken-1 ">
          <option value="" disabled selected style="color: white">Select Department</option>
          </select>
          
          <!--Export CSV button-->
          <button style="align-items:left;float:right;margin-right:10px" class="btn green darken-1" onclick='op()'>
           Export CSV
          </button> 
          
          <select id='zonechoice' class="dropdown-trigger btn blue darken-1 ">
          <option value="" disabled selected style="color: white">Select Zone</option>
        </select>
          <br>
        <br>

<div style="color:white;width:18%;background-color:green;border-radius:2px;font-weight:bold;"> Showing <p id="result" style="display:inline;"> </p> PRF of <p id="result1" style="display:inline;"> </p> PRF</div><br>
 <div class="row" id="megblock">
<div class="col s12  blue lighten-4" >
  <table class="striped">
    <thead>
      <tr>
          <th>Instance ID</th>
          <th>Position Details</th>
          <th>Zone</th>
          <th>Department</th>
          <th>No. of Positions</th>
          <th>Status</th>
          <th>Initiate</th>
          <!-- <th>Withdraw</th> -->
      </tr>
    </thead>

    <tbody id='rawdata'>
      
    </tbody>
  </table>
</div> 
</div>

<br>
<center>
<button class="button" id="kindlybtn">kindly enter candidate's email ID for below PRF</button>
</center>
<br>
<div class="col s7 offset-m3 blue lighten-4" id="selectedrow">
  <table class="striped">
    <thead>
      <tr>
          <th>Instance ID</th>
          <th>Position Details</th>
          <th>Zone</th>
          <th>Department</th>
          <th>No. of Positions</th>
          <th>Status</th>
      </tr>
    </thead>

    <tbody id='rawdata'>
    <td id="oniid"></td>
    <td id="onpos"></td>
    <td id="onzone"></td>
    <td id="ondept"></td>
    <td id="onnpos"></td>
    <td id="onsts"></td>
      
    </tbody>
  </table>
</div> 
</div>
<br>

<div id="loader">
    <div id="txt">
            <b>Please wait while we are creating a batch and notifying them</b>
    </div>  
</div>
 

<div class="row" id="dumpdiv">
    <div class="col s12 m4 offset-m4">
      <div class="card white darken-1">
        <div class="card-content blue-text">
          <span class="card-title"><b><center>Upload prospective candidate details</center></b></span>
          
<script>
  //function for export csv button
  function op(){
    console.log("Export csv button working");
  }

// function for opening dialouge box
function openmodal(cid)
{
  $("#appending_id").empty()
  $("#appending_id").append("<b id='bid' name='"+cid+"'></b>")
  $("#modal2").modal("open")
}

// function withdraw(confr)
// {
//   var btn_id = $('#bid').attr('name')
//   if(confr)
//   {
//     $.ajax({
//       url:'http://localhost/hrms/api/withdrawposition.php',
//       type:'POST',
//       data:{'id':btn_id},
//       success : function(para)
//       {
//         if(para == "success")
//         {
//           alert("Position Withdrawn Successfully")
//           window.setTimeout(function(){location.reload()},400)
//         }
//         else if(para == "fail")
//         {
//           alert("Position Can't be Withdrawn")
//         }
//         else
//         {
//           alert("Error Occured")
//         }
//       }
  
//     })  
//   }
    
// }


function showmodal(x)
{
  $("#modalrow").text("")      
  $.ajax({
    url:'http://localhost/hrms/api/getfullprf.php',
    type:'POST',
    data:
    {
      'prf':x
    },
    success:function(para)
    {
      para = JSON.parse(para)
      console.log("this is asdassd",para)
      for(let i=0;i<para.length;i++)
      {
        var str = '<td>'+para[i]+'</td>'
        $("#modalrow").append(str)      
      }
    }
  })
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
          <center>
          <form id="forms" method="POST" action="" enctype="multipart/form-data">
                            
                         <br><br>
                                    
                                    <label class="custom-file-upload" id="prof">
                                        <a class="btn blue darken-1">
                                        <input id="uploadcsv" type="file" accept=".csv"  required  name="uploadcsv" onchange="readURL(this)"><p id='myfile0'> Select file<i class="material-icons right">open_in_browser</i> </p></a>
                                    </label>
                                    <a class="btn red" id="fileformatmodal" style="margin-left:2%" onclick="mymodalopen()"><i class="material-icons right">format_align_justify</i>FILE FORMAT</a>
                                    <br><br><br>
                                    
                            <!-- <button type="submit" onclick="showupdump()" class="btn blue darken-1" name="submit" id="submit" value="Upload"><i class="material-icons right">send</i>Upload</button> -->
                            <input type="button" class="btn blue darken-1" onclick="showupdump()" value="Upload" id="but_upload"> </input>

                        </form>
                        <br>
                      
          </center>
          



        </div>

      </div>
      <center><p style="color:red" id="uploaddump">Please wait uploading email dump ...</p></center>
       <center><b id='unsentmails'>Mails not sent to the following candidates . Please reinitiate the round</b>
  <div id="get"></div>
    </div>
  </div>
 
  
  <div class="row" >
      
      <p style="color: green;text-align: center;margin-left:18%;" id="creatinggrp">Creating Group...! </p>
      <p style="color: green;text-align: center;margin-left:18%;" id="groupcreated">Group Created Successfully </p>
      <p style="color: red;text-align: center;margin-left:18%;" id="groupnotcreated">Unable to create group </p>
          
  </div>
  
  <div class="card white darken-1" id="ordiv" style="width:15%;margin-left:42%;" ><center><b>OR <br></center></div><br>
  <div class="row card white darken-1" style="width:35%;margin-left:32%;" id="emailcollection">
  <center> <br> Enter prospective candidate details <br></b> </center>
    <div class="input-field col s12 m4 offset-m10 blue-text" style="width:60%;margin-left:20%;">
      <i class="material-icons prefix">assignment</i>
      <input id="cname" onfocus="addText(this)" type="text" class="validate" placeholder="Candidate 1 Full Name">
      <input id="email" type="email" class="validate" placeholder="Candidate 1 Email Address">

    </div>
  </div>

  <div class="row">
  <div class="input-field col s12 m4 offset-m4 center">
    <button  class="btn waves-effect waves-light blue darken-1" id="submitmail" >Submit Mail
      <i class="material-icons right">send</i>
    </button>
  </div>
  </div>

  </div>

  <div id="nodata" style="margin-left:40%;color:white;background-color:red;width:15%;height:5%;border-radius:5px;text-align:center;">
    <b>NO PRF's AVAILABLE</b>
  </div>


  <div id="modal3" class="modal" style="width:50%;">
    <div class="modal-content" >
    <table class="white-text teal">
      <tr>
        <th>SrNo.</th>
        <th>Candidate Full Name</th>
        <th>Candidate Email Ad</th>

      </tr>
    </table>
    </div>
    <center><b class="red-text">Please ensure that the file to be uploaded must have above columns only</b></center>
    <div class="modal-footer">
    <a href="./formats/emaildumpformat.csv" class="modal-close waves-effect waves-green btn-flat" style="color:green" download>Download</a>
    <a href="#!" class="modal-close waves-effect waves-green btn-flat" style="color:red">Close</a>
    </div>
  </div>
  
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

$("#but_upload").click(function(){
    $("#loader").show();

  console.log("This is form submit",window.prf)

  var fd = new FormData();
        var files = $('#uploadcsv')[0].files[0];
        fd.append('uploadcsv',files);
        fd.append('prf',window.prf);
        fd.append('pos',window.pos);
        fd.append('positiond',window.position);
        fd.append('dept',window.dept);
        console.log("This is  - ",fd)
        $.ajax({
            url: 'http://localhost/hrms/uploademails.php',
            type: 'post',
            data: 
                fd,
            contentType: false,
            processData: false,
            success: function(response){
              
              if(response == "success")
              {
                $("#loader").hide();
                window.setTimeout(function(){location.reload()},1000)
              }
              else
              {
                $("#loader").hide();
                window.setTimeout(function(){location.reload()},1000)
              }
              console.log("Response",response)
      
            },
        });
})
  

  function readURL(input) {
  var f = $('#uploadcsv').val().split('.')
      var x=f[1]
      if(x=='csv')
      {
        var f = $('#uploadcsv').val()
      
      $('#myfile0').text(f)
      }
      else
      {
        alert('Invalid File\n Only CSV Files Accepted')
        $('#uploadcsv').val(" ")
      }
}

function mymodalopen()
{
  
  $("#modal3").modal('open');
}

$('#dumpdiv').hide();
$('#emailcollection').hide();
$('#edump').hide();
$('#submitmaildump').hide();
$('#submitmail').hide();
$('#groupcreated').hide()
$('#groupnotcreated').hide()
$('#creatinggrp').hide()

$('#unsentmails').hide()

$('#emaildump').change(function()
{
      var f = $('#emaildump').val()
      var filesplit=f.split(".")
      checkfile=filesplit[1]
      if(checkfile=="csv")
      {
        $('#myfile').replaceWith(f);
      }
      else
      {
        alert("Invalid File Format")
      }
      
        
})

function removeusingSet(arr) { 
            let outputArray = Array.from(new Set(arr)) 
            return outputArray 
        } 

function filterbydept()
{
  $('#deptchoice').fadeIn(600)
  $('#deptchoice').empty()

  $.ajax({
    url:'http://localhost/hrms/api/getdepartments.php',
    type:'POST',
    success:function(para)
    {
      para = JSON.parse(para)
      uniquedept = removeusingSet(para);
      for(i=0;i<uniquedept.length;i++)
      {
        var str = '<option value="'+uniquedept[i]+'"  style="color: white">'+uniquedept[i]+'</option>'
         $('#deptchoice').append(str);

      }
      

    }
  })
}


  var ctr = 0
  var counter

function addText(x)
{
ctr = ctr+1
counter = ctr+1
var str = 'email'+ctr
var txt1 = "<div class='input-field col s12 m4 offset-m4  blue-text' style='width:60%;margin-left:20%;' >"
var txt2 = "<i class='material-icons prefix'>assignment</i>"
var txt3 = "<input id='"+str+"_name' onfocus='addText(this)' type='text' class='validate' placeholder='Candidate "+counter+" Full Name'>"
var txt4 = "<input id='"+str+"' type='text' class='validate' placeholder='Candidate "+counter+" Email Address'>"
var txt5 = "</div>"
$("#emailcollection").append(txt1+txt2+txt3+txt4+txt5);
}
var arr=[]
var dept=[]
$(document).ready(function(){

  // functionality for notifications start here
  $('#badge_ongoing').hide();
  $('#badge_rescheduling').hide();
  $('#badge_letter').hide();
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
  $("#loader").hide();
  $('.modal').modal();
  
  $('#zonechoice').hide();
  $("#uploaddump").hide()
  $("#nodata").hide()
  $("#ordiv").hide()

 $.ajax({
    url:'http://localhost/hrms/api/getprfdump.php',
    type:'POST',
    // data:{'arr1':arr1},
    success : function(para)
    {
      if(para == "No Data")
      {
        $("#nodatamodal").modal("open");
      }
      else
      {
        console.log(para+"<br>")
        para=JSON.parse(para)
        // window.data=para
        // para=['1001','Developer','North','Sales','5','ongoing']
        console.log("this is length : "+para.length)
        for(let i=0;i<=para.length;i++)
        {
          arr[i]=para[i];
          
        }
        document.getElementById("result").innerHTML = arr.length;
        document.getElementById("result1").innerHTML = arr.length;

        dept[0]="All"
        for(let i =1 ;i<para.length;i++)
        {
          dept[i] = para[i-1][3]
        }
        uniquedept = removeusingSet(dept);
        
        for(i=0;i<uniquedept.length;i++)
        {
          var str = '<option value="'+uniquedept[i]+'"  style="color: white">'+uniquedept[i]+'</option>'
          
          $('#deptchoice').append(str);
        }
        countdept = uniquedept.length;
        $strs = '<span class="new badge green">4</span>';
        $("#badges").append($strs)

        for(let j=0;j<arr.length-1;j++)
        {
          
          if(arr[j][6] == "initiated")
          {
            var x='<tr id="rows" style="background-color:orange;"><td id="prf" value="'+arr[j][0]+'"><b class="modal-trigger" href="#modal1" id="'+arr[j][0]+'" onclick=showmodal(this.id) style="cursor:pointer">'+arr[j][0]+'</b></td><td id="pos">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="status">'+arr[j][5]+'</td><td><a id="'+arr[j][0]+"*"+arr[j][1]+"*"+arr[j][2]+"*"+arr[j][3]+"*"+arr[j][4]+"*"+arr[j][5]+'" class="btn green darken-1" onclick="xyz(this.id)">Initiate</a></td></tr>'
          }else
          {
            var x='<tr id="rows"><td id="prf" value="'+arr[j][0]+'" ><b class="modal-trigger" href="#modal1" id="'+arr[j][0]+'" onclick=showmodal(this.id) style="cursor:pointer">'+arr[j][0]+'</b></td><td id="pos">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="status">'+arr[j][5]+'</td><td><a id="'+arr[j][0]+"*"+arr[j][1]+"*"+arr[j][2]+"*"+arr[j][3]+"*"+arr[j][4]+"*"+arr[j][5]+'" class="btn green darken-1" onclick="xyz(this.id)">Initiate</a></td></tr>'          
          }
        $('#rawdata').append(x);
        }
      }
      
     
    },
  })

  

})
$('#submitmail').click(function()
{
  $("#loader").show();
  $('#submitmail').prop('disabled', true);
  $('#emailcollection').fadeOut(600)
  $('#creatinggrp').fadeIn(600)


  var arr1=[]
  arr1[0]= [$('#email').val(),$('#cname').val()]
  for(let i =1;i<ctr;i++)
  {
    var x = '#email'+i
    var y = '#email'+i+'_name'
    arr1[i] = [$(x).val(),$(y).val()]
    arr1[i] = arr1[i].filter(function(entry) { return entry.trim() != ""; });
  }
  
  $.ajax({
    url : 'http://localhost/hrms/api/sendmail.php',

    type:'POST',

    data:{'emails':arr1,
      'prf':window.prf,
      'dept':window.dept,
      'pos':window.pos,
      'status':window.status,
      'position':window.position,
      'poszone':window.zone
    },
    success : function(para)
    {
      // para=JSON.parse(para);
      console.log("this is ",para);
      // alert(para)
      if(para == "sent")
      {
        $("#loader").hide();
        $('#groupcreated').show();
        $('#submitmail').prop('disabled', false);
        // alert("This is 2 : "+id)
        $(id).attr('disabled','disabled')
        $(id).text('Initiated')
        console.log("sent")
        $('#creatinggrp').fadeOut(600)
        window.setTimeout(function(){location.reload()},1000)


      }
      else{
        $("#loader").hide();
        para=JSON.parse(para);
        console.log("This is : ",para)
        $('#creatinggrp').fadeOut(100)
        $('#unsentmails').fadeIn(500)
        for(i=0;i<para.length;i++)
        {
          s2="<b style='color:red;'>"+(i+1)+". "+para[i]+"<b><br>";
          $("#get").append(s2);
          $("#submitmail").hide();
        }
      }
      

    },
  })
})

function showupdump()
{
 
  if($('#uploadcsv').val() == "")
  {
    alert('Please Upload a File..!')
  }
  else
  {
    $("#uploaddump").fadeIn()
  }
}

//Added by Sarang - 03/14/2020



$('#deptchoice').change(function(){

$("#prfno").empty()   
var ap1 = "<option disabled selected style='color: white'>Select PRF</option>"
$("#prfno").append(ap1)    
$('#rawdata').empty();


$.ajax({
url:"http://localhost/hrms/api/getfilteredprf.php",
type:"POST",
data: {"dept": $('#deptchoice').val()},
success:function(arr)
{ 

  if(arr == "No Data")
  {
    document.getElementById("result").innerHTML = 0;
    $("#nodatamodal").modal("open");
  }
  else
  {

    // console.log("this are prflist = ",arr.length)
    arr=JSON.parse(arr);
    console.log("this are prflist = ",arr.length)

    //Count of result, filtered
    document.getElementById("result").innerHTML = arr.length;
    for(let j=0;j<arr.length;j++)
    {
      
      if(arr[j][6] == "initiated")
          {
            var x='<tr id="rows" style="background-color:orange;"><td id="prf" value="'+arr[j][0]+'"><b class="modal-trigger" href="#modal1" id="'+arr[j][0]+'" onclick=showmodal(this.id) style="cursor:pointer">'+arr[j][0]+'</b></td><td id="pos">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="status">'+arr[j][5]+'</td><td><a id="'+arr[j][0]+"*"+arr[j][1]+"*"+arr[j][2]+"*"+arr[j][3]+"*"+arr[j][4]+"*"+arr[j][5]+'" class="btn green darken-1" onclick="xyz(this.id)">Initiate</a></td></tr>'
          }else
          {
            var x='<tr id="rows"><td id="prf" value="'+arr[j][0]+'" ><b class="modal-trigger" href="#modal1" id="'+arr[j][0]+'" onclick=showmodal(this.id) style="cursor:pointer">'+arr[j][0]+'</b></td><td id="pos">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="status">'+arr[j][5]+'</td><td><a id="'+arr[j][0]+"*"+arr[j][1]+"*"+arr[j][2]+"*"+arr[j][3]+"*"+arr[j][4]+"*"+arr[j][5]+'" class="btn green darken-1" onclick="xyz(this.id)">Initiate</a></td></tr>'          
          }

      $('#rawdata').append(x);
    }
    $('#zonechoice').fadeIn(300);

    //---------------------------------Sarang -------------get unique zones
    $.ajax({
            url:'http://localhost/hrms/api/getzones.php',
            type:'POST',
            // data:{'arr1':arr1},
            success : function(para)
            {
              zone=[]
              para = JSON.parse(para)

              for(let i =0 ;i<para.length;i++)
              {
                zone[i] = para[i]
              }
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
  }

}

})

})


//-------------------------------------------Get Filtered Zones -------------------------------------------------

//get filtered department
$('#zonechoice').change(function(){

  console.log("Selected Zones : "+ $('#deptchoice').val()+$('#zonechoice').val())
  
  $('#rawdata').empty();
  //Sarang Yesterday  13/03/2020
  $.ajax({
  url:"http://localhost/hrms/api/hrgetfilteredzones.php",
  type:"POST",
  data: {
    "dept": $('#deptchoice').val(),
    "zone": $('#zonechoice').val()
    },
  success:function(arr)
  { 
    console.log(arr)
    if(arr == "No data")
    {
      document.getElementById("result").innerHTML = 0;
      $("#nodatamodal").modal("open");
      console.log("Entered");
      $('#nodata').fadeIn(300);
    
    }
    else
    {
      $('#nodata').hide();
      console.log("This is my data : "+arr)
      arr=JSON.parse(arr);
      console.log("this are prflist = ",arr)
      document.getElementById("result").innerHTML = arr.length;
      for(let j=0;j<arr.length;j++)
      {
        if(arr[j][6] == "initiated")
        {
          var x='<tr id="rows" style="background-color:orange;"><td id="prf" value="'+arr[j][0]+'"><b class="modal-trigger" href="#modal1" id="'+arr[j][0]+'" onclick=showmodal(this.id) style="cursor:pointer">'+arr[j][0]+'</b></td><td id="pos">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="status">'+arr[j][5]+'</td><td><a id="'+arr[j][0]+"*"+arr[j][1]+"*"+arr[j][2]+"*"+arr[j][3]+"*"+arr[j][4]+"*"+arr[j][5]+'" class="btn green darken-1" onclick="xyz(this.id)">Initiate</a></td></tr>'
        }else
        {
          var x='<tr id="rows"><td id="prf" value="'+arr[j][0]+'" ><b class="modal-trigger" href="#modal1" id="'+arr[j][0]+'" onclick=showmodal(this.id) style="cursor:pointer">'+arr[j][0]+'</b></td><td id="pos">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="status">'+arr[j][5]+'</td><td><a id="'+arr[j][0]+"*"+arr[j][1]+"*"+arr[j][2]+"*"+arr[j][3]+"*"+arr[j][4]+"*"+arr[j][5]+'" class="btn green darken-1" onclick="xyz(this.id)">Initiate</a></td></tr>'          
        }
        $('#rawdata').append(x);
      }
     
    }
  
  
  }
  
  })
  
  })

//----------------------------------------------END---------------------------------------------------------------



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
       