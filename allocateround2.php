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
    <title>Rescheduling</title>

    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
        
        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">

    <script src="public/jquery-3.2.1.min.js"></script>
    <script src="./public/js/logout.js"></script>



    <script src="public/js/materialize.js"></script>
    <script src="public/js/materialize.min.js"></script>

<style>
.datepicker-controls .select-month input {
    width: 100px;
}
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
      <a class="modal-close waves-effect green btn" href="http://localhost/hrms/hrdash.php">OK<i class="material-icons left" >check_box</i></a>
      </center>
    </div>
  </div>
<!-- no data modal ends here -->

<div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000loverflow-y:hidden">

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

                  <div class="row">
                    <div class="col s12 m12">
                      <div class="white">
                        <div class="card-content blue-text">
                            <table class="striped">
                                <thead>
                                  <tr>
                                      <th>PRF-POSITION-INSTANCE-ROUND</th>
                                      <th>Department</th>
                                      <th>Zone</th> 
                                      <th>Position Details</th>
                                      <th>No. of Positions</th>
                                      <th>Interviewer Name</th>
                                      <th>Interviewer Mail Id</th>
                                      <th>Reason Of rejection</th>
                                      <th>Reshedule Round</th>
                                  </tr>
                                </thead>
                                <tbody id="addtr">
                                  
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <center>
                  <b><p id="pleasewait" style="color:red">Updating Information Please Wait...</p></b>
                  </center>

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
                                      <input id="imail" type="text" required>
                                      <label class="active" for="imail">Interviewer Mail ID</label>
                                    </div> 
                                    <div class="input-field col s3 m3 " >
                                          <input id="location" type="text" class="text" required>
                                          <label class="active" for="location" id="location">Interview Location</label>
                                        </div>
                                        <div class="input-field col s3 m3 " >
                                          <input id="contactperson" type="text" class="text" required>
                                          <label class="active" for="contactperson" id="contactperson">Contact Person Name</label>
                                        </div>
                                  </div>       
                                    <div class="row">
                                        <div class="input-field col s3 m3 " >
                                          <input id="idept" type="text" class="text" required>
                                          <label class="active" for="idept" id="idept">Interviewer Department</label>
                                        </div>                                    
                                        <div class="input-field col s3 m3 " >
                                          <input id="idesg" type="text" class="text" required>
                                          <label class="active" for="idesg" id="idesg">Interviewer Designation</label>
                                        </div>
                                       
                                        
                                    </div>          

                                
                                  <div class="row">
                                    <button class="btn waves-effect blue darken-1 col m3 s3 offset-m4" id='allocatesubmit'>Submit
                                    <i class="material-icons right">send</i>
                                    </button>
                                      
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <table class="striped">
                            <thead>
                              <tr>
                                <th>Mail ID</th>
                                <th>Old Date</th>
                                <th>New Date</th>
                                <th>Old Time</th>
                                <th>New Time</th>
                                <th>Select</th>
                                <th class="btn blue darken-1" id="submit">Assign Interviewer</th>
                              </tr>
                            </thead>
                            <tbody id="adddetail">
                              
                                  <div id="temp">

                                  </div>
                              
                            </tbody>
                          </table>

                        </div>          
                      </div>
                    </div>
                  </div>
                            
                  </div>                   
<center>
<p id="nodata"><b style="color:red;margin-left:12%">No Data Available..!</b></p>
</center>


<div id="loader">
  <div id="txt">
    <b>Please wait.. while we schedule this interview</b>
  </div>
</div>


<script src="public/js/common.js"></script>
<script>

