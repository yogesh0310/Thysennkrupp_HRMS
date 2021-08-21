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

    
    if($designation == "hr2")
    {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HR2</title>

    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">


    <script src="public/jquery-3.2.1.min.js"></script>

    <script src="public/js/materialize.js"></script>
    <script src="public/js/materialize.min.js"></script>
    <script src="./public/js/logout.js"></script>


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
        <a class="modal-close waves-effect green btn" >OK<i class="material-icons left" >check_box</i></a>
        </center>
        </div>
    </div>
<!-- no data modal ends here -->

<div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000;overflow-y:hidden">

<h3 class="w3-bar-item white"> <center><a href="http://localhost/hrms/">Home</a>
<i id="remin" class="material-icons" style="float: right;cursor: pointer;">close</i></center>   
</a></h3> <br><br>
<a href="http://localhost/hrms/" class="w3-bar-item w3-button">To Do List <span class="new badge green" data-badge-caption="New Task(s)" id="badge_todo">4</span></a> <br>
<a href="http://localhost/hrms/hr2history.php" class="w3-bar-item w3-button">See History  </a> <br>  
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
        <div class="white-text">
            <div class="card-content blue-text">
                <span class="card-title">Groups For Document Validation <a class="waves-effect green btn-small" style="float:right" href="http://localhost/hrms/hr2dash.php"><i class="material-icons right">refresh</i>Refresh</a></span>
                <table class="striped">
                    <thead>
                        <tr>
                            <th>PRF</th>
                            <th>Position Details</th>
                            <th>Zone</th>
                            <th>Department</th>
                           
                            <th>Validate</th>
                        </tr>
                    </thead>
                    <!-- TO DO LIST  -->
                    <tbody id="todolistbody">
                        
                    </tbody>
                    <!-- End of TO DO LIST -->
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row" id="selection" >
    <div class="col s12" >
        <ul class="tabs">
            <li class="tab col s3" id="validation"><a class="active" href="#test1" style="color: orangered">Validation</a></li>
            <li class="tab col s3" id="revalidation"><a  href="#test2" style="color: red">Revalidation</a></li>
            <li class="tab col s3" id="validated"><a  href="#test3" style="color: green">Validated</a></li>

        </ul>
    </div>


    <div class="row" id="emailrow">
        <div class="col s12 m12">
            <div class="card white-text">
                <div class="card-content blue-text">
                    <span class="card-title">Candidates Mail</span>
                    <table class="striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Validate</th>
                                
                                
                            </tr>
                        </thead>
                        <!-- Email Body  -->
                        <tbody id="emailbody">
    
                        
                        </tbody>
                        
                       
                        <!-- End of Email Body -->
                    </table>
                    <div id="nomembers"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="emailrow3">
        <div class="col s12 m12">
            <div class="card white-text">
                <div class="card-content blue-text">
                    <span class="card-title">Candidates Mail</span>
                    <table class="striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Validate</th>
                                
                                
                            </tr>
                        </thead>
                        <!-- Email Body  -->
                        <tbody id="emailbody3">
    
                        </tbody>
                        <!-- End of Email Body -->
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="emailrow2">
        <div class="col s12 m12">
            <div class="card white-text">
                <div class="card-content blue-text">
                    <span class="card-title">Candidates Mail</span>
                    <table class="striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Validate</th>
                                
                                
                            </tr>
                        </thead>
                        <!-- Email Body  -->
                        <tbody id="emailbody2">
    
                        </tbody>
                        
                        <!-- End of Email Body -->
                    </table>
                </div>
            </div>
        </div>
    </div>
    
   
</div>
<!-- Changed by sarang - 10/01/2020 -->
<center>
<p id="nodata"><b style="color:red;margin-left:2%;font-size:20px;">No Candidates For Validation..!</b></p>
</center>       
    <!-- Script Starts Here -->
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
    
            </script>
    
    

<!-- Script Starts Here -->
<script>
$(document).ready(function(){
    
  // functionality for notifications start here
  $('#badge_todo').hide();
  // ajax call for getting notification details
  $.ajax({
      url:'http://localhost/hrms/api/getprfvalidate.php',
      type:'GET',
      success:function(para)
      {
          // dummy data : give notification count, if no new notification please give 0 ex todo:0
         // para = {'todo':para.length} 
         para=JSON.parse(para)
         console.log("this"+para)
          
          if(para.length > 0)
          {
              $('#badge_todo').text(para.length);
              $('#badge_todo').show();
          }

      }
  })
  // functionality for notification ends here

$('.tabs').tabs();
$("#emailrow").hide()
$("#selection").hide()
$("#emailrow2").hide()
$('.modal').modal();
$('#nodata').hide()
//displaying validation and revalidation on click

$("#validation").click(function(){
   
    $("#emailrow3").hide();
    $("#emailrow2").hide();
    $("#emailrow").fadeIn(600)
})


$("#revalidation").click(function(){
    $("#emailrow").hide();
    $("#emailrow3").hide();
    $("#emailrow2").fadeIn(600)
})

$("#validated").click(function(){
    $("#emailrow").hide();
    $("#emailrow2").hide();
    $("#emailrow3").fadeIn(600)
})

// Ajax Call For Tking data of Grops for validation
$.ajax({
    url:"http://localhost/hrms/api/getprfvalidate.php",
    type:"GET",
    success:function(para)
    {   
        console.log("1 st ajax: : ",para)

        para=JSON.parse(para)
        
        console.log("1 st ajax: : ",para)
        if(para.length!=0)
        {
           
            //dummy data please send in below format..!!
            // para = [["instanceid","posdetails","poszone","dept","number of position","position",'PRF1-INSTANCE1-ROUND1'],["instanceid","posdetails","poszone","dept","number ofpositions","position",'PRF1-INSTANCE1-ROUND1']]
            
            for(let i=0;i<para.length;i++)
            {
                var txt1 = '<tr><td>'+para[i][0]+'</td><td>'+para[i][1]+'</td><td>'+para[i][2]+'</td><td>'+para[i][3]+'</td>'
                var txt2 = '<td><button class="btn waves-effect green"  id="'+para[i][0]+'" onclick="displayMail(this.id)">Start Validation' 
                var txt3 = ' </button></td></tr>'
                var str = txt1+txt2+txt3;
                $("#todolistbody").append(str)
            }
        }
        else
         {
             //Changed by sarang - 10/01/2020
            $("#nodata").fadeIn();
            $("#nodatamodal").modal("open");
            // alert("No Data")
           
         }       
    }    

})
// end of page loading ajax call
});
//ajax call for displaying email id's


function completeValidation(digit13)
{
    //Changed by sarang - 10/01/2020

    alert("This is : "+digit13);
    $("#"+digit13).html("completing...");
    $("#"+digit13).attr('disabled','disabled')
    id=digit13.split("-");
    $.ajax({
        url:"http://localhost/hrms/api/completevalidation.php",
        type:"POST",
        data:{
            "prf":id[0],
            "pos":id[1],
            "iid":id[2],
            "rid":id[3]
        },

        success:function(para)
        {   
            console.log(para);
            if(para="success")
            {
                $("#"+digit13).html("Successfully Completed");
                // window.setTimeout(function(){location.reload()},1000)
            }
            else
            {
                $("#"+digit13).html("Error While Processing");
            }
        }
    })
            

}
function displayMail(x)
{
    $("#emailrow4").hide()
    alert(x)
    
    $.ajax({
        url:"http://localhost/hrms/api/getemailvalidate.php",
        type:"GET",
        data:{
            "id":x
        },

        success:function(para)
        {   
            
            
console.log(para)
            $("#emailbody").text("")
            $("#emailbody2").text("")
            $("#emailbody3").text("")
            $('#emailbody4').text("")
            para=JSON.parse(para)
            console.log(para.length);
            lenpara=para.length
            
            window.id=x;
            // Dummy Data please send in below format..!!
           // para = [['Tanny@gmail.com',"0"],["rb@gmail.com","1"],["ad@gmail.com","0"],["shaikh@gmail.com","1"]]
            var temparr = [];

            //Changed by sarang - 10/01/2020
            if(para[0] == "")
            {
                    console.log("This is : "+x);
                    txt4='<b style="color:red;font-size:15px;"> No members left for validation. You can complete the validation process for this position</b>'
                    status = "#emailbody"
                   
                    var txt2 = '<td><button class="btn waves-effect green" id="'+x+'"   onclick="completeValidation(this.id)">Complete Validation Process</button>'                       
                    var txt3 = '</td></tr>' 
                    var str = txt2+txt3;
                    $('#nomembers').append(txt4)
                    $(status).append(str)
                  
            }
            else
            {
                $("#emailrow4").hide()
                for(let i=0;i<para.length;i++)
                {
                    for(let j=0;j<4;j++)
                    {
                        temparr[j] = para[i][j];
                        console.log(temparr[j]);
                        
                    }
                    var status;
                
                    if(temparr[2] == "0")
                    {
                        status = "#emailbody"
                        console.log("Name : ",temparr[0])
                        var txt0 = '<tr><td><p>'+temparr[0]+'</p></td>'
                        var txt1 = '<td><p>'+temparr[1]+'</p></td>'
                        var txt2 = '<td><button class="btn waves-effect green" id="'+temparr[1]+'"  onclick="evaluateMail(this.id)">Validate Candidate'                       
                        var txt3 = ' </button></td></tr>' 
                        var str = txt0+txt1+txt2+txt3;
                        $(status).append(str)
                    }
                    else if(temparr[2] == "1")
                    {
                        status = "#emailbody2"
                        var txt0 = '<tr><td><p>'+temparr[0]+'</p></td>'
                        var txt1 = '<td><p>'+temparr[1]+'</p></td>'
                        var txt2 = '<td><button class="btn waves-effect green" id="'+temparr[1]+'"onclick="evaluateMail(this.id)">Validate Candidate'                       
                        var txt3 = ' </button></td></tr>' 
                        var str =txt0+txt1+txt2+txt3;
                        $(status).append(str)
                        
                    }
                    else if(temparr[2] == "2")
                    {
                        status = "#emailbody3"
                        var txt0 = '<tr><td><p>'+temparr[0]+'</p></td>'
                        var txt1 = '<td><p>'+temparr[1]+'</p></td>'
                        var txt2 = '<td><button class="btn waves-effect green" id="'+i+'e3" name="'+temparr[1]+'" onclick="rol(this.id,this.name)">Request Offer Letter</button>'                       
                        var txt3 = '</td></tr>' 
                        var str = txt0+txt1+txt2+txt3;
                        $(status).append(str)
                    }
                    else if(temparr[2] == "4")
                    {
                        status = "#emailbody2"
                        var txt0 = '<tr><td><p>'+temparr[0]+'</p></td>'
                        var txt1 = '<td><p>'+temparr[1]+'</p></td>'
                        var txt2 = '<td><button class="btn waves-effect green" id="'+temparr[1]+'"onclick="evaluateMail(this.id)" disabled>Not Uploaded'                       
                        var txt3 = ' </button></td></tr>' 
                        var str = txt0+txt1+txt2+txt3;
                        $(status).append(str)
                    }
                    else if(temparr[2] == "5")
                    {
                        status = "#emailbody3"
                        var txt0 = '<tr><td><p>'+temparr[0]+'</p></td>'
                        var txt1 = '<td><p>'+temparr[1]+'</p></td>'
                        var txt2 = '<td><button class="btn waves-effect green" id="'+i+'e3" name="'+temparr[1]+'" onclick="rol(this.id,this.name)" disabled>Requested</button>'                       
                        var txt3 = '</td></tr>' 
                        var str = txt0+txt1+txt2+txt3;
                        $(status).append(str)
                    }
                    if(temparr[3] != "filled"){
                            
                            document.getElementById(temparr[1]).disabled = true;

                        }
                
                    

                }
            }
            $("#validation").click()
            $("#selection").fadeIn(600)
        }
    })
}

function rol(para,name)
{
    // alert(name)
    var s = '#'+para;
    console.log(window.id);
    // alert(s)

    $.ajax({
        url:"http://localhost/hrms/api/reqofferletter.php",
        type:"POST",
        data:{
            "mail":name,
            "id":window.id
        },
        success:function(para)
        {  
            console.log("this came from backend : ",para)
            if(para == "success")
            {
                alert("Offer Letter Requested")
                $(s).html("Requested");
                $(s).attr('disabled','disabled')
            }
            else
            {
                alert("Unable to Request Offer Letter",s)
                

            }
        }
    })
}

// function for jumping to Document Validation Form form
function evaluateMail(x)
{
    
    localStorage.setItem('currentemail',x)
    // alert(localStorage.getItem('currentemail'))
     window.open("http://localhost/hrms/documentvalidation.php?token="+x+"", '_blank');
     window.setTimeout(function(){location.reload()},1000)

}

</script>
<!-- Script Ends -->
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