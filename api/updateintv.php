<?php
include 'db.php';
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{

    include 'maildetails.php';
    $mail->setFrom("thyssenkrupp", 'tkei');
    $mail->addReplyTo(Email, 'Information');
    $mail->isHTML(true);   
    //$mail->SMTPDebug=4;

    $invname=$_POST['intv'];
    $oldintv=$_POST['oldintv'];
    $emails = $_POST['emails'];
    $iname=$_POST['iname'];
    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

    $dates = $_POST['dates'];
    $times = $_POST['times'];

    $digit13 = preg_split('/[-]/', $_POST['prf']);

    
        //Start - Check whether the new interviewer exists or not 
        $res=$db->interviews->findOne(
            array("rid"=>$digit13[3],
                'iid'=>$digit13[2],
                "prf"=>$digit13[0],
                "pos"=>$digit13[1],
                "intvmail"=>$_POST['intv'],
                ),array('projection' => array('intvmail'=>1)));
        $res=count($res);
        // echo json_encode($res);
        //END - Check whether the new interviewer exists or not

        //Start -If new interviewer exists
        if($res != 0)
        {
            echo $_POST['intv'];
            //Start - Check whether he is initially rejected by some hr so delete reject status
            $res=$db->interviews->findOne(
                array("rid"=>$digit13[3],
                    'iid'=>$digit13[2],
                    "prf"=>$digit13[0],
                    "pos"=>$digit13[1],
                    "intvmail"=>$_POST['intv'],
                    "reject"=>array('$exists'=>true)
                    ));
                    $res=count($res);
                if($res !=0)
                {
                    // echo $_POST['intv'];
                        $result = $db->interviews->updateOne(
                            array("rid"=>$digit13[3],
                                'iid'=>$digit13[2],
                                "prf"=>$digit13[0],
                                "pos"=>$digit13[1],
                                "intvmail"=>$_POST['intv']),
                            array(
                                '$unset' => array('reject' => true,)),array('multi' => true)
                            );
                }
                else
                {

                }
            //End - Check whether he is initially rejected by some hr so delete reject status

                
                //Start - Push the members from old interviewer doc to new interviewr doc which already exists
                $result=$db->interviews->updateOne(
                    array("rid"=>$digit13[3],
                        'iid'=>$digit13[2],
                        "prf"=>$digit13[0],
                        "intvmail"=>$invname,
                        ),
                    array('$set'=>array("dates"=>$dates,"moddates"=>$dates,"times"=>$times,"modtimes"=>$times,"ilocation"=>$_POST['iloc'],"iperson"=>$_POST['iperson'],"invstatus"=>"0")));
                    $result=$db->interviews->updateOne(
                        array("rid"=>$digit13[3],
                            'iid'=>$digit13[2],
                            "prf"=>$digit13[0],
                            "intvmail"=>$_POST['oldintv'],
                            ),
                        array('$set'=>array("reject"=>"Assigned To Other Interviewer","invstatus"=>"0","accepted"=>"no")));
                    
                    foreach($emails as $d)
                    {
                        $result=$db->interviews->updateOne(
                            array("rid"=>$digit13[3],
                            'iid'=>$digit13[2],
                            "prf"=>$digit13[0],
                            "intvmail"=>$invname,
                            ),
                            array('$addToSet'=>array("members"=>$d)));
                    }
                    //END - Push the members from old interviewer doc to new interviewr doc which already exists

                    
                }
                //End -If new interviewer exists

                else
                {
                    //Start - Create new document if the new interviewer doesnt exists.
                    $result=$db->interviews->updateOne(array("rid"=>$digit13[3],"prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"intvmail"=>$_POST['oldintv']),array('$set'=>array("intvmail"=>$_POST['intv'],"invname"=>$_POST['iname'],"designation"=>$_POST['idesg'],"dept"=>$_POST['idept'],"dates"=>$dates,"moddates"=>$dates,"times"=>$times,"modtimes"=>$times,"ilocation"=>$_POST['iloc'],"iperson"=>$_POST['iperson'],"invstatus"=>"0","accepted"=>"no")));
                    //END - Create new document if the new interviewer doesnt exists.
                    $createuser= $db->users->insertOne(array("uid"=>$invname,"name"=>$iname,'password'=>$invname,"mail"=>$invname,"dsg"=>"inv","dept"=>$_POST['idept'],"rg"=>$_POST['iloc']));
                    $result3 = $db->prfs->findOne(array("prf"=>$digit13[0]));
                    
                    $candidates = [];
                    for($i=0;$i<count($_POST['emails']);$i++)
                    {
                        $q = $db->tokens->findOne(array("email"=>$_POST['emails'][$i]));
                        array_push($candidates,$q["full_name"]);
                    }
                    $candidates = implode(", ",$candidates);
                    $dashurl="http://localhost/hrms/invdash.php";
                    $mail->addAddress($_POST['intv']);
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
                                                Dear '.$_POST['iname'].',
                                                <br><br>
                                                Your Previous Interview Schedule is now Updated.
                                                <br><br>
                                                Please find below the details for the updated interview for the post of '.$result3['position'].' and Confirm on the site portal.
                                                <br><br>
                                                Location - '.$_POST['iloc'].'
                                                <br><br>
                                                Contact Person - '.$_POST['iperson'].'
                                                <br><br>
                                                Candidates Name: 
                                                <br><br>
                                                '.$candidates.'
                                                <br><br>
                                                To access your dashboard for more details, please click <a href='.$dashurl.'>here</a> 
                                                <br><br>
                                                Your Credentials for Login are as follows : <br><br>User ID : '.$invname.'<br><br>Password : '.$invname.'<br><br>

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

                    $mail->AltBody = 'Your interview is rescheduled. Please check your dashboard for further progress.';

                    if($mail->send()) 
                    {
                        echo "sent";
                    }
                    else
                    {
                        echo "notsent";
                    }   
                }
}
else
{
    header("refresh:0;url=notfound.php");    
}
?>