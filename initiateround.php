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

    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
        
        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">

    <script src="public/jquery-3.2.1.min.js"></script>
    <script src="./public/js/logout.js"></script>

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
  background: rgba(0,0,0,0.95)  url(loader2.gif)  no-repeat center center !important;
  z-index: 10000;
}
#loader > #txt{
  font-size:23px;
  color:lightskyblue;
  margin-left:31% !important;
  margin-top:18% !important; 
}

#notified {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.95)  url(loader2.gif)  no-repeat center center !important;
  z-index: 10000;
}
#notified > #txt{
  font-size:23px;
  color:lightskyblue;
  margin-left:31% !important;
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

<!-- refresh data modal starts here -->
  <!-- Modal Structure -->
  <div id="refreshmodal" class="modal">
    <div class="modal-content">
      <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
      <br>
      
      <center><h2>Please Wait Refreshing</h2></center>
      
    </div>

  </div>
<!-- refresh data modal ends here -->

<!-- modal 2 starts here -->
<div id="modal2" class="modal">
    <div class="modal-content">
      <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
      <br>
      
      <center><h2>Are You Sure ?</h2></center>
      <center><p>Interviewer Will be Assigned to the candidate(s)</p></center>
    </div>
    <div class="modal-footer">
      <center>
      <a onclick="allocateSubmit(true)" class="modal-close waves-effect green btn" >Confirm<i class="material-icons left" >check_box</i></a>
      <a onclick="allocateSubmit(false)" class="modal-close waves-effect red btn">Cancel<i class="material-icons left">highlight_off</i></a>
      </center>
    </div>
  </div>
