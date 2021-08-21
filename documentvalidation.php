<?php
include 'api/db.php';
$cursor = $db->tokens->find();

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
<style>
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
  margin-left:35% !important;
  margin-top:18% !important; 
}
</style>
</head>
<body>

<nav>
    <div class="nav-wrapper blue darken-1">
        <a href="#!" class="brand-logo center">thyssenkrupp Elevators</a>
    </div>
</nav>
<br><br>
<div class="row" id="parent">
    <div class="col m12  ">
        <div class="card white">
            <div class="card-content blue-text">
                <span class="card-title"><p id="mail" style="color: green"></p></span> <br>
                <p id="uan" name="uan" disabled style="color:green;text-align:center;font-weight: bold;font-size:30px;"></p><br>
                <center>
                <table id="noms" style="color:green;width:50%;">
                <tr>
                    <th>Nominee1 Name</th>
                    <td id="nom1n" style="color:#1e88e5;"></td>
                    <th>Nominee1 DOB</th>
                    <td id="nom1d" style="color:#1e88e5;"></td>
                    <th>Nominee1 Gender</th>
                    <td id="nom1g" style="color:#1e88e5;"></td>
                </tr>
                <tr>
                    <th>Nominee2 Name</th>
                    <td id="nom2n" style="color:#1e88e5;"></td>
                    <th>Nominee2 DOB</th>
                    <td id="nom2d" style="color:#1e88e5;"></td>
                    <th>Nominee2 Gender</th>
                    <td id="nom2g" style="color:#1e88e5;"></td>
                </tr>
                <tr>
                    <th>Nominee3 Name</th>
                    <td id="nom3n" style="color:#1e88e5;"></td>
                    <th>Nominee3 DOB</th>
                    <td id="nom3d" style="color:#1e88e5;"></td>
                    <th>Nominee3 Gender</th>
                    <td id="nom3g" style="color:#1e88e5;"></td>
                </tr>
                <tr>
                    <th>Nominee4 Name</th>
                    <td id="nom4n" style="color:#1e88e5;"></td>
                    <th>Nominee4 DOB</th>
                    <td id="nom4d" style="color:#1e88e5;"></td>
                    <th>Nominee4 Gender</th>
                    <td id="nom4g" style="color:#1e88e5;"></td>
                </tr>                
                </table>
                </center>
                <br><br>
                <table class="striped">
                    <thead>
                      <tr>
                          <th>Uploaded Documents</th>
                          <th>Valid</th>
                          <th>Invalid</th>

                          <th>Reason</th>
                          <th>Freez</th>
                          
                      </tr>
                    </thead>
            
                    <tbody>
                    
                       <tr id="tdcv">
                            <td>
                                 <a class="waves-effect blue darken-1  btn modal-trigger  col s12 m6" value="" href="#modal1" id="cv" onclick="clicked(this)">CV</a>
                            </td>
                            
                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gcv" type="radio"  value="valid" id="cvv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gcv" type="radio" value="invalid" id="cvi"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rcv1">
                                    <input id="rcv" type="text" style="color:black" class="validate" placeholder="Specify Reason">
                                    <label for="rcv">Specify Reason</label>
                                 </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" name="d1" id="cvf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>

                        </tr>

                        

                        <tr id="tdpan">
                            <td>
                                 <a class="waves-effect blue darken-1  btn modal-trigger col s12 m6" value=""  href="#modal1" onclick="clicked(this)" id="pan">Identity Proof</a>
                            </td>

                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gpan" type="radio"  value="valid" id="panv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gpan" type="radio" value="invalid" id="pani"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rpan1">
                                    <input id="rpan" type="text" style="color:black" class="validate" placeholder="Specify Reason">
                                    <label for="rpan">Specify Reason</label>
                                 </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" name="d2" id="panf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>

                        </tr>

                        <tr id="tdAdhaar">
                            <td>
                                 <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="Adhaar">Adhaar</a>
                            </td>
                            
                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gAdhaar" type="radio"  value="valid" id="Adhaarv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gAdhaar" type="radio" value="invalid" id="Adhaari"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rAdhaar1">
                                    <input id="rAdhaar" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rAdhaar">Specify Reason</label>
                                 </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" name="d3" id="Adhaarf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>

                        <tr id="tdPhoto">
                            <td>
                                 <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6" value=""  href="#modal1" onclick="clicked(this)" id="Photo">Photo</a>
                            </td>

                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gPhoto" type="radio"  value="valid" id="Photov"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gPhoto" type="radio" value="invalid" id="Photoi"/>
                                    <span>Invalid</span>
                                </label>
                            </td>
                            
                            <td>
                                <div class="input-field col s12 m12" id="rPhoto1" >
                                    <input id="rPhoto" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rPhoto">Specify Reason</label>
                                </div>
                            </td>
                            <td>
                            <a class="waves-effect green btn" name="d4" id="Photof" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>

                        


                        
                        <tr id="tdap">
                            <td>
                                <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="ap">Address Proof</a>
                            </td>
                        
                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gap" type="radio"  value="valid" id="apv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gap" type="radio" value="invalid" id="api"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rap1">
                                    <input id="rap" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rap">Specify Reason</label>
                                </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" name="d6" id="apf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>

                        <tr id="tdal">
                            <td>
                                <a class="waves-effect blue darken-1  modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="al">Appointment Letter / Salary Breakup</a>
                            </td>

                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gal" type="radio"  value="valid" id="alv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gal" type="radio" value="invalid" id="ali"/>
                                    <span>Invalid</span>
                                </label>
                            </td>
 
                            <td>
                                <div class="input-field col s12 m12" id="ral1">
                                    <input id="ral" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="ral">Specify Reason</label>
                                </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" name="d7" id="alf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>

                        <!-- <tr id="tdsb">
                            <td>
                                <a class="waves-effect blue darken-1  modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="sb">Salary Breakup</a>
                            </td>

                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gsb" type="radio"  value="valid" id="sbv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gsb" type="radio" value="invalid" id="sbi"/>
                                    <span>Invalid</span>
                                </label>
                            </td>
 
                            <td>
                                <div class="input-field col s12 m12" id="rsb1">
                                    <input id="rsb" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rsb">Specify Reason</label>
                                </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" name="d5" id="sbf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr> -->

                        
                        <tr id="tdpayslip">
                            <td>
                                <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="payslip">Past 3 Month Payslip</a>
                            </td>
                            
                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gpayslip" type="radio"  value="valid" id="payslipv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gpayslip" type="radio" value="invalid" id="payslipi"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rpayslip1">
                                    <input id="rpayslip" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rpayslip">Specify Reason</label>
                                </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" name="d9" id="payslipf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>


                        <tr id="tdcc">
                            <td>
                                <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="cc">Cancelled Cheque</a>
                            </td>

                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gcc" type="radio"  value="valid" id="ccv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gcc" type="radio" value="invalid" id="cci"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rcc1">
                                    <input id="rcc" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rcc">Specify Reason</label>
                                </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" name="d10" id="ccf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>


                        <tr id="tdmarks10">
                            <td>
                                <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="marks10">10th Marksheet</a>
                            </td>

                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gmarks10" type="radio"  value="valid" id="marks10v"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gmarks10" type="radio" value="invalid" id="marks10i"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rmarks101">
                                    <input id="rmarks10" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rmarks10">Specify Reason</label>
                                </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" name="d13" id="marks10f" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>

                        
                        <tr id="tdmarks12">
                            <td>
                                <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="marks12">12th Marksheet</a>
                            </td>

                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gmarks12" type="radio"  value="valid" id="marks12v"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gmarks12" type="radio" value="invalid" id="marks12i"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rmarks121">
                                    <input id="rmarks12" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rmarks12">Specify Reason</label>
                                </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" name="d14" id="marks12f" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>

                        <tr id="tditidiploma">
                            <td>
                                <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="itidiploma">ITI/Diploma Marksheet</a>
                            </td>

                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gitidiploma" type="radio"  value="valid" id="itidiplomav"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gitidiploma" type="radio" value="invalid" id="itidiplomai"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="ritidiploma1">
                                    <input id="ritidiploma" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="ritidiploma">Specify Reason</label>
                                </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" name="d15" id="itidiplomaf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>


                        <tr id="tdugcert">
                            <td>
                                <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="ugcert">Graduation Marksheet</a>
                            </td>

                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gugcert" type="radio"  value="valid" id="ugcertv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gugcert" type="radio" value="invalid" id="ugcerti"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rugcert1">
                                    <input id="rugcert" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rugcert">Specify Reason</label>
                                </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" name="d11" id="ugcertf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>

                        <tr id="tdpgcert">
                            <td>
                                <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="pgcert">Post Graduate Marksheet</a>
                            </td>

                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gpgcert" type="radio"  value="valid" id="pgcertv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gpgcert" type="radio" value="invalid" id="pgcerti"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rpgcert1">
                                    <input id="rpgcert" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rpgcert">Specify Reason</label>
                                </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" name="d12" id="pgcertf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>

                            <td>
                            
                            </td> 

                            <td>
                               
                            </td>

                            <td>
                               
                            </td>

                            <td>
                            <a class="waves-effect green btn" onclick=freezall()><i class="material-icons right">done</i>Freez All</a>
                            </td>
                        </tr>
                        
                    </tbody>

                  </table>

            </div>
            <center><a class="waves-effect blue darken-1 btn" id="submit">Submit Validation</a></center>
        </div>
    </div>
