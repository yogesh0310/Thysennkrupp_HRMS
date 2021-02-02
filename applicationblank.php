<?php
session_start();
?>
<html> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" /> -->

    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
   
    <script src="public/jquery-3.2.1.min.js"></script>

    <script src="public/js/materialize.js"></script>
    <script src="public/js/materialize.min.js"></script>

   
    

</head>

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
 
/* input[type="text"] {
  text-transform: uppercase;
}  */

input[type='number']::-webkit-outer-spin-button,
input[type='number']::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0; 
}

input[type=number] {
    -moz-appearance:textfield;
}

@media screen and (max-width: 360px){
    #std,#stdref
    {
        font-size:10px;
    }
    #tele,#teleref
    {
        font-size:10px;
    }

}

<?php

$position = $_GET['position'];
$_SESSION['positionapplied'] = $position;

?>


</style>

<body>



                <nav>
                    <div class="nav-wrapper blue darken-1">
                      <a href="#!" class="brand-logo center">thyssenkrupp Elevators</a>
                     </div>
                </nav>
                  <br><br>

                <!-- warnings starts here -->
                <div class="row" id="warn">
                        <div class="col s12 m6 offset-m3">
                                <div class="card white">
                                        <div class="card-content ">
                                                <center><i class="material-icons large" style="color: green;">check_circle</i></center>
                                                <center><h1><p  style="color:green">Details Submitted Successfully...!</p></h5></center>
                                        </div>
                                </div>
                        </div>
                </div>

                <div class="row" id="warn2">
                        <div class="col s12 m6 offset-m3">
                                <div class="card white">
                                        <div class="card-content ">
                                                <center><i class="material-icons large" style="color: red;">error</i></center>
                                                <center><h1><p  style="color:red">Form Expired <br> 7 Days Passed</p></h5></center>
                                        </div>
                                </div>
                        </div>
                </div>

                <div class="row" id="warn3">
                        <div class="col s12 m6 offset-m3">
                                <div class="card white">
                                        <div class="card-content ">
                                        
                                                <center><h1><p style="color:red;font-size: 25px"><b> Attention</b><br>
                                                If you are re-applying, please make sure it has been six months since your previous application.</p></h5></center>
                                        </div>
                                </div>
                        </div>
                </div>
                <!-- warning fields ends here -->
               
                                    
                    

                  <div class="row">
                        
                        <div class="col s12 m6 offset-m3">
                          <div class="card white">
                            <div class="card-content blue-text darken-1" id="form">
                            
                          <form method="POST" id="myform"  name="applicationblank" enctype='multipart/form-data'  > 
                                 
                                <span class="error-all" style="color:red;font-weight:bold;">
                                        <center>  Please check your form again and fill all the required fields.</p></h5></center>
                                </span>
                                <!-- form starts -->
                                <center>

                                        <b style="font-size: 35px">Application Form</b><br><br>
                                        
                                </center> 
                                
                                <div class="row">
                                        <b style="font-size:20px;">Candidate Photo</b><br>
                                        
                                       
                                                        <img name="photo" id="image_upload_preview" src="" alt="your image" width="150" height="150"/>
                                       
                                </div>
                                <div class="row"> 

                                        <div class="file-field input-field">
                                                <div class="btn blue darken-1">
                                                        <span>Upload Photo</span>
                                                        <input id="photo"    name='photo' type="file" accept=".png, .jpg, .jpeg" required="true">
                                                </div>
                                                <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text">
                                                </div>
                                        </div>
                                        
                                    </div><br>
                                
                                     
                                    <b style="font-size:20px;">Candidate CV</b>
                                
                                        <div class="file-field input-field">
                                                <div class="btn blue darken-1">
                                                        <span>Upload CV</span>
                                                        <input id="mycv" name="mycv" required type="file" accept=".pdf">
                                                </div>
                                                <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text">
                                                </div>
                                        </div>
                                        
                                      
                                          <div class="row">
                                        <b style="font-size:20px;margin-left:2%;">Aadhaar Card Number</b><br>

                                                <div class="input-field col s6">
                                                        <input id="aadharno" name="aadharno" type="number" class="validate"   onkeypress="return mynumbervalid(event)" required >
                                                        <label for="aadharno">Aadhaar Card Number</label>
                                                        <span id="error-adhar"></span>
                                                </div> 
                                          </div>                                           
                                        <b class="blue-text" style="font-size:20px;">Candidate Name</b>
                                        <div class="row">

                                            <div class="input-field col s4">
                                              <input id="last_name" name="last_name" type="text" class="validate"  onkeyup="this.value=this.value.toUpperCase();"   onkeypress="return mytextvalid(event)" required>
                                              <label for="last_name">Last Name</label>
                                              <span id="error-lname"></span>
                                            </div>
                                            <div class="input-field col s4">
                                              <input id="first_name" name="first_name" type="text" class="validate" onkeyup="this.value=this.value.toUpperCase();"    onkeypress="return mytextvalid(event)" required>
                                              <label for="first_name">First Name</label>
                                              <span id="error-fname"></span>
                                            </div>
                                            <div class="input-field col s4">
                                              <input id="mid_name" name="mid_name" type="text" onkeyup="this.value=this.value.toUpperCase();" onkeypress="return mytextvalid(event)" required>
                                              <label for="mid_name">Middle Name</label>
                                              <span id="error-mname"></span>
                                            </div>
                                        </div>
                                          <b class="blue-text" style="font-size:20px;">Present Address</b>
                                          <div class="row">
                                                
                                            <div class="input-field col s4">
                                              <input   id="street" name="street" type="text" class="validate" onkeyup="this.value=this.value.toUpperCase();"   onchange="return mytextvalid(event)" required>
                                              <label for="street"> House Number</label>
                                            </div>

                                            <div class="input-field col s4">
                                              <input   id="Locality" name="Locality" type="text" class="validate" onkeyup="this.value=this.value.toUpperCase();"  required >
                                              <label for="Locality">Locality/society</label>
                                            </div>

                                            <div class="input-field col s4">
                                              <input   id="City" name="City" type="text" class="validate" onkeyup="this.value=this.value.toUpperCase();"   onkeypress="return mytextvalid(event)" required>
                                              <label for="City">City</label>
                                            </div>

                                            <div class="input-field col s4">
                                              <input   id="State" name="State" type="text" class="validate" onkeyup="this.value=this.value.toUpperCase();"   onkeypress="return mytextvalid(event)" required>
                                              <label for="State">State</label>
                                            </div>

                                            <div class="input-field col s4">
                                              <input   id="Pincode" name="Pincode" type="number" class="validate"  onblur="checkpincode(this.id)"   required>
                                              <label for="Pincode">Pincode</label>
                                              <span id="error-pincode"></span>
                                            </div>
                                          </div>

                                          <b class="blue-text" style="font-size:20px">Contact Details</b>
                                          <div class="row">
                                            <div class="input-field col s4">
                                              <input id="unumber" maxlength="10" onchange="checkcont(this.id)" name="unumber" type="number" class="validate"   required>
                                              <label for="unumber">Contact number</label>
                                              <span id="error-cont"></span>
                                            </div>

                                            <div class="input-field col s4">
                                              <input id="stdcode" name="stdcode" type="number">
                                              <label for="stdcode" id="std">STD Code (Optional)</label>
                                            </div>

                                            <div class="input-field col s4">
                                              <input id="pnumber" maxlength="7" name="pnumber" type="number">
                                              <label for="pnumber" id="tele">Telphone Number (Optional)</label>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="input-field col s6">
                                              <input id="uemail" name="uemail" type="email" class="validate" onblur="ValidateEmail(document.applicationblank.uemail,'uemail')"   required>
                                              <label for="uemail">Email</label>
                                              <span id="error-mail"></span>
                                            </div>
                                           
                                            <div class="input-field col s6">
                                                <input id="udob" name="udob" onkeydown="return false" type="text" class="datepicker" required>
                                                <label for="udob">Date Of Birth</label>
                                            </div>
                                                 
                                          </div>


                                          <div class="row">
                                                <div class="input-field col s6">
                                                  <input id="position" name="position" type="text" value="<?php echo $position ?>" style="color:black" onkeyup="this.value=this.value.toUpperCase();" class="validate"  disabled>
                                                  <label for="position">Position Applied For</label>
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                    <input id="location" name="location" type="text" class="validate"   onkeyup="this.value=this.value.toUpperCase();" onkeypress="return mytextvalid(event)" required>
                                                    <label for="location">Location</label>
                                                </div>
                           
                                          </div>


                                          <div class="row">
                                            
                                                <div class="input-field col s12">
                                                  <input id="passport" name="passport" type="text" class="validate" onkeyup="this.value=this.value.toUpperCase();" required  onkeypress="return mytextvalid(event)" required>
                                                  <label for="passport">Passport Availability/Validity</label>
                                                </div>
                                          </div>

                                          <b style="font-size:20px;">Academic Professional Qualification (Highest Qualification)</b>
                                          <br><br>
                                          <div class="row">                                          
                                          
                                             <div class="col s6">
                                                <b style="font-size:15px;color:red">Select for Under Graduate</b>
                                                <select class="dropdown-trigger btn blue darken-1" id="selectug" onchange="checkUG()">
                                                <option value="" disabled selected>Choose your option</option>
                                                <option value="ITI">ITI</option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="B.Tech/B.E">B.Tech/B.E</option>
                                                <option value="Bsc">Bsc</option>
                                                <option value="B.A">B.A</option>
                                                <option value="B.COM">B.COM</option>
                                                <option value="LLB">LLB</option>
                                                <option value="BBA">BBA</option>
                                                <option value="Others">Others</option>
                                                </select>
                                              </div>
                                                

                                           
                                             <div class="col s6">
                                                <b style="font-size:15px;color:red">Select Specialization for UG</b>
                                                <select class="dropdown-trigger btn blue darken-1" id="specialug" onchange="checkSpecialUG()">
                                                <option value="" disabled selected>Choose your option</option>
                                                <option value="Mechanical">Mechanical</option>
                                                <option value="Civil">Civil</option>
                                                <option value="Computer/IT">Computer/IT</option>
                                                <option value="Electronics">Electronics</option>
                                                <option value="Electrical">Electrical</option>
                                                <option value="Others">Others</option>

                                                </select> 
                                              </div>
                                              
                                              <br>
                                              </div>
                                              <div class="row" >
                                                <div class="input-field col s12" id="otherUg">
                                                <input id="otherUgtxt" name="otherUgtxt" type="text" class="validate"   >
                                                <label for="otherUgtxt">Specify Other Under Graduate</label>
                                                </div>

                                                <div class="input-field col s12 " id="otherspecialUg">
                                                <input id="otherspecialUgtxt" name="otherspecialUgtxt" type="text" class="validate"   >
                                                <label for="otherspecialUgtxt">Specify Other  Under Graduate Specialization</label>
                                                </div>
                                                </div>                                    
                                        <div class="row">
                                             <div class="col s6" style="margin-top:20px">
                                                <b style="font-size:15px;color:red">Select for Post Graduate</b>
                                                <select class="dropdown-trigger btn blue darken-1" id="selectpg" onchange="checkPG()">
                                                <option value="" disabled selected>Choose your option</option>
                                                <option value="MBA">MBA</option>
                                                <option value="ICWA">ICWA</option>
                                                <option value="CA">CA</option>
                                                <option value="CS">CS</option>
                                                <option value="LLM">LLM</option>
                                                <option value="M.TECH/M.E">M.TECH/M.E</option>
                                                <option value="PG DIPLOMA">PG DIPLOMA</option>
                                                <option value="Others">Others</option>

                                                </select> 
                                              </div> 

                                              <div class="col s6" style="margin-top:20px">
                                                <b style="font-size:15px;color:red">Select Specialization for PG</b>
                                                <select class="dropdown-trigger btn blue darken-1" id="specialpg" onchange="checkSpecialPG()">
                                                <option value="" disabled selected>Choose your option</option>
                                                <option value="Mechanical">Mechanical</option>
                                                <option value="Civil">Civil</option>
                                                <option value="Computer/IT">Computer/IT</option>
                                                <option value="Electronics">Electronics</option>
                                                <option value="Electrical">Electrical</option>
                                                <option value="Sales/Marketing">Sales/Marketing</option>
                                                <option value="HR">HR</option>
                                                <option value="Finance">Finance</option>
                                                <option value="Systems">Systems</option>
                                                <option value="Operations">Operations</option>
                                                <option value="Systems">Systems</option>
                                                <option value="Others">Others</option>

                                                </select> 
                                              </div> 
                                        </div>
                                              <div class="row" >
                                                <div class="input-field col s12" id="otherPg">
                                                <input id="otherPgtxt" name="otherPgtxt" type="text" class="validate">
                                                <label for="otherPgtxt">Specify Other Post Graduate</label>
                                                </div>

                                                <div class="input-field col s12 " id="otherspecialPg">
                                                <input id="otherspecialPgtxt" name="otherspecialPgtxt" type="text" class="validate">
                                                <label for="otherspecialPgtxt">Specify Other  Post Graduate Specialization</label>
                                                </div>
                                             </div>   
                                           

      
                                          <b style="font-size:20px;">Professional Experience (Mention Company Name And Designation)</b>
                                          <br>
                                          <b style="font-size:20px;color:red">If you are Experienced,hit the below button...!</b>
                                          <div class="row">
                                                
                                                <div class="input-field col s12">
                                                        <a class="btn blue darken-1" id='myexperience' onclick="$('#mainexpdiv').show(300)">Add Experience</a>
                                                        <!--<input id="experience" type="text" >
                                                        <label for="experience">Professional Experience</label>-->
                                                </div>
                                                <div class="col s12" id="mainexpdiv">
                                                  <div class="col s12" id="myexpdiv">
                                                        <p>
                                                        <label>
                                                                <input type="checkbox" id="todate0,c" onchange="checkEmployer(this,this.id)" class="filled"/>
                                                                <span>Is it current employer ?</span>
                                                        </label>
                                                        </p>
                                                        <div class="input-field col s6">
                                                                <input id="orgname0" name="orgname0[]" type="text" class="validate"  onkeyup="this.value=this.value.toUpperCase();"  >
                                                                <label for="orgname0" style="font-size: 11px">Current Organization Name</label>
                                                        </div>
                                                                             
                                                        <div class="input-field col s6">
                                                                <input id="olddesignation0" name="olddesignation0[]" type="text"class="validate" onkeyup="this.value=this.value.toUpperCase();"  onkeypress="return mytextvalid(event)">
                                                                <label for="olddesignation0" style="font-size: 11px">Designation</label>
                                                        </div>
                                                        
                                                        <div class="input-field col s6">
                                                                <input id="fromdate0" name="fromdate0[]" type="text" class="datepicker" onkeydown="return false">
                                                                <label for="fromdate0" style="font-size: 11px">From</label>
                                                        </div>

                                                        <div class="input-field col s6">
                                                                <input id="todate0" name="todate0[]" type="text" class="datepicker" onkeydown="return false">
                                                                <label for="todate0" style="font-size: 11px">To</label>
                                                        </div> 

                                                       
                                                        <div class="row" id="addnextexp">
                                                                <a class="btn-floating btn" id="addbtn" onclick="addnewexp(this)"><i class="material-icons">add</i></a>                                                    
                                                                <a class="btn-floating btn" onclick="$('#mainexpdiv').hide(300)" style="float:right;"><i class="material-icons">remove</i></a>                                                    
                                                        </div>

                                                        
                                                                                                                        
                                                  </div>
                                                </div>
          
                                                   
                                          </div>

                                          



                                          <div class="row">
                                                <div class="input-field col s6">
                                                  <input id="jdate" name="jdate" type="text" class="datepicker" onkeydown="return false" required>
                                                  <label for="jdate" style="font-size: 11px">If Selected, how soon you can join us?</label>
                                                </div>
                                                
                                                
                                                <div class="input-field col s6">
                                                    <input id="notice" name="notice" type="number" onblur="checknotice(this.id)" required>
                                                    <label for="notice" style="font-size: 11px">Notice Period In Current Oraganization (IN DAYS)</label>
                                                    <span id="error-notice"></span>
                                                </div>

                                                
                                                <div class="input-field col s6" >
                                                        <input id="manager" name="manager" type="text" onkeyup="this.value=this.value.toUpperCase();" required >
                                                        <label for="manager" style="font-size: 11px">Reporting Manager's Designation</label>
                                                </div>

                                          </div>

                                          <b style="font-size:20px;">Referral Sources</b>
                                          <br><br>                        
                                           <div class="row">
                                            
                                                <label class="col s12">
                                                        <input type="checkbox" id="internet" name="internet" class="filled-in">
                                                        <span>Internet (Job Boards)</span>
                                                </label><br>

                                                <label class="col s12">
                                                        <input type="checkbox" id="empref" name="empref" class="filled-in">
                                                        <span>Employee Referel</span>
                                                </label><br>

                                                <label class="col s12">
                                                        <input type="checkbox" id="walkin" name="walkin" class="filled-in">
                                                        <span>Walk-In (Factory Gate)</span>
                                                </label><br>

                                                <label class="col s12">
                                                         <input type="checkbox" id="website" name="website" class="filled-in">
                                                        <span>Company Website</span>
                                                </label><br>

                                                <label class="col s12">
                                                        <input type="checkbox" id="other" name="other" class="filled-in">
                                                        <span>Other</span>
                                                        <input placeholder="Enter Specific Details" id="otherdetails" name="otherdetails" type="text" onkeyup="this.value=this.value.toUpperCase();" class="validate">                                                        
                                                </label>
   
                                          </div>

                                            <b style="font-size:20px;">Family Details :</b>
                                                
                                          <div class="row">

                                                
                                            <div class="input-field col s6">
                                                    <input id="father" name="father" type="text" onkeyup="this.value=this.value.toUpperCase();" onkeypress="return mytextvalid(event)" required>
                                                    <label for="father">Father Name</label>
                                            </div>

                                            
                                            <div class="input-field col s6">
                                                    <input id="fdob" name="fdob" type="text" class="datepicker" onkeydown="return false" required>
                                                    <label for="fdob">DOB</label>
                                            </div>


                                            
                                            <div class="input-field col s6">
                                                    <input id="mother" name="mother" type="text" onkeyup="this.value=this.value.toUpperCase();" onkeypress="return mytextvalid(event)" required>
                                                    <label for="mother">Mother Name</label>
                                            </div>

                                            
                                            <div class="input-field col s6">
                                                    <input id="mdob" name="mdob" type="text" class="datepicker" onkeydown="return false" required>
                                                    <label for="mdob">DOB</label>
                                            </div>


                                            
                                            <div class="input-field col s6">
                                                    <input id="spouse" name="spouse" type="text" onkeyup="this.value=this.value.toUpperCase();" onkeypress="return mytextvalid(event)">
                                                    <label for="spouse">Spouse Name (Enter NA if NOT APPLICABLE)</label>
                                            </div>

                                            
                                            <div class="input-field col s3">
                                                    <input id="spdob" name="spdob" type="text" class="datepicker" >
                                                    <label for="spdob">DOB</label>
                                            </div>
                                            
                                            <div class="col s3 ">
                                                <br>
                                                    <select id='sgender' name='sgender' class="dropdown-trigger btn blue darken-1" >
                                                        <option value="" disabled selected style="color: white">Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                      </select>
                                                      <br><br>
                                                </div>   
                                  

                                            
                                            <div class="input-field col s6">
                                                    <input id="child1" name="child1" type="text" onkeyup="this.value=this.value.toUpperCase();" onkeypress="return mytextvalid(event)" >
                                                    <label for="child1">Child1 Name (Enter NA if NOT APPLICABLE)</label>
                                            </div>

                                            
                                            <div class="input-field col s3">
                                                    <input id="c1dob" name="c1dob" type="text" class="datepicker" >
                                                    <label for="c1dob">DOB</label>
                                            </div>
                                            <div class="col s3 ">
                                                    <br>
                                                        <select id='c1gender' name='c1gender' class="dropdown-trigger btn blue darken-1">
                                                            <option value="" disabled selected style="color: white">Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                          </select>
                                                          <br><br>
                                                </div> 


                                            
                                            <div class="input-field col s6">
                                                    <input id="child2" name="child2" type="text" onkeyup="this.value=this.value.toUpperCase();" onkeypress="return mytextvalid(event)">
                                                    <label for="child2">Child2 Name (Enter NA if NOT APPLICABLE)</label>
                                            </div>

                                            
                                            <div class="input-field col s3">
                                                    <input id="c2dob" name="c2dob" type="text" class="datepicker">
                                                    <label for="c2dob">DOB</label>
                                            </div>

                                            
                                            <div class="col s3 ">
                                                    <br>
                                                        <select id='c2gender' name='c2gender' class="dropdown-trigger btn blue darken-1" >
                                                            <option value="" disabled selected style="color: white">Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                          </select>
                                                          <br><br>
                                                </div> 



                                          </div>
                                          <b style="font-size:20px;">Remuneration Details:</b>
                                          <div class="row">

                                                <div class="input-field col s6">
                                                        <input id="monthhome" name="monthhome" type="text" disabled value="Annual Gross(CTC)" style="color: black" >
                                                        <span id="error-monthhome"></span>
                                                </div>
    
                                                
                                                <div class="input-field col s3">
                                                        <input id="homepresent" name="homepresent" type="number" onkeypress="return mynumbervalid(event)" >
                                                        <label for="homepresent">Present</label>
                                                        <span id="error-homepresent"></span>
                                                </div>
                                                
                                                <div class="input-field col s3">
                                                        <input id="homeexp" name="homeexp" type="number" onkeypress="return mynumbervalid(event)">
                                                        <label for="homeexp">Expected</label>
                                                        <span id="error-homeexp"></span>
                                                </div>
                                                
                                                
                                                <div class="input-field col s6">
                                                        <input id="monthgross" type="text" disabled value="Monthly Gross(CTC)" style="color: black" >
                                                        <span id="error-monthgross"></span>
                                                </div>
    
                                                
                                                <div class="input-field col s3">
                                                        <input id="grosspresent" name="grosspresent" type="number" onkeypress="return mynumbervalid(event)">
                                                        <label for="grosspresent">Present</label>
                                                </div>
                                                
                                                
                                                <div class="input-field col s3">
                                                        <input id="grossexp" name="grossexp" type="number" onkeypress="return mynumbervalid(event)">
                                                        <label for="grossexp">Expected</label>
                                                </div>
                                                


                                                
                                                <div class="input-field col s6">
                                                        <input id="ypresent" type="text" disabled value="Monthly Take Home" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s3">
                                                        <input id="yearpresent" name="yearpresent" type="number" onkeypress="return mynumbervalid(event)">
                                                        <label for="yearpresent">Present</label>
                                                </div>
                                                
                                                <div class="input-field col s3">
                                                        <input id="yearexp" name="yearexp" type="number" onkeypress="return mynumbervalid(event)">
                                                        <label for="yearexp">Expected</label>
                                                </div>
    
                                          </div>


                                         
                                          <b style="font-size:20px;">References :
                                          <br>
                                                <span class="red-text">*Minimum Two Reference Required*</span>
                                          </b>

                                          <div class="row" id="mainref">
                                          <div id="ref" class="col">
  
                                                <div class="input-field col s6">
                                                        <input id="refname" onkeyup="this.value=this.value.toUpperCase();" type="text" disabled value="Name" style="color: black">
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                        <input id="nameref0" name="nameref0[]" onkeyup="this.value=this.value.toUpperCase();" required class="validate" type="text" onkeypress="return mytextvalid(event)">
                                                        <label for="nameref0">Reference</label>
                                                </div>
                                                
                                                
                                                
                                                
                                                <div class="input-field col s6">
                                                        <input id="dsgref" onkeyup="this.value=this.value.toUpperCase();" type="text" disabled value="Designation" style="color: black">
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                        <input id="designationref0" name="designationref0[]" onkeyup="this.value=this.value.toUpperCase();" required class="validate" type="text" onkeypress="return mytextvalid(event)">
                                                        <label for="designationref0">Reference</label>
                                                </div>
                                                
                                               
                                                
                                                <div class="input-field col s6">
                                                        <input id="cnameref" onkeyup="this.value=this.value.toUpperCase();" type="text" disabled value="Company Name" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                        <input id="cmpnmref0" name="cmpnmref0[]" onkeyup="this.value=this.value.toUpperCase();" required class="validate" type="text" >
                                                        <label for="cmpnmref0">Reference </label>
                                                </div>

                                                <div class="input-field col s6">
                                                        <input id="cnoref" type="text" disabled value="Contact Number" style="color: black" >
       
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                        <input id="contref0" name="contref0[]" onkeyup="this.value=this.value.toUpperCase();" type="number" class="validate" required />
                                                        <label for="contref0">Reference</label>
                                                </div>

                                                <div class="input-field col s6">
                                                        <input id="phoneref" type="text" disabled value="LandLine Number (Optional)" style="color: black">
       
                                                </div>
    
                                                <div class="input-field col s3">
                                                        <input id="stdcoderef0" name="stdcoderef0[]" class="validate" type="number"  class="validate"/>
                                                        <label for="stdcoderef0" id="stdref" >STD Code</label>
                                                </div>
                                                <div class="input-field col s3">
                                                        <input id="phoneref0" name="phoneref0[]" class="validate" type="number" />
                                                        <label for="phoneref0" id="teleref">Phone Number</label>
                                                </div>
                                                
                                                

                                                <div class="input-field col s6">
                                                         <input id="emailref" type="email" disabled value="Email" name="refmail" style="color: black" >
                                                         
                                                </div>
                                                
                                            
                                                <div class="input-field col s6">
                                                        <input id="mailref0" name="mailref0[]" type="email"  class="validate" required  onblur="ValidateEmail(document.applicationblank.mailref0,'ref')">
                                                        <label for="mailref0">Reference</label>
                                                        <span id="error-mail-ref"></span>
                                                </div>

                                                <div class="col s6" id="addnextref">
                                                        <a class="btn-floating btn" onclick="addnewref(this)" id="refaddbtn"><i class="material-icons">add</i></a>
                                                        <span id="error-ref"></span>
                                                </div>
                                        </div>
                                        </div>
                                        

                                              
        

                                                
         
                                            
                                <div class="row">
                                        <div class=" col s6 offset-s3 center" id="submitform">
                                             <input type="button" class="btn blue darken-1" value="Submit Application" id="submitformdata"> </input>
                                        
                                              <br>
                                              <b style="color:green" id="pleasewait">Submitting Your Form .. Please Wait</b>
                                             
                                        </div>                                    
                                </div>   
                                <div id="loader">
                                        <div id="txt">
                                                <b>Please wait while we submit your form</b>
                                        </div>  
                                </div>
                                

                                <!-- form end -->







                        </form>

                        </div>
                           
                          </div>
                        </div>
                      </div>
                
        
                         
