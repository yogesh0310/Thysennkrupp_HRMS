<?php 
error_reporting(0);
include "db.php";

include 'maildetails.php';
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    $mail->setFrom("thyssenkrupp", 'tkei');
    $mail->addReplyTo(Email, 'Information');
    $mail->isHTML(true);
    //echo "ello";
    $prf=$_POST['prf'];
    $iid=$_POST['iid'];
    $rid=$_POST['rid'];
    $oldname=$_POST['oldname']?$_POST['oldname']:"null";
    $oldemail=$_POST['oldemail']?$_POST['oldemail']:"null";
    $olddept=$_POST['olddept']?$_POST['olddept']:"null";
    $olddsg=$_POST['olddsg']?$_POST['olddsg']:"null";
    $newname=$_POST['newname']?$_POST['newname']:"null";
    $newemail=$_POST['newemail']?$_POST['newemail']:"null";
    $newdept=$_POST['newdept']?$_POST['newdept']:"null";
    $newdsg=$_POST['newdsg']?$_POST['newdsg']:"null";
    $newiloc=$_POST['iloc']?$_POST['iloc']:"null";
    $newiperson=$_POST['iperson']?$_POST['iperson']:"null";
    $members=$_POST['members']['members']?$_POST['members']['members']:"null";

    echo $newname." ".$newemail." ".$prf." ".$rid." ".$iid;
    echo $oldname." ".$oldemail." ".$prf." ".$rid." ".$iid;
    // $res  = $db->interviews.count(
    //     array(
    //         "rid"=>$rid,'iid'=>$iid,"prf"=>$prf,"intvmail"=>$newemail,"invname"=>$newname),
    //         array('limit'=> 1 ));
    // echo "Count => ".count($res);
    
    $res=$db->interviews->findOne(
        array("rid"=>$rid,
            'iid'=>$iid,
            "prf"=>$prf,
            "intvmail"=>$newemail,
            "invname"=>$newname));

    if(count($res) != 0)
    {

        // echo "NEew".$newemail;
        // echo "Old Email ".$oldemail;
        // echo "Yes gotit";
        $result=$db->interviews->updateOne(
            array("rid"=>$rid,
                'iid'=>$iid,
                "prf"=>$prf,
                "intvmail"=>$newemail,
                ),
            array('$set'=>array("ilocation"=>$newiloc,"designation"=>$newdsg,"dept"=>$newdept,"iperson"=>$newiperson,"accepted"=>"no","reject"=>"Assigned To Other Interviewer")));
                
        
            foreach($members as $d)
            {
                $result=$db->interviews->updateOne(
                    array("rid"=>$rid,
                        'iid'=>$iid,
                        "prf"=>$prf,
                        "intvmail"=>$newemail,
                        ),
                    array('$addToSet'=>array("members"=>$d)));
            }
            
            
    }
    else
    {
        $result=$db->interviews->updateOne(
        array("rid"=>$rid,
            'iid'=>$iid,
            "prf"=>$prf,
            "intvmail"=>$oldemail,
            "invname"=>$oldname),
        array('$set'=>array("intvmail"=>$newemail,"invname"=>$newname,"designation"=>$newdsg,"dept"=>$newdept,"ilocation"=>$newiloc,"iperson"=>$newiperson,"accepted"=>"no")));

        $createuser = $db->users->insertOne(array("uid"=>$newemail,"name"=>$newname,'password'=>$newemail,"mail"=>$newemail,"dsg"=>"inv","dept"=>$newdept,"rg"=>$newiloc));
        if($createuser)
        {
            $result3 = $db->prfs->findOne(array("prf"=>$prf));
            $candidates = [];
            for($i=0;$i<count($members);$i++)
            {
                $q = $db->tokens->findOne(array("email"=>$members[$i]));
                array_push($candidates,$q["full_name"]);
            }
            $candidates = implode(", ",$candidates);
            $dashurl="http://localhost/hrms/invdash.php";
            $mail->addAddress($newemail);
            $mail->Subject = 'Interview schedule for '.$result3['department'].' - '.$result3['position'].' .';
            $mail->AddEmbeddedImage("../public/logo.png", "logoimg", "../public/logo.png");
            $mail->isHTML(true); 
            $mail->Body ='
            <head>
        
            </head>
            <body style="background-color:white;"> 
                <table align="center" border="0" cellpadding="0" cellspacing="0"
                    width="750" bgcolor="white" style="border: 3px solid rgb(0,160,246);"> 
                    <tbody> 
                        <tr> 
                            <td align="center"> 
                        
                                <table align="center" border="0" cellpadding="0"
                                    cellspacing="0" class="col-550" width="750"> 
                                    <tbody> 
                                        <tr> 
                                            <td align="center" style="background-color: rgb(0,160,246); 
                                                    height: 50px;">  
                                                    <p style="font-size:30px;color:white;">
                                                    thyssenkrup Elevators
                                                    </p>
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
                                    border-bottom: 2px solid #361B0E; 
                                    background-color: white;"> 
                                
                            
                                <p class="data"
                                style="text-align: justify-all; 
                                        align-items: center; 
                                        font-size: 18px; 
                                        padding-bottom: 12px;"> 
                                        Dear '.$newname.',
                                        <br><br>
                                        Please find below the details for the interview for the post of '.$result3['position'].' and Confirm on the site portal.
                                        <br><br>
                                        Location - '.$newiloc.'
                                        <br><br>
                                        Contact Person - '.$newiperson.'
                                        <br><br>
                                        Candidates Name: 
                                        <br><br>
                                        '.$candidates.'
                                        <br><br>
                                        To access your dashboard for more details, please click <a href='.$dashurl.'>here</a> 
                                        <br><br>Your Credentials for Login are as follows : <br><br>User ID : '.$newemail.'<br><br>Password : '.$newemail.'<br><br>
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
    
            $mail->AltBody = 'You are assigned for an interview. Please check your dashboard for further progress.';
    
            if($mail->send()) 
            {
                echo "sent";
            }
            else
            {
                echo "notsent";
            }  
            $mail->ClearAddresses();

        }

        $result=$db->interviews->updateOne(
            array("rid"=>$rid,
                'iid'=>$iid,
                "prf"=>$prf,
                "intvmail"=>$oldemail,
                ),
            array('$set'=>array("reject"=>"Assigned To Other Interviewer")));

            $dashurl="http://localhost/hrms/invdash.php";
            $mail->addAddress($oldemail);
            $mail->Subject = 'Interview Cancellation for '.$result3['department'].' - '.$result3['position'].' .';
            $mail->AddEmbeddedImage("../public/logo.png", "logoimg", "../public/logo.png");
            $mail->isHTML(true); 
            $mail->Body ='
            <head>
        
            </head>
            <body style="background-color:white;"> 
                <table align="center" border="0" cellpadding="0" cellspacing="0"
                    width="750" bgcolor="white" style="border: 3px solid rgb(0,160,246);"> 
                    <tbody> 
                        <tr> 
                            <td align="center"> 
                        
                                <table align="center" border="0" cellpadding="0"
                                    cellspacing="0" class="col-550" width="750"> 
                                    <tbody> 
                                        <tr> 
                                            <td align="center" style="background-color: rgb(0,160,246); 
                                                    height: 50px;">  
                                                    <p style="font-size:30px;color:white;">
                                                    thyssenkrup Elevators
                                                    </p>
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
                                    border-bottom: 2px solid #361B0E; 
                                    background-color: white;"> 
                                
                            
                                <p class="data"
                                style="text-align: justify-all; 
                                        align-items: center; 
                                        font-size: 18px; 
                                        padding-bottom: 12px;"> 
                                        Dear '.$oldname.',
                                        <br><br>
                                        Your Previously Assigned Interview for the post of '.$result3['position'].' is Cancelled. Please check your dashboard for updates.
                                        <br><br>
                                        To access your dashboard for more details, please click <a href='.$dashurl.'>here</a> 
                                        <br><br>
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
    
            $mail->AltBody = 'You are assigned for an interview. Please check your dashboard for further progress.';
    
            if($mail->send()) 
            {
                echo "sent";
            }
            else
            {
                echo "notsent";
            }
            
            $mail->ClearAddresses();

    }
 }
else
{
    header("refresh:0;url=notfound.php");    
}

?>