
<?php
include 'api/db.php';
$result = $db->tokens->findOne(array('email'=>$_GET['token']));



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

    <script src="public/jquery-3.2.1.min.js"></script>

    <script src="public/js/materialize.js"></script>
    <script src="public/js/materialize.min.js"></script>

</head>
<style>
input[type="file"]
{
    display: none;
}
</style>
<body>

<nav>
    <div class="nav-wrapper blue darken-1">
        <a href="#!" class="brand-logo center">thyssenkrupp Elevators</a>
    </div>
</nav>
<br><br>

<div class="row" id="formdiv">
    <div class="col m6  offset-m3">
        <div class="card white">
            <div class="card-content blue-text">
                <span class="card-title"><p id="mail" style="color: green"></p></span>
                <table >
                    <thead>
                      <tr>
                          <th>Document</th>
                
                          <th>Reason</th>
                      </tr>
                    </thead>
                   

            <form id="forms" method="POST" enctype="multipart/form-data" name="validationform"> 
                    <tbody >

                      <tr id="tdcv">
                            <td>
                                <label class="custom-file-upload" >
                                 <a class="btn col s12 m12 blue darken-1"><input id="cv" name="cv" type="file" accept=".pdf" class="validate" required="" aria-required="true" ><p id='letter1'>cv</p></a>
                                </label>
                            </td>
                            

                            <td>
                                <div class="input-field col s12 m12" id="rcv1">
                                    <input id="rcv" type="text" class="validate" value="<?php echo $result['cvreason'];?> " readonly>
                                    <label for="rcv"> Reason Specified</label>
                                 </div>
                            </td>
                        </tr>

                        

                        <tr id="tdpan">
                            <td>
                                <label class="custom-file-upload">
                                     <a class="btn col s12 m12 blue darken-1"><input id="pan" name="pan" type="file" accept=".pdf" class="validate" required="" aria-required="true" ><p id='letter2'>pan</p></a>
                                </label>
                                 
                            </td>
                            

                            <td>
                                <div class="input-field col s12 m12" id="rpan1">
                                    <input id="rpan" type="text" class="validate" value="<?php echo $result['pancardreason'];?>" readonly>
                                    <label for="rpan">Reason Specified</label>
                                 </div>
                            </td>
                        </tr>

                        <tr id="tdAdhaar">
                            <td>
                                <label class="custom-file-upload">
                                    <a class="btn col s12 m12 blue darken-1"><input id="Adhaar" name="Adhaar" type="file" accept=".pdf" class="validate" required="" aria-required="true" ><p id='letter3'>Adhaar Card</p></a>
                                </label>
                            </td>
                            
                            <td>
                                <div class="input-field col s12 m12" id="rAdhaar1">
                                    <input id="rAdhaar" type="text" class="validate" value="<?php echo $result['adhaarreason'];?>" readonly>
                                    <label for="rAdhaar">Reason Specified</label>
                                 </div>
                            </td>
                        </tr>

                        <tr id="tdPhoto">
                            <td>
                                <label class="custom-file-upload">
                                    <a class="btn col s12 m12 blue darken-1"><input id="photo" name="photo" name="photo" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx" class="validate" required="" aria-required="true" ><p id='letter4'>PHOTO</p></a>
                                </label>
                            </td>
                           

                            <td>
                                <div class="input-field col s12 m12" id="rPhoto1" >
                                    <input id="rPhoto" type="text" class="validate" value="<?php echo $result['photoreason'];?>" readonly>
                                    <label for="rPhoto">Reason Specified</label>
                                </div>
                            </td>
                        </tr>

                        <tr id="tdmarks10">
                            <td>
                                <label class="custom-file-upload">
                                    <a class="btn col s12 m12 blue darken-1"><input id="marks10" name="marks10" type="file" accept=".pdf" class="validate" required="" aria-required="true"><p id='letter14'>10th MARKSHEET</p></a>
                                </label>
                            </td>
                           
                            <td>
                                <div class="input-field col s12 m12" id="rmarks101">
                                    <input id="rmarks10" type="text" class="validate" value="<?php echo $result['marks10reason'];?>" readonly>
                                    <label for="rmarks10">Reason Specified</label>
                                </div>
                            </td>
                        </tr>

                        <tr id="tdmarks12">
                            <td>
                                <label class="custom-file-upload">
                                    <a class="btn col s12 m12 blue darken-1"><input id="marks12" name="marks12" type="file" accept=".pdf" class="validate" required="" aria-required="true"><p id='letter15'>12th MARKSHEET</p></a>
                                </label>
                            </td>
                           
                            <td>
                                <div class="input-field col s12 m12" id="rmarks121">
                                    <input id="rmarks12" type="text" class="validate" value="<?php echo $result['marks12reason'];?>" readonly>
                                    <label for="rmarks12">Reason Specified</label>
                                </div>
                            </td>
                        </tr>

                        <tr id="tditidiploma">
                            <td>
                                <label class="custom-file-upload">
                                    <a class="btn col s12 m12 blue darken-1"><input id="itidiploma" name="itidiploma" type="file" accept=".pdf" class="validate" required="" aria-required="true"><p id='letter16'>ITI / DIPLOMA MARKSHEET</p></a>
                                </label>
                            </td>
                           
                            <td>
                                <div class="input-field col s12 m12" id="ritidiploma1">
                                    <input id="ritidiploma" type="text" class="validate" value="<?php echo $result['itidiplomareason'];?>" readonly>
                                    <label for="ritidiploma">Reason Specified</label>
                                </div>
                            </td>
                        </tr>
                        
                        <tr id="tdugcert">
                            <td>
                                <label class="custom-file-upload">
                                    <a class="btn col s12 m12 blue darken-1"><input id="ugcert" name="ugcert" type="file" accept=".pdf" class="validate" required="" aria-required="true"><p id='letter5'>GRADUATION MARKSHEET</p></a>
                                </label>
                            </td>
                           
                            <td>
                                <div class="input-field col s12 m12" id="rugcert1">
                                    <input id="rugcert" type="text" class="validate" value="<?php echo $result['ugcertreason'];?>" readonly>
                                    <label for="rugcert">Reason Specified</label>
                                </div>
                            </td>
                        </tr>
                        <tr id="tdpgcert">
                            <td>
                                <label class="custom-file-upload">
                                    <a class="btn col s12 m12 blue darken-1"><input id="pgcert" name="pgcert" type="file" accept=".pdf" class="validate" required="" aria-required="true"><p id='letter12'>POST GRADUATION MARKSHEET</p></a>
                                </label>
                            </td>
                           
                            <td>
                                <div class="input-field col s12 m12" id="rpgcert1">
                                    <input id="rpgcert" type="text" class="validate" value="<?php echo $result['pgcertreason'];?>" readonly>
                                    <label for="rpgcert">Reason Specified</label>
                                </div>
                            </td>
                        </tr>
                        <tr id="tdap">
                            <td >
                                <label class="custom-file-upload">
                                     <a class="btn col s12 m12 blue darken-1"><input id="ap" name="ap" type="file" accept=".pdf" class="validate" required="" aria-required="true" ><p id='letter6'>Address Proof</p></a>
                                </label>
                            </td>
                           
                            <td>
                                <div class="input-field col s12 m12" id="rap1">
                                    <input id="rap" type="text" class="validate" value="<?php echo $result['addressreason'];?>" readonly>
                                    <label for="rap">Reason Specified</label>
                                </div>
                            </td>
                        </tr>

                        <tr id="tdal">
                            <td>
                                <label class="custom-file-upload">
                                 <a class="btn col s12 m12 blue darken-1"><input id="al" name="al" type="file" accept=".pdf" class="validate" required="" aria-required="true" ><p id='letter7'>APPOINTMENT LETTER / SALARY BREAKUP</p></a>
                                </label>
                            </td>
                           
                            <td>
                                <div class="input-field col s12 m12" id="ral1">
                                    <input id="ral" type="text" class="validate" value="<?php echo $result['appletterreason'];?>" readonly>
                                    <label for="ral">Reason Specified</label>
                                </div>
                            </td>
                        </tr>

                        <!-- <tr id="tdsb">
                            <td>
                                <label class="custom-file-upload">
                                 <a class="btn col s12 m12 blue darken-1"><input id="sb" name="sb" type="file" accept=".pdf" class="validate" required="" aria-required="true" ><p id='letter13'>Salary Breakup</p></a>
                                </label>
                            </td>
                           
                            <td>
                                <div class="input-field col s12 m12" id="rsb1">
                                    <input id="rsb" type="text" class="validate" value="" readonly>
                                    <label for="rsb">Reason Specified</label>
                                </div>
                            </td>
                        </tr> -->

                        <tr id="tdpayslip">
                            <td>
                            <label class="custom-file-upload">
                                 <a class="btn col s12 m12 blue darken-1"><input id="payslip" name="payslip" type="file" accept=".pdf" class="validate" required="" aria-required="true" ><p id='letter10'>PAST PAY SLIP</p></a>
                                </label>
                            </td>
                            
                            <td>
                                <div class="input-field col s12 m12" id="rpayslip1">
                                    <input id="rpayslip" type="text" class="validate" value="<?php echo $result['pastpayslipreason'];?>" readonly>
                                    <label for="rpayslip">Reason Specified</label>
                                </div>
                            </td>
                        </tr>
                        
                        <tr id="tdcc">
                            <td>
                            <label class="custom-file-upload">
                                 <a class="btn col s12 m12 blue darken-1"><input id="cc" name="cc" type="file" accept=".pdf" class="validate" required="" aria-required="true" ><p id='letter11'>CANCELLED CHEQUE</p></a>
                                </label>
                            </td>
                            
                            <td>
                                <div class="input-field col s12 m12" id="rcc1">
                                    <input id="rcc" type="text" class="validate" value="<?php echo $result['cancheckreason'];?>" readonly>
                                    <label for="rcc">Reason Specified</label>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                    </form>

                    <script> 
                        function getUrlVars() {
                            var vars = {};
                            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                                vars[key] = value;
                            });
                            return vars;
                        }



                        var token = getUrlVars()["token"];
                        console.log("Mail-"+token);
                        document.getElementById('forms').action = 'updatedoc.php?token='+token;
                    </script>
                  </table>

            </div><br>
            <center>
            <a class="waves-effect blue darken-1 btn" type="submit" id="submit" onclick="submitForm()">Submit</a>
            </center>
        </div>

    </div>