<!-- modal 2 ends here -->

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
                  

                  <br><br>

                  <div class="row">
                    <div class="col s12 m12">
                      <div class="card  white">
                        <div class="card-content blue-text">
                            <table class="striped">
                                <thead>
                                  <tr>
                                  <th>PRF-POSITION-INSTANCE-ROUND</th>
                                      <th>Position Details</th>
                                      <th>Zone</th>
                                      <th>Department</th>
                                      <th>No. of Positions</th>
                                      <th>Initiate Round</th>
                                  </tr>
                                </thead>
                                <tbody id="addtr">
                                  
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <center id="nodata">
                  <b style="color:red">No Data Available..!!</b>
                  </center>
                  <center>
                  <b><p id="pleasewait" style="color:red">Updating Information Please Wait...</p></b>

                  </center>
                  <u><b id="nomems"  style="color:red;margin-left:30%;font-size:20px;cursor:pointer;"> Application Blank Not Submitted By The Members </b></u>
                  <br> <br>
                  <b id="expiry"  style="color:green;margin-left:35%;font-size:20px;cursor:pointer;"> Form Validity </b>

                  <div class="row">
                    <div class="col s5 offset-m3" id=showmembersdiv>
                  

                      <table class="stripped">
                      <thead>
                        <tr class="blue darken-1 white-text">
                          <br>
                          <th>Sr No.</th>
                          <th>Name</th>
                          <th>Email ID &nbsp;&nbsp; <button id="notify" class="waves-effect orange  btn">Notify candidates</button>
                        </tr>
                      </thead>
                      
                      <tbody id="memberstable">
                      </tbody>
                      </table>
                    </div>
                  </div>


                  <div class="row" id="allocatingcandidate" >
                    <div class="col s12 m12">
                      <div class="card  white">
                        <div class="card-content blue-text">
                          <p id='rid' style="display:inline;"><b></b></p>
                         
                          <div class="row" id="allocation" >
                            <div class="col s12 m12" style="border: solid 5p">
                              <div class="card white">
                              <div class="row">
                              <div class="input-field col s3 m3 " >
                              <select id='intchoice' class="dropdown-trigger btn blue darken-1 " onchange="feedvalue(this)">
                              <option id="NO" value=""  style="color: white">Location</option>
                              <option id="01-Head Quarter-Pune" value="Plot No. A-23, MIDC Chakan , Phase II Village Khalunmbre, Tal. Khed District Pune Maharashtra-410501"  style="color: white">01-Head Quarter-Pune</option>
                              
                              <option id="01-Head Quarter-Mumbai" value="A-24, Vardhan House, Street No. 3 M.I.D.C. Andheri(E) Mumbai Maharashtra-400093" style="color: white">01-Head Quarter-Mumbai</option>
                              <option id="07-Delhi Branch"  value="429, Functional Industrial Estate Patparganj New Delhi Delhi-110092" style="color: white">07-Delhi Branch</option>
                              <option id="08-Lucknow Branch"  value="415 A/B/C, Cyber Heights Vibhuti Khand, Gomti Nagar Lucknow Uttar Pradesh-226010" style="color: white">08-Lucknow Branch</option>
                              <option id="09-Jaipur Branch"  value="Rajwada Palace, Barwada House Colony Ajmer Road, Civil Line Jaipur Rajasthan-302006" style="color: white">09-Jaipur Branch</option>
                              <option id="10-Chandigarh Branch"  value="Plot No.422, Sector-82 JLPL Industrial Area, Airport Road Mohali (SAS Nagar) Punjab-160065" style="color: white">10-Chandigarh Branch</option>
                              <option id="11-Gurugram Branch" value="Unit No. 808, 809, 810, 8th Floor Paras Trinity, Sector-63, Golf Course Road Extension Gurugram Haryana-122018"  style="color: white">11-Gurugram Branch</option>
                              <option id="13-Noida Branch"  value="D-23, Ground Floor Sector-63 Noida Uttar Pradesh-201307"  style="color: white">13-Noida Branch</option>
                              <option id="26-Kolkata Regional HQ"  value="Malik Court, 3rd Floor 39A, Harish Mukherjee Road Kolkata West Bengal-700025"  style="color: white">26-Kolkata Regional HQ</option>
                              <option id="27-Kolkata Branch"  value="M-3/20, Shree Krishna Puri Basawan Park Patna Bihar-800001"  style="color: white">27-Kolkata Branch</option>
                              <option id="28-Bhubaneswar Branch"  value="Plot No: 1A, Udyan Marg Forest Park Bhubaneswar Orissa-751009"  style="color: white">28-Bhubaneswar Branch</option>
                              <option id="29-Guwahati Branch"  value="House No. 23, Ganapati Bhawan, S. K. Baruah Road Distt. Kamrup, Rukminigaon Guwahati Assam-781022"  style="color: white">29-Guwahati Branch</option>
                              <option id="31-Jamshedpur Branch"  value="72 New Barduari, Sakchi Jamshedpur Jharkhand-831001"  style="color: white">31-Jamshedpur Branch</option>
                              <option id="37-Bengaluru Branch"  value="No.18 (CITB 127), 11th  Main, 33rd Cross 4th  Block,  East  Jayanagar Bengaluru Karnataka-560011"  style="color: white">37-Bengaluru Branch</option>
                              <option id="38-Hydrabad Branch"  value="S.C.B. D.No : 6-03-063, Phase -1, Plot No.25Ground Floor, Bandan Arcade Chandragiri Colony, Trimulgherry Secunderabad Telangana-500015"style="color: white">38-Hydrabad Branch</option>
                              <option id="39-Mangalore Branch"  value="2-1-1(2), Kulur Ferry Road Commercial Complex, 2nd Floor, Opp. More Super Market, Chilimbi Mangalore Karnataka-575006"  style="color: white">39-Mangalore Branch</option>
                              <option id="40-Goa Branch"  value="Shree Plaza, Shop No.308, 309, 310, Third Floor Near Damodar High School, Comba Margao  Goa-403601"  style="color: white">40-Goa Branch</option>
                              <option id="42-Chennai Branch"  value="No.5/84-1, (Butt Road) Mount Poonamalle Road, St. Thomas Mount Chennai Tamilnadu-600016"  style="color: white">42-Chennai Branch</option>
                              <option id="44-Coimbatore Branch"  value="No.G-S-370 Lalbagadhur Colony, Peelamedu Coimbatore Tamilnadu-641004"  style="color: white">44-Coimbatore Branch</option>
                              <option id="46-Cochin Branch"  value="TC-4/477, ATRRA-118, Kousthubham Rangoon Line, Toll Junction, Kawdiar Thiruvananthapuram Kerala-695003"  style="color: white">46-Cochin Branch</option>
                              <option id="47-Calicut Branch"  value="No. 53/2088, Ground Floor, 'Sree Parvathy' Near Kanakalaya Bank, Kannur Riad, West Hill Post Calicut Kerala-673005"  style="color: white">47-Calicut Branch</option>
                              <option id="82-Pune Branch"  value="703, 7th floor, Building-A, East Court Next to Phoenix Mall, Viman Nagar Pune Maharashtra-411041"  style="color: white">82-Pune Branch</option>
                              <option id="85-Indore Branch"  value="Plot No 582, Near 56 Shops M.G. Road Indore Madhya Pradesh-452001"  style="color: white">85-Indore Branch</option>
                              <option id="87-Gujarat Branch"  value="Office No.204, Suyojan Building Near President Hotel, C.G. Road Ahmedabad Gujarat-380006"  style="color: white">87-Gujarat Branch</option>
                              <option id="90-Chattishgarh Branch"  value="Plot No. 44 Navjeevan Colony, Wardha Road Nagpur Maharashtra-440015"  style="color: white">90-Chattishgarh Branch</option>
                              <option id="94-Navi Mumbai Branch"  value="Unit No.302, 3rd Floor, Ellora Fiesta Plot No.8, Sector 11, Juinagar-West, Opposite Juinagar Station Navi Mumbai Maharashtra-400705"style="color: white">94-Navi Mumbai Branch</option>
                             
                                
                               </select>
                               

                               
                               </div></div>
                                <div class="card-content blue-text">
                                  <div class="row">
                                    <div class="input-field col s4 m4 " >
                                      Interviewer Name: <input id="iname" type="text" class="text">
                                     </div>           
                                    <div class="input-field col s4 m4" >
                                      Interviewer Mail Id: <input id="imail" type="text" required>
                                      </div> 

                                      <div class="input-field col s4 m4 " >
                                        Interviewer Designation:  <input id="idesg" type="text" class="text" required>
                                        </div>
                                      </div>
                                      <div class="row">
                                      
                                    
                                      
                                      <div class="input-field col s4 m4 " >
                                        Contact Person Name:  <input id="contactperson" type="text" class="text" required>
                                          </div> 

                                          <div class="input-field col s4 m4 " >
                                        Interviewer Department:  <input id="idept" type="text" class="text" required>
                                        </div>   

                                                                    
                                       
                                    
                                        
                                  </div>       
                                    <div class="row">
                                            
                                    <div class="input-field col s3 m3 " >
                                        Interviewer Location:  <input id="loc" type="text" class="text" required>
                                        </div>                                    
                                       
                                       

                                         <div class="input-field col s9 m9" >
                                      Interview Address: <input id="iadd" type="text" required>
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
                          <button class="btn waves-effect green" style="float:right;margin-bottom: 10px;" id="rfresh" onclick="getit()">Refresh</button>
                          
                          <table class="striped">
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>Mail ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Select</th>
                                <th class="btn blue darken-1" name="submit" id="submit" disabled>Assign Interviewer</th>
                                <th class="btn red" style="margin-left: 25px;" id="abort" onclick='$("#modal1").modal("open")'> Abort</th>
                                
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
                  <div id="loader">
                    <div id="txt">
                      <b>Please wait.. while we schedule this interview</b>
                    </div>
                  </div>
                  
                  <div id="notified">
                    <div id="txt">
                      <b>Sending a reminder mail to these candidates..</b>
                    </div>
                  </div>
    </div>        
                          
    <style>
    html{
    scroll-behaviour:smooth;

  }
    </style>
    <script src="public/js/common.js"></script>