<?php

$_SESSION['token'] = $_GET['token'];
?>
                        
<script>



$("#pleasewait").hide()
$("#otherUg").hide()
$("#otherspecialUg").hide()
$("#otherPg").hide()
$("#otherspecialPg").hide()
var expctr=0        
var ctr=0
var ctr2=0

var cdate=new Date();
var cyear=cdate.getFullYear();



function checkcont(x)
{
        var id="#"+x;
        var phone=$(id).val();
        console.log(id)
        console.log(phone)
        $('#error-cont').empty()
        if(phone.length!=10)
        {
                $('#error-cont').append("<p style='color:red;font-weight:bold;display:inline;'>Please Enter valid contact Number*</p>")
                $(id).val(" ")
        }
}

function checkpincode(x)
{
        $('#error-pincode').empty()
        var id="#"+x;
        var txt=$(id).val();
        if(txt.length!=6)
        {
                $('#error-pincode').append("<p style='color:red;font-weight:bold;display:inline;'>Please Enter valid pincode*</p>")
                $(id).val(" ")
        }
}
function mytextvalid(e)
{
        //Written by Tanmay
        var charCode = event.keyCode;
        //Gets ASCII code of character
        if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || charCode >= 32 && charCode <= 47)
                return true;
        else
                return false;

}
function mynumbervalid(e)
{
        console.log("called");
        var charCode = event.keyCode;
        //Gets ASCII code of character
        if ((charCode >= 48 && charCode <= 57))
                return true;
        else
                return false;

}
function ValidateEmail(inputText,part)
{
        var mailformat =  /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(part=='uemail')
        {
                $('#error-mail').empty()
                if(inputText.value.match(mailformat))
                {
                //The pop up alert for a valid email address
               // document.applicationblank.uemail.focus();
                return true;
                }
                else
                {
                // alert("You have entered an invalid email address!");    //The pop up alert for an invalid email address
                $('#error-mail').append("<p style='color:red;font-weight:bold;display:inline;'>Please Enter valid email address*</p>")
               // document.applicationblank.uemail.focus();
                return false;
                }
        }
        else
        {
                $('#error-mail-ref').empty()
                if(inputText.value.match(mailformat))
                {
                //The pop up alert for a valid email address
               // document.applicationblank.mailref0.focus();
                return true;
                }
                else
                {
                // alert("You have entered an invalid email address!");    //The pop up alert for an invalid email address
                $('#error-mail-ref').append("<p style='color:red;font-weight:bold;display:inline;'>Please Enter valid email address*</p>")
               // document.applicationblank.mailref0.focus();
                return false;
                }
        }
        
}
function checknotice(x)
{
        $('#error-notice').empty()
        var id="#"+x;
        var noticeperiod=$(id).val();
        
        if(!(noticeperiod.length>=1 && noticeperiod.length<=3))
        {
                $('#error-notice').append("<p style='color:red;font-weight:bold;display:inline;'>Please Enter valid notice period*</p>")
                $(id).val(" ")
        }
}
function addnewexp(x)
{
        expctr = expctr+1
        //var str = 'myexpdiv'+ctr

                                                  
        var exptxt='<div class="col s12" id="myexpdiv"><p><label><input type="checkbox" id="todate'+expctr+',c" onchange="checkEmployer(this,this.id)" class="filled"/><span>Is it current employer ?</span></label></p><div class="input-field col s6"><input name="orgname0[]" id="orgname'+expctr+'" type="text" class="validate" onkeypress="return mytextvalid(event)"  ><label for="orgname'+expctr+'" style="font-size: 11px">Current Organization Name</label></div><div class="input-field col s6"><input name="olddesignation0[]" id="olddesignation'+expctr+'" type="text" class="validate" onkeypress="return mytextvalid(event)" ><label for="olddesignation'+expctr+'" style="font-size: 11px">Designation</label></div><div class="input-field col s6"><input name="fromdate0[]" id="fromdate'+expctr+'" type="text" class="datepicker" onkeydown="return false" ><label for="fromdate'+expctr+'" style="font-size: 11px;">From</label></div><div class="input-field col s6"><input name="todate0[]" id="todate'+expctr+'" type="text" class="datepicker" onkeydown="return false"><label for="todate'+expctr+'" style="font-size: 11px;">To</label></div><div class="row" id="addnextexp"><a class="btn-floating btn" onclick="addnewexp(this)"><i class="material-icons">add</i></a><a class="btn-floating btn" style="float:right" onclick="removenewexp(this.id)" id="rembtn"><i class="material-icons">remove</i></a></div></div>'
        $("#mainexpdiv").append(exptxt);
        $('.datepicker').datepicker({
                        //dateFormat:"dd/mm/yy",
                        yearRange:[1900,cyear],
                        changeMonth:true,
                        
                        //changeYear:true
               
        });            

}

