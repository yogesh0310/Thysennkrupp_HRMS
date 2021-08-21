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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

      
        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
          
  <!-- <link rel="stylesheet" type="text/css" media="screen" href="css/materialize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="css/materialize.min.css"> -->
  <script src="./public/js/logout.js"></script>

        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">

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
     margin-left:22% !important;
     margin-top:18% !important; 
   }
   #updated {
     position: fixed;
     top: 0;
     left: 0;
     right: 0;
     bottom: 0;
     width: 100%;
     background: rgba(0,0,0,0.95)  url(loader2.gif)  no-repeat center center !important;
     z-index: 10000;
   }
   #updated > #txt{
     font-size:23px;
     color:lightskyblue;
     margin-left:22% !important;
     margin-top:18% !important; 
   }
   </style>

<script>
if(window.screen.width <= 720)
{
  window.location="http://localhost/hrms/interviewmob.php";
}
</script>

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
<br>
<!-- nav and side menu ended -->
<a class="waves-effect green btn-small" style="float:right" href="http://localhost/hrms/interview.php"><i class="material-icons right">refresh</i>Refresh</a>
<br><br>
<div class="row">
<div class="col s12 blue lighten-4">
  <table class="striped " >
    <thead>
      <tr>
      
                        
                        
          <th>PRF</th>
          <th>Instance Id</th>
          <th>Round Id</th>
          <th>Position Details</th>
          <th>Zone</th>
          <th>Department</th>
          <th>Interviewer Name</th>
          <th>Interviewer Email</th>
          <th>Accepted</th>
          <th>Update</th>
          <th>Notify Candidates</th>
      </tr>      
    </thead>
    <tbody id='rawdata'>
    </tbody>
  </table>
</div> 
</div>


<div id='updatediv' class="row">
    <br>
    <b style="color:red;margin-left:28%;font-size:18px;" >You Can Edit The Following - Interviewer, Date & Time</b><br><br>
    <div class="col s10  m12  blue lighten-4">
           
            <div class="row" >
                
                <div class="input-field col s3">
                <b>Interviewer Name</b>
                <input id="interviewer_name" type="text" class="validate">
                </div>
                <div class="input-field col s3">
                <b>Interviewer Email</b>
                <input id="interviewer_email" type="text" class="validate">
                </div>
                <div class="input-field col s3">
                <b>Department Name</b>
                <input id="interviewer_dept" type="text" class="validate">
                </div>

                <div class="input-field col s3">
                <b>Interview Location</b>
                <input id="iloc" type="text" class="validate">
                </div>
                <div class="input-field col s3">
                <b>Contact Person</b>
                <input id="iperson" type="text" class="validate">
                </div>

                <div class="input-field col s3">
                <b>Designation</b>
                <input id="interviewer_dsg" type="text" class="validate">
                </div>

                <br>
               
            </div>
            <center>
                    <a class="btn green darken-1" id='updatebtn'>UPDATE</a>
            </center>
            <hr style="border: 2px solid black";>
            <table class="striped">
                    <thead>
                      <tr>
                      
                          <th style="font-size:15px;" >Members</th>
                          <th style="font-size:15px;" >Date</th>
                          <th style="font-size:15px;" >Time</th>
                      </tr>      
                    </thead>
                    <tbody id='memberdata'>
                    

                    </tbody>
                   
                </table>
              
                <br>

            
    </div>
</div>
<div id=successdiv>
    <center>
<b style="color:green">UPDATED SUCCESSFULLY</b>
</center>
</div>

  






</div>
<div id="loader" >
    <div id="txt">
        <b>Please wait while we send confirmation to candidates and interviewer</b>    
    </div>  
</div>

<div id="updated" >
    <div id="txt">
        <b>Please wait while we send modification details to respective authority</b>    
    </div>  
  </div>
</div>
</body>


<script src="public/js/common.js"></script>

<script>
$('#updatediv').hide();
$('#successdiv').hide();

var id;
var prfint;
var newname;
var newdate;
var newtime;
var oldname;
var olddate;
var oldtime;

var intarr=['Member1','Member2','Member3']
var newname;

