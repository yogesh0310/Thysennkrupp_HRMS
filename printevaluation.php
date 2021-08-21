<?php
// error_reporting(0);
include 'api/db.php';
if(isset($_COOKIE['sid']))
{
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    
    $designation = $cursor['dsg'];
    
    if($designation == "hr" || $designation == "inv")
    {
        $mailid = $_GET['aid'];
        $round_id = "0".$_GET['rid'];
          $result = $db->intereval->find(array("email"=>$mailid,"prf"=>$_GET['prf'],"iid"=>$_GET['iid'],"rid"=>$round_id));
          $cursor2 = $db->tokens->findOne(array("email"=>$mailid));
          
          $temp;
          foreach($result as $doc)
          { 
              $temp = $doc;
          }
          $doc = $temp;
          $cv=$cursor2['usercv'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
<style>



</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evaluation Form</title>

    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="public/jquery-3.2.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://parall.ax/parallax/js/jspdf.js"></script>
    <script src="public/js/materialize.js"></script>
    <script src="public/js/materialize.min.js"></script>



    <!-- <script type="text/javascript">
  function PDF1(){
    var doc = new jsPDF();
    var elementHandler = {
      '#ignorePDF': function (element, renderer) {
        return true;
      }
    };
    var source = window.document.getElementsByTagName("body")[0];
    doc.fromHTML(
      source,
      15,
      15,
      {
        'width': 180,'elementHandlers': elementHandler
      });

      var string = doc.output('datauristring');
var iframe = "<iframe width='100%' height='100%' src='" + string + "'></iframe>"
var x = window.open();
x.document.open();
x.document.write(iframe);
x.document.close();
    }

 
</script> -->

</head>
<body>
 

<!-- <p id="ignorePDF">don't print this to pdf</p> -->
<nav>
    <div class="nav-wrapper blue darken-1">
       
    </div>
</nav>
<br><br>
<center>
 <p id="candidatename"  style="color:#0892d0;font-size: 25px" > Candidate name: <?php echo $cursor2['full_name']; ?></p><img  align="right" height = 130 width=130 src= <?php echo $cursor2['userphoto']; ?>>
 
 
</center>        
<div class="row">
    <div class="col s12 m6 offset-m3">
        <div class="card white-text">
            <div class="card-content blue-text">
                <br>
                <!-- <div class="row">  <button  id="cv" class="btn modal-trigger blue darken-1">View CV</button></div> -->
                
                <div class="row">
                
                    <div class="col m12 s12">
                        <b style="font-size: 19px">Functional/Technical Knowledge:</b>
                        <br><br>
                        <div class="row">
                            <label class="col">
                                <input class="with-gap" <?php echo ($doc['candidateknowledge']=='Excellent')?'checked':'disabled' ?> name="group1" type="radio" id="ke" value="Excellent" />
                                <span>Excellent</span>
                            </label>

                            <label class="col">
                                <input class="with-gap" <?php echo ($doc['candidateknowledge']=='Very Good')?'checked':'disabled' ?> name="group1" type="radio" id="kvg" value="Very Good"/>
                                <span>Very Good</span>
                            </label>

                            <label class="col">
                                <input value="Good" <?php echo ($doc['candidateknowledge']=='Good')?'checked':'disabled' ?> class="with-gap" name="group1" type="radio"  id="kg" value="Good" />
                                <span>Good</span>
                            </label>

                            <label class="col">
                                <input value="Satisfactory" <?php echo ($doc['candidateknowledge']=='Satisfactory')?'checked':'disabled' ?> class="with-gap" name="group1" type="radio" id="ks" />
                                <span>Satisfactory</span>
                            </label>

                            <label class="col">
                                <input value="Poor" <?php echo ($doc['candidateknowledge']=='Poor')?'checked':'disabled' ?> class="with-gap" name="group1" type="radio" id="kp" />
                                <span>Poor</span>
                            </label>
                        </div>     
            
                    </div>
                </div>
<br><br>
                <div class="row">
                    <div class="col m12 s12">
                        <b style="font-size: 19px">Relevent Project/Functional Experience:</b>
                        <br><br>
                        <div class="row">
                            <label class="col">
                                <input value="Excellent" <?php echo ($doc['candidateexperience']=='Excellent')?'checked':'disabled' ?> class="with-gap" name="group2" type="radio" id="ee" />
                                <span>Excellent</span>
                            </label>

                            <label class="col">
                                <input value="Very Good" <?php echo ($doc['candidateexperience']=='Very Good')?'checked':'disabled' ?> class="with-gap" name="group2" type="radio"  id="evg"/>
                                <span>Very Good</span>
                            </label>

                            <label class="col">
                                <input value="Good" <?php echo ($doc['candidateexperience']=='Good')?'checked':'disabled' ?> class="with-gap" name="group2" type="radio" id="eg" />
                                <span>Good</span>
                            </label>

                            <label class="col">
                                <input value="Satisfactory" <?php echo ($doc['candidateexperience']=='Satisfactory')?'checked':'disabled' ?> class="with-gap" name="group2" type="radio"  id="es"/>
                                <span>Satisfactory</span>
                            </label>

                            <label class="col">
                                <input value="Poor" <?php echo ($doc['candidateexperience']=='Poor')?'checked':'disabled' ?> class="with-gap" name="group2" type="radio" id="ep" />
                                <span>Poor</span>
                            </label>
                        </div>     
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="input-field col s12">
                     <b><label for="strength">Major Strenths(Technical/Functional):</label> </b>
                     <br><br> <label><?php echo $doc['candidatestrength']; ?></label>
                                             
                    </div>
                </div>
                <br><br>
                
                <div class="row">
                    <div class="input-field col s12">
                    <b><label for="weakness">Major Weakness(Technical/Functional):</label>     </b> 
                        <br><br> <label><?php echo $doc['candidateweakness']; ?></label>                                    
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="input-field col s12">
                    <b><label for="special">Any Special Areas Probed:</label></b> 
                      
                        <br><br> <label><?php echo $doc['candidatespecial']; ?></label>                                              
                    </div>
                </div>
                <br><br>

                <div class="row">
                    <div class="col m12 s12">
                        <b style="font-size: 19px">Result Of Interview:</b>
                        <br><br>
                        <div class="row">
                            <label class="col">
                            <span>Selected</span>
                                <input value="selected" <?php echo ($doc['result']=='selected')?'checked':'disabled' ?> class="with-gap" name="group3" type="radio" onclick="disp(this)" id="rs" >
                                
                            </label>

                            <label class="col">
                            <span>put-on-hold</span>
                                <input value="hold" <?php echo ($doc['result']=='onhold')?'checked':'disabled' ?> class="with-gap" name="group3" type="radio" onclick="disp(this)" id="rh" >
                               
                            </label>

                            <label class="col">
                            <span>Rejected</span>
                                <input value="rejected" <?php echo ($doc['result']=='rejected')?'checked':'disabled' ?> class="with-gap" onclick="disp(this)" name="group3" type="radio" id="rr" >
                               
                            </label>
                        </div> 
                            
                    </div>
                </div>


                <?php if($doc['result']=='selected'){
?>

<br><br>
<div class="row" id="ifselected">
                    <b class="col">Please Fill Following Information :</b><br><br>
                    <div class="input-field col s12">
                    <b><label for="designation">Designation for which candidate is found suitable</label></b>
                        
                        <br><br> <label><?php echo $doc['candidatedesignation']; ?></label>   
                    </div>
                    <br><br>
                    <div class="input-field col s12">
                    <b><label for="date">Date at which candidate has agreed to join</label></b>
                    <br><br>
                      
                        <label><?php echo $doc['date']; ?></label>   
                    </div>
                    
                </div>

                <br><br>
                
<!-- Script Starts Here -->
<script>


function disp(x)
{
    var result = $("input[name='group3']:checked").val();
    window.selection = result
    console.log(window.selection) //changed by sarang
    if(result == "put-on-hold")
    {
        $("#ifselected").hide() 
        $("#ifonhold").show(600)    
    }

    if(result == "selected")
    {
        $("#ifonhold").hide() 
        $("#ifselected").show(600) 
    }

    if(result == "rejected"){
        $("#ifselected").hide() 
        $("#ifonhold").hide() 
        


    }

}
function clicked(x)
{
    var v = $(x).attr('value'); 
    var i = $(x).attr('id'); 
    // console.log("Value : ",v," -",i)
    $("#obj").attr("href",v)
    $("#obj").attr("data",v)
}
$(document).ready(function(){
    


$('.modal').modal();
$("#problem").hide()  

$("#ifonhold").hide()  

$("#submit").click(function(){
    var knowledge = $("input[name='group1']:checked").val();
    if(knowledge){
            console.log(knowledge);
    }
    var experience = $("input[name='group2']:checked").val();
    if(experience){
        console.log(experience);
    }

    var candidateknowledge = knowledge
    var candidateexperience = experience
    var candidatestrength = $("#strength").val()
    var candidateweakness = $("#weakness").val()
  
    var candidatespecial = $("#special").val()
    var candidatereasonhold = $("#reasonhold").val()
    var candidatedesignation = $("#designation").val()
    var date = $("#date").val()
    var remark = $("#remark").val()
    var name = localStorage.getItem('currentemail')
     var id=localStorage.getItem('id') //added by sarang
    // console.log("Hello",name)  
 
});
document.tite='My Print';window.print();
// PDF1();
});

</script>
<!-- Script Ends -->
</body >
</html>
<?php
          }
          ?>
<div class="row">
                    <div class="input-field col s12">
                    <b><label for="remark">Remark if any</label></b>
                    <br><br>
                   
                        <label><?php echo $doc['remark']; ?></label>
                    </div> <br><br><br><br><br><br>
                </div>
                    <b><center style="color: green;font-size: 30px">Interviewer Details</center> </b><br><br>
                    <table class="responsive-table">
                    <tr>
                    <td><b style="color: green;font-size: 20px">Name :</b> <b style="color:blue darken-1;font-size: 20px"><?php echo $doc['inv_name']; ?></b></td>
                    <td><b style="color: green;font-size: 20px">Email ID :</b> <b style="color: blue darken-1;font-size: 20px"><?php echo $doc['interviewer']; ?></b></td>
                    </tr>
                    <tr>
                    <td><b style="color: green;font-size: 20px">Department :</b> <b style="color: blue darken-1;font-size: 20px"><?php echo $doc['inv_dept']; ?></b></td>
                    <td><b style="color: green;font-size: 20px">Designation :</b> <b style="color: blue darken-1;font-size: 20px"><?php echo $doc['inv_dsg']; ?></b></td>
                    </tr>
                    <tr>
                    <td><b style="color: green;font-size: 20px">Date :</b> <b style="color: blue darken-1;font-size: 20px"><?php echo $doc['inv_date']; ?></b></td>
                    <td><b style="color: green;font-size: 20px">Time :</b> <b style="color: blue darken-1;font-size: 20px"><?php echo $doc['inv_time']; ?></b></td>
                    </tr>
                    <tr>
                    <td><b style="color: green;font-size: 20px">Place :</b> <b style="color: blue darken-1;font-size: 20px"><?php echo $doc['inv_place']; ?></b></td>
                    <td><b style="color: green;font-size: 20px">Contact Person :</b> <b style="color: blue darken-1;font-size: 20px"><?php echo $doc['inv_cperson']; ?></b></td>
                    </tr>
                    </table>
                </div>
                </div>
                
                </div>
            </div>
        </div>
    </div>
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