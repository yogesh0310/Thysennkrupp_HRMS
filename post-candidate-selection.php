<?php
session_start();
$_SESSION['mailid'] = $_GET['token'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>thyssenkrupp</title>
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
  background: rgba(0,0,0,0.95)  url(loader2.gif)  no-repeat center center !important;
  z-index: 10000;
}
#loader > #txt{
  font-size:25px;
  color:lightskyblue;
  margin-left:33% !important;
  margin-top:18% !important; 
}

input[id="uan"]
{
    text-transform: uppercase;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}       

</style>
<body>
    <nav id="namethy">
        <div class="nav-wrapper blue darken-1">
            <a href="#!" class="brand-logo center">thyssenkrupp Elevators</a>
        </div>
    </nav>

    <!-- details submitted warning starts here -->
        <div class="row" id="details">
                <div class="col s12 m6 offset-m3">
                        <div class="card white">
                                <div class="card-content ">
                                        <center><i class="material-icons large" style="color: green;">check_circle</i></center>
                                        <center><h1><p  style="color:green">Details Submitted Successfully.</p></h5></center>
                                </div>
                        </div>
                </div>
        </div>
    <!-- details submitted warning ends here -->
    
    <form id="myForm" method="POST" action="http://localhost/hrms/api/submitevalform.php" enctype="multipart/form-data">
    
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="card white">
                <div class="card-content blue-text darken-1" id="main">
                    <form action="#">
                    <b>Upload Latest Company Appointment Letter / Salary Breakup</b>
                    <div class="row">
                        <div class="file-field input-field">
                                <div class="btn blue darken-1">
                                        <span>Appointment Letter/Salary Breakup</span>
                                                <input id="appletter" name="appletter" type="file" accept=".pdf">
                                </div>
                                <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                </div>
                        </div>                             
                    </div>


                    
                    <!-- <b>Current Company's Latest Letter Indicating Salary Breakup</b>
                    <div class="row">  
                        <div class="file-field input-field">
                                <div class="btn blue darken-1">
                                        <span>Salary Breakup Letter</span>
                                                <input id="salarybreak" name="salarybreak" type="file" accept=".pdf">
                                </div>
                                <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                </div>
                        </div>                                                   
                    </div> -->
                                      
                    
                    <b>Past Three Months Pay Slip</b>
                    <div class="row">
                        <div class="file-field input-field">
                                <div class="btn blue darken-1">
                                        <span>Past Pay Slip</span>
                                                <input id="pastpayslip" name="pastpayslip" type="file" accept=".pdf">
                                </div>
                                <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                </div>
                        </div> 
                     </div>
                    
                    <div class="row">
                            <div class="input-field col s6">
                                    <input id="uan" name="uan" type="text" class="validate" maxlength="12" onkeypress="return validuan(event)" onchange="uanlength(this.id);">
                                    <label for="uan">UAN</label>
                                    <b id="checkuan"></b>
                                  </div>            
                    </div>


                    <b>Cancelled Cheque *</b>
                    <div class="row">
                            <div class="file-field input-field">
                                                <div class="btn blue darken-1">
                                                        <span>Cancelled Cheque *</span>
                                                        <input id="cancelcheck" name="cancelcheck" type="file" accept=".pdf">
                                                </div>
                                                <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text">
                                                </div>
                                </div>                       
                    </div>


                    <b>Name of Nominees (Atleast 1 Compulsory)</b>
                    <div class="row">
                            <div class="input-field col s6">
                                    <input id="nom1" name="nom1" type="text" required="" aria-required="true" >
                                    <label for="nom1">Nominee 1 *</label>
                            </div>
                            <div class="input-field col s3">
                                <input id="n1dobdates" name="n1dobdates" type="text" class="datepicker" aria-required="true" required>
                                <label for="n1dobdates">Date Of Birth *</label>
                            </div>
                            <div class="col s3 "><br>
                                <select id='n1gender' name='n1gender' class="dropdown-trigger btn blue darken-1" required>
                                <option value="" disabled selected style="color: white">Gender *</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="input-field col s6">
                                    <input id="nom2" name="nom2" type="text">
                                    <label for="nom2">Nominee 2</label>
                            </div>
                            <div class="input-field col s3">
                                <input id="n2dobdates" name="n2dobdates"  type="text" class="datepicker">
                                <label for="n2dobdates">Date Of Birth</label>
                            </div>
                            <div class="col s3 "><br>
                                <select id='n2gender' name='n2gender' class="dropdown-trigger btn blue darken-1" >
                                <option value="" disabled selected style="color: white">Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="input-field col s6">
                                    <input id="nom3" name="nom3" type="text">
                                    <label for="nom3">Nominee 3</label>
                            </div>  
                            <div class="input-field col s3">
                                <input id="n3dobdates" name="n3dobdates"  type="text" class="datepicker">
                                <label for="n3dobdates">Date Of Birth</label>
                            </div>
                            <div class="col s3 "><br>
                                <select id='n3gender' name='n3gender' class="dropdown-trigger btn blue darken-1">
                                <option value="" disabled selected style="color: white">Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="input-field col s6">
                                    <input id="nom4" name="nom4" type="text">
                                    <label for="nom4">Nominee 4</label>
                            </div> 
                            <div class="input-field col s3">
                                <input id="n4dobdates" name="n4dobdates"  type="text" class="datepicker">
                                <label for="n4dobdates">Date Of Birth</label>
                            </div> 
                            <div class="col s3 "><br>
                                <select id='n4gender' name='n4gender' class="dropdown-trigger btn blue darken-1">
                                <option value="" disabled selected style="color: white">Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                                </select>
                            </div>                    
                    </div>

        


                        <b style="font-size:15px;">Upload your Aadhar Card as Proof Of Identity *</b>
                        <div class="file-field input-field">
                                <div class="btn blue darken-1">
                                <span>Upload File *</span>
                                        <input id="proof_identity_addhar" name="proof_identity_addhar" type="file" accept=".png, .jpg, .jpeg, .pdf" required>
                                        </div>
                                <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                </div>
                        </div>


                        <div id="uploadotherdoc">
                        <b style="font-size:15px;">Proof Of Identity(PAN/Voter ID/Driving Licence/Passport) *</b>
                                <div class="file-field input-field">
                                        <div class="btn blue darken-1">
                                        <span>Upload File *</span>
                                                <input id="proof_otherthanadhar" name="proof_otherthanadhar" type="file" accept=".png, .jpg, .jpeg, .pdf">
                                        </div>
                                        <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                        </div>
                                </div>
                        </div>


                        <b style="font-size:15px;">Proof Of Address(Rent Agreement/Voter ID/Driving Licence/Passport) *</b>
                        <div class="file-field input-field">
                                <div class="btn blue darken-1">
                                <span>Upload File *</span>
                                        <input id="proof_address" name="proof_address" required type="file" accept=".png, .jpg, .jpeg, .pdf">
                                </div>
                                <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                </div>
                        </div>

                        <b style="font-size:15px;">10th Marksheet *</b>
                        <div class="file-field input-field">
                                <div class="btn blue darken-1">
                                <span>Upload File *</span>
                                        <input id="marks10" name="marks10" required type="file" accept=".png, .jpg, .jpeg, .pdf">
                                </div>
                                <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                </div>
                        </div>

                        <b style="font-size:15px;">12th Marksheet (If Applicable)</b>
                        <div class="file-field input-field">
                                <div class="btn blue darken-1">
                                <span>Upload File</span>
                                        <input id="marks12" name="marks12" type="file" accept=".png, .jpg, .jpeg, .pdf">
                                </div>
                                <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                </div>
                        </div>

                        <b style="font-size:15px;">ITI/Diploma Marksheet (If Applicable)</b>
                        <div class="file-field input-field">
                                <div class="btn blue darken-1">
                                <span>Upload File</span>
                                        <input id="itidiploma" name="itidiploma" type="file" accept=".png, .jpg, .jpeg, .pdf">
                                </div>
                                <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                </div>
                        </div>

                        <b style="font-size:15px;">Graduation Marksheet</b>
                        <div class="file-field input-field">
                                <div class="btn blue darken-1">
                                <span>Upload File</span>
                                        <input id="ugcert" name="ugcert" type="file" accept=".png, .jpg, .jpeg, .pdf">
                                </div>
                                <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                </div>
                        </div>

                        <b style="font-size:15px;">Post Graduation Marksheet (If Applicable)</b>
                        <div class="file-field input-field">
                                <div class="btn blue darken-1">
                                <span>Upload File</span>
                                        <input id="pgcert" name="pgcert" type="file" accept=".png, .jpg, .jpeg, .pdf">
                                </div>
                                <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                </div>
                        </div>
                     

                        <div class="row">
                                        <div class=" col s6 offset-s3 center" id="submitform">
                                        <!-- id="submitformdata" -->
                                              <button class="btn blue darken-2" id="submitbtn" type="submit" name="action" >Submit
                                                <i class="material-icons right">send</i>
                                              </button>
                                        </div>                                    
                                </div>        
                        </form>           
                </div>
                <div id="postsubmit">

                </div>


            </div>
        </div>

