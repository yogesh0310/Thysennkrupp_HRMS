<?php
error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'api/db.php';

  $countPrfs = $db->prfs->count();
  $countHistory = $db->prfs->count(array("status"=>"completed"));
  $countInstances = $db->prfs->count(array("status"=>"open"));

  $countInitiate = $db->rounds->count(array("status"=>"bstart"));
  $countOngoing = $db->rounds->count(array("status"=>"invcomplete"));
  $countSchedule = $db->interviews->count(array("invstatus"=>"1"));
  $countInterviews = $db->interviews->count(array("status"=>"0"));
  $req = $db->intereval->count(array("offerletter"=>"requested"));
  $sent = $db->intereval->count(array("offerletter"=>"sent"));
  $countOffers = $req+$sent;


  $_SESSION['ongoings']=$countOngoing;



  
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg'];
    $name = $cursor['name'];

    
    if($designation == "hr" || $designation == "ceo" || $designation == "hod" || $designation == "rghead" )
    {
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
        
        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">

        <script src="public/jquery-3.2.1.min.js"></script>
    
        <script src="public/js/materialize.js"></script>
        <script src="public/js/materialize.min.js"></script>
        <script src="./public/js/logout.js"></script>

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
}
}
</style>

<body>
<div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000;overflow-y:hidden;overflow-y:hidden">

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
        <a href="#!" class="brand-logo left" style="margin-left: 2%;"><i id="showsidenbutton" class="material-icons">menu</i></a>
        <a href="http://localhost/hrms/" class="brand-logo center">thyssenkrupp Elevators</a>

        <ul style="float:right;">
          <li>
            <select id="logout"class="dropdown-trigger btn blue darken-1">
              <option value=""><?php echo($name) ?></option>
              <option value="profile" id="profile" onclick="">Profile</option>
              <option value="logout">Logout</option>
            </select>
          </li>
        </ul> 
      </div>
  </nav>
  <br><br>
  <!-- nav and side menu ended -->
  <!-- main card starts here -->
  <div class="row" id="attr">
    <div class="col s12 m12 ">
      <!-- <div class="card white"> -->
      <div class="card-content blue-text">
        <div class="row" id="cardsradius">
          <a href="http://localhost/hrms/csvupload.php">
              <div class="col  m6 s6">
                <div class="card " style="background: #536DFE">
                  <div class="card-content white-text">
                    <span class="card-title">Upload PRF Dump</span>
                    <br>Total PRFs : <?php echo $countPrfs; ?><p></p>
                  </div>
                  
                </div>
              </div>
          </a>

          <a href="http://localhost/hrms/hrnew.php">

              <div class="col  m6 s6">
                <div class="card " style="background: #EA5455;">
                  <div class="card-content white-text">
                    <span class="card-title">Open PRFs</span>
                    <br> Open PRFs : <?php echo $countInstances; ?> <p></p>
                  </div>

                  
                  
                </div>
              </div>

          </a> 
          </div>
          <div class="row" id="cardsradius">
          <a href="http://localhost/hrms/initiateround.php">
              <div class="col  m6 s6">
                <div class="card " style="background: #28C76F;">
                  <div class="card-content white-text">
                    <span class="card-title">Round Initiation</span>
                    <br> PRFs to be Initiated : <?php echo $countInitiate; ?>
                  </div>
                  
                </div>
              </div>
          </a>
          
          <a href="http://localhost/hrms/allocateround.php">

              <div class="col  m6 s6">
                <div class="card " style="background: #9F44D3;">
                  <div class="card-content white-text">
                    <span class="card-title">Ongoing Rounds  </span>
                    <br> Total Ongoing PRFs : <?php echo $countOngoing; ?><p></p>
                  </div>
                </div>
              </div>
          </a>

          <a href="http://localhost/hrms/history.php">

              <div class="col  m6 s6">
                <div class="card " style="background: #9F44D3;">
                  <div class="card-content white-text">
                    <span class="card-title">History  </span>
                    <br> Completed PRFs : <?php echo $countHistory; ?><p></p>
                  </div>
                </div>
              </div>
          </a>

          <a href="http://localhost/hrms/allocateround2.php">

              <div class="col  m6 s6">
                <div class="card " style="background: #28C76F; ">
                  <div class="card-content white-text">
                    <span class="card-title">Rescheduling  </span>
                    <br> Interviews to be Resheduled : <?php echo $countSchedule; ?><p></p>
                  </div>
                </div>
              </div>
          </a>

          <a href="http://localhost/hrms/interview.php">

              <div class="col  m6 s6">
                <div class="card " style="background: #677E8C">
                  <div class="card-content white-text">
                    <span class="card-title">Interview Updation  </span>
                    <br> Total Scheduled Interviews : <?php echo $countInterviews; ?><p></p>
                  </div>
                </div>
              </div>
          </a>

          <a href="http://localhost/hrms/offerletter.php">

              <div class="col  m6 s6">
                <div class="card " style="background: #EA5455; ">
                  <div class="card-content white-text">
                    <span class="card-title">Offer Letters  </span>
                    <br> Offer Letter Requests : <?php echo $countOffers; ?><p></p>
                  <!-- </div> -->
                </div>
              </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- main card ends here -->
<script src="public/js/common.js"></script>
<script>

$("#profile").click(function()
{
  document.location.replace("http://localhost/hrms/profile.php")
})


$( document ).ready(function() {
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
      console.log(para)
      if(para.general.ongoing_round > 0)
      {
        $('#badge_ongoing').text(para.general.ongoing_round);
        $('#badge_ongoing').show();
      }
      if(para.general.schdule_count  > 0)
      {
        $('#badge_rescheduling').text(para.general.schdule_count );
        $('#badge_rescheduling').show();
      }
      if(para.completeddata.olrequest+para.completeddata.completed > 0)
      {
        $('#badge_letter').text(para.completeddata.olrequest+para.completeddata.completed);
        $('#badge_letter').show();
      }
    }
  })
});


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
