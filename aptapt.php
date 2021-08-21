<html>

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
    <script>
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
                                            
                                           
                                             if(para == "expired")
                                             {
                                               console.log("Expired Page");
                                                $('#form').hide()
                                            
                                             }
                                             else if(para=='success')
                                             {
                                                console.log("You are welcome");
                                             
                                             }
                                             },
                                            error : function(err){        
                                            }
                 });
                
        </script>
         <!-- script ended by SARANG -->

</head>
<style>
input[id="full_name"] {
  text-transform: uppercase;
}
input[id="mother"] {
  text-transform: uppercase;
}
input[id="father"] {
  text-transform: uppercase;
}
input[id="spouse"] {
  text-transform: uppercase;
}
input[id="child1"] {
  text-transform: uppercase;
}
input[id="child2"] {
  text-transform: uppercase;
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
                          <div class="card white">
                            <div class="card-content blue-text darken-1" id="form">



                                <!-- form starts -->
                                
                                <center>
                                        <b style="font-size: 35px">Application Form</b><br><br>
                                        
                                </center> 
                                
                                <div class="row">
                                        <b style="font-size:20px;">Candidate Photo</b><br>
                                        
                                       
                                                        <img id="image_upload_preview" src="" alt="your image" width="150" height="150"/>
                                       

                                    <div class="row"> 
                                    
                                        <div class="input-field col s12" id="uphoto">
                                                <label class="custom-file-upload" id="prof">
                                                   <a class="btn blue darken-1"> 
                                                           <input id="photo" type="file" accept=".png, .jpg, .jpeg but .exe and .app"  onchange="readURL(this)"><p id='myfile0'>Upload File</p></a>
                                                           <div>                                                           
                                                        </div>
                                                </label>
                                            </div>
                                        </div><br><br>
                                        <div class="row" id="myphoto">
                                                                                              
                                        </div>

                                        <b style="font-size:20px;">Candidate CV</b>
                                        <div class="row">
                                                        <div class="input-field col s12" id="ucv">
                                                                <label class="custom-file-upload" id="cv">
                                                                        <a class="btn blue darken-1"> <input id="mycv" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"><p id='myfilecv'>Upload CV</p></a>
                                                                </label>
                                                        </div>
                                        </div>                                        
                                        <br><br>
                                      
                                          <div class="row">
                                                <div class="input-field col s6">
                                                        <input id="useradharno" type="text" class="validate" required maxlength="12" aria-required="true">
                                                        <label for="useradharno">Aadhar Card Number</label>
                                                      </div> 
                                          </div>                                           

                                        <div class="row">

                                            <div class="input-field col s12">
                                              <input id="full_name" type="text" class="validate" required="" aria-required="true">
                                              <label for="full_name">Full Name</label>
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="input-field col s12">
                                              <input   id="address" type="text" class="validate" required="" aria-required="true">
                                              <label for="address">Present Address</label>
                                              
                                            </div>
                                          </div>


                                          <div class="row">
                                            <div class="input-field col s12">
                                              <input id="unumber" type="number" class="validate" required="" aria-required="true">
                                              <label for="number">Contact number</label>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="input-field col s6">
                                              <input id="uemail" type="email" class="validate" required="" aria-required="true">
                                              <label for="uemail">Email</label>
                                            </div>

                                            
                                            <div class="input-field col s6">
                                                <input id="udob" type="text" class="datepicker" required="" aria-required="true">
                                                <label for="udob">Date Of Birth</label>
                                            </div>
                                                 
                                          </div>


                                          <div class="row">
                                                <div class="input-field col s6">
                                                  <input id="position" type="text" class="validate" required="" aria-required="true">
                                                  <label for="position">Position Applied For</label>
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                    <input id="location" type="text" class="validate" required="" aria-required="true">
                                                    <label for="location">Location</label>
                                                </div>
                           
                                          </div>


                                          <div class="row">
                                            
                                                <div class="input-field col s12">
                                                  <input id="passport" type="text" class="validate" required="" aria-required="true">
                                                  <label for="passport">Passport Availability/Validity</label>
                                                </div>
                                          </div>

                                          <b style="font-size:20px;">Academic professional Qualification</b>
                                          <div class="row">
                                                
                                                <div class="input-field col s6">
                                                        <input id="qualification" type="text" class="validate" required="" aria-required="true">
                                                        <label for="qualification">Highest Qualification</label>
                                                      </div>
          
                                                      
                                                      <div class="input-field col s6">
                                                          <input id="passing" type="text" class="validate" required="" aria-required="true">
                                                          <label for="passing">Passing Year</label>
                                                      </div>
                                                </div>
                                                <div class="row">
                                                               
                                                      <div class="col s12">
                                                                <b style="color: red;">Please Upload all Documents until Highest Qualification</b>
                                                                        <label class="custom-file-upload">
                    
                                                                                        <br><br>
                                                                           <a class="btn blue darken-1"> <input id="alldocs" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"> <p id='mydocs'> Upload Document</p></a>
                                                                        </label>
                                                                    
                                                        </div>
                                                </div>

                                                      


                                                      
                                          

                                          <b style="font-size:20px;">Professional Experience (Mention Company Name And Designation)</b>
                                          <div class="row">
                                                
                                                <div class="input-field col s12">
                                                        <a class="btn blue darken-1" id='myexperience'>Add Experience</a>
                                                        <!--<input id="experience" type="text" >
                                                        <label for="experience">Professional Experience</label>-->
                                                </div>
                                                <div class=" col s12" id="mainexpdiv">
                                                  <div class="col s12" id="myexpdiv">
                                                          
                                                        <div class="input-field col s6">
                                                                <input id="orgname0" type="text" class="validate" required="" aria-required="true">
                                                                <label for="orgname0" style="font-size: 11px">Current Organization Name</label>
                                                        </div>
                                  
                                                                              
                                                        <div class="input-field col s6">
                                                                <input id="olddesignation0" type="text"class="validate" required="" aria-required="true" >
                                                                <label for="olddesignation0" style="font-size: 11px">Designation</label>
                                                        </div>
                                                        
                                                        <div class="input-field col s6">
                                                                <input id="fromdate0" type="text" class="datepicker">
                                                                <label for="fromdate0" style="font-size: 11px">From</label>
                                                        </div>

                                                        <div class="input-field col s6">
                                                                <input id="todate0" type="text" class="datepicker">
                                                                <label for="todate0" style="font-size: 11px">To</label>
                                                        </div> 

                                                        <div class="input-field col s6">
                                                                <input id="managername0" type="text" class="validate" required="" aria-required="true">
                                                                <label for="managername0" style="font-size: 11px">Reporting Manager Name</label>
                                                        </div> 
                                                              
                                                        <div class="input-field col s6">
                                                                <input id="managermail0" type="text" class="validate" required="" aria-required="true">
                                                                <label for="managermail0" style="font-size: 11px">Enter Manager Email</label>
                                                        </div> 
                                                        <div class="row" id="addnextexp"x>
                                                                <a class="btn-floating btn" onclick="addnewexp(this)"><i class="material-icons">add</i></a>                                                    
                                                        </div>
                                                                                                                        
                                                  </div>
                                                </div>
          
                                                   
                                          </div>

                                          <b style="font-size:20px;">Referral Sources</b>
                                          <br><br>                        
                                           <div class="row">
                                            
                                                <label class="col s12">
                                                        <input type="checkbox" id="internet" class="filled-in">
                                                        <span>Internet (Job Boards)</span>
                                                </label><br>

                                                <label class="col s12">
                                                        <input type="checkbox" id="empref" class="filled-in">
                                                        <span>Employee Referel</span>
                                                </label><br>

                                                <label class="col s12">
                                                        <input type="checkbox" id="walkin" class="filled-in">
                                                        <span>Walk-In (Factory Gate)</span>
                                                </label><br>

                                                <label class="col s12">
                                                         <input type="checkbox" id="website" class="filled-in">
                                                        <span>Company Website</span>
                                                </label><br>

                                                <label class="col s12">
                                                        <input type="checkbox" id="other" class="filled-in">
                                                        <span>Other</span>
                                                        <input placeholder="Enter Specific Details" id="otherdetails" type="text" class="validate">                                                        
                                                </label>
                                                
                                            
                                                   
                                          </div>



                                          <div class="row">
                                                <div class="input-field col s6">
                                                  <input id="jdate" type="text">
                                                  <label for="jdate" style="font-size: 11px">If Selected, how soon you can join us?</label>
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                    <input id="notice" type="text" >
                                                    <label for="notice" style="font-size: 11px">Notice Period In Current Oraganization</label>
                                                </div>

                                                
                                                <div class="input-field col s6" >
                                                        <input id="manager" type="text" >
                                                        <label for="manager" style="font-size: 11px">Reporting Manager Name & Designation</label>
                                                </div>

                                                <div class="input-field col s6" >
                                                        <input id="position" type="text" >
                                                        <label for="ifselectposition" style="font-size: 11px">Current Position</label>
                                                </div>

                                                

                                             
                           
                                          </div>


                                          
                                          <b style="font-size:20px;">Upload your Aadhar Card as Proof Of Identity</b>
                                          <div class="row">
                                                <!-- <div class="input-field col s12">
                                                        <a class="btn green" id="yesforaadhar">YES</a>                                                                                                               
                                                        <a class="btn red" id="noforaadhar">NO</a>
                                                </div> -->
                                                                                        
                                                <div class="input-field col s12" id="showaddharupload">
                                                                <label class="custom-file-upload">
                                                                        <a class="btn blue darken-1"><input id="proof_identity_addhar" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx" required><p id='myfile_adhar'>Upload Aadhar Card </p></a>
                                                                </label>
                                                </div>
                                        </div><br>
                                         <div id="uploadotherdoc">
                                                        <b>Proof Of Identity(PAN/Voter ID/Driving Licence/Passport)</b>


                                                        <div class="row">
                                                                <div class="input-field col s12" >
                                                                                  <label class="custom-file-upload">
                                                                                           <a class="btn blue darken-1"> <input id="proof_otherthanadhar" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"> <p id='myfile1'> Upload file </p></a>
                                                                                  </label>
                                                                              </div>
                                                              </div><br>                                                        
                                         </div>
                                         
                                            

                                            <b style="font-size:20px;">Proof Of Address(Rent Agreement/Voter ID/Driving Licence/Passport)</b>
                                                
                                          <div class="row">

                                                <div class="input-field col s12" >
                                                    <label class="custom-file-upload">

                                                    
                                                       <a class="btn blue darken-1"> <input id="proof_address" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"> <p id='myfile2'> Upload file </p></a>
                                                    </label>
                                                </div>
                                          </div>

                                          <br><br>

                                            <b style="font-size:20px;">Family Details :</b>
                                                
                                          <div class="row">

                                                
                                            <div class="input-field col s6">
                                                    <input id="father" type="text">
                                                    <label for="father">Father Name</label>
                                            </div>

                                            
                                            <div class="input-field col s6">
                                                    <input id="fdob" type="text" class="datepicker"  >
                                                    <label for="fdob">DOB</label>
                                            </div>


                                            
                                            <div class="input-field col s6">
                                                    <input id="mother" type="text">
                                                    <label for="mother">Mother Name</label>
                                            </div>

                                            
                                            <div class="input-field col s6">
                                                    <input id="mdob" type="text" class="datepicker" >
                                                    <label for="mdob">DOB</label>
                                            </div>


                                            
                                            <div class="input-field col s6">
                                                    <input id="spouse" type="text">
                                                    <label for="spouse">Spouse Name</label>
                                            </div>

                                            
                                            <div class="input-field col s3">
                                                    <input id="spdob" type="text" class="datepicker" >
                                                    <label for="spdob">DOB</label>
                                            </div>
                                            
                                            <div class="col s3 ">
                                                <br>
                                                    <select id='sgender' class="dropdown-trigger btn blue darken-1" >
                                                        <option value="" disabled selected style="color: white">Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                      </select>
                                                      <br><br>
                                                </div>   
                                  

                                            
                                            <div class="input-field col s6">
                                                    <input id="child1" type="text">
                                                    <label for="child1">Child1 Name</label>
                                            </div>

                                            
                                            <div class="input-field col s3">
                                                    <input id="c1dob" type="text" class="datepicker" >
                                                    <label for="c1dob">DOB</label>
                                            </div>
                                            <div class="col s3 ">
                                                    <br>
                                                        <select id='c1gender' class="dropdown-trigger btn blue darken-1" >
                                                            <option value="" disabled selected style="color: white">Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                          </select>
                                                          <br><br>
                                                    </div> 


                                            
                                            <div class="input-field col s6">
                                                    <input id="child2" type="text">
                                                    <label for="child2">Child2 Name</label>
                                            </div>

                                            
                                            <div class="input-field col s3">
                                                    <input id="c2dob" type="text" class="datepicker" >
                                                    <label for="c2dob">DOB</label>
                                            </div>

                                            
                                            <div class="col s3 ">
                                                    <br>
                                                        <select id='c2gender' class="dropdown-trigger btn blue darken-1" >
                                                            <option value="" disabled selected style="color: white">Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                          </select>
                                                          <br><br>
                                                    </div> 



                                          </div>
                                          <b style="font-size:20px;">Renumation Details:</b>
                                          <div class="row">

                                                <div class="input-field col s6">
                                                        <input id="monthhome" type="text" disabled value="Annual Gross(CTC)" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s3">
                                                        <input id="homepresent" type="number">
                                                        <label for="homepresent">Present</label>
                                                </div>
                                                
                                                <div class="input-field col s3">
                                                        <input id="homeexp" type="number">
                                                        <label for="homeexp">Expected</label>
                                                </div>
                                                
                                                
                                                <div class="input-field col s6">
                                                        <input id="child2" type="text" disabled value="Monthly Gross(CTC)" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s3">
                                                        <input id="grosspresent" type="number">
                                                        <label for="grosspresent">Present</label>
                                                </div>
                                                
                                                
                                                <div class="input-field col s3">
                                                        <input id="grossexp" type="number">
                                                        <label for="grossexp">Expected</label>
                                                </div>
                                                


                                                
                                                <div class="input-field col s6">
                                                        <input id="child2" type="text" disabled value="Monthly Take Home" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s3">
                                                        <input id="yearpresent" type="number">
                                                        <label for="yearpresent">Present</label>
                                                </div>
                                                
                                                <div class="input-field col s3">
                                                        <input id="yearexp" type="number">
                                                        <label for="yearexp">Expected</label>
                                                </div>
    
                                          </div>


                                         
                                          <b style="font-size:20px;">References :</b>
                                          <div class="row" id="mainref">
                                                  <div id="ref" class="col">

                                                <div class="input-field col s6">
                                                        <input id="child2" type="text" disabled value="Name" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                        <input id="nameref0" type="text">
                                                        <label for="nameref0">Reference</label>
                                                </div>
                                                
                                                
                                                
                                                
                                                <div class="input-field col s6">
                                                        <input id="child2" type="text" disabled value="Designation" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                        <input id="designationref0" type="text">
                                                        <label for="designationref0">Reference</label>
                                                </div>
                                                
                                               
                                                
                                                <div class="input-field col s6">
                                                        <input id="child2" type="text" disabled value="Company Name" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                        <input id="cmpnmref0" type="text">
                                                        <label for="cpmnmref0">Reference </label>
                                                </div>
                                                
                                               


                                                
                                                <div class="input-field col s6">
                                                        <input id="child2" type="text" disabled value="Contact Number" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                        <input id="contref0" type="number" class="validate" required="" aria-required="true"/>
                                                        <label for="contref0">Reference</label>
                                                </div>
                                                
                                                

                                                <div class="input-field col s6">
                                                         <input id="child2" type="text" disabled value="Email" style="color: black">
                                                </div>

                                                <div class="input-field col s6">
                                                        <input id="mailref0" type="email" class="validate" required="" aria-required="true">
                                                        <label for="mailref0">Reference</label>
                                                </div>

                                                <div class="col s6" id="addnextref">
                                                        <a class="btn-floating btn" onclick="addnewref(this)"><i class="material-icons">add</i></a>                                                    
                                                </div>
                                        </div>
                                        </div>

                                              
        

                                                
    
                                         




                                        <div class=" col s6 offset-s3 center" id="submitform">
                                              <button class="btn blue darken-2" type="submit" name="action" id="submitformdata">Submit
                                                <i class="material-icons right">send</i>
                                              </button>
                                        </div>                                    
                                        
                                      </div>
                                            


                                <!-- form end -->










                           
                          </div>
                        </div>
                      </div>
                         

                        
<script>
var ctr=0
var ctr2 = 0
var expctr = 0
function addnewexp(x)
{
        ctr = ctr+1
        var str = 'myexpdiv'+ctr
       
        var txt='<div class="input-field col s12" id="myexpdiv"><div class="input-field col s6"><input id="orgname" type="text"><label for="oldorgname" style="font-size: 11px">Current Organization Name</label></div>  <div class="input-field col s6"><input id="olddesignation" type="text" ><label for="olddesg" style="font-size: 11px">Designation</label></div><div class="input-field col s6"><input id="fromdate" type="text" class="datepicker"><label for="fromdate" style="font-size: 11px">From</label></div><div class="input-field col s6"><input id="todate" type="text" class="datepicker"><label for="todate" style="font-size: 11px">To</label></div><div class="input-field col s6"><input id="managername" type="text"><label for="managername" style="font-size: 11px">Reporting Manager Name</label></div><div class="input-field col s6"><input id="managermail" type="text"><label for="managermail" style="font-size: 11px">Enter Manager Email</label></div><div class="input-field" id="addnextexp"><a class="btn-floating btn" onclick="addnewexp(this)"><i class="material-icons">add</i></a></div></div>'
        $("#mainexpdiv").append(txt);
}

function addnewref(x)
{

        ctr2 = ctr2+1
        var txt='<div id="ref" class="col"><div class="input-field col s6"><input id="child2" type="text" disabled value="Name" style="color: black"></div><div class="input-field col s6"><input id="nameref'+ctr2+'" type="text"><label for="nameref'+ctr2+'">Reference</label></div><div class="input-field col s6"><input id="child2" type="text" disabled value="Designation" style="color: black"></div><div class="input-field col s6"><input id="designationref'+ctr2+'" type="text"><label for="designationref'+ctr2+'">Reference</label></div><div class="input-field col s6"> <input id="child2" type="text" disabled value="Company Name" style="color: black"></div><div class="input-field col s6"><input id="cmpnmref'+ctr2+'" type="text"><label for="cpmnmref'+ctr2+'">Reference </label></div><div class="input-field col s6"><input id="child2" type="text" disabled value="Contact Number" style="color: black"></div><div class="input-field col s6"><input id="contref'+ctr2+'" type="number"><label for="contref'+ctr2+'">Reference</label></div><div class="input-field col s6"><input id="child2" type="text" disabled value="Email" style="color: black"></div><div class="input-field col s6"><input id="mailref'+ctr2+'" type="email"><label for="mailref'+ctr2+'">Reference</label></div><div class="col s6" id="addnextref"><a class="btn-floating btn" onclick="addnewref(this)"><i class="material-icons">add</i></a></div></div>'
        $("#mainref").append(txt);
}


var userphoto
var myimg
var cv
var userfullnamel
var address
var number
var email
var dob
var pos
var loc
var passport
var qualif
var passing
var alldocs
var experience
var check_internet
var check_emp
var check_walkin
var check_web
var check_other
var joindate
var notice
var manager
var posifselect
var proof_identity_addhar
var proof_otherthanadhar
var proof_identity_pan
var proofaddress
var fathername
var fdob
var mothername
var mdob
var spousename
var spdob
var spgender
var ch1
var ch1dob
var ch1gender
var ch2
var ch2dob
var ch2gender
var homepresent
var homeexpect
var grosspresent
var grossexpect
var ypresent
var yexpect
var f



$("#image_upload_preview").hide()
$("#myexpdiv").hide();
$("#otherdetails").hide();
//$("#uploadotherdoc").hide();
//$("#showaddharupload").hide();
$("#myphoto").hide();


$(document).ready(function(){
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

$("#photo").change(function(){
        $("#image_upload_preview").slideDown("slow")
})


$("#yesforaadhar").click(function(){
        $("#uploadotherdoc").fadeOut("slow");
        $("#showaddharupload").fadeIn("slow");
})

$("#noforaadhar").click(function(){
        $("#showaddharupload").fadeOut("slow");
        $("#uploadotherdoc").fadeIn("slow");
})



$("#myexperience").click(function(){
        $("#myexpdiv").fadeIn(300);
})

$("#addnextexp").click(function(){
        $("#myexpdiv").fadeIn(300);
})

$(document).ready(function(){

//    $('.datepicker').datepicker();
    
    $('.filled-in').on('change', function() {
		    $('.filled-in').not(this).prop('checked', false);  

		});    
                $('.datepicker').datepicker({
                        //dateFormat:"dd/mm/yy",
                        yearRange:[1919,2020],
                        changeMonth:true,
                        //changeYear:true
                });
})



$('#proof_identity_addhar').change(function(){
      var f = $('#proof_identity_addhar').val()
      
        $('#myfile_adhar').replaceWith(f)
})
$('#proof_otherthanadhar').change(function(){
      var f = $('#proof_otherthanadhar').val()
      
        $('#myfile1').replaceWith(f)
})


$('#proof_address').change(function(){
      var f = $('#proof_address').val()
      
        $('#myfile2').replaceWith(f)
})
$('#alldocs').change(function(){
      var f = $('#alldocs').val()
      
        $('#mydocs').replaceWith(f)
})
$('#proof_address').change(function(){
      var f = $('#proof_address').val()
      
        $('#myfile2').replaceWith(f)
})

$('#photo').change(function(){
        
        
   f=$('#photo').val()
   $('#myfile0').replaceWith(f)
  
})
$('#mycv').change(function(){
        f =$('#mycv').val()
        $('#myfilecv').replaceWith(f)
})
/*function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('image_upload_preview');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}*/

function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_upload_preview').attr('src', e.target.result);
                    
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

       

// Ajax call started for getting form details

    
$('#submitformdata').click(function(){


        refarr1=[]
exparr1=[]
for(let i=0;i<=expctr;i++)
{
        var str1=$("#orgname"+i).val()
        var str2=$("#olddesignation"+i).val()
        var str3=$("#fromdate"+i).val()
        var str4=$("#todate"+i).val()
        var str5=$("#managername"+i).val()
        var str6=$("#managermail"+i).val()
        exparr1[i] = [str1,str2,str3,str4,str5,str6]
}
for(let i=0; i<=ctr2; i++)
{
        

        var str1 = $("#nameref"+i).val()
        var str2 = $("#designationref"+i).val()
        var str3 = $("#cmpnmref"+i).val()
        var str4 = $("#contref"+i).val()
        var str5 = $("#mailref"+i).val()
      
        
        refarr1[i]=[str1,str2,str3,str4,str5]
        

 }

 console.log(refarr1)
 console.log(exparr1)


userphoto=$('#photo').val();
myimg=$("#image_upload_preview").val();
cv=$("#mycv").val();
userfullname=$('#full_name').val();
address=$('#address').val();
number=$('#unumber').val();
email=$('#uemail').val();
dob=$('#udob').val();
pos=$('#position').val();
loc=$('#location').val();
passport=$('#passport').val();
qualif=$('#qualification').val();
passing=$('#passing').val();
alldocs=$("#alldocs").val();
experience=$('#experience').val();
check_internet=$('#internet').val();
check_emp=$('#empref').val();
check_walkin=$('#walkin').val();
check_web=$('#website').val();
check_other=$('#other').val();
joindate=$('#jdate').val();
notice=$('#notice').val();
manager=$('#manager').val();
posifselect=$('#ifselectposition').val();
proof_identity_addhar=$("#proof_identity_addhar").val();
proof_otherthanadhar=$("#proof_otherthanadhar").val();
proofaddress=$('#proof_address').val();
fathername=$('#father').val();
fdob=$('#fdob').val();
mothername=$('#mother').val();
mdob=$('#mdob').val();
spousename=$('#spouse').val();
spdob=$('#spdob').val();
spgender=$('#sgender').val();
ch1=$('#child1').val();
ch1dob=$('#c1dob').val();
ch1gender=$('#c2gender').val();
ch2=$('#child2').val();
ch2dob=$('#c2dob').val();
ch2gender=$('#c2gender').val();
homepresent=$('#homepresent').val();
homeexpect=$('#homeexp').val();
grosspresent=$('#grosspresent').val();
grossexpect=$('#grossexp').val();
ypresent=$('#yearpresent').val();
yexpect=$('#yearexp').val();






if($('#internet').prop("checked") == true)
{
        referalchoice=$('#internet').val();
}

if($('#empref').prop("checked") == true)
{
        referalchoice=$('#empref').val();
}
if($('#walkin').prop("checked") == true)
{
        referalchoice=$('#walkin').val();
}
if($('#website').prop("checked") == true)
{
        referalchoice=$('#website').val();
}
if($('#other').prop("checked") == true)
{
        referalchoice=$('#other').val();
        
 
}



var token = (window.location.href).split("=");


$.ajax({
        url:'api/submitapplication.php',
        type:'GET',
        data:{
        "token":token[1],
        "userphoto":userphoto,
        "cv":cv,
        "username":userfullname,
        "address":address,
        "number":number,
        "email":email,
        "dob":dob,
        "position":pos,
        "location":loc,
        "passport":passport,
        "qualification":qualif,
        "passing":passing,
        "alldocs":alldocs,
        "exp":experience,
        "internet":check_internet,
        "checkemp":check_emp,
        "walk":check_walkin,
        "web":check_web,
        "other":check_other,
        "jdate":joindate,
        "notice":notice,
        "manger":manager,
        "posifselect":posifselect,
        "proofidentityaadhar":proof_identity_addhar,
        "proofotherthanadhar":proof_otherthanadhar,
        "proofaddr":proofaddress,
        "fathersname":fathername,
        "fdob":fdob,
        "mother":mothername,
        "mdob":mdob,
        "spousename":spousename,
        "spdob":spdob,
        "sgender":spgender,
        "child1":ch1,
        "ch1dob":ch1dob,
        "ch2gender":ch1gender,
        "child2":ch2,
        "ch2dob":ch2dob,
        "ch2gender":ch2gender,
        "homepresent":homepresent,
        "homeexpect":homeexpect,
        "grosspresent":grosspresent,
        "grossexpect":grossexpect,
        "ypresent":ypresent,
        "yexpect":yexpect,
        // "olddesg":olddesignation,
        // "mangermail":managermail,
        // "managername":managername,
        // "fromdate":fromdate,
        // "todate":todate,
        "refarr1":refarr1,
        "exparr1":exparr1,
        
        
        "otherdetails":otherdetails
    },
    success:function(para)
    {
            console.log(para)
            if(para){
            console.log(para)
            }
            else{
            console.log("rooror")}
      var formsuccess="<br><b style='color:red;'>FORM SUBMITTED SUCCESSFULLY</b>"
      $('#submitform').append(formsuccess) 
    },

error:function()
{
alert("error")
}
})




// Ajax call for fetching data ends








})
</script>

<style>

input[type="file"] {
    display: none;
}



</style>
                               
</body>
</html>