</form>
<div id="loader">
        <div id="txt">
                <b>Please wait while we submit your form !!</b>
        </div>
</div>

<script>

$("#myform").submit(function(){
        
        $('#loader').show()
        window.location.href="documentsubmittedsuccesfully.html"

})

function validuan(e)
{
        
        var charCode = e.which; 
        if ((charCode >= 48 && charCode <=57))
        {
                return true;
        }
        else
        {
                return false;
        } 
      
}
function uanlength(x) 
{
        var id="#"+x;
        var myuan=$(id).val();

        if(myuan.length!=12)
        {
                $("#checkuan").css("color","red")
                $("#checkuan").html("Invalid UAN...!")
                $("#uan").val(" ");
        }
        else
        {
                $("#checkuan").css("color","green")
                $("#checkuan").text("Valid UAN...!")
        }
           
}

function mytextvalid(e)
{
        //Written by Tanmay
        var charCode = event.keyCode;
        //Gets ASCII code of character
        if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8)
                return true;
        else
                return false;

}

$(document).ready(function(){
var cdate=new Date();
var cyear=cdate.getFullYear();
        $('.datepicker').datepicker({
                        //dateFormat:"dd/mm/yy",
                        yearRange:[1900,cyear],
                        changeMonth:true,
                        
                        //changeYear:true
               
        });
        $("#details").hide();
        $("#loader").hide()
        function getUrlVars() {
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                vars[key] = value;
            });
            return vars;
        }
        var token = getUrlVars()["token"];
        var expiry = getUrlVars()["explink"];
        var data={"token":token, "expdate":expiry};
       // console.log(token);
        $.ajax({
                url : 'http://localhost/hrms/api/checkExpiry2.php',
                type : 'POST',
                data :(data),          
                success : function(para){
                       // alert(para)
                if(para == "expired")
                {
                console.log("Expired Page");
                $('#main').hide()   
                $("#details").show();             
                }
                else if(para=='success')
                {
                console.log("You are welcome");
                }
                else if(para == "submitted")
                {
                $("#details").show();
                $('#main').hide()
                }
                },
                error : function(err){        
                }
                 });
                });