function removenewexp(x)
{
        var id="#"+x;
        $(id).closest("#myexpdiv").remove();
        
}

function addnewref(x)
{
        $('#error-ref').empty()
        ctr2 = ctr2+1
        
        var txt='<div id="ref" class="col"><div class="input-field col s6"><input id="child2" type="text" disabled value="Name" style="color: black" onkeyup="this.value=this.value.toUpperCase();"></div><div class="input-field col s6"><input name="nameref0[]" id="nameref'+ctr2+'" type="text" onkeypress="return mytextvalid(event)" onkeyup="this.value=this.value.toUpperCase();"><label for="nameref'+ctr2+'">Reference</label></div><div class="input-field col s6"><input id="child2" type="text" disabled value="Designation" style="color: black"></div><div class="input-field col s6"><input name="designationref0[]" id="designationref'+ctr2+'" type="text" onkeyup="this.value=this.value.toUpperCase();" onkeypress="return mytextvalid(event)"><label for="designationref'+ctr2+'">Reference</label></div><div class="input-field col s6"> <input id="child2" type="text" disabled value="Company Name" style="color: black"></div><div class="input-field col s6"><input name="cmpnmref0[]" id="cmpnmref'+ctr2+'" type="text" onkeyup="this.value=this.value.toUpperCase();" ><label for="cpmnmref'+ctr2+'">Reference </label></div><div class="input-field col s6"><input id="child2" type="text" disabled value="Contact Number" style="color: black"></div><div class="input-field col s6"><input name="contref0[]" id="contref'+ctr2+'" type="number" onchange="checkcont(this.id)" required><label for="contref'+ctr2+'">Reference</label></div><div class="input-field col s6"><input id="phoneref" type="text" disabled value="LandLine Number (Optional)" style="color: black"></div><div class="input-field col s3"><input id="stdcoderef'+ctr2+'" name="stdcoderef0[]" type="number"/><label for="stdcoderef'+ctr2+'" id="stdref">STD Code</label></div><div class="input-field col s3"><input id="phoneref'+ctr2+'" name="phoneref0[]" type="number"/><label for="phoneref'+ctr2+'" id="teleref">Phone Number</label></div><div class="input-field col s6"><input id="child2" type="text" d<isabled value="Email" style="color: black"></div><div class="input-field col s6"><input name="mailref0[]" id="mailref'+ctr2+'" type="email" onblur="ValidateEmail(document.applicationblank.uemail,"ref")""><label for="mailref'+ctr2+'">Reference</label><span id="error-mail-ref"></span></div><div class="col s6" id="addnextref"><a class="btn-floating btn" onclick="addnewref(this)" ><i class="material-icons">add</i></a>&nbsp;<span id="error-ref0"></span></div></div>'
        if(ctr2==1)
        {
                $("#mainref").append(txt);
        }
        
        if(ctr2==2)
        {
          var addclosebtn='<div id="ref" class="col"><div class="input-field col s6"><input id="child2" type="text" disabled value="Name" style="color: black"></div><div class="input-field col s6"><input name="nameref0[]" id="nameref'+ctr2+'" type="text" onkeyup="this.value=this.value.toUpperCase();" onkeypress="return mytextvalid(event)"><label for="nameref'+ctr2+'">Reference</label></div><div class="input-field col s6"><input id="child2" type="text" disabled value="Designation" style="color: black"></div><div class="input-field col s6"><input name="designationref0[]" id="designationref'+ctr2+'" type="text" onkeyup="this.value=this.value.toUpperCase();" onkeypress="return mytextvalid(event)"><label for="designationref'+ctr2+'">Reference</label></div><div class="input-field col s6"> <input id="child2" type="text" disabled value="Company Name" style="color: black"></div><div class="input-field col s6"><input name="cmpnmref0[]" id="cmpnmref'+ctr2+'" type="text" onkeyup="this.value=this.value.toUpperCase();"><label for="cpmnmref'+ctr2+'">Reference </label></div><div class="input-field col s6"><input id="child2" type="text" disabled value="Contact Number" style="color: black"></div><div class="input-field col s6"><input name="contref0[]" id="contref'+ctr2+'" type="number" onchange="checkcont(this.id)" required><label for="contref'+ctr2+'">Reference</label></div><div class="input-field col s6"><input id="phoneref" type="text" disabled value="LandLine Number (Optional)" style="color: black"></div><div class="input-field col s3"><input id="stdcoderef'+ctr2+'" name="stdcoderef0[]" type="number"/><label for="stdcoderef'+ctr2+'" id="stdref">STD Code</label></div><div class="input-field col s3"><input id="phoneref'+ctr2+'" name="phoneref0[]" type="number"/><label for="phoneref'+ctr2+'" id="teleref">Phone Number</label></div><div class="input-field col s6"><input id="child2" type="text" d<isabled value="Email" style="color: black"></div><div class="input-field col s6"><input name="mailref0[]" id="mailref'+ctr2+'" type="email"><label for="mailref'+ctr2+'">Reference</label></div><div class="col s6" id="addnextref"><a class="btn-floating btn" onclick="addnewref(this)"><i class="material-icons">add</i></a><a class="btn-floating btn" id="refrembtn" style="float:right" onclick="removelastref(this.id)"><i class="material-icons">close</i></a></div></div>'      
          $("#mainref").append(addclosebtn);
          
        }
        if(ctr2==3)
        {
                alert("Maximum Three Reference can be added")
        }
        
        
        
}