</div>
<div id="loader">
        <div id="txt">
          <b>Submitting you work.. Please wait!!</b>
        </div>
    </div>
 <div id="modal1" class="modal">
    <div class="modal-content" id="cnt">

    </div>
</div>

  
  <center id="bwaiting">
  <b style="color:red">Submitting Details Please Wait...</b>
  </center>
  <div>

    <div class="row" id="bcomplete" style="margin-top: 10%;margin-left: 20%;" >
        <div class="col s10 m9">
            <div class="card" style="background-color: green;">
                <div class="card-content white-text">
                        <center>
                    <span class="card-title">Result</span>
                
                    <i class="material-icons large">sentiment_very_satisfied</i>
                    <p style='font-size:25px;;font-family:Times New Roman'>Candidate Validated Successfully <br> You Can Close This Window Now </p>
                </center>
                </div>
            </div>
        </div>
    </div>


<!-- Script Starts Here -->
<script>
var counter=0;
var validcount = 0;
var valid = [];
var invalid = [];
var invalidreason = [];
var ctr1 = 0;
var ctr2 = 0;
var ctr = 0;

function freez(id)
{
    var b = '#'+id
    id = id.substring(0, id.length - 1);
    var group = "g"+id
    var radioresult = id+'i'
    var reason = "#r"+id
    var x = $(reason).val()

    
    var r = $('input[name="'+group+'"]:checked').attr('id');
    if(r)
    {
        if(r==radioresult)
        {
            if(x == "")
            {
                
                alert('Please Specify Reason..!!')
            }
            else
            {

            invalid[ctr1] = id;
            var str_reason = $(reason).val()
            invalidreason[ctr1] = str_reason;
            ctr1++;
            var v = '#'+id+'v'
            var i = '#'+id+'i'
            $(v).attr('disabled',true)
            $(i).attr('disabled',true)
            $(b).attr('disabled',true)
            $(reason).attr('disabled',true)
            ctr++;
            
            }
        }
        else
        {
            valid[ctr2] = id;
            ctr2++;
            var v = '#'+id+'v'
            var i = '#'+id+'i'
            $(b).text('freezed')
            $(v).attr('disabled',true)
            $(i).attr('disabled',true)
            $(b).attr('disabled',true)
            $(reason).attr('disabled',true)
            ctr++;
        }

    }
    else
    {
        alert('Please select Valid or Invalid')

    }
    


}