$("#postsubmit").hide();   
$("#details").fadeIn();




$('#proof_address').change(function(){
      var f = $('#proof_address').val().split('.')
      var x=f[1]
      if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
      {
        alert('Invalid File\n Only PDF/IMAGES accepted')
        document.getElementById("proof_address").value=null
      }
        
})


$('#proof_otherthanadhar').change(function(){
      var f = $('#proof_otherthanadhar').val().split('.')
      var x=f[1]
      if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
      {
        alert('Invalid File\n Only PDF/IMAGES accepted')
        document.getElementById("proof_otherthanadhar").value=null
      }
        
})


$('#proof_identity_addhar').change(function(){
      var f = $('#proof_identity_addhar').val().split('.')
      var x=f[1]
      if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
      {
        alert('Invalid File\n Only PDF/IMAGES accepted')
        document.getElementById("proof_identity_addhar").value=null
      }
})

$('#appletter').change(function(){
      
        var f = $('#appletter').val().split('.');
        var x=f[1]
        
        if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
        {
                alert('Invalid File\n Only PDF/IMAGES accepted')
                document.getElementById("appletter").value=null
        }
 })


// $('#salarybreak').change(function(){
//         var f = $('#salarybreak').val().split('.');
//         var x=f[1]
//         if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
//         {
//                 alert('Invalid File\n Only PDF/IMAGES accepted')
//                 document.getElementById("salarybreak").value=null
//         }

   
// })