function removelastref(x)
{
        var id="#"+x;
        $(id).closest("#ref").remove();
        
}

function checkUG()
{
        if( $("#selectug").val() == "Others")
        {
                $("#otherUg").show(800)
        }
        else
        {
                $("#otherUg").hide(800)
        }
}

function checkSpecialUG()
{
        if( $("#specialug").val() == "Others")
        {
                $("#otherspecialUg").show(800)
        }
        else
        {
                $("#otherspecialUg").hide(800)
        }
}

function checkPG()
{
        if( $("#selectpg").val() == "Others")
        {
                $("#otherPg").show(800)
        }
        else
        {
                $("#otherPg").hide(800)
        }
}

function checkSpecialPG()
{
        if( $("#specialpg").val() == "Others")
        {
                $("#otherspecialPg").show(800)
        }
        else
        {
                $("#otherspecialPg").hide(800)
        }
}

function checkEmployer(me,cid)
{
        cid = "#"+cid;
        cid2 = cid.split(',');
        cid2 = cid2[0];
       
        if(me.checked)
        {
                
                $(cid2).prop('disabled',true)
        }
        else
        {
                $(cid2).prop('disabled',false)
        }



        
        
}

/******************AJAX CALL STARTS************************ */
$("#submitformdata").click(function () 
{
        nameref0 = []
        designationref0 = []
        cmpnmref0 = []
        contref0 = []
        mailref0 = []
        phoneref0=[]
        stdref0=[]
        orgname0=[]
        olddesignation0=[]
        fromdate0 = []
        todate0=[]
        managername0=[]
        managermail0=[]
        var fd = new FormData();

        //References
                $('input[name^="nameref0"]').each(function() {
                        nameref0.push($(this).val());
                        });
                        $('input[name^="designationref0"]').each(function() {
                        designationref0.push($(this).val());
                        });
                        $('input[name^="cmpnmref0"]').each(function() {
                        cmpnmref0.push($(this).val());
                        });
                        $('input[name^="contref0"]').each(function() {
                        contref0.push($(this).val());
                        });
                        $('input[name^="mailref0"]').each(function() {
                        mailref0.push($(this).val());
                        });
                        $('input[name^="stdcoderef0"]').each(function() {
                        stdref0.push($(this).val());
                        });
                        $('input[name^="phoneref0"]').each(function() {
                        phoneref0.push($(this).val());
                        });

                        if(nameref0.length<2 )
                        {
                                alert("Enter atleast two references")
                                $('#error-ref').append("<p style='color:red;font-weight:bold;display:inline;'>Please Enter Atleast 2 references*</p>")
                                // $("#addnextref").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter atleast 2 references</div>");

                        }
                        else
                        {
                                // cleanArray = nameref0.filter(function () { return true });
                                arr = nameref0.filter(item => item);
                                console.log("This is - "+arr.length)
                                if(arr.length<2)
                                {
                                        alert("Wrong")
                                        $('#error-ref0').append("<p style='color:red;font-weight:bold;display:inline;'>Please Enter Atleast 2 references*</p>")
                                }
                                else
                                {
                                        valid = true
                                        //to check all fields are filled 
                                        $('[required]').each(function() {
                                        if ($(this).is(':invalid') || !$(this).val()) valid = false;
                                        })
                                        if (!valid)
                                        {
                                                console.log(valid)
                                                window.scrollTo(0, 0);
                                                $('.error-all').show();
                                        } 
                                        else
                                        {
                                                $('#loader').show()
                                                fd.append("nameref0",JSON.stringify(nameref0))
                                                fd.append("designationref0",JSON.stringify(designationref0))
                                                fd.append("cmpnmref0",JSON.stringify(cmpnmref0))
                                                fd.append("contref0",JSON.stringify(contref0))
                                                fd.append("mailref0",JSON.stringify(mailref0))
                                                fd.append("stdcoderef0",JSON.stringify(stdref0))
                                                fd.append("phoneref0",JSON.stringify(phoneref0))


                                                //Documents - PHOTO ,CV,PGCERT,UGCERT
                                                var files = $('#photo')[0].files[0];
                                                fd.append('photo',files);

                                                var files = $('#mycv')[0].files[0];
                                                fd.append('mycv',files);

                                        


                                                //Personal Information
                                                if($("#aadharno").val()==" ")
                                                {
                                                        alert("Wrong")
                                                        $('#error-adhar').append("<p style='color:red;font-weight:bold;display:inline;'>Please Enter Adha*</p>")
                                                }
                                                fd.append("aadharno",$("#aadharno").val())
                                                fd.append("last_name",$("#last_name").val())
                                                fd.append("first_name",$("#first_name").val())
                                                fd.append("mid_name",$("#mid_name").val())
                                                fd.append("State",$("#State").val())
                                                fd.append("street",$("#street").val())
                                                fd.append("Locality",$("#Locality").val())
                                                fd.append("City",$("#City").val())
                                                fd.append("Pincode",$("#Pincode").val())
                                                fd.append("unumber",$("#unumber").val())
                                                fd.append("stdcode",$("#stdcode").val())
                                                fd.append("pnumber",$("#pnumber").val())
                                                fd.append("uemail",$("#uemail").val())
                                                fd.append("udob",$("#udob").val())
                                                fd.append("position",$("#position").val())
                                                fd.append("location",$("#location").val())
                                                fd.append("passport",$("#passport").val())
                                        
                                                if($("#selectug").val()=="Others")
                                                {
                                                        fd.append("selectug",$("#otherUgtxt").val())
                                                }
                                                else
                                                {
                                                        fd.append("selectug",$("#selectug").val())
                                                }
                                                if($("#specialug").val()=="Others")
                                                {
                                                        fd.append("specialug",$("#otherspecialUgtxt").val())
                                                }
                                                else
                                                {
                                                        fd.append("specialug",$("#specialug").val())
                                                }
                                                if($("#selectpg").val()=="Others")
                                                {
                                                        fd.append("selectpg",$("#otherPgtxt").val())
                                                }
                                                else
                                                {
                                                        fd.append("selectpg",$("#selectpg").val())
                                                }
                                                if($("#specialpg").val()=="Others")
                                                {
                                                        fd.append("specialpg",$("#otherspecialPgtxt").val())
                                                }
                                                else
                                                {
                                                        fd.append("specialpg",$("#specialpg").val())
                                                }
                                                
                                
                                                fd.append("jdate",$("#jdate").val())
                                                fd.append("notice",$("#notice").val())
                                                fd.append("manager",$("#manager").val())
                                                fd.append("ifselectposition",$("#ifselectposition").val())
                                                fd.append("father",$("#father").val())
                                                fd.append("fdob",$("#fdob").val())
                                                fd.append("mother",$("#mother").val())
                                                fd.append("mdob",$("#mdob").val())
                                                fd.append("spouse",$("#spouse").val())
                                                fd.append("spdob",$("#spdob").val())
                                                fd.append("sgender",$("#sgender").val())
                                                fd.append("child1",$("#child1").val())
                                                fd.append("c1dob",$("#c1dob").val())
                                                fd.append("c1gender",$("#c2gender").val())
                                                fd.append("child2",$("#child2").val())
                                                fd.append("c2dob",$("#c2dob").val())
                                                fd.append("c2gender",$("#c2gender").val())
                                                fd.append("homepresent",$("#homepresent").val())
                                                fd.append("homeexp",$("#homeexp").val())
                                                fd.append("grosspresent",$("#grosspresent").val())
                                                fd.append("grossexp",$("#grossexp").val())
                                                fd.append("yearpresent",$("#yearpresent").val())
                                                fd.append("yearexp",$("#yearexp").val())



                                                // Reference & Experiance
                                                var referalchoice;

                                                if($('#internet').prop("checked") == true)
                                                {
                                                        // referalchoice=$('#internet').val();
                                                        fd.append("internet",$("#internet").val())

                                                }

                                                if($('#empref').prop("checked") == true)
                                                {
                                                        // referalchoice=$('#empref').val();
                                                        fd.append("empref",$("#empref").val())

                                                }
                                                if($('#walkin').prop("checked") == true)
                                                {
                                                        // referalchoice=$('#walkin').val();
                                                        fd.append("walkin",$("#walkin").val())

                                                }
                                                if($('#website').prop("checked") == true)
                                                {
                                                        fd.append("website",$("#website").val())
                                                        
                                                        // referalchoice=$('#website').val();
                                                }
                                                if($('#other').prop("checked") == true)
                                                {
                                                        fd.append("other",$("#other").val())
                                                        referalchoice=$('#other').val();
                                                        fd.append("otherdetails",$("#otherdetails").val())

                                                
                                                }
                                                // orgname0olddesignation0fromdate0todate0managername0managermail0
                                                        
                                                $('input[name^="orgname0"]').each(function() {
                                                        orgname0.push($(this).val());
                                                });
                                                $('input[name^="olddesignation0"]').each(function() {
                                                        olddesignation0.push($(this).val());
                                                });
                                                $('input[name^="fromdate0"]').each(function() {
                                                        fromdate0.push($(this).val());
                                                });
                                                $('input[name^="todate0"]').each(function() {
                                                        todate0.push($(this).val());
                                                });
                                                $('input[name^="managername0"]').each(function() {
                                                        managername0.push($(this).val());
                                                });
                                                $('input[name^="managermail0"]').each(function() {
                                                        managermail0.push($(this).val());
                                                });
                                                
                                                fd.append("orgname0",JSON.stringify(orgname0))
                                                fd.append("olddesignation0",JSON.stringify(olddesignation0))
                                                fd.append("fromdate0",JSON.stringify(fromdate0))
                                                fd.append("todate0",JSON.stringify(todate0))
                                                fd.append("managername0",JSON.stringify(managername0))
                                                fd.append("managermail0",JSON.stringify(managermail0))

                                                 $.ajax({
                                        
                                                url:'http://localhost/hrms/api/submitapplication.php',
                                                type:'POST',
                                                data:fd,
                                                contentType: false,
                                                processData: false,
                                                success:function(para)
                                                {
                                                        $("#submitformdata").prop('disabled',true);
                                                        $('#loader').hide()
                                                        $("#pleasewait").show()
                                                        window.setTimeout(function(){location.reload()},1000)
                                                        
                                                },
                                                })
                                        }
                                       
                                }
                              

                        }

})

