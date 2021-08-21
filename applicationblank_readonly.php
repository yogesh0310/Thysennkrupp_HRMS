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
    if($designation == "hr" || $designation == "ceo" || $designation == "hod" || $designation == "inv" || $designation == "hr2" )
    {
        $mailid = $_GET['aid'];
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

              <nav>
                    <div class="nav-wrapper blue darken-1">
                      <a href="#!" class="brand-logo center">thyssenkrupp Elevators</a>
                     </div>
                  </nav>
                  <br><br>


                  <div class="row">
                        
                        <div class="col s12 m6 offset-m3">
                        

                          <!-- <center> <p><h5> <b> Applicant Mail : <?php echo $_GET['aid']; ?></b></h5></p> </center> -->

                          <div class="card white">

                            <div class="card-content blue-text darken-1">



                                <!-- form starts -->

                                <center>
                                        <b style="font-size: 35px">Application Form</b><br><br>
                                        
                                </center> 
                                
                                
                                        <b style="font-size:20px;">Candidate Photo</b><br>
                                        
                                       
                                       

                                    <div class="row"> 
                                    
                                        <div class="input-field col s12" id="uphoto">
                                               <img src="<?php echo $row["userphoto"]; ?>" alt="" width="150" height="150"> 
                                        </div>
                                        </div>


                                        <b style="font-size:20px;">Candidate CV</b><br>
                                        
                                        <div class="row">
                                        <div class="input-field col s12" id="uphoto">
                                        <a class="waves-effect blue darken-1 btn" href ="<?php echo $row["usercv"]; ?>" target="_blank" >View Candidate CV</a>
                                        </div>                                       
                                        </div> 
                                        
                                          <div class="row">
                                                <div class="input-field col s6">
                                                        <input id="useradharno" type="text" class="validate"  value = "<?php echo $row["aadharno"]; ?>" readonly required maxlength="12" aria-required="true">
                                                        <label for="useradharno">Aadhar Card Number</label>
                                                      </div> 
                                          </div>                                           

                                        <div class="row">

                                            <!-- <div class="input-field col s12">
                                              <input id="full_name" type="text" class="validate"  value = "" readonly required="" aria-required="true">
                                              <label for="full_name">Full Name</label>
                                            </div> -->
                                          
                                          <div class="input-field col s4">
                                              <input id="last_name" name="last_name" type="text" class="validate" value="<?php echo $row['last_name'];?>" readonly required aria-required="true">
                                              <label for="last_name">Last Name</label>
                                            </div>
                                            <div class="input-field col s4">
                                              <input id="first_name" name="first_name" type="text" class="validate" value="<?php echo $row['first_name'];?>" readonly required aria-required="true">
                                              <label for="first_name">First Name</label>
                                            </div>
                                            <div class="input-field col s4">
                                              <input id="mid_name" name="mid_name" type="text" class="validate" value="<?php echo $row['mid_name'];?>" readonly required aria-required="true">
                                              <label for="mid_name">Middle Name</label>
                                            </div>
                                        </div>                                    


                                            <b class="blue-text" style="font-size:20px;">Present Address</b>
                                          <div class="row">
                                            <!-- <div class="input-field col s12">
                                              <input   id="address" type="text" class="validate"  value = "" readonly required="" aria-required="true">
                                              <label for="address">Present Address</label>
                                            </div> -->



                                            <div class="input-field col s4">
                                              <input   id="street" name="street" type="text" class="validate" value = "<?php echo $row["street"]; ?>" readonly required aria-required="true">
                                              <label for="street">Street</label>
                                            </div>

                                            <div class="input-field col s4">
                                              <input   id="Locality" name="Locality" type="text" class="validate" value = "<?php echo $row["Locality"]; ?>" readonly required aria-required="true">
                                              <label for="Locality">Locality</label>
                                            </div>

                                            <div class="input-field col s4">
                                              <input   id="City" name="City" type="text" class="validate" value = "<?php echo $row["City"]; ?>" readonly required aria-required="true">
                                              <label for="City">City</label>
                                            </div>

                                            <div class="input-field col s4">
                                              <input   id="State" name="State" type="text" class="validate" value = "<?php echo $row["State"]; ?>" readonly required aria-required="true">
                                              <label for="State">State</label>
                                            </div>

                                            <div class="input-field col s4">
                                              <input   id="Pincode" name="Pincode" type="number" class="validate" value = "<?php echo $row["Pincode"]; ?>" readonly required aria-required="true">
                                              <label for="Pincode">Pincode</label>
                                            </div>
                                          </div>

                                          <b class="blue-text" style="font-size:20px">Contact Details</b>
                                          <div class="row">
                                            <div class="input-field col s4">
                                              <input id="unumber" type="number" class="validate"  value = "<?php echo $row["number"]; ?>" readonly required="" aria-required="true">
                                              <label for="number">Contact number</label>
                                            </div>

                                            <div class="input-field col s4">
                                              <input id="stdcode" name="stdcode" type="number" value = "<?php echo $row["std"]; ?>" readonly>
                                              <label for="stdcode">STD Code (Optional)</label>
                                            </div>

                                            <div class="input-field col s4">
                                              <input id="pnumber" maxlength="7" name="pnumber" type="number" value = "<?php echo $row["phonenum"]; ?>" readonly>
                                              <label for="pnumber">Telphone number (Optional)</label>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="input-field col s6">
                                              <input id="uemail" type="email" class="validate" value = "<?php echo $row["email"]; ?>" readonly  required="" aria-required="true">
                                              <label for="uemail">Email</label>
                                            </div>

                                            
                                            <div class="input-field col s6">
                                                <input id="udob" type="text" class="datepicker" value = "<?php echo $row["dob"]; ?>" readonly required="" aria-required="true">
                                                <label for="udob">Date Of Birth</label>
                                            </div>
                                                 
                                          </div>


                                          <div class="row">
                                                <div class="input-field col s6">
                                                  <input id="position" type="text" class="validate"  value = "<?php echo $row["position"]; ?>" readonly required="" aria-required="true">
                                                  <label for="position">Position Applied For</label>
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                    <input id="location" type="text" class="validate" value = "<?php echo $row["location"]; ?>" readonly required="" aria-required="true">
                                                    <label for="location">Location</label>
                                                </div>
                           
                                          </div>


                                          <div class="row">
                                            
                                                <div class="input-field col s12">
                                                  <input id="passport" type="text" class="validate" value = "<?php echo $row["passport"]; ?>" readonly required="" aria-required="true">
                                                  <label for="passport">Passport Availability/Validity</label>
                                                </div>
                                          </div>

                                          <b style="font-size:20px;">Academic Professional Qualification (Highest Qualification)</b>
                                          <!-- <div class="row">
                                                
                                                <div class="input-field col s6">
                                                        <input id="qualification" type="text" class="validate"  value = "<?php echo $row["qualification"]; ?>" readonly required="" aria-required="true">
                                                        <label for="qualification">Highest Qualification</label>
                                                      </div>
          
                                                      
                                                      <div class="input-field col s6">
                                                          <input id="passing" type="text" class="validate" value = "<?php echo $row["passing"]; ?>" readonly required="" aria-required="true">
                                                          <label for="passing">Passing Year</label>
                                                      </div>
                                                </div>
                                                <b style="color: red;">Documents Until Highest Qualification</b>
                                                <br><br>
                                                <div class="row">
                                                <div class="input-field col s12" >
                                                <a class="waves-effect blue darken-1 btn" href ="<?php echo $row["alldocs"]; ?>" target="_blank" >Qualifications</a>
                                                </div>
                                                </div> -->
                                                <br><br>
                                          <div class="row">                                          
                                          
                                             <div class="col s6">
                                                <b style="font-size:15px;color:red">Select for Under Graduate</b>
                                                <select class="dropdown-trigger btn blue darken-2" id="selectug">
                                                <option value="<?php echo $row['selectug']; ?>" disabled selected><?php echo $row['selectug']; ?></option>
                                                </select>
                                              </div>
                                                

                                           
                                             <div class="col s6">
                                                <b style="font-size:15px;color:red">Select Specialization for UG</b>
                                                <select class="dropdown-trigger btn blue darken-2" id="specialug">
                                                <option value="<?php echo $row['specialug']; ?>" disabled selected><?php echo $row['specialug']; ?></option>
                                                </select> 
                                              </div>

                                                                                             
                                                
                                             <div class="col s6" style="margin-top:20px">
                                                <b style="font-size:15px;color:red">Select for Post Graduate</b>
                                                <select class="dropdown-trigger btn blue darken-2" id="selectpg">
                                                <option value="<?php echo $row['selectpg']; ?>" disabled selected><?php echo $row['selectpg']; ?></option>
                                                </select> 
                                              </div> 

                                              <div class="col s6" style="margin-top:20px">
                                                <b style="font-size:15px;color:red">Select Specialization for PG</b>
                                                <select class="dropdown-trigger btn blue darken-2" id="specialpg">
                                                <option value="<?php echo $row['specialpg']; ?>" readonly><?php echo $row['specialpg']; ?></option>
                                                </select> 
                                              </div> 
                                        </div>
     
                                          <b style="font-size:20px;">Professional Experience (Mention Company Name And Designation)</b>
                                          <?php  
                                          
                                          for($i=0;$i<count($row["orgname"]);$i++)
                                          {
                                        ?>
                                                <div class="row">
                                                
            
                                                <div class=" col s12" id="mainexpdiv">
                                                  <div class="col s12" id="myexpdiv">
                                                          
                                                        <div class="input-field col s6">
                                                                <input id="orgname0" type="text" class="validate" value = "<?php echo $row["orgname"][$i]?$row["orgname"][$i]:"NA"; ?>" readonly  required="" aria-required="true">
                                                                <label for="orgname0" >Current Organization Name</label>
                                                        </div>
                                  
                                                                              
                                                        <div class="input-field col s6">
                                                                <input id="olddesignation0" type="text"class="validate" required="" aria-required="true"  value = "<?php echo $row["olddesignation0"][$i]?$row["olddesignation0"][$i]:"NA"; ?>" readonly>
                                                                <label for="olddesignation0" >Designation</label>
                                                        </div>
                                                        
                                                        <div class="input-field col s6">
                                                                <input id="fromdate0" type="text" class="datepicker" value = "<?php echo $row["fromdate"][$i]?$row["fromdate"][$i]:"NA"; ?>" readonly>
                                                                <label for="fromdate0" >From</label>
                                                        </div>

                                                        <div class="input-field col s6">
                                                                <input id="todate0" type="text" class="datepicker" value = "<?php echo $row["todate"][$i]?$row["todate"][$i]:"NA"; ?>" readonly>
                                                                <label for="todate0" >To</label>
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
                                                </label><br>

                                                <label class="col s12">
                                                        <input type="checkbox" id="empref" class="filled-in" <?php echo $row["checkemp"] == "on" ? 'checked':'disabled'; ?>  readonly>
                                                        <span>Employee Referel</span>
                                                </label><br>

                                                <label class="col s12">
                                                        <input type="checkbox" id="walkin" class="filled-in" <?php echo $row["walk"] == "on" ? 'checked':'disabled'; ?>  readonly>
                                                        <span>Walk-In (Factory Gate)</span>
                                                </label><br>

                                                <label class="col s12">
                                                         <input type="checkbox" id="website" class="filled-in" <?php echo $row["web"] == "on" ? 'checked':'disabled'; ?>  readonly>
                                                        <span>Company Website</span>
                                                </label><br>

                                                <label class="col s12" style="display:<?php echo $row["other"]? $row["other"]:'none'; ?>">
                                                        <input type="checkbox" id="other" class="filled-in" <?php echo $row["other"] == "on" ? 'checked':'disabled'; ?>  readonly>
                                                        <span>Other</span>
                                                        <input placeholder="Enter Specific Details" value="<?php echo $row["otherdetails"]; ?>" readonly  type="text" >                                                        
                                                </label>
                                                
                                            
                                                   
                                          </div>



                                          <div class="row">
                                                <div class="input-field col s6">
                                                  <input id="jdate" type="text" value = "<?php echo $row["jdate"]; ?>" readonly>
                                                  <label for="jdate" >If Selected, how soon you can join us?</label>
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                    <input id="notice" type="number" value = "<?php echo $row["notice"]; ?>" readonly >
                                                    <label for="notice" >Notice Period In Current Oraganization</label>
                                                </div>

                                                
                                                <div class="input-field col s6" >
                                                        <input id="manager" type="text" value="<?php echo $row["manager"]; ?>" readonly >
                                                        <label for="manager" >Reporting Manager Name & Designation</label>
                                                </div>                                             
                                        
                           
                                          </div>


                                          
                                          <!-- <b style="font-size:20px;">Aadhar Card as Proof Of Identity</b>
                                          <div class="row">
                                                <div class="input-field col s12">
                                                        <a class="btn green" id="yesforaadhar">YES</a>                                                                                                               
                                                        <a class="btn red" id="noforaadhar">NO</a>
                                                </div> -->
                                                                                        
                                                <!-- <div class="input-field col s12" id="showaddharupload">

                                                <a class="waves-effect blue darken-1 btn" href ="<?php echo $row['proofaadhar']; ?>" target="_blank" >Adhaar Card</a>

                                                </div>
                                        </div><br>
                                         <div id="uploadotherdoc">
                                                        <b>Proof Of Identity(PAN/Voter ID/Driving Licence/Passport)</b>


                                                        <div class="row">
                                                                <div class="input-field col s12" >
                                                                
                                                                                  <a class="waves-effect blue darken-1 btn" href ="<?php echo $row['proofidentity']; ?>" target="_blank" >Identity Proof</a>

                                                                              </div>
                                                              </div><br>                                                        
                                         </div>
                                         
                                            

                                            <b style="font-size:20px;">Proof Of Address(Rent Agreement/Voter ID/Driving Licence/Passport)</b>
                                                
                                          <div class="row">

                                                <div class="input-field col s12" >
                                        
                                                    <a class="waves-effect blue darken-1 btn" href ="<?php echo $row['proofaddr']; ?>" target="_blank" >Proof Of Address</a>

                                                </div>
                                          </div> -->

                                          <br><br>

                                            <b style="font-size:20px;">Family Details :</b>
                                                
                                          <div class="row">

                                                
                                            <div class="input-field col s6">
                                                    <input id="father" type="text" value = "<?php echo $row["fathersname"]; ?>" readonly>
                                                    <label for="father">Father Name</label>
                                            </div>

                                            
                                            <div class="input-field col s6">
                                                    <input id="fdob" type="text" class="datepicker"  value = "<?php echo $row["fdob"]; ?>" readonly >
                                                    <label for="fdob">DOB</label>
                                            </div>


                                            
                                            <div class="input-field col s6">
                                                    <input id="mother" type="text" value = "<?php echo $row["mother"]; ?>" readonly>
                                                    <label for="mother">Mother Name</label>
                                            </div>

                                            
                                            <div class="input-field col s6">
                                                    <input id="mdob" type="text" class="datepicker" value = "<?php echo $row["mdob"]; ?>" readonly >
                                                    <label for="mdob">DOB</label>
                                            </div>


                                            
                                            <div class="input-field col s6">
                                                    <input id="spouse" type="text" value = "<?php echo $row["spousename"]?$row["spousename"]:"NA"; ?>" readonly>
                                                    <label for="spouse">Spouse Name</label>
                                            </div>

                                            
                                            <div class="input-field col s3">
                                                    <input id="spdob" type="text" class="datepicker" value = "<?php echo $row["spdob"]?$row["spdob"]:"NA"; ?>" readonly>
                                                    <label for="spdob">DOB</label>
                                            </div>
                                            
                                            <div class="col s3 ">
                                                <br>
                                                    <select id='sgender' class="dropdown-trigger btn blue darken-1" > 
                                                        <option value="<?php echo $row["sgender"]; ?>"><?php echo $row["sgender"]; ?></option>
                                                      </select>
                                                      <br><br>
                                                </div>   
                                  

                                            
                                            <div class="input-field col s6">
                                                    <input id="child1" type="text" value = "<?php echo $row["child1"]?:"NA"; ?>" readonly>
                                                    <label for="child1">Child1 Name</label>
                                            </div>

                                            
                                            <div class="input-field col s3">
                                                    <input id="c1dob" type="text" class="datepicker" value = "<?php echo $row["ch1dob"]?$row["ch1dob"]:"NA"; ?>" readonly>
                                                    <label for="c1dob">DOB</label>
                                            </div>
                                            <div class="col s3 ">
                                                    <br>
                                                        <select id='c1gender' class="dropdown-trigger btn blue darken-1" >
                                                           
                                                            <option value="<?php echo $row["ch1gender"]; ?>"><?php echo $row["ch1gender"]; ?></option>
                                                            
                                                          </select>
                                                          <br><br>
                                                    </div> 


                                            
                                            <div class="input-field col s6">
                                                    <input id="child2" type="text" value = "<?php echo $row["child2"]?$row["child2"]:"NA"; ?>" readonly>
                                                    <label for="child2">Child2 Name</label>
                                            </div>

                                            
                                            <div class="input-field col s3">
                                                    <input id="c2dob" type="text" class="datepicker" value = "<?php echo $row["ch2dob"]?$row["ch2dob"]:"NA"; ?>" readonly >
                                                    <label for="c2dob">DOB</label>
                                            </div>

                                            
                                            <div class="col s3 ">
                                                    <br>
                                                        <select id='c2gender' class="dropdown-trigger btn blue darken-1" >
                                                            
                                                            <option value="<?php echo $row["ch2gender"]; ?>"><?php echo $row["ch2gender"]; ?></option>
                                                          
                                                          </select>
                                                          <br><br>
                                                    </div> 



                                          </div>
                                          <b style="font-size:20px;">Renumeration Details:</b>
                                          <div class="row">

                                                <div class="input-field col s6">
                                                        <input id="monthhome" type="text" disabled value="Annual Gross(CTC)" style="color: black" >
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s3">
                                                        <input id="homepresent" type="number" value = "<?php echo $row["homepresent"]; ?>" readonly>
                                                        <label for="homepresent">Present</label>
                                                </div>
                                                
                                                <div class="input-field col s3">
                                                        <input id="homeexp" type="number" value = "<?php echo $row["homeexpect"]; ?>" readonly>
                                                        <label for="homeexp">Expected</label>
                                                </div>
                                                
                                                
                                                <div class="input-field col s6">
                                                        <input id="child2" type="text" disabled value="Monthly Gross(CTC)" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s3">
                                                        <input id="grosspresent" type="number" value = "<?php echo $row["grosspresent"]; ?>" readonly>
                                                        <label for="grosspresent">Present</label>
                                                </div>
                                                
                                                
                                                <div class="input-field col s3">
                                                        <input id="grossexp" type="number" value = "<?php echo $row["grossexpect"]; ?>" readonly>
                                                        <label for="grossexp">Expected</label>
                                                </div>
                                                


                                                
                                                <div class="input-field col s6">
                                                        <input id="child2" type="text" disabled value="Monthly Take Home" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s3">
                                                        <input id="yearpresent" type="number" value = "<?php echo $row["ypresent"]; ?>" readonly>
                                                        <label for="yearpresent">Present</label>
                                                </div>
                                                
                                                <div class="input-field col s3">
                                                        <input id="yearexp" type="number" value = "<?php echo $row["yexpect"]; ?>" readonly>
                                                        <label for="yearexp">Expected</label>
                                                </div>
    
                                          </div>


                                         
                                          <b style="font-size:20px;">References :</b>
                                          <?php 
                                          
                                          for($i=0;$i<count($row["refname"]);$i++)
                                          {
                                                  ?>

                                                <div class="row" id="mainref">
                                                  <div id="ref" class="col">

                                                <div class="input-field col s6">
                                                        <input id="nameref" type="text" disabled value="Name" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                        <input id="nameref0" type="text" value = "<?php echo $row["refname"][$i]; ?>" readonly>
                                                        <label for="nameref0">Reference</label>
                                                </div>
                                                
                                                
                                                
                                                
                                                <div class="input-field col s6">
                                                        <input id="dsgref" type="text" disabled value="Designation" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                        <input id="designationref0" type="text" value="<?php echo $row["refdsg"][$i]; ?>" readonly>
                                                        <label for="designationref0">Reference</label>
                                                </div>
                                                
                                               
                                                
                                                <div class="input-field col s6">
                                                        <input id="cnameref" type="text" disabled value="Company Name" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                        <input id="cmpnmref0" type="text" value="<?php echo $row["refcn"][$i]; ?>" readonly>
                                                        <label for="cpmnmref0">Reference </label>
                                                </div>
                                                
                                               


                                                
                                                <div class="input-field col s6">
                                                        <input id="cnoref" type="text" disabled value="Company Number" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                        <input id="contref0" type="number" class="validate" value="<?php echo $row["refcontact"][$i]; ?>" readonly required="" aria-required="true"/>
                                                        <label for="contref0">Reference</label>
                                                </div>
                                                
                                                <div class="input-field col s6">
                                                        <input id="phoneref" type="text" disabled value="LandLine Number" style="color: black">
       
                                                </div>
    
                                                <div class="input-field col s3">
                                                        <input id="stdcoderef0" name="stdcoderef0[]" type="number" value="<?php echo $row["refstd"][$i]; ?>" readonly />
                                                        <label for="stdcoderef0">STD  Code</label>
                                                </div>
                                                <div class="input-field col s3">
                                                        <input id="phoneref0" name="phoneref0[]" type="number" value="<?php echo $row["refphone"][$i]; ?>" readonly/>
                                                        <label for="phoneref0">Reference</label>
                                                </div>
                                                                                                

                                                <div class="input-field col s6">
                                                         <input id="emailref" type="text" value="Company Email" disabled style="color: black">
                                                </div>

                                                <div class="input-field col s6">
                                                        <input id="mailref0" type="email" class="validate" value = "<?php echo $row["refmail"][$i]; ?>" readonly required="" aria-required="true">
                                                        <label for="mailref0">Reference</label>
                                                </div>


                                        </div>
                                        </div>
<br> <br>

                                                  <?php
                                          }
                                          
                                          ?>
                                          
                                              
        

                                                
    
                                         



                                   
                                        
                                      </div>
                                            


                                <!-- form end -->










                           
                          </div>
                        </div>
                      </div>
                     
                      </div>
                         

                       
</body>
<script>
$(document).ready(function(){
        $('#image_upload_preview').hide()
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