<?php

include './db.php';
include 'maildetails.php';

global $mail;
$mail->setFrom('thyssenkrupp@tkep.com', 'tkei');
$mail->addReplyTo(Email, 'Information');
 

header('Content-Type: application/json');
//var_dump($GLOBALS);
$action=$_POST['action'];
$mail2=$_POST['mail'];
$username=$_POST['username'];

if($action=='1'){
$password=$_POST['password'];
$region=$_POST['region'];
$dsg=$_POST['dsg'];
$dept=$_POST['dept'];
}


if($action=='3'){
    $uid=$_POST['uid'];
    $region=$_POST['region'];
    $dsg=$_POST['dsg'];
    $dept=$_POST['dept'];
    $pass=$_POST['pass'];
}

function checkByUID($db,$uid){
    return $db->users->count(["uid"=>$uid]);
   }

function checkByName($db,$name){
    return $db->users->count(["name"=>$name]);
   }

function checkByMail($db,$mail6){
     return $db->users->count(["mail"=>$mail6]);
   }

function addUser($mail,$db,$uid,$password,$mail1,$dsg,$rg,$dept){
    if(checkByUID($db,$uid) or checkByMail($db,$mail1)){
        echo json_encode(array("status"=>"false","message"=>"Hey User Already Found!"));
    }
    else{

        $url="http://10.128.17.99";
        $db->users->insertOne(["uid"=>$uid,"name"=>$uid,"password"=>$password,"mail"=>$mail1,"dsg"=>$dsg,"rg"=>$rg,"dept"=>$dept]);
         $mail->addAddress($mail1);
         $mail->Subject = "User Creation For Thyssenkrupp";
         $mail->isHTML(true); 
         $mail->AddEmbeddedImage("../public/logo.png", "logoimg", "../public/logo.png");
                    
         $mail->Body='<body style="background-color:white;"> 
         <table align="center" border="0" cellpadding="0" cellspacing="0"
             width="750" bgcolor="white" > 
             <tbody> 
                 <tr> 
                     <td align="center"> 
                 
                         <table align="center" border="0" cellpadding="0"
                             cellspacing="0" class="col-550" width="750" style="background-color: rgb(0,160,246);"> 
                             <tbody> 
                                 <tr> 
                                     <td align="center; 
                                             height: 50px;">  
                                             <center>
                                             <p style="font-size:30px;color:white;">
                                             thyssenkrup Elevators
                                             </p>
                                             </center>
                                         </a> 
                                     </td> 
                                 </tr> 
                             </tbody> 
                         </table> 
                     </td> 
                 </tr> 
                 <tr style="display: inline-block;"> 
                     <td style="height: 150px; 
                             padding: 20px; 
                             border: none; 
                             
                             background-color: white;"> 
                         
                     
                         <p class="data"
                         style="text-align: justify-all; 
                                 align-items: center; 
                                 font-size: 18px; 
                                 padding-bottom: 12px;"> 
                                 Dear '. $uid.',<br></br><br></br>

                                 Yor are added as a '.$dsg.' in our system.To use system further you need to use following Details.
                                 <br></br><br></br>
                                Username: '.$uid.'
                                 <br></br><br></br>
                                Password: '.$password.'
                                 <br></br><br></br>
                                 

                                 To access the link, please click <a href='.$url.'>here</a>
                                 <br></br><br></br>
                                 Thank you for your interest in working with us.
                                 <br></br><br></br>
                                 In-case of any query, feel free to reach out to recruitment@tkeap.com
                                
                                 tkEI Recruiting Team.
                         </p> 
                     <center><img src="cid:logoimg" width="70" height="70">
                     <p style="font-size: 20px;color: #2196F3;">engineering.tomorrow.together</p></center>

                     </td> 
                 </tr> 
                 <tr style="border: none; 
                 background-color: rgb(0,160,246); 
                 height: 40px; 
                 color:white; 
                 padding-bottom: 20px; 
                 text-align: center;"> 
                     
     <td height="40px" align="center"> 
        
         <a href="#"
         style="border:none; 
             text-decoration: none; 
             padding: 5px;"> 
                 
         <img height="30"
         src= 
     "https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/icon-twitter_20190610074030.png"
         width="30" /> 
         </a> 
         
         <a href="#"
         style="border:none; 
         text-decoration: none; 
         padding: 5px;"> 
         
         <img height="30"
         src= 
     "https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/icon-linkedin_20190610074015.png"
     width="30" /> 
         </a> 
         
         <a href="#"
         style="border:none; 
         text-decoration: none; 
         padding: 5px;"> 
         
         <img height="20"
         src= 
     "https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/facebook-letter-logo_20190610100050.png"
             width="24"
             style="position: relative; 
                 padding-bottom: 5px;" /> 
         </a> 
     </td> 
     </tr> 

             </tbody> 
         </table> 
     </body> ';
    

         if($mail->send()){ 


        echo json_encode(array("status"=>"true","message"=>"User Added Successfully"));
       
         
    }else{
        echo json_encode(array("status"=>"false","message"=>"User not Added"));
       

    }


    }   
}

function deleteUser($db,$name,$mail){
   // echo json_encode(checkByName($db,$name));
     if(checkByName($db,$name)>0 && checkByMail($db,$mail)>0){
        if($db->users->deleteOne(["name"=>$name,"mail"=>$mail])){
        
            echo json_encode(array("status"=>"true","message"=>"User Deleted Successfully"));
        }
        else{
            echo json_encode(array("status"=>"true","message"=>"User Not Deleted...Something went Wrong"));
        }   
    }
    else{
        echo json_encode(array("status"=>"false","message"=>"User Not Found!"));      
    }   
}



function UpdateUser($db,$uid,$name,$mail7,$dsg,$region,$dept,$pass){
        $criteria=array('mail'=>$mail7);
        if(checkByMail($db,$mail7)){
       if( $db->users->updateOne($criteria,array('$set'=>array("rg"=>$region,"name"=>$name,"uid"=>$uid,"dsg"=>$dsg,"dept"=>$dept,"password"=>$pass)))){

       echo json_encode(["status"=>true,"message"=>"user updated successfully"]);
       }
     else{
        echo json_encode(["status"=>false,"message"=>"user not updated"]);
    
    }
}
   
    else{
       echo json_encode(["status"=>false,"message"=>"user not found here"]);
    

    }
}

switch($action){
    case "1": addUser($mail,$db,$username,$password,$mail2,$dsg,$region,$dept);
            break;
    case "2":
            deleteUser($db,$username,$mail2);
            break;
    case "3":
            UpdateUser($db,$uid,$username,$mail2,$dsg,$region,$dept,$pass);
            break;

    default: echo json_encode(["status"=>"false","message"=>"invalid action","dept"=>$dept]); 
}


?>