<script>
$("#nomems").hide()
$("#expiry").hide()

var id_round = "0";
var selectedmail = []
var selectedmailID = []
var selecteddate = []
var selecteddate2 = []
var timearray=[]
var allmail = []
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
  $("#nomems").hide()
  $("#expiry").hide()
  $("#showmembersdiv").hide()
  $("#loader").hide()
  $("#notified").hide()
  
  $('.datepicker').datepicker();
  $('.timepicker').timepicker();
  $('.modal').modal();

  // $("#rfresh").click(function(){
  //   window.setTimeout(function(){location.reload()},1000)
  // })

  $("#nodata").hide()
  $("#pleasewait").hide();
  $.ajax(
    {
      url:'http://localhost/hrms/api/baserounds.php',
      type:'POST',
      success:function(para){
      if(para != "no data")
      {
       $("#nodata").hide()
       var arr =  JSON.parse(para)
       console.log(arr)
       
        for(let i =0;i<arr.length;i++)
        {
          var appended=arr[i].prf+"-"+arr[i].pos+"-"+arr[i].iid+"-"+arr[i].rid
          var appended2=arr[i].prf+"/"+arr[i].pos+"/"+arr[i].iid+"/"+arr[i].rid+"/"+arr[i].dept+"/"+arr[i].poszone;
          console.log(appended2)
          var s1='<tr id="'+appended+'row">'
          var s2='<td><b>'+appended+'</b></td><td>'+arr[i].position+'</td><td>'+arr[i].poszone+'</td><td>'+arr[i].dept+'</td><td>'+arr[i].pos+'</td>'
          var s4='<td><button class="waves-effect green  btn"  id="'+appended2+'" onclick="createnextround(this.id)">Initiate Round</button></td></tr>'
          var str=s1+s2+s4
           $('#addtr').append(str)
        }
      }
      
      else
      {
        $("#nodatamodal").modal("open");
        console.log("No Data Found")
        $("#nodata").fadeIn(400)
      }
      }
    });



  
  
  $('#allocation').hide();
  $('#allocatingcandidate').hide();

  //final assignment for interviwer,date and time  
  $('#submit').click(function(){
    
    // console.log("Length of selecteddate "+selecteddate.length)
    var iid=window.iid;
    if(selectedmail.length <= 0 )
    {
      alert("Please Select Atleast 1 Member")
    }
    else
    {
    for(let i=0;i<selectedmail.length;i++)
    {
     console.log(window.iid)
     
    }

    $('#allocation').show(600);
    $.ajax({
    url:'http://localhost/hrms/api/getinterviewers.php',
    type:'POST',
    success:function(para)
    { 
      para = JSON.parse(para)
      names=para.names
      console.log("this is para :",para)
      para=para.interviewers
      // for(i=0;i<para.length;i++)
      //  {
      //    var str = '<option id="'+para[i]+'"  value="'+para[i]+'"  style="color: white">'+names[i]+'</option>'
      //     $('#intchoice').append(str);

      //  }
      

    }
  })

    }
  
  })

  $('#allocatesubmit').click(function(){
    $("#modal2").modal("open");

   

  })


})
//end of document.ready(function)   

