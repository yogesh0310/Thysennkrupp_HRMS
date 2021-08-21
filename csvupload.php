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

           
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #loader {
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          width: 100%;
          background: rgba(0,0,0,0.97)  url(loader2.gif)  no-repeat center center !important;
          z-index: 10000;
        }
        #loader > #txt{
                font-size:25px;
                margin-left:28% !important;
                margin-top:18% !important; 
        }
    input[type="file"] {
    display: none;
    }
    </style>
</head>
<body>
<div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000;overflow-y:hidden">

  <h3 class="w3-bar-item white"> <center>
  <a href="http://localhost/hrms/">Home</a><i id="remin" class="material-icons" style="float: right;cursor: pointer;">close</i></center>  
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

    <!-- card stars -->
    <div class="row" id="forms">
        <div class="col s12 m6 offset-m3">
            <div class="card white">
                <div class="card-content blue-text">
                <a class="btn red modal-trigger" href="#modal1" style="float:right;" id="mymodal">CSV FILE FORMAT</a>
                <span class="card-title">Upload Dump</span>
                <p>Upload csv dump here consisting of all the previous data.<br>
                    Once the file is uploaded
                 cannot be changed.   
                </p>

                <form method="post" action="" enctype="multipart/form-data" id="myform">
                            
                    <div class="input-field col s12 offset-m4" id="uphoto">
                            
                            <label class="custom-file-upload" id="prof">
                                <a class="btn blue darken-1">
                                <input id="uploadcsv" required type="file" accept=".csv" name="uploadcsv" onchange="readURL(this)"><p id='myfile0'> Select file<i class="material-icons right">open_in_browser</i> </p></a>
                            </label>
                            <br><br><br> &nbsp;&nbsp;&nbsp;
                    <!-- <button type="submit" class="btn blue darken-1" name="submit" id="formsub" value="Upload"><i class="material-icons right">send</i>Upload</button> -->
                    <!-- <button  class="btn blue darken-1"  name="submit" id="formsub">Upload<i class="material-icons right">send</i></button> -->
                    <input type="button" class="btn blue darken-1" value="Upload" id="but_upload"> </input>
                    </div>
                </form>
                <br><br><br><br><br>
                </div>

            </div>
        </div>
  </div>
    <!-- card ends -->
    </div>
<div class="success">

</div>
    <div id="loader">
      <div id="txt">
              <b>Please wait while we add entries to the system</b>
      </div>
    </div>


    <div id="modal1" class="modal" style="width:90%;">
    <div class="modal-content">
        
      <table style="border-radius:5px solid black;" class="white-text teal">
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
       
      </table>
      
    </div>
    <div class="modal-footer">
    <b class="red-text">Please ensure that the CSV file to be uploaded must have above columns only</b>   <br>
    <a href="./formats/prfdumpformat.csv"  class="modal-close waves-effect waves-green btn-flat" style="color:green" download>Download</a>
  
    </div>
    
   
  </div>








    <script src="public/js/common.js"></script>

  <script>
  
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
  });
  // functionality for notification ends here
  $(".modal").modal();

  console.log("Hello document");
  $("#loader").hide();



//Form Submit
  $("#but_upload").click(function(){
  

  console.log("This is form submit")


        if( document.getElementById("uploadcsv").files.length == 0 ){
          alert("Please select a file");
        }
        else
        {
              $("#loader").show();
              var fd = new FormData();
              var files = $('#uploadcsv')[0].files[0];
              fd.append('uploadcsv',files);
              console.log("This is  - ",fd)
              $.ajax({
                  url: 'http://localhost/hrms/importExcel.php',
                  type: 'post',
                  data: fd,
                  contentType: false,
                  processData: false,
                  success: function(response){
                    response = response.trim()
                    console.log("Response",response)
                     
                      if(response != "error"){

                        $("#loader").hide();
                        $('#forms').hide()
                          if(response == "No")
                          {
                              s1 = '<div class="row">'
                              s2 = '<div class="col s12 m6 offset-m3">'
                              s3 = '<div class="card white">'
                              s4 = ' <div class="card-content blue-text">'
                              s5 = '<center><span class="card-title" >Please upload the file in the given format </span></center>'
                              s7 = '</div></div></div></div>'
                              s8 = s1+s2+s3+s4+s4+s5+s7;
                              $('.success').append(s8)
                              window.setTimeout(function(){location.reload()},3000)
                          }
                          else
                          {
                              s1 = '<div class="row">'
                              s2 = '<div class="col s12 m6 offset-m3">'
                              s3 = '<div class="card white">'
                              s4 = ' <div class="card-content blue-text">'
                              s5 = '<span class="card-title">Upload Dump Status :'+response+' New Entries added </span>'
                              s7 = '</div></div></div></div>'
                              s8 = s1+s2+s3+s4+s4+s5+s7;
                              $('.success').append(s8)
                              window.setTimeout(function(){location.reload()},3000)
                          }
                       
                         
                      }
                      else if(response == "error"){
                          alert('file not uploaded');
                      }
                  },
              });
        }
        
})
  





})

//   $("#myform").submit(function(){
//         console.log("Hello")
       
// })
function readURL(input) {
  var f = $('#uploadcsv').val().split('.')
  
      var x=f[1]
      if(x=='csv')
      {
        var filename = $('#uploadcsv').val().replace(/^.*[\\\/]/, '')
        $('#myfile0').text(filename)
      }
      else
      {
        alert('Invalid File\n Only CSV Files Accepted')
        $('#uploadcsv').val(" ")
      }
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
       