$('#pastpayslip').change(function(){
        var f = $('#pastpayslip').val().split('.')
        var x=f[1]
        if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
        {
                alert('Invalid File\n Only PDF/IMAGES accepted')
                document.getElementById("pastpayslip").value=null
        }
  

})

$('#cancelcheck').change(function(){
        var f = $('#cancelcheck').val().split('.')
        var x=f[1]
        if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
        {
                alert('Invalid File\n Only PDF/IMAGES accepted')
                document.getElementById("cancelcheck").value=null
        }   
 
})

$('#marks10').change(function(){
        var f = $('#marks10').val().split('.')
        var x=f[1]
        if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
        {
                alert('Invalid File\n Only PDF/IMAGES accepted')
                document.getElementById("marks10").value=null
        }   
 
})

$('#marks12').change(function(){
        var f = $('#marks12').val().split('.')
        var x=f[1]
        if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
        {
                alert('Invalid File\n Only PDF/IMAGES accepted')
                document.getElementById("marks12").value=null
        }   
 
})

$('#itidiploma').change(function(){
        var f = $('#itidiploma').val().split('.')
        var x=f[1]
        if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
        {
                alert('Invalid File\n Only PDF/IMAGES accepted')
                document.getElementById("itidiploma").value=null
        }   
 
})

$('#ugcert').change(function(){
        var f = $('#ugcert').val().split('.')
        var x=f[1]
        if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
        {
                alert('Invalid File\n Only PDF/IMAGES accepted')
                document.getElementById("ugcert").value=null
        }   
 
})

$('#pgcert').change(function(){
        var f = $('#pgcert').val().split('.')
        var x=f[1]
        if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
        {
                alert('Invalid File\n Only PDF/IMAGES accepted')
                document.getElementById("pgcert").value=null
        }   
 
})

var appletter
var uan
// var salarybreak
var pastpayslip
var cancelcheck
var nom1
var nom2
var nom3
var nom4
var ugcert
var pgcert

// $('#submitformdata').click(function(){
//         var fd = new FormData();
//         var files = $('#appletter')[0].files[0];
//         fd.append('appletter',files)

      
//         var files = $('#pastpayslip')[0].files[0];
//         fd.append('pastpayslip',files)

//         var files = $('#salarybreak')[0].files[0];
//         fd.append('salarybreak',files)

//         var files = $('#cancelcheck')[0].files[0];
//         fd.append('cancelcheck',files)

//         var files = $('#alldocs')[0].files[0];
//         fd.append('alldocs',files)

//         var files = $('#proof_identity_addhar')[0].files[0];
//         fd.append('adhaar',files)

        

//         var files = $('#proof_otherthanadhar')[0].files[0];
//         fd.append('pancard',files)

//         var files = $('#proof_address')[0].files[0];
//         fd.append('proof_address',files)

//         fd.append('uan',$("#uan").val())
//         fd.append('nom1',$("#nom1").val())
//         fd.append('nom2',$("#nom2").val())
//         fd.append('nom3',$("#nom3").val())
//         fd.append('nom4',$("#nom4").val())
//         fd.append('mail',token)
       
// $.ajax({


//     url:'http://localhost/hrms/api/submitevalform.php',
//     type:"POST",
//     data:
//     fd,
//     contentType: false,
//     processData: false,
//     success:function(para)
//     {
//             console.log("hello this is me : ",para)
//             if(para == "success" )
//             {
//                     alert("data entered");
//                     console.log("data entered")
//             }
//         //alert('yes')
//         var formsuccess="<h3 style='color:green;'>Form Submitted Successfully</h3>"
//         $("#main").hide();
//         $('#postsubmit').append(formsuccess) 
//         $('#postsubmit').fadeIn(300);
      
        
//     }
// })


// })



</script>
</body>
</html>