function feedvalue(select){

 // console.log("selected "+id)
  var interviewer=select.options[select.selectedIndex].getAttribute("id");
  console.log("Location"+interviewer)
  document.getElementById("loc").value=interviewer
  var sel = document.getElementById(interviewer);
  console.log("adress",sel.value)
  document.getElementById("iadd").value=sel.value






  

}

function allocateSubmit(cnfrm)
{
  if(cnfrm)
  {
    var imail = $('#imail').val();
      var iname = $('#iname').val();
      var idept = $('#idept').val();
      var idesg = $('#idesg').val();
      var iloc = $('#loc').val();
      var iperson = $('#contactperson').val();
      var address=$('#iadd').val()
      var posdept = window.dept
      var poszone = window.zone
      var candidatetime
    
      if(imail != "" && iname != "" && idept != "" && idesg != "" && iperson != "" && iloc != "")
      {
        $("#loader").show()
        $('#allocation').hide(600);
        $("#pleasewait").fadeIn(600);
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
        url:'http://localhost/hrms/api/interviewer.php',
        type:'POST',
        data:{
          //dept needed to be submitted
          'emails':selectedmail,
          'times':selecteddate,
          'dates':selecteddate2,
          'intv':imail,
          'prf':iid,
          'iname':iname,
          "idesg":idesg,
          "idept":idept,
          "iloc":iloc,
          "iperson":iperson,
          "dept":posdept,
          "poszone":poszone,
          "address":address

        },
        success:function(para){
          
          console.log("This is the para after interbiew = ",para)
          for(let i=0;i<selectedmail.length;i++)
            {
             var ml = selectedmail[i];
             var id = allmail.indexOf(ml) 
             var str='#check'+id+'row';
             
              $(str).remove();
              //document.location.reload();
              $("#pleasewait").hide();
              $("#loader").hide();
               window.setTimeout(function(){location.reload()},1000)

            }
            selectedmail = []
            selecteddate = []
            selecteddate2 = []
            selectedmailID=[]
        }
      })
      }
      else
      {
        alert("Please Fill All Data")
      }
  }
}
var ctr=0
function selection(x)
{
  $('#submit').attr('disabled',false)
 
  var b = '#'+x
  var y ='#'+x+'mail'  
 
  if($(b).prop("checked") == true)
  {
    if($(b+"date").val() !="" && $(b+"date2").val() !="" )
    {
        // $(b).prop("checked")=false
        // alert("Date not entered");
        selectedmail.push($(y).text())
        selectedmailID.push(b)
        console.log('mail:'+selectedmail)
        console.log('ID:'+selectedmailID)
    }
    else
    {
      $(b).prop("checked",false)
      alert("Date not entered");
    }
  }
  else
  {                                               
    for( var i = 0; i < selectedmail.length; i++)
    { 
      if ( selectedmail[i] === $(y).text()) 
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

//add interviewers



var id_round

function createnextround(id)
{
  $("#nomems").empty()
  
  // $('.timepicker').timepicker();
  window.iid=id;
  console.log(iid)
  id = id.split("/")
  id_round = id[0]+"-"+id[1]+"-"+id[2]+"-"+id[3]

  //dept zone added to database
  window.dept = id[4]
  window.zone = id[5]
  // console.log(zone)
  console.log(id_round)
  
  var p1='<b id="rid">ID:'+id_round+'<b>'
  $('#showmembersdiv').hide(); 
  $('#rid').replaceWith(p1);
  $.ajax({
    url:'http://localhost/hrms/api/baseroundmembers.php',
    type:'POST',
    data:{
          "id":id_round
         },
    success:function(para)
    {
      $('#allocatingcandidate').fadeIn(600);
      para = JSON.parse(para)
      var arr1=[]
      var toggle = 0   
      //  
      $("#nomems").click(function()
      {
        $("#memberstable").empty()
        if(toggle == 0)
        {
          toggle = 1
          $("#showmembersdiv").fadeIn(1200);
            for(let i=0;i<para[1];i++)
            {
              console.log("Members - "+para[2][i])
              j = parseInt(i)
              j += 1
              var membersdata='<tr><td>'+j+'</td><td>'+para[2][i][0]+'</td><td>'+para[2][i][1]+'</td</tr>'
              $("#memberstable").append(membersdata)
            }
        }
        else
        {
          toggle = 0
          $("#showmembersdiv").fadeOut(100);

        }    
      })
      $("#notify").click(function()
      {
        $("#notified").show()
        console.log("Notified");
        $.ajax({
        url:'http://localhost/hrms/api/resendappblank.php',
        type:'POST',
        data:{
              "id":id_round,
              "emails":para[2]
            },
        success:function(para)
        {
          if(para == "success")
          {
              $("#notified").hide()
              window.setTimeout(function(){location.reload()},1000)
          }
          else
          {
              $("#notified").hide()
              window.setTimeout(function(){location.reload()},1000)
          }
        }
        })
      })
       console.log("this are base round mems  = ",para)

       if(para[0] == null)
       {
         $("#submit").hide()
         $("#abort").hide()
         $("#nomems").text("Application Blank Not Submitted By "+para[1]+" Member(s)")
         $("#nomems").show()

        if(para[3] == "expired")
        {
          $("#expiry").text("Form Expired")
          $("#expiry").show()
        }
        else
        {
          $("#expiry").text("After "+para[3]+" Day(s) Form Will Expire")
          $("#expiry").show()
        }
       }
      else if(para[1] != 0)
      {
        $("#nomems").text("Application Blank Not Submitted By "+para[1]+" Member(s)")
        $("#nomems").show()

        if(para[3] == "expired")
        {
          $("#expiry").text("Form Expired")
          $("#expiry").show()
        }
        else
        {
          $("#expiry").text("After "+para[3]+" Day(s) Form Will Expire")
          $("#expiry").show()
        }

      $('#adddetail').text("")
      var arr = para[0]
      // $('.timepicker').timepicker();
      for(let i =0;i<arr.length;i++)
      {
        allmail[i] = arr[i];
        console.log("Name 1 - ",allmail[i][0]);
        console.log("Email - ",allmail[i][1]);
        var s1='<tr id="check'+i+'row">'
        var s2='<td><a href="http://localhost/hrms/applicationblank_readonly.php?aid='+arr[i][1]+'"  target="_blank" ><p >'+arr[i][0]+'</p></a></td>'
        var s3 ='<td><p id="check'+i+'mail">'+arr[i][1]+'</p></td>'
        var s4='<td><input id="check'+i+'date" class="timepicker" ></td>'
        var s5 ='<td><input id="check'+i+'date2" class="datepicker" ></td>'
        var s6='<td><label><input type="checkbox" class="filled-in" id="check'+i+'" onclick="selection(this.id)">'
        var s7='<span class="blue-text darken-1" ></span></label></td></tr>'
          
        var str=s1+s2+s3+s5+s4+s6+s7
       
        $('#adddetail').append(str)
        $('.timepicker').timepicker();
        $('.datepicker').datepicker({
          minDate:new Date()
        });
        
      }
      
    }
    else
    {
      $("#nomems").hide()
 
 
      $('#adddetail').text("")
      var arr = para[0]
  
      for(let i =0;i<arr.length;i++)
      {
        allmail[i] = arr[i];
        console.log("Name - ",allmail[i][0]);
        console.log("Email - ",allmail[i][1]);
        var s1='<tr id="check'+i+'row">'
        var s2='<td><a href="http://localhost/hrms/applicationblank_readonly.php?aid='+arr[i][1]+'"  target="_blank" ><p >'+arr[i][0]+'</p></a></td>'
        var s3 ='<td><p id="check'+i+'mail">'+arr[i][1]+'</p></td>'
        var s4='<td><input id="check'+i+'date" class="timepicker" ></td>'
        var s5 ='<td><input id="check'+i+'date2" class="datepicker" ></td>'
        var s6='<td><label><input type="checkbox" class="filled-in" id="check'+i+'" onclick="selection(this.id)">'
        var s7='<span class="blue-text darken-1" ></span></label></td></tr>'
        var str=s1+s2+s3+s5+s4+s6+s7
       
        $('#adddetail').append(str)
        $('.timepicker').timepicker();
        $('.datepicker').datepicker({
          minDate:new Date()
        });
      }
    }
    }
  })
  $(document).scrollTop($(document).height())   ;

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




function abort_round(confr)
{
  
  if(confr)
  {
 
    $.ajax({
      url:"http://localhost/hrms/api/abortround.php",
      type:"POST",
      data: {
        "digit13" :  id_round
      },
      success:function(para){
        console.log(para)
        if(para=="success")
        {
          document.location.reload();
        }
        else
        {
          console.log("something went wrong")
        }
      } 
    })
  
  }

}

function getit(){
  
  var cutme = $('#rid').text();
  cutme = cutme.split(":");
  cutme = cutme[1];
  console.log(cutme)

  $("#nomems").empty()

  console.log("cutme   = = ",cutme)
  $('#showmembersdiv').hide()
  
  $("#refreshmodal").modal("open");
  $.ajax({
    url:'http://localhost/hrms/api/baseroundmembers.php',
    type:'POST',
    data:{
          "id": cutme
         },
    success:function(para)
    {
      $("#refreshmodal").modal("close");
      $('#allocatingcandidate').fadeIn(600);
      para = JSON.parse(para)
      var arr1=[]
      var toggle = 0   
      //  
      $("#nomems").click(function()
      {
        $("#memberstable").empty()
        if(toggle == 0)
        {
          toggle = 1
          $("#showmembersdiv").fadeIn(1200);
            for(let i=0;i<para[1];i++)
            {
              j = parseInt(i)
              j += 1
              var membersdata='<tr><td>'+j+'</td><td>'+para[2][i][0]+'</td><td>'+para[2][i][1]+'</td</tr>'
              $("#memberstable").append(membersdata)
            }
        }
        else
        {
          toggle = 0
          $("#showmembersdiv").fadeOut(100);

        }    
      })
       console.log("this are base round mems  = ",para)

       if(para[0] == null)
       {
         $("#submit").hide()
         $("#abort").hide()
         $("#nomems").text("Application Blank Not Submitted By "+para[1]+" Member(s)")
         $("#nomems").show()

        if(para[3] == "expired")
        {
          $("#expiry").text("Form Expired")
          $("#expiry").show()
        }
        else
        {
          $("#expiry").text("After "+para[3]+" Day(s) Form Will Expire")
          $("#expiry").show()
        }
       }
      else if(para[1] != 0)
      {
        $("#nomems").text("Application Blank Not Submitted By "+para[1]+" Member(s)")
        $("#nomems").show()

        if(para[3] == "expired")
        {
          $("#expiry").text("Form Expired")
          $("#expiry").show()
        }
        else
        {
          $("#expiry").text("After "+para[3]+" Day(s) Form Will Expire")
          $("#expiry").show()
        }

      $('#adddetail').text("")
      var arr = para[0]
      // $('.timepicker').timepicker();
      for(let i =0;i<arr.length;i++)
      {
        allmail[i] = arr[i];
        console.log("Name 1 - ",allmail[i][0]);
        console.log("Email - ",allmail[i][1]);
        var s1='<tr id="check'+i+'row">'
        var s2='<td><a href="http://localhost/hrms/applicationblank_readonly.php?aid='+arr[i][1]+'"  target="_blank" ><p >'+arr[i][0]+'</p></a></td>'
        var s3 ='<td><p id="check'+i+'mail">'+arr[i][1]+'</p></td>'
        var s4='<td><input id="check'+i+'date" class="datepicker" ></td>'
        var s5 ='<td><input id="check'+i+'date2" class="timepicker" ></td>'
        var s6='<td><label><input type="checkbox" class="filled-in" id="check'+i+'" onclick="selection(this.id)">'
        var s7='<span class="blue-text darken-1" ></span></label></td></tr>'
          
        var str=s1+s2+s3+s4+s5+s6+s7
       
        $('#adddetail').append(str)
        $('.timepicker').timepicker();
        $('.datepicker').datepicker({
          minDate:new Date()
        });
        
      }
      
    }
    else
    {
      $("#nomems").hide()
 
 
      $('#adddetail').text("")
      var arr = para[0]
  
      for(let i =0;i<arr.length;i++)
      {
        allmail[i] = arr[i];
        console.log("Name - ",allmail[i][0]);
        console.log("Email - ",allmail[i][1]);
        var s1='<tr id="check'+i+'row">'
        var s2='<td><a href="http://localhost/hrms/applicationblank_readonly.php?aid='+arr[i][1]+'"  target="_blank" ><p >'+arr[i][0]+'</p></a></td>'
        var s3 ='<td><p id="check'+i+'mail">'+arr[i][1]+'</p></td>'
        var s4='<td><input id="check'+i+'date" class="datepicker" ></td>'
        var s5 ='<td><input id="check'+i+'date2" class="timepicker" ></td>'
        var s6='<td><label><input type="checkbox" class="filled-in" id="check'+i+'" onclick="selection(this.id)">'
        var s7='<span class="blue-text darken-1" ></span></label></td></tr>'
        var str=s1+s2+s3+s4+s5+s6+s7
       
        $('#adddetail').append(str)
        $('.timepicker').timepicker();
        $('.datepicker').datepicker({
          minDate:new Date()
        });
      }
    }
    $('#expiry').hide()
    }
  })
}

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