function modifyMail(id,name)
{
    newemail=$('#interviewer_email').val()    
    console.log("id=",id)
    console.log("name=",newemail)
    console.log("mail=",newemail)
    console.log("Data  : "+id );
    id_ = id;
    id=id.split("*");
    // console.log("Name  : "+name );
    date = '#check'+name+"date";
    name = '#check'+name+'time';
    console.log("Date id - ",date,name)
    updatedTime = $(name).val()
    updatedDate = $(date).val()
    // console.log("Updated Date - ",updatedDate)
    // console.log("Updated Time - ",updatedTime)
    // console.log('Exsiting is time : ',id[2])

    // console.log("Updated index - ",id[0])
    // console.log("Updated date - ",id[1])
    // console.log("Updated time - ",id[2])
    // console.log("Updated digit13 - ",id[3])
    // console.log("Updated mail - ",newemail)
    // console.log("Updated times - ",updatedTime)
    // console.log("Updated dates - ",updatedDate)




    if(id[2].localeCompare(updatedTime)==0 && id[1].localeCompare(updatedDate) == 0 )
    {
       alert("Same date time")
    }
    else
    {
        console.log("Not Equal")
        $.ajax({
        url:"http://localhost/hrms/api/hrmodifytime.php",
        type:"POST",
        data:{
            "index":id[0],
            "date":id[1],
            'time':id[2],
            "digit13":id[3],
            "mail":newemail,
            "updatedTime":updatedTime,
            "updatedDate":updatedDate
        },
        success:function(para)
        {
            if(para=="modify")
            {
                alert("Modification Done");
                window.setTimeout(function(){location.reload()},1000)
      
            }
            else if(para == "fail")
            {
                alert("Operation Failed . Please try again..")
            }
           
            console.log("This is my data:  "  +para)
        }

       })
    }
    console.log("This is : ")
    console.log("Split data : "+id[0]+" & "+id[1]+"&"+id[2])

    
}


function xyz(x)
{
  $('#memberdata').text('')
  id=x;
  prfint=id;
  prfints=id.split('*')
  console.log(prfints)
  // alert(prfint)
  $.ajax({
      url:"http://localhost/hrms/api/getthatintvmembers.php",
      type:"POST",
      data:{'prfint':prfint},
      success:function(para)
      {
        console.log("This is : ",para);
        // intarr=para;
        para=JSON.parse(para);
        members=para
        for (let i=0;i<(para.members).length;i++)
        {
            $digit13 = para.prf+'-'+para.pos+'-'+para.iid+'-'+para.rid;
            var s0 ='<tr><td>'+para.members[i]+'</td>'
            var s1='<td><input type="text" id="check'+i+'date" value="'+para.dates[i]+'"class="datepicker"></td>'
            var s2='<td><input type="text" id="check'+i+'time" value="'+para.times[i]+'"class="timepicker"></td>'
            var s3 ='<td><button  class="btn waves-effect green"  id="'+i+'*'+para.dates[i]+'*'+para.times[i]+'*'+$digit13+'" name="'+i+'" onclick="modifyMail(this.id,this.name)">Modify Time<i class="material-icons right">send</i></button></td></tr>'
            var str= s0+s1+s2+s3
            // s2 = s0+s1;
            $('#memberdata').append(str)
            $('.timepicker').timepicker();
            $('.datepicker').datepicker();
        }
      }

  })
  console.log(prfints)
    $('#updatediv').show(600);
    $('#interviewer_name').val(prfints[6])
    $('#interviewer_email').val(prfints[7])
    $('#interviewer_dept').val(prfints[9])
    $('#interviewer_dsg').val(prfints[10])
    $('#iloc').val(prfints[13])
    $('#iperson').val(prfints[12])

    prf=prfints[0];
    rid=prfints[2];
    iid=prfints[1];
    oldname=prfints[6];
    olddept=prfints[5];
    olddsg=prfints[10];
    oldemail=prfints[7];
    oldiloc=prfints[13];
    oldiperson=prfints[12];
    
    // console.log(prfints[5])
    // console.log(prfints[6])
    // console.log(prfints[7])
    // console.log(prfints[8])
    // console.log(prfints[9])
    // console.log(prfints[10])

}