/**********************AJAX CALL ENDED************************* */
$("#image_upload_preview").hide()

$("#otherdetails").hide();
//$("#uploadotherdoc").hide();
//$("#showaddharupload").hide();
//$("#myphoto").hide();

$("#passing").change(function()
{
        var pas = $("#passing").val();
        if(pas.length!=4)
        {
                alert("Please provide a valid year");
                $("#passing").val("");
        }        
        
})






$(document).ready(function(){
        // $('select').formSelect();
        $('#warn').hide()
        $('#warn2').hide()
        $('#warn3').hide()
        $('.error-all').hide();
        $('#loader').hide()
        $("#mainexpdiv").hide();
//         $("#aadharno").on("input", function(){
//                 console.log(text($(this).val());
//         // Print entered value in a div box
//         //$("#result").text($(this).val());
//     });
        function getUrlVars() {
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                vars[key] = value;
            });
            return vars;
        }
        var token = getUrlVars()["token"];
        var data={"token":token};
       // console.log(token);
        $.ajax({
                                            url : 'http://localhost/hrms/api/checkExpiry.php',
                                            type : 'POST',
                                            data :(data),          
                                             success : function(para){
                                             console.log(para)
                                             if(para == "expired2")
                                             {
                                                console.log("Expired Page");
                                                $('#loader').hide()
                                                $('#form').hide()
                                                $('#warn2').show()
                                             }
                                             else if(para == "expired")
                                             {
                                               console.log("Submitted");
                                                $('#loader').hide()
                                                $('#form').hide()
                                                $('#warn').show()
                                                
                                           
                                             }
                                             else if(para=='success')
                                             {
                                                console.log("You are welcome");
                                             
                                             }
                                             },
                                            error : function(err){        
                                            }
                 });
               
        

        $('.datepicker').datepicker
        ({
                
                yearRange:[1900,cyear],
                
                
        });

        $('#jdate').datepicker
        ({
                
                yearRange:[1900,cyear],
                minDate:new Date(),
                changeMonth:true,
                
        });            

        $('.filled-in').on('change', function() {
		    $('.filled-in').not(this).prop('checked', false);  

	});    
               

        $("#other").change(function(){
        if(this.checked)
        {
                $("#otherdetails").fadeIn("slow")
        }
        else
        {
                $("#otherdetails").fadeOut("slow")
        }
})
});