</div>

 <div id="modal1" class="modal">
    <div class="modal-content">
            <object data="p.pdf" type="application/pdf" width="700" height="800" id="obj">
                <a href="p.pdf">test.pdf</a>
            </object>
    </div>
    <div class="modal-footer">
      <a id="valid" onclick="valid(this)" value="" class="modal-close waves-effect waves-green btn-flat" style="color:green">Valid</a>
      <a id="invalid" onclick="invalid(this)" value="" class="modal-close waves-effect waves-green btn-flat" style="color: red">Invalid</a>
    </div>

  </div>
   <!-- details submitted warning starts here -->
   <div class="row" id="details">
                <div class="col s12 m6 offset-m3">
                        <div class="card white">
                                <div class="card-content ">
                                        <center><i class="material-icons large" style="color: green;">check_circle</i></center>
                                        <center><h1><p  style="color:green">Documents Submitted Successfully.</p></h5></center>
                                </div>
                        </div>
                </div>
        </div>
    <!-- details submitted warning ends here -->

<!-- Script Starts Here -->
<script type="text/javascript">

para=['pan','ccl']
 
function clicked(x)
{
    var v = $(x).attr('value'); 
    var i = $(x).attr('id'); 
    
    $("#obj").attr("href",v)
    $("#obj").attr("data",v)
    $("#valid").attr("value",i)
    $("#invalid").attr("value",i)
}

