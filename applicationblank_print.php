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
    if($designation == "hr" || $designation == "ceo" || $designation == "hod" || $designation == "inv" )
    {
        $mailid = $_GET['aid'];;
          $result = $db->tokens->find(array("email"=>$mailid));
          
          $temp;
          foreach($result as $row)
          { 
              $temp = $row;
          }
          $row = $temp;

?>


<html>

<script>

</script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="public/jquery-3.2.1.min.js"></script>

    <script src="public/js/materialize.js"></script>
    <script src="public/js/materialize.min.js"></script>
    

</head>
<style>
input[type="text"] {
  text-transform: uppercase;
}

input[type="file"]{
        display:none;
}



</style>
<body>



                  <div class="row">
                        
                        <div class="col s12 m6 offset-m3">
                        

                          <!-- <center> <p><h5> <b> Applicant Mail : <?php echo $_GET['aid']; ?></b></h5></p> </center> -->

                          <div class="card white">

                            <div class="card-content blue-text darken-1">



                                <!-- form starts -->

                                <center>
                                        <b style="font-size: 35px">Application Form</b><br><br>
                                        
                                </center> 
                                
                                
                     
                                        
                                       
                                       

                                    <div class="row"> 
                                    
                                        <div class="input-field col s12" id="uphoto">
                                               <img  align ="right" src="<?php echo $row["userphoto"]; ?>" alt="" width="150" height="150"> 
                                        </div>
                                        </div>


                                    
 
 <br><br><br>                                       
                                        <table width="350"> 
                                        <tr>
                                        <td><b> <label for="last_name">Last Name</label></b></td>
                                        <td><b> <label for="first_name">First Name</label></b></td>
                                        <td><b> <label for="mid_name">Middle Name</label></b></td>
                                        </tr>
                                        <tr>
                                        <td><label><?php echo $row['last_name'];?></label><br></td>
                                        <td><label><?php echo $row['first_name'];?><label><br></td>
                                        <td><label><?php echo $row['mid_name'];?><label><br></td>
                                        </tr>
                                        </table>   
                                        <br>

                                          <div class="row">
                                                <div class="input-field col s6">
                                                <b><label for="useradharno">Aadhar Card Number: </label></b>
                                                <label><?php echo $row["aadharno"]; ?></label>
                                                        
                                                      </div> 
                                          </div>                                        
<br>
   


<br>
                                        <b class="blue-text" style="font-size:20px;">Present Address</b><br><br>

                                        <table width="500"> 
                                        <tr>
                                        <td><b> <label for="last_name">Street</label></b></td>
                                        <td><b> <label for="first_name">Locality</label></b></td>
                                        <td><b> <label for="mid_name">City</label></b></td>
                                        <td><b> <label for="mid_name">State</label></b></td>
                                        <td><b> <label for="mid_name">Pincode</label></b></td>
                                        </tr>
                                        <tr>
                                        <td><label><?php echo $row['street'];?></label><br></td>
                                        <td><label><?php echo $row['Locality'];?><label><br></td>
                                        <td><label><?php echo $row['City'];?><label><br></td>
                                        <td><label><?php echo $row['State'];?><label><br></td>
                                        <td><label><?php echo $row['Pincode'];?><label><br></td>
                                        </tr>
                                        </table>   
                                           <br><br>

                                           
                                          <b class="blue-text" style="font-size:20px">Contact Details</b><br><br>




                                        <table width="500"> 
                                        <tr>
                                        <td><b> <label for="last_name">Contact number</label></b></td>
                                        <td><b> <label for="first_name">STD Code (Optional)</label></b></td>
                                        <td><b> <label for="mid_name">Telphone number (Optional)</label></b></td>
                                        
                                        </tr>
                                        <tr>
                                        <td><label><?php echo $row['number'];?></label><br></td>
                                        <td><label><?php echo $row['std'];?><label><br></td>
                                        <td><label><?php echo $row['phonenum'];?><label><br></td>
                                        
                                        </tr>
                                        </table>   
                                           <br>
                                          </div>
                                          <div class="row">
                                            <div class="input-field col s6">
                                            <b><label for="uemail">Email: </label></b>
                                             <label><?php echo $row["email"]; ?></label>
                                              
                                            </div>
<br>
                                            
                                            <div class="input-field col s6">
                                            <b><label for="udob">Date Of Birth:</label></b>
                                               <label><?php echo $row["dob"]; ?><label>
                                                
                                            </div>
                                                 
                                          </div>
<br>

                                          <div class="row">
                                                <div class="input-field col s6">
                                                <b><label for="position">Position Applied For</label></b>
                                                  <label><?php echo $row["position"]; ?></label>
                                                 
                                                </div>
    
                                               <br> 
                                                <div class="input-field col s6">
                                                <b><label for="location">Location</label></b>
                                                    <label><?php echo $row["location"]; ?></label>
                                                   
                                                </div>
                           
                                          </div>

<br>
                                          <div class="row">
                                            
                                                <div class="input-field col s12">
                                                <b><label for="passport">Passport Availability/Validity:</label></b>
                                                  <label><?php echo $row["passport"]; ?></label>
                                                
                                                </div>
                                          </div>
<br>
                                          <b style="font-size:20px;">Academic professional Qualification</b>
                                   
                                          <div class="row">
                                                
                                                <div class="input-field col s6">
                                                <br> <b> <label for="qualification">Highest Qualification:</label></b>
                                                       <label><?php echo $row["qualification"]; ?></label>
                                                        
                                                      </div>
          
                                                      <br>
                                                      <div class="input-field col s6">
                                                      <b><label for="passing">Passing Year:</label></b>
                                                         <label><?php echo $row["passing"]; ?></label>
                                                          
                                                      </div>
                                                </div>


                                                      
<br>

                                                      
                                          
                                                
                                          <b style="font-size:20px;">Professional Experience (Mention Company Name And Designation)</b>
                                          <?php  
                                          
                                          for($i=0;$i<count($row["orgname"]);$i++)
                                          {
                                        ?>
                                                <div class="row">
                                                
            
                                                <div class=" col s12" id="mainexpdiv">
                                                  <div class="col s12" id="myexpdiv">
                                                          <br>
                                                        <div class="input-field col s6">
                                                        <b><label for="orgname0" >Current Organization Name:</label></b>
                                                        <label><?php echo $row["orgname"][$i]?$row["orgname"][$i]:"NA"; ?></label>
                                                                
                                                        </div>
                                                        <br>
                                                                              
                                                        <div class="input-field col s6">
                                                        <b><label for="olddesignation0" >Designation:</label></b>
                                                        <label><?php echo $row["olddesignation0"][$i]?$row["olddesignation0"][$i]:"NA"; ?></label>
                                                               
                                                        </div>
                                                        <br>
                                                        <div class="input-field col s6">
                                                        <b><label for="fromdate0" >From:</label></b>
                                                        <label><?php echo $row["fromdate"][$i]?$row["fromdate"][$i]:"NA"; ?><label>
                                                                
                                                        </div>
                                                        <br>
                                                        <div class="input-field col s6">
                                                        <b><label for="todate0" >To:</label></b>
                                                        <label><?php echo $row["todate"][$i]?$row["todate"][$i]:"NA"; ?></label>
                                                                
                                                        </div> 
                                                        <br>
                                                        <div class="input-field col s6">
                                                       <b> <label for="managername0" >Reporting Manager Name</label></b>
                                                        <label><?php echo $row["managername"][$i]?$row["managername"][$i]:"NA"; ?><label>
                                                                
                                                        </div> 
                                                        <br>      
                                                        <div class="input-field col s6">
                                                        <b><label for="managermail0" >Enter Manager Email</label></b>
                                                        <label><?php echo $row["managermail"][$i]?$row["managermail"][$i]:"NA"; ?></label>
                                                                
                                                        </div> 

                                                                                                                        
                                                  </div>
                                                </div>
          
                                                   
                                          </div>
                                               <br>
                                                <br>

                                        <?php
                                          }

                                          ?>
                                          
                                          <b style="font-size:20px;">Referral Sources</b>
                                          <br><br>                        
                                           <div class="row">
                                            
                                                <label class="col s12">
                                                        <input type="checkbox" id="internet" class="filled-in" <?php echo $row["internet"] == "on" ? 'checked':'disabled'; ?> readonly>
                                                        <span>Internet (Job Boards)</span>
                                                </label>
                                                <br><br>

                                                <label class="col s12">
                                                        <input type="checkbox" id="empref" class="filled-in" <?php echo $row["checkemp"] == "on" ? 'checked':'disabled'; ?>  readonly>
                                                        <span>Employee Referel</span>
                                                </label>
                                                <br><br>

                                                <label class="col s12">
                                                        <input type="checkbox" id="walkin" class="filled-in" <?php echo $row["walk"] == "on" ? 'checked':'disabled'; ?>  readonly>
                                                        <span>Walk-In (Factory Gate)</span>
                                                </label>
                                                <br><br>

                                                <label class="col s12">
                                                         <input type="checkbox" id="website" class="filled-in" <?php echo $row["web"] == "on" ? 'checked':'disabled'; ?>  readonly>
                                                        <span>Company Website</span>
                                                </label>
                                                <br><br>
                                                <label class="col s12" style="display:<?php echo $row["other"]? $row["other"]:'none'; ?>">
                                                        <input type="checkbox" id="other" class="filled-in" <?php echo $row["other"] == "on" ? 'checked':'disabled'; ?>  readonly>
                                                        <span> Other</span><br>
                                                        <label> <b>Reason if other selected - </b><?php echo $row["otherdetails"]; ?><label>                                                        
                                                </label>
                                                
                                                <br><br>
                                                   
                                          </div>


<br>
                                          <div class="row">
                                                <div class="input-field col s6">
                                                <b><label for="jdate" >If Selected, how soon you can join us?</label></b>
                                                <br><br>
                                                <label><?php echo $row["jdate"]; ?></label><br>
                                                  
                                                </div>
                                                <br>
                                                
                                                <div class="input-field col s6">
                                               <b> <label for="notice" >Notice Period In Current Oraganization</label></b>
                                               <br><br>
                                                <label><?php echo $row["notice"]; ?></label><br>
                                                    
                                                </div>
                                                <br>
                                                
                                                <div class="input-field col s6" >
                                                <b><label for="manager" >Reporting Manager Name & Designation</label></b>
                                                <br><br>
                                                 <label><?php echo $row["manager"]; ?></label><br>
                                                        
                                                </div>
                                                <br>
                                                <div class="input-field col s6" >
                                                <b><label for="ifselectposition" >Current Position</label></b>
                                                <br><br>
                                                <label><?php echo $row["ifselectposition"]; ?></label><br>
                                                        
                                                </div>
                                                <br>
                                                

                                             
                           
                                          </div>



                                          <br><br>

                                            <b style="font-size:20px;">Family Details :</b>
                                                <br><br>
                                          <div class="row">

                                                

                                         <table width="350"> 
                                        <tr>
                                        <td> <b><label for="father">Father Name</label></b></td>
                                        <td><b><label for="fdob">DOB</label></b></td>
                                  
                                        </tr>
                                        <tr>
                                        <td>  <label><?php echo $row["fathersname"]; ?></label><br></td>
                                        <td>   <label><?php echo $row["fdob"]; ?></label><br></td>
                                
                                        </tr>
                                        </table>   
<br><br>

                                        <table width="350"> 
                                        <tr>
                                        <td> <b><label for="mother">Mother Name</label></b></td>
                                        <td><b><label for="fdob">DOB</label></b></td>
                                  
                                        </tr>
                                        <tr>
                                        <td>  <label><?php echo $row["mother"]; ?></label><br></td>
                                        <td>   <label><?php echo $row["mdob"]; ?></label><br></td>
                                
                                        </tr>
                                        </table>   

                                        <br><br>
                                        
                                        <table width="350"> 
                                        <tr>
                                        <td> <b><label for="mother">Spouse  Name</label></b></td>
                                        <td><b><label for="fdob">DOB</label></b></td>
                                        <td><b><label for="fdob">Gender</label></b></td>
                                  
                                        </tr>
                                        <tr>
                                        <td>  <label><?php echo $row["spousename"]?$row["spousename"]:"NA"; ?></label><br></td>
                                        <td>   <label><?php echo $row["spdob"]?$row["spdob"]:"NA"; ?></label><br></td>
                                        <td>   <label><?php echo $row["sgender"]?$row["sgender"]:"NA"; ?></label><br></td>
                                
                                        </tr>
                                        </table>   
<br><br>



<table width="350"> 
                                        <tr>
                                        <td> <b><label for="mother">Child1  Name</label></b></td>
                                        <td><b><label for="fdob"> Child1  DOB</label></b></td>
                                        <td><b><label for="fdob">Child1  Gender</label></b></td>
                                  
                                        </tr>
                                        <tr>
                                        <td>  <label><?php echo $row["child1"]?:"NA"; ?></label><br></td>
                                        <td>   <label><?php echo $row["ch1dob"]?$row["ch1dob"]:"NA"; ?></label><br></td>
                                        <td>   <label><?php echo $row["ch1gender"]?$row["ch1gender"]:"NA"; ?></label><br></td>
                                
                                        </tr>
                                        </table>   
<br><br>



<table width="350"> 
                                        <tr>
                                        <td> <b><label for="mother">Child2  Name</label></b></td>
                                        <td><b><label for="fdob"> Child2  DOB</label></b></td>
                                        <td><b><label for="fdob">Child2  Gender</label></b></td>
                                  
                                        </tr>
                                        <tr>
                                        <td>  <label><?php echo $row["child2"]?:"NA"; ?></label><br></td>
                                        <td>   <label><?php echo $row["ch2dob"]?$row["ch2dob"]:"NA"; ?></label><br></td>
                                        <td>   <label><?php echo $row["ch2gender"]?$row["ch2gender"]:"NA"; ?></label><br></td>
                                
                                        </tr>
                                        </table>   
<br><br>


 

                                            
 

               


                                          </div>
                                          <b style="font-size:20px;">Renumeration Details:</b><br><br>
                                          <div class="row">

                                                <div class="input-field col s6">
                                                       <b> <label>Annual Gross(CTC)</label></b><br><br>
                                                        
                                                </div>
    
                                                

                                        <table width="350"> 
                                        <tr>
                                        <td> <b><label for="homepresent">Present: </label></b></td>
                                        <td><b><label for="homeexp">Expected: </label></b></td>
                                  
                                        </tr>
                                        <tr>
                                        <td><label><?php echo $row["homepresent"]; ?></label><br></td>
                                        <td> <label><?php echo $row["homeexpect"]; ?></label><br></td>
                                
                                        </tr>
                                        </table>      


                                                
                                                <br><br>
                                                <div class="input-field col s6">
                                                       <b><label>Monthly Gross(CTC)</label></b><br><br>
                                                        
                                                </div>
    
    
                                                <table width="350"> 
                                        <tr>
                                        <td> <b><label for="homepresent">Present: </label></b></td>
                                        <td><b><label for="homeexp">Expected: </label></b></td>
                                  
                                        </tr>
                                        <tr>
                                        <td> <label><?php echo $row["grosspresent"]; ?></label><br></td>
                                        <td>  <label><?php echo $row["grossexpect"]; ?></label><br></td>
                                
                                        </tr>
                                        </table>      

                                                

                                                <br><br>
                                                
                                                <div class="input-field col s6">
                                                       <b> <label>Monthly Take Home</label></b><br><br>
                                                        
                                                </div>
    

       
    
                                        <table width="350"> 
                                        <tr>
                                        <td> <b><label for="homepresent">Present: </label></b></td>
                                        <td><b><label for="homeexp">Expected: </label></b></td>
                                  
                                        </tr>
                                        <tr>
                                        <td>  <label><?php echo $row["ypresent"]; ?></label><br></td>
                                        <td>   <label><?php echo $row["yexpect"]; ?></label><br></td>
                                
                                        </tr>
                                        </table>      
                                                
    
                                          </div>
<br><br>

                                         
                                          <b style="font-size:20px;">References :</b>
                                          <br><br>
                                          <?php 
                                          $ctr=1;
                                          for($i=0;$i<count($row["refname"]);$i++)
                                          {
                
                                                  ?>

                                                <div class="row" id="mainref">
                                                  <div id="ref" class="col">

                                                  
                                                       
                                                 <b> <label for="nameref0">Reference  </label></b><label><?php echo $ctr; ?><label><br>
                                                        
                                                 <br>
                                               
                                                
                                                <div class="input-field col s6">
                                               <b> <label for="nameref0">Reference Name:</label></b>
                                                        <label><?php echo $row["refname"][$i]; ?><label><br>
                                                      
                                                </div>
                                                
                                                
                                                
                                                <br>
    
                                                
                                                <div class="input-field col s6">
                                                <b><label for="designationref0">Designation:</label></b>
                                                       <label><?php echo $row["refdsg"][$i]; ?></label><br>
                                                        
                                                </div>
                                                
                                                <br>
    
                                                
                                                <div class="input-field col s6">
                                                <b><label for="cpmnmref0">Company name: </label></b>
                                                      <label><?php echo $row["refcn"][$i]; ?></label><br>
                                                       
                                                </div>
                                                
                                               


                                                <br>
                                 
                                                
                                                <div class="input-field col s6">
                                                <b><label for="contref0">Contact Number:</label></b>
                                                        <label><?php echo $row["refcontact"][$i]; ?></label><br>
                                                   
                                                </div>
                                                <br>
                                                
                                                <div class="input-field col s6">
                                                       <b> <label>LandLine Number</label></b>
       
                                                </div>
                                                <br>
    
                                                <div class="input-field col s3">
                                               <b> <label for="stdcoderef0">STD  Code:</label></b>
                                                        <label><?php echo $row["refstd"][$i]; ?><label>
                                                        
                                                </div>
                                                <br>
                                                <div class="input-field col s3">
                                               <b> <label for="phoneref0">Contact:</label></b>
                                                        <label><?php echo $row["refphone"][$i]; ?></label>
                                                        
                                                </div>
                                                                                                
                                                <br>
                                                <div class="input-field col s6">
                                                <b><label for="mailref0">Company Email: </label></b>
                                                       <label><?php echo $row["refmail"][$i]; ?></label><br>
                                                       
                                                </div>


                                        </div>
                                        </div>
<br> <br>

                                                  <?php
                                                  $ctr++;
                                          }
                                          
                                          ?>
                                          
                                              
        

                                                
    
                                         



                                   
                                        
                                      </div>
                                            


                                <!-- form end -->




<b><p style="font-size:20px;">Documents Attached:</p></b>

                                       
<div class="row">
<div class="input-field col s12" id="uphoto">
<a class="waves-effect blue darken-1 btn" href ="<?php echo $row["usercv"]; ?>" target="_blank" >Candidate CV</a>
 </div>                                       
</div> 
<br>

<div class="row">
<div class="input-field col s12" >
<a class="waves-effect blue darken-1 btn" href ="<?php echo $row["alldocs"]; ?>" target="_blank" >Highest Qualification</a>
</div>
</div>

<br>

                                          

                                          <div class="row">
                                                                                        
                                                <div class="input-field col s12" id="showaddharupload">

                                                <a class="waves-effect blue darken-1 btn" href ="<?php echo $row['proofaadhar']; ?>" target="_blank" >Aadhar Card as Proof Of Identity</a>

                                                </div>
                                        </div><br>
                                         <div id="uploadotherdoc">
                                                      
<br>

                                                        <div class="row">
                                                                <div class="input-field col s12" >
                                                                
                                                                                  <a class="waves-effect blue darken-1 btn" href ="<?php echo $row['proofidentity']; ?>" target="_blank" >Proof Of Identity(PAN/Voter ID/Driving Licence/Passport)</a>

                                                                              </div>
                                                              </div><br>                                                        
                                         </div>
                                         
          <br>                                  

                                                
                                          <div class="row">

                                                <div class="input-field col s12" >
                                        
                                                    <a class="waves-effect blue darken-1 btn" href ="<?php echo $row['proofaddr']; ?>" target="_blank" >Proof Of Address(Rent Agreement/Voter ID/Driving Licence/Passport)</a>

                                                </div>
                                          </div>





                           
                          </div>
                        </div>
                      </div>
                     
                      </div>
                         

                       
</body>
<script>
$(document).ready(function(){
        $('#image_upload_preview').hide()
        window.print();
})

</script>
</html>
<?php
          }
          else
          {
                  echo "jojojoj";
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