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
      <a class="modal-close waves-effect green btn" href="http://localhost/hrms/hrdash.php" >OK<i class="material-icons left" >check_box</i></a>
      </center>
    </div>
  </div>
<!-- no data modal ends here -->

  <!-- Modal Structure for Joining -->
  <div id="datemodal" class="modal">
    <div class="modal-content">
      <center><h2>Please Select Date of Joining</h2></center><br>
      <div class="row">
        <input type="text" class="datepicker s12 m6" id="joindate" placeholder = "Join date">
        
      </div>
      
      <br><br><br><br><br><br><br><br><br><br>
    </div>
    
    <div class="modal-footer">
      <center>
      <a class="modal-close waves-effect green btn" onclick="confirmDate()">Confirm</a>
      <a class="modal-close waves-effect red btn" >cancel</a>
      </center>
    </div>
  </div>

<!-- Modal Structure for Rejection -->
<div id="rejectmodal" class="modal">
    <div class="modal-content">
      <center><h2>Are You Sure ?</h2></center><br>
    
    </div>
    
    <div class="modal-footer">
      <center>
      <a class="modal-close waves-effect green btn" onclick="confirmReject()">Confirm</a>
      <a class="modal-close waves-effect red btn" >cancel</a>
      </center>
    </div>
  </div>

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
        </ul>     </div>
</nav>
<br><br>

<!-- nav and side menu ended -->

 <div class="row" id="firsttb">
<div class="col s12 blue lighten-4">
  <table class="striped">
    <thead>
      <tr>
          <th>PRF</th>
          <th>Position</th>
          <th>Instance ID</th>
          <th>Round ID</th>
          <th>Candidate Name</th>
          <th>Candidate Mail</th>
          <th>Requester Name</th>
          <th>Requester Mail</th>
          <th>Offer Letter</th>

      </tr>
    </thead>

    <tbody id='rawdata'>
      
    </tbody>
  </table>
</div> 
</div>


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
        <a class="modal-close waves-effect green btn" >OK<i class="material-icons left" >check_box</i></a>
        </center>
        </div>
    </div>
<!-- no data modal ends here -->


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
var flag0 = 0

function sendmailtoinv(x,name)
{
  
  btnid=x;
  // alert(btnid);
  prfid=x.split("-")
  var str = '#'+btnid;
  alert(str);
  var candidate = "#"+prfid[0]+"5"
  var cmail = $(candidate).html()
  $(str).html("sending...");
  $(str).attr('disabled','disabled')
 
  $.ajax({
    url:'http://localhost/hrms/api/sendofferletter.php',
    type:'POST',
    data:{
      'mail':name,
      'candidate':cmail,
      'prf':prfid[1],
      'pos':prfid[2],
      'iid':prfid[3],
      'rid':prfid[4]
    },
    success:function(para)
    {
      console.log("This is : ",para);
      if(para=="success")
      {
        $(str).html("letter sent");
        alert("Mail Sent To Candidate")
        window.setTimeout(function(){location.reload()},1000)
      }
      else
      {
        console.log(para)
      }
    }
  })
}

var ctr = 0
var arr=[]
$(document).ready(function(){ 
  $('.datepicker').datepicker();
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


  $('.modal').modal();
 $.ajax({
    url:'http://localhost/hrms/api/seerequestletters.php',
    type:'POST',
    success : function(para)
    {
      if(para =="No Data")
      {
        $("#nodatamodal").modal("open");
      }
      else
      {
        para = JSON.parse(para)
        console.log(para)
        arr = para
        
      
        for(let j=0;j<arr.length;j++)
        {
          if(arr[j][8] == "requested")
          {
            var candidate = arr[j][5];
            digit13=arr[j][0]+'-'+arr[j][1]+'-'+arr[j][2]+'-'+arr[j][3];
            console.log("Digit13",digit13)
            var x='<tr id="rows"><td id="prf" value="'+arr[j][0]+'">'+arr[j][0]+'</td><td id="pos">'+arr[j][1]+'</td><td id="iid">'+arr[j][2]+'</td><td id="rid">'+arr[j][3]+'</td><td id="'+j+'4" >'+arr[j][4]+'</td><td id="'+j+'5" >'+arr[j][5]+'</td><td id="interviewername">'+arr[j][6]+'</td><td id="interviewermail">'+arr[j][7]+'</td><td><a name="'+arr[j][7]+'" id="'+j+'-'+digit13+'-'+'" class="btn green darken-1" onclick="sendmailtoinv(this.id,this.name)">Send Letter</a></td></tr>'
            $('#rawdata').append(x);
          }
          else if(arr[j][8] == "sent")
          {
            var candidate = arr[j][5];
            digit13=arr[j][0]+'-'+arr[j][1]+'-'+arr[j][2]+'-'+arr[j][3];
            console.log("Digit13",digit13)
            var x='<tr id="rows"><td id="prf" value="'+arr[j][0]+'">'+arr[j][0]+'</td><td id="pos">'+arr[j][1]+'</td><td id="iid">'+arr[j][2]+'</td><td id="rid">'+arr[j][3]+'</td><td id="'+j+'4" >'+arr[j][4]+'</td><td id="'+j+'5" >'+arr[j][5]+'</td><td id="interviewername">'+arr[j][6]+'</td><td id="interviewermail">'+arr[j][7]+'</td><td><a name="'+arr[j][5]+'" id="'+j+'-'+digit13+'" class="btn green darken-1" onclick="joined(this.id,this.name)"> Accepted </a><a name="'+arr[j][5]+'" id="'+j+'-'+digit13+'" class="btn red darken-1" onclick="Rejected(this.id,this.name)"> Rejected </a></td></tr>'
            $('#rawdata').append(x);
          }
       }
      }

    }
  })
  

})

function joined(id,email)
{
  console.log("ID - ",id)
  console.log("Email - ",email)
  window.id = id;
  window.email = email;
  $("#datemodal").modal("open");
}

// function on click of confirm after joining
function confirmDate()
{
  if($("#joindate").val() != "")
  {
    $.ajax({
      url:'http://localhost/hrms/api/joined.php',
      type:'POST',
      data:{
        'id' : window.id,
        'email' : window.email,
        'date' : $("#joindate").val()
      },
      success: function(para)
      {
        console.log(para)
        if(para == "success")
        {
          document.location.reload();
        }
        else
        {
          alert("Some Error Occurred")
        }
      }
    })
  }
}  


function Rejected(id,email)
{
  window.id = id;
  window.email = email;
  $("#rejectmodal").modal("open");
}


// function on click of confirm after Rejection by candidate
function confirmReject()
{
  $.ajax({
    url:'http://localhost/hrms/api/rejectoffer.php',
    type:'POST',
    data:{
      'id' : window.id,
      'email' : window.email
    },
    success: function(para)
    {
      if(para == "success")
      {
        document.location.reload();
      }
      else
      {
        alert("Some Error Occurred")
      }
    }
  })
  
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