$('#cv').change(function(){
    var f=$('#cv').val();

$('#letter1').replaceWith(f);
})

$('#pan').change(function(){
    var f=$('#pan').val();

$('#letter2').replaceWith(f);
})

$('#Adhaar').change(function(){
    var f=$('#Adhaar').val();
    $('#letter3').replaceWith(f);
})
$('#photo').change(function(){
    var f=$('#photo').val();

$('#letter4').replaceWith(f);
})

$('#ugcert').change(function(){
    var f=$('#ugcert').val();

$('#letter5').replaceWith(f);
})


$('#ap').change(function(){
    var f=$('#ap').val();

$('#letter6').replaceWith(f);
})
$('#al').change(function(){
    var f=$('#al').val();
    

$('#letter7').replaceWith(f);
})
$('#rl').change(function(){
    var f=$('#rl').val();
    

$('#letter8').replaceWith(f);
})
$('#ccl').change(function(){
    var f=$('#ccl').val();
    

$('#letter9').replaceWith(f);
})
$('#payslip').change(function(){
    var f=$('#payslip').val();
    

$('#letter10').replaceWith(f);
})
$('#cc').change(function(){
    var f=$('#cc').val();
    

$('#letter11').replaceWith(f);
})

$('#pgcert').change(function(){
    var f=$('#pgcert').val();
    

$('#letter12').replaceWith(f);
})