function freezall()
{
    $("a[name='d1']").click();
    $("a[name='d2']").click();
    $("a[name='d3']").click();
    $("a[name='d4']").click();
    $("a[name='d5']").click();
    $("a[name='d6']").click();
    // $("a[name='d7']").click();
    $("a[name='d9']").click();
    $("a[name='d10']").click();
    $("a[name='d11']").click();
    $("a[name='d12']").click();
    $("a[name='d13']").click();
    $("a[name='d14']").click();
    $("a[name='d15']").click();


}

function clicked(x)
{

    var v = $(x).attr('value'); 
    var i = $(x).attr('id'); 
    // console.log("Value : ",v," -",i)


    $(".modal-content").empty();
    $(".modal-content").removeData();
    var str='<object data="p.pdf" type="application/pdf" width="700" height="800" id="obj">Not Applicable</object>'
    $("#cnt").append(str)
    $("#obj").attr("href",v)
    $("#obj").attr("data",v)
    $("#valid").attr("value",i)
    $("#invalid").attr("value",i)
}

function valid(x)
{
    counter++;
    var v = $(x).attr('value'); 
    // alert(v)
    nameDoc=v;
    var btn = "#"+v
    var v2 = "#r"+v 
    v = "#r"+v+"1"
    $(v).show()
    $(v2).val("Validated")
    $(v2).attr("disabled","true")

    // alert("This is val : "+$(v2).val())
    var m = localStorage.getItem('currentemail')
    doc=$(v2).val()
    console.log("This is valid : "+doc)
    $.ajax({

    type:"POST",
    url:"http://localhost/hrms/api/validdoc.php",

    data:
    {
    "doc":nameDoc,
    'reason':doc,
    'mail':m
    },
    success:function(para)
    {

    console.log(para)
    //alert(str)
    if(para=="success")
    {
    console.log("successful")
    }
    else
    {
    console.log("not successful")

    }

    }

    })
}