var selectedmail = []
var allmail = []
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
     // para = {'ongoing':10,'rescheduling':5,"offerletter":0} 
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

  $("#nodata").hide()
  $('.modal').modal();
  $("#pleasewait").hide();
  $.ajax(
    {
      url:'http://localhost/hrms/api/rejectedinv.php',
      type:'POST',
      success:function(para){
        console.log(para)
      
      if(para != "nodata")
      {
       var arr =  JSON.parse(para)
        for(let i =0;i<arr.length;i++)
        {
          var intvmail=arr[i]['intvmail'];
          var reason=arr[i]['reason'];
          console.log(reason)
          var appended=arr[i]['prf']+"-"+arr[i]['position']+"-"+arr[i]['iid']+"-"+arr[i]['rid'];
          // alert(appended);
          var s1='<tr id="'+appended+'row">'
          var s6='<tr id="intvmail row">'
          var s7='<tr id="reason row">'
          var s2='<td>'+appended+'</td><td>'+arr[i]['posdetails']+'</td><td>'+arr[i]['zone']+'</td><td>'+arr[i]['dept']+'</td><td>'+arr[i]['position']+'</td>'
          var s3='<td>'+arr[i]['invname']+'</td><td>'
          var s8='<p >'+arr[i]['intvmail']+'</p></td><td>'
          var s9='<p >'+reason+'</p></td><td>'
        
          var s4='<button class="waves-effect green  btn"  id='+appended+'*'+intvmail+' onclick="createnextround(this.id)">Reshedule Round</button></td></tr>'
          var str=s1+s2+s3+s8+s9+s4
           $('#addtr').append(str)
        }
      }
      else
      {
        $("#nodatamodal").modal("open");
        $("#nodata").fadeIn(600);
      }
      }
  });

  $('.datepicker').datepicker
  ({
    minDate:new Date(),
  })
  
  $('.timepicker').timepicker();
  $('#allocation').hide();
  $('#allocatingcandidate').hide();

  //final assignment for interviwer,date and time
  counter=1;

  $('#submit').click(function(){
    if(selectedmail.length <= 0 && counter == 1)
    {
      alert("Please Select Atleast 1 Member")
    }
    else
    {
      counter=1;
    
    var iid=window.iid;
     var oldintv=window.intvmail;
    
    //var oldintv=intvmail;
    for(let i=0;i<selectedmail.length;i++)
    {
     //console.log(window.iid)
     
    }
 

    $('#allocation').show(600);
    $('#allocatesubmit').click(function(){
      console.log(iid);
      $('#loader').show();
      // alert("Old " +oldintv);
      var imail = $('#imail').val();
      var iname = $('#iname').val();
     
      var idept = $('#idept').val();
      var idesg = $('#idesg').val();
      var iloc = $('#location').val();
      var iperson = $('#contactperson').val();
      // alert("new " +iname);
      console.log(selectedmail)
      $('#allocation').hide(600);
      $("#pleasewait").fadeIn(600);
      $.ajax({
        url:'http://localhost/hrms/api/updateintv.php',
        type:'POST',
        data:{
          //dept needed to be submitted
          'oldintv':oldintv,
          'emails':selectedmail,
          'intv':imail,  
          'dates':dates,
          'times':times,
          'prf':iid,
          'iname':iname,
          "idesg":idesg,
          "idept":idept,
          "iloc":iloc,
          "iperson":iperson
        },
        success:function(para){
          // alert(JSON.parse(para))
          console.log("After execution - "+para)
       //   console.log("This is the para after interbiew = ",para)
          for(let i=0;i<selectedmail.length;i++)
            {
             var ml = selectedmail[i];
             var id = allmail.indexOf(ml) 
             var str='#check'+id+'row';
              $(str).remove();
              //document.location.reload();
              $("#pleasewait").hide();
            }
            selectedmail = []
            $('#loader').hide();
            window.setTimeout(function(){location.reload()},1000)

        }
      })
    })
  }  
  })
})
//end of document.ready(function)   

dates = []
times = []
var ctr=0
function selection(x)
{
 
  var b = '#'+x
  var y ='#'+x+'mail'  
 var dateid = '#'+x+'date21';
 var timeid = '#'+x+'tp1';

console.log("Date id" + $(dateid).val())
console.log("Time id"+timeid)
  if($(b).prop("checked") == true)
  {
    selectedmail.push($(y).text())
    dates.push($(dateid).val())
    times.push($(timeid).val())
    console.log(selectedmail)
    console.log(dates)
    console.log(times)

  }
  else
  {                                               
    for( var i = 0; i < selectedmail.length; i++)
    { 
      if (selectedmail[i] === $(y).text()) 
      {
        selectedmail.splice(i, 1); 
        dates.splice(i, 1); 
        times.splice(i, 1); 
        i--;
      }
    }
    console.log(selectedmail)
    console.log(dates)
    console.log(times)
  }
}

var id_round
function createnextround(ids)
{
  console.log(ids)
  var res = ids.split("*");
  var id=res[0]
  var intvmail=res[1]
  window.intvmail=intvmail
  window.iid=id;
  id_round = id
  // alert("this is id : "+id)
  // alert("this is mail : "+intvmail)
  //alert("this is reason : "+reason)
  console.log(id_round)
  console.log(intvmail)

  $('#allocatingcandidate').slideDown(600);
 
  $.ajax({
    url:'http://localhost/hrms/api/invrejectroundmembs.php',
    type:'POST',
    data:{
          "id":id_round,
          "intvmail":intvmail
         },
    success:function(para)
    {
      //var p1='<b>Reason : '+reason+'<b>'
      //$('#rid').replaceWith(p1);  
      $('#adddetail').text("")
      // console.log("mails : "+para.members)
      var arr = JSON.parse(para)
      console.log("this are rejected round mamnreafs = ",arr)

      console.log("mails :> "+para)
      $('#iname').val(arr.invname)
      $('#imail').val(arr.intvmail)
      $('#location').val(arr.ilocation)
      $('#contactperson').val(arr.iperson)
      $('#idept').val(arr.dept)
      $('#idesg').val(arr.designation)
      
      M.updateTextFields();
      for(let i =0;i<(arr.members).length;i++)
      {

        allmail[i] = arr.members[i];

        var s1='<tr id="check'+i+'row"><td><p id="check'+i+'mail">'+arr.members[i]+'</p></td>'
        var txt2 = '<td><input style="width:70%;" id="check'+i+'date2" disabled value="'+arr.dates[i]+'" class="datepicker" ></td>'
        var txt3 = '<td><input style="width:70%;" id="check'+i+'date21" value="'+arr.moddates[i]+'" class="datepicker" ></td>'
        var txt4 = '<td><input style="width:70%;" type="text" style="width:50%;" disabled id="check'+i+'tp" value="'+arr.times[i]+'" class="timepicker"></td>'
        var txt5 = '<td><input style="width:70%;" type="text" style="width:50%;" id="check'+i+'tp1" value="'+arr.modtimes[i]+'" class="timepicker"></td>'
        var s2='<td><label><input type="checkbox" class="filled-in" id="check'+i+'" onclick="selection(this.id)"/>'
        var s3='<span class="blue-text darken-1" ></span></label></td></tr>'
        var str=s1+txt2+txt3+txt4+txt5+s2+s3
       
        $('#adddetail').append(str)
        $('.timepicker').timepicker();
        $('.datepicker').datepicker();
      }
    }
  })
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