var prf
var arr=[]
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

  $('#loader').hide()
  $('#updated').hide()
  $('.modal').modal();
  $('.datepicker').datepicker
  ({
      minDate:new Date(),
  })
  $('.timepicker').timepicker();
 $.ajax({
    url:'http://localhost/hrms/api/getinterviewer.php',
    type:'POST',
    data:{
        'arr':arr,
        },
    success : function(para)
    {
      if(para == "No Data")
      {
        $("#nodatamodal").modal("open");
      }
      else
      {
        console.log("this is : ",para)
        para=JSON.parse(para);
        console.log("this is : ",para)
        //para=JSON.parse(para)
        //para=[['1111','ABCD','Accept','28/11/19','4.00'],['1111','ABCD','Accept','28/11/19','4.00'],['1111','ABCD','Accept','28/11/19','4.00']]
        
        for(let j=0;j<para.length;j++)
        {
            if(para[j][8] == "yes" && para[j][11] == "done")
            {
              var x='<tr id="rows" class="rows"><td>'+para[j][0]+'</td><td>'+para[j][1]+'</td><td>'+para[j][2]+'</td><td>'+para[j][3]+'</td><td>'+para[j][4]+'</td><td>'+para[j][5]+'</td><td>'+para[j][6]+'</td><td>'+para[j][7]+'</td><td>'+para[j][8]+'</td><td><a id="'+para[j][0]+'*'+para[j][1]+'*'+para[j][2]+'*'+para[j][3]+'*'+para[j][4]+'*'+para[j][5]+'*'+para[j][6]+'*'+para[j][7]+'*'+para[j][8]+'*'+para[j][9]+'*'+para[j][10]+'*'+para[j][11]+'*'+para[j][12]+'*'+para[j][13]+'" class="btn green darken-1" onclick="xyz(this.id)">Update</a></td><td><a id="'+para[j][0]+'*'+para[j][1]+'*'+para[j][2]+'*'+para[j][7]+'*'+para[j][9]+'*'+para[j][10]+'*'+para[j][6]+'*'+para[j][8]+'*'+para[j][13]+'*'+para[j][12]+'" class="btn green darken-1" onclick="notifyCandidate(this.id)" name="notify" style="width: 150px;" disabled>Mail Sent</a></td></tr>'
            }
            else if(para[j][8] == "pending")
            {
              var x='<tr id="rows" class="rows"><td>'+para[j][0]+'</td><td>'+para[j][1]+'</td><td>'+para[j][2]+'</td><td>'+para[j][3]+'</td><td>'+para[j][4]+'</td><td>'+para[j][5]+'</td><td>'+para[j][6]+'</td><td>'+para[j][7]+'</td><td>'+para[j][8]+'</td><td><a id="'+para[j][0]+'*'+para[j][1]+'*'+para[j][2]+'*'+para[j][3]+'*'+para[j][4]+'*'+para[j][5]+'*'+para[j][6]+'*'+para[j][7]+'*'+para[j][8]+'*'+para[j][9]+'*'+para[j][10]+'*'+para[j][11]+'*'+para[j][12]+'*'+para[j][13]+'" class="btn green darken-1" onclick="xyz(this.id)">Update</a></td><td><a id="'+para[j][0]+'*'+para[j][1]+'*'+para[j][2]+'*'+para[j][7]+'*'+para[j][9]+'*'+para[j][10]+'*'+para[j][6]+'*'+para[j][8]+'*'+para[j][13]+'*'+para[j][12]+'" class="btn red darken-3" onclick="notifyCandidate(this.id)" name="notify"  style="width: 150px;">Send Mail</a></td></tr>'
            }
            else
            {
              var x='<tr id="rows" class="rows"><td>'+para[j][0]+'</td><td>'+para[j][1]+'</td><td>'+para[j][2]+'</td><td>'+para[j][3]+'</td><td>'+para[j][4]+'</td><td>'+para[j][5]+'</td><td>'+para[j][6]+'</td><td>'+para[j][7]+'</td><td>'+para[j][8]+'</td><td><a id="'+para[j][0]+'*'+para[j][1]+'*'+para[j][2]+'*'+para[j][3]+'*'+para[j][4]+'*'+para[j][5]+'*'+para[j][6]+'*'+para[j][7]+'*'+para[j][8]+'*'+para[j][9]+'*'+para[j][10]+'*'+para[j][11]+'*'+para[j][12]+'*'+para[j][13]+'" class="btn green darken-1" onclick="xyz(this.id)">Update</a></td><td><a id="'+para[j][0]+'*'+para[j][1]+'*'+para[j][2]+'*'+para[j][7]+'*'+para[j][9]+'*'+para[j][10]+'*'+para[j][6]+'*'+para[j][8]+'*'+para[j][13]+'*'+para[j][12]+'" class="btn green darken-1" onclick="notifyCandidate(this.id)" name="notify" style="width: 150px;" disabled>Send Mail</a></td></tr>'
            }
            $('#rawdata').append(x); 
        }
       
        
      }
    },
  })
})


function notifyCandidate(id)
{
  console.log("ID - "+id)
  $('#loader').show()
  
  $.ajax({
    url:"http://localhost/hrms/api/notifyCandidate.php",
    type:"POST",
    data:{
      "prf13":id
    },
    success:function(para){
      $('#loader').hide()
      console.log("This is - "+para)
      window.setTimeout(function(){location.reload()},1000)
      
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

$('#updatebtn').click(function()
    {  
        $('#updated').show()   
        newname=$('#interviewer_name').val()
        newdate=$('#interview_date').val()
        newtime=$('#interview_time').val()   
        newemail=$('#interviewer_email').val()    
        newdept=$('#interviewer_dept').val()   
        newdsg=$('#interviewer_dsg').val() 
        iloc=$('#iloc').val()   
        iperson=$('#iperson').val()   
        console.log("Members", members) 
        $.ajax({
          
            url:"http://localhost/hrms/api/updateint.php",
            type:"POST",
            data:
            {
                'prf':prf,
                'rid':rid,
                'iid':iid,
                'oldname':oldname,
                'oldemail':oldemail,
                'olddept':olddept,
                'olddsg':olddsg, 
                'newname':newname,
                'newemail':newemail,
                'newdept':newdept,
                'newdsg':newdsg,
                'iloc':iloc,
                'iperson':iperson,
                'members' : members

            },
            success:function(para)
            {
              console.log("para : ",para)
                //console.log(oldname,olddate,oldtime,newname,newdate,newtime)
                   $('#updatediv').hide(800);
                  $('#successdiv').show(800);
                  $('#updated').hide()     
                  window.setTimeout(function(){location.reload()},2000)

            }

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
       