function invalid(x)
{
    counter++;

    var va = $(x).attr('value'); 
    v = "#r"+va+"1"
    $(v).show()
    //alert(v)
    var m = localStorage.getItem('currentemail')
    $.ajax({

        type:"POST",
        url:"http://localhost/hrms/api/invaliddoc.php",
        data:
        {
            'doc':va,
            'mail':m
        },
        success:function(para)
        {
            
            console.log(para)
            //alert(str)
            if(para=="success")
            {
                console.log("successful")
            }
            else
            {
                console.log("not successful")
                
            }

        }
    
    })
}


$(document).ready(function(){

$("#loader").hide();
//for valid
$("#cvv").click(function(){
        var r = $("input[name='gcv']:checked").attr('id');
        if(r=="cvi"){
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rcv").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#panv").click(function(){
        var r = $("input[name='gpan']:checked").attr('id');
        if(r=="pani"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rpan").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#Adhaarv").click(function(){
        var r = $("input[name='gAdhaar']:checked").attr('id');
        if(r=="Adhaari"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rAdhaar").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#Photov").click(function(){
        var r = $("input[name='gPhoto']:checked").attr('id');
        if(r=="Photoi"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rPhoto").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#apv").click(function(){
        var r = $("input[name='gap']:checked").attr('id');
        if(r=="api"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rap").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#alv").click(function(){
        var r = $("input[name='gal']:checked").attr('id');
        if(r=="ali"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#ral").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

// $("#sbv").click(function(){
//         var r = $("input[name='gsb']:checked").attr('id');
//         if(r=="sbi"){
            
//             r = r.substring(0, r.length - 1);
//             var btn = r
//             btn = '#'+btn+'f'
//             r = '#r'+r+'1' 
//             $(r).fadeIn(600)
//             r = r.substring(0, r.length - 1);
//             //$("#ral").val("")
//             $(r).prop("disabled", false)
                    
//         }
//         else
//         {
            
//             r = r.substring(0, r.length - 1);
//             var btn = r
//             btn = '#'+btn+'f'
//             r = '#r'+r+'1' 
//             $(r).fadeIn(600)
//             r = r.substring(0, r.length - 1);
//             $(r).val("Validated")
//             $(r).prop("disabled", true)
//         }
// });

$("#payslipv").click(function(){
        var r = $("input[name='gpayslip']:checked").attr('id');
        if(r=="payslipi"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rpayslip").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#ccv").click(function(){
        var r = $("input[name='gcc']:checked").attr('id');
        if(r=="cci"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rcc").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});



//for invalid
$("#cvi").click(function(){
        var r = $("input[name='gcv']:checked").attr('id');
        if(r=="cvi"){
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rcv").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#pani").click(function(){
        var r = $("input[name='gpan']:checked").attr('id');
        if(r=="pani"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rpan").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#Adhaari").click(function(){
        var r = $("input[name='gAdhaar']:checked").attr('id');
        if(r=="Adhaari"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rAdhaar").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#Photoi").click(function(){
        var r = $("input[name='gPhoto']:checked").attr('id');
        if(r=="Photoi"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rPhoto").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#api").click(function(){
        var r = $("input[name='gap']:checked").attr('id');
        if(r=="api"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rap").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#ali").click(function(){
        var r = $("input[name='gal']:checked").attr('id');
        if(r=="ali"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#ral").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

// $("#sbi").click(function(){
//         var r = $("input[name='gsb']:checked").attr('id');
//         if(r=="sbi"){
            
//             r = r.substring(0, r.length - 1);
//             var btn = r
//             btn = '#'+btn+'f'
//             r = '#r'+r+'1' 
//             $(r).fadeIn(600)
//             r = r.substring(0, r.length - 1);
//             //$("#ral").val("")
//             $(r).prop("disabled", false)
                    
//         }
//         else
//         {
            
//             r = r.substring(0, r.length - 1);
//             var btn = r
//             btn = '#'+btn+'f'
//             r = '#r'+r+'1' 
//             $(r).fadeIn(600)
//             r = r.substring(0, r.length - 1);
//             $(r).val("Validated")
//             $(r).prop("disabled", true)
//         }
// });

$("#rli").click(function(){
        var r = $("input[name='grl']:checked").attr('id');
        if(r=="rli"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rrl").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#payslipi").click(function(){
        var r = $("input[name='gpayslip']:checked").attr('id');
        if(r=="payslipi"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rpayslip").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#cci").click(function(){
        var r = $("input[name='gcc']:checked").attr('id');
        if(r=="cci"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rcc").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#marks10i").click(function(){
        var r = $("input[name='gmarks10']:checked").attr('id');
        if(r=="marks10i"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rcc").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#marks10v").click(function(){
        var r = $("input[name='gmarks10']:checked").attr('id');
        if(r=="marks10i"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#marks12i").click(function(){
        var r = $("input[name='gmarks12']:checked").attr('id');
        if(r=="marks12i"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rcc").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#marks12v").click(function(){
        var r = $("input[name='gmarks12']:checked").attr('id');
        if(r=="marks12i"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#itidiplomai").click(function(){
        var r = $("input[name='gitidiploma']:checked").attr('id');
        if(r=="itidiplomai"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rcc").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#itidiplomav").click(function(){
        var r = $("input[name='gitidiploma']:checked").attr('id');
        if(r=="itidiplomai"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});


$("#ugcerti").click(function(){
        var r = $("input[name='gugcert']:checked").attr('id');
        if(r=="ugcerti"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rcc").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#ugcertv").click(function(){
        var r = $("input[name='gugcert']:checked").attr('id');
        if(r=="ugcerti"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#pgcerti").click(function(){
        var r = $("input[name='gpgcert']:checked").attr('id');
        if(r=="pgcerti"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rcc").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#pgcertv").click(function(){
        var r = $("input[name='gpgcert']:checked").attr('id');
        if(r=="pgcerti"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});



$("#bwaiting").hide()
$("#bcomplete").hide()
$('.modal').modal();
var m = localStorage.getItem('currentemail')

$.ajax({
    url:"http://localhost/hrms/api/getnameevaluation.php",
    data:{
        "email" : m
    },
    type:"POST",
    success:function(para)
    {
        // alert(para)
       window.name = para
       var str = "<center><b>Candidate Name : "+window.name+"</b></center><br><center><b>Candidate Application Blank : <b><a href='http://localhost/hrms/applicationblank_readonly.php?aid="+m+"' target='_blank'><button class='btn waves-effect white darken-1'><b>View Form</b></a></center>"
       $("#mail").append(str) 
    }
})

// var str = "<center><b>Candidate Name : "+window.name+"</b></center><br><center><b>Candidate Application Blank : <b><a href='http://localhost/hrms/applicationblank_readonly.php?aid="+m+"' target='_blank'><button class='btn waves-effect white darken-1'><b>View Form</b></a></center>"
// $("#mail").append(str)
$("#rcv1").hide()
$("#raf1").hide()
$("#rpan1").hide()
$("#rAdhaar1").hide()
$("#rPhoto1").hide()
$("#rssc1").hide()
$("#rhsc1").hide()
$("#rap1").hide()
$("#ral1").hide()
// $("#rsb1").hide()
$("#rrl1").hide()
$("#rpayslip1").hide()
$("#ruan1").hide()
$("#rcc1").hide()

$("#rmarks101").hide()
$("#rmarks121").hide()
$("#ritidiploma1").hide()


$("#rugcert1").hide()
$("#rpgcert1").hide()


$.ajax({
    url:"http://localhost/hrms/api/getdocuments.php",
    data:{
        "mail" : m
    },
    type:"POST",
    success:function(para)
    {
        console.log(para)
        
        para=JSON.parse(para)
        console.log("len:" +para[1].length)
        for(i=0;i<para.length;i++)
        {
            console.log("This is : ",para)
        }
        console.log("this is data = ",para)
        //console.log(para)
        $("#cv").attr("value",para[0][0])
        $("#pan").attr("value",para[0][1])
        $("#Adhaar").attr("value",para[0][2])
        $("#Photo").attr("value",para[0][3])
        $("#ap").attr("value",para[0][4])
        $("#al").attr("value",para[0][5])
        // $("#sb").attr("value",para[0][11])
        $("#payslip").attr("value",para[0][6])
        $("#uan").append("UAN : "+para[0][7])
        $("#cc").attr("value",para[0][8]) 

        $("#marks10").attr("value",para[0][9])  
        $("#marks12").attr("value",para[0][10])  
        $("#itidiploma").attr("value",para[0][11])  


        $("#ugcert").attr("value",para[0][12])  
        $("#pgcert").attr("value",para[0][13])  
        $("#nom1n").append(para[0][12]?para[0][14]:"")
        $("#nom2n").append(para[0][15]?para[0][15]:"")
        $("#nom3n").append(para[0][16]?para[0][16]:"")
        $("#nom4n").append(para[0][17]?para[0][17]:"")

        $("#nom1d").append(para[0][18]?para[0][18]:"")
        $("#nom2d").append(para[0][19]?para[0][19]:"")
        $("#nom3d").append(para[0][20]?para[0][20]:"")
        $("#nom4d").append(para[0][21]?para[0][21]:"")

        $("#nom1g").append(para[0][22]?para[0][22]:"")
        $("#nom2g").append(para[0][23]?para[0][23]:"")
        $("#nom3g").append(para[0][24]?para[0][24]:"")
        $("#nom4g").append(para[0][25]?para[0][25]:"")

        validcount = para[1].length
        for(let i=0;i<para[1].length;i++)
        {
            var hideelement='#td'+para[1][i];
            // alert(hideelement)
            $(hideelement).remove()
        }        

    }
})

});

$("#submit").click(function(){
    console.log("this is valid:",valid)
    console.log("this is invalid:",invalid)
    console.log("this is vinalid reason:",invalidreason)
    console.log("this is ctr:",ctr)

    $("#loader").show();
    if(ctr==(12-validcount))    
    {
    
    cv=$("#rcv").val()
    pancard = $("#rpan").val()
    adhaar=$("#rAdhaar").val()
    photo = $("#rPhoto").val()
    address=$("#rap").val()
    cancheck=$("#rcc").val()
    appletter=$("#ral").val()
    // salarybreakup=$("#rsb").val()
    pastpayslip=$("#rpayslip").val()
    currcomp=$("#rccl").val()

    marks10=$("#rmarks10").val()
    marks12=$("#rmarks12").val()
    itidiploma=$("#ritidiploma").val()


    ugcert=$("#rugcert").val()
    pgcert=$("#rpgcert").val()

    
    var m = localStorage.getItem('currentemail')
    $('#parent').empty();

    $('#parent').append('<center><h4><b style="color:red;">Submitting Details Please Wait</b></h4></center>')
   // alert(cv)
    $.ajax({
        url:"http://localhost/hrms/api/submitvalidation.php",
        type:"POST",
        data:{
            "valid":valid,
            "invalid" :invalid,
            "reason" :invalidreason,
            "cv":cv,
            "pancard" : pancard,
            "adhaar":adhaar,
            "photo" : photo,
            "address":address,
            "cancheck":cancheck,
            "appletter":appletter,
            // "salarybreakup":salarybreakup,
            "pastpayslip":pastpayslip,

            "marks10":marks10,
            "marks12":marks12,
            "itidiploma":itidiploma,

            "ugcert":ugcert,
            "pgcert":pgcert,
            "mail":m
        },
        success:function(para)
        {
            $("#loader").hide();
            $('#parent').empty();
            console.log("submit"+para)
            $("#parent").fadeOut(600)
            $("#bcomplete").show()   
            setTimeout(function(){ window.close(); }, 3000); 
           
        }
    })
    }else{
        alert("Please Validate All Documents..!")
    }

})


</script>
<!-- Script Ends -->


</body>

</html>