// $("#yesforaadhar").click(function(){
//         $("#uploadotherdoc").fadeOut("slow");
//         $("#showaddharupload").fadeIn("slow");
// })

// $("#noforaadhar").click(function(){
//         $("#showaddharupload").fadeOut("slow");
//         $("#uploadotherdoc").fadeIn("slow");
// })



// $("#myexperience").click(function(){
//         $("#myexpdiv").fadeIn(300);
        
// })


$("#addnextexp").click(function(){
        $("#myexpdiv").fadeIn(300);
})


$('#alphaaddh').hide();
$('#12addh').hide();

function checkValidDate() {
        var addharnumber=$('#udob').val();
        console.log(addharnumber);
}
$( "#aadharno" ).change(function() {
        $('#error-adhar').empty()
        var addharnumber=$('#aadharno').val();
        if(addharnumber.length != 12)
        {
               
                $('#error-adhar').append("<p style='color:red;font-weight:bold;display:inline;'>Please Enter 12 Digits of Aadhar*</p>")
                $('#aadharno').val(" ")
                // document.getElementById('aadharno').select();
        }
        
        var data={"aadharno":addharnumber};
        //console.log(addharnumber);



        $.ajax({
                url: "http://localhost/hrms/api/check.php",
                type : 'POST',
                data :(data), 
                success: function(result){
                        // result1=JSON.parse(result);
                        result = $.trim(result)
                        if(result=="​expired​"){
                                console.log("Aadhar number already exists");
                                $('#form').hide()
                                $('#warn3').show()
                        }
                        else
                        {
                                console.log("ok")
                        }
                    

                         
                        
    }});        

});




        
        
        // if(addaharnumber.length<12)
        // {
        //         alert('Invalid')
        // }
        