// $('#sb').change(function(){
//     var f=$('#sb').val();
    
// $('#letter13').replaceWith(f);
// })

$('#marks10').change(function(){
    var f=$('#marks10').val();
    
$('#letter14').replaceWith(f);
})

$('#marks12').change(function(){
    var f=$('#marks12').val();
    
$('#letter15').replaceWith(f);
})

$('#itidiploma').change(function(){
    var f=$('#itidiploma').val();
    
$('#letter16').replaceWith(f);
})

$(document).ready(function(){
    $("#details").hide();
    function getUrlVars() {
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                vars[key] = value;
            });
            return vars;
        }
        var token = getUrlVars()["token"];
        var expiry = getUrlVars()["expdate"];
        var data={"token":token, "expdate":expiry};
       console.log(expiry);
        $.ajax({
                url : 'http://localhost/hrms/api/checkExpiry3.php',
                type : 'POST',
                data :(data),          
                success : function(para){
                       // alert(para)
                if(para == "expired")
                {
                console.log("Expired Page");
                $("#formdiv").hide()  
                $("#details").show();           
                }
                else if(para=='success')
                {
                console.log("You are welcome");
                }

                },
                error : function(err){        
                }
                 });

    if(token == "1")
    {
        $("#formdiv").hide()
    }
    else
    {
        $.ajax({
        url:"http://localhost/hrms/api/getvaliddoc.php",
        type:'POST',
        data:
        {
            "mail":token
        },
        success:function(para)
        {

            console.log(para)
            if(para == '["cv","pan","Adhaar","Photo","ap","al","rl","payslip","cc","marks10","marks12","itidiploma","ugcert","pgcert"]')
            {
                $("#formdiv").hide()
            }
            para=JSON.parse(para)
            
            for(let i=0;i<para.length;i++)
            {
                var hideelement='#td'+para[i];
                // alert(hideelement)
                $(hideelement).remove()
                
                
            }

        }
  }  )
    }
  
    // $("#done").hide();
    // $('#submit').click(function(){
    //     alert(para)
    //     $('#done').show()
    // })

})

function submitForm()
{
    var x = document.getElementsByName('validationform');
    x[0].submit(); // Form submission
    alert('submitted')
    
}
</script>
<!-- Script Ends -->


</body>

</html>