$('#proof_identity_addhar').change(function(){
      var f = $('#proof_identity_addhar').val().split('.')
      var x=f[1]
      if(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg')
      {
        var f = $('#proof_identity_addhar').val()
      
      $('#myfile_adhar').text(f)
      }
      else
      {
        alert('Invalid File\n Only PDF/IMAGES accepted')
        document.getElementById("proof_identity_addhar").value=null

        
      }
        
})
$('#proof_otherthanadhar').change(function(){
      var f = $('#proof_otherthanadhar').val().split('.')
      var x=f[1]
      if(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg')
      {
        var f = $('#proof_otherthanadhar').val()
      
      $('#myfile1').text(f)
      }
      else
      {
        alert('Invalid File\n Only PDF/IMAGES accepted')
        document.getElementById("proof_otherthanadhar").value=null
        
      }
        
})


$('#proof_address').change(function(){
      var f = $('#proof_address').val().split('.')
      var x=f[1]
      if(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg')
      {
        var f = $('#proof_address').val()
      
      $('#myfile2').text(f)
      }
      else
      {
        alert('Invalid File\n Only PDF/IMAGE accepted')
        document.getElementById("proof_address").value=null
        
      }
})
$('#alldocs').change(function(){
      var f = $('#alldocs').val().split('.')
      var x=f[1]
      if(x=='pdf')
      {
        var f = $('#alldocs').val()
      
      $('#mydocs').text(f)
      }
      else
      {
        alert('Invalid File\n Only PDF accepted')
        document.getElementById("alldocs").value=null
        
      }
        
})


$('#photo').change(function(){
        
        
   var f=$('#photo').val().split('.')
   var x=f[1]
   if(x=='jpeg'||x=='png'||x=='jpg')
   {
        $('#myfile0').replaceWith($('#photo').val())
        
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_upload_preview').attr('src', e.target.result);
                    
                };

                reader.readAsDataURL(this.files[0]);
            }
        
        $("#image_upload_preview").slideDown("slow");
   }
   else
   {
        alert('Invalid File \n Only IMAGE accepted')
        document.getElementById("photo").value=null

   }
   
  
})
$('#mycv').change(function(){ 
        var f =$('#mycv').val().split('.')
        var x=f[1]
        if(x=='pdf')
        {         
                f =$('#mycv').val()
        $('#myfilecv').text(f)
        }
        else
        {
        alert('Invalid File \n Only PDF accepted')
        document.getElementById("mycv").value=null
        }
        
})


</script>
</body>
</html>
