<?php
include 'maildetails.php';
include 'db.php';

$mail->setFrom("thyssenkrupp", 'tkei');
$mail->addReplyTo(Email, 'Information');
$mail->isHTML(true);   

$invname=$_POST['iname'];
$intvmail=$_POST['intvmail'];
$date=$_POST['candates'];
$time=$_POST['cantimes'];
$imail=$_POST['intvmail'];

$j=0;
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    $digit13 = preg_split('/[-]/', $_POST['prf']);

    //get latest  round created
    $result = $db->rounds->find(array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2]),array('sort' => array('_id' => -1)));

    $i = 0;
    foreach($result as $doc)
    {
        $arr[$i] = $doc;
        $i++;
    }

    $result = $arr[0];
    $result1=$arr[1];
    echo "Second element status - ".$result1['status'];

    // echo "Previous Rid - ".$previousrid;
    if($result['status']=="ristart")
    {
        if($result1['status']=='invcomplete')
        {
            $previousrid=$result1['rid'];
        }
        $rid=(string)sprintf("%02s",$result['rid']);//keep the round id same 

    }
    else
    {
        // echo "Generating new round";
        $previousrid=(string)sprintf("%02s",$result['rid']);//previous round id
        $rid =(string) sprintf("%02s",$result["rid"]+1); //next round id
    }


    $db->interviews->insertOne(array("rid"=>$rid,"prf"=>$digit13[0],'pos'=>$digit13[1],"iid"=>$digit13[2],"members"=>$_POST['emails'],"evaluated"=>array(),"times"=>$_POST['cantimes'],"modtimes"=>$_POST['cantimes'],"dates"=>$_POST['candates'],"moddates"=>$_POST['candates'],"invname"=>$_POST['iname'],"designation"=>$_POST['idesg'],"intvmail"=>$_POST['intvmail'],"ilocation"=>$_POST['iloc'],"addresscode"=>$_POST['address'],"iperson"=>$_POST['iperson'],"dept"=>$_POST['idept'],"status"=>"0","invstatus"=>"0","accepted"=>"no"));


    $createuser= $db->users->insertOne(array("uid"=>$imail,"name"=>$invname,'password'=>$imail,"mail"=>$imail,"dsg"=>"inv","dept"=>$_POST['idept'],"rg"=>$_POST['iloc']));
    $credentials = '<br><br>Your Credentials for Login are as follows : <br><br>User ID : '.$imail.'<br><br>Password : '.$imail.'<br><br>';
    
    //updating status of base round
    //deleting tokens
    $db->tokens->updateMany(array("prf"=>$digit13[0],'iid'=>$digit13[2],"pos"=>$digit13[1]),array('$set'=>array("token"=>"1")));





    //newly added
    $result3 = $db->prfs->findOne(array("prf"=>$digit13[0]));
    $criteria=array("status"=>"ristart","prf"=>$digit13[0],"pos"=>$digit13[1],"rid"=>$rid,'iid'=>$digit13[2],"dept"=>$_POST['posdept'],"poszone"=>$_POST['poszone'],"position"=>$result3['position']);
        
    foreach($_POST['emails'] as $d)
    {
        //Query to add the available data - iid ,rid,prf,members
        $db->rounds->updateOne($criteria,array('$push'=>array('members'=>$d)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));  

        //Query to update round id in token of member
        $criteria2=array("prf"=>$digit13[0],"pos"=>$digit13[1],"rid"=>$previousrid,'iid'=>$digit13[2],"email"=>$d); 
        
        //Query to remove members from selectedremove 
        $res=$db->rounds->updateOne(array("rid"=>$previousrid,'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]),array('$pull'=>array('selectedremove'=>$d)),array('safe'=>true,'timeout'=>5000,'upsert'=>true)); 
    }

    //Query to add empty arrays to documents - selected, rejected, onhold
    $db->rounds->updateOne($criteria,array('$set'=>array("selected"=>array(),"rejected"=>array(),"onhold"=>array())));


    $countRound=$db->rounds->findOne(array("rid"=>$previousrid,'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]));
    // $countRound1=$db->rounds->findOne(array("rid"=>$rid,'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]));

    $result1=$countRound['selectedremove'];
    $result2=$countRound['members'];


    $orderCount1 =count(iterator_to_array($result1));
    $orderCount2 =count(iterator_to_array($result2));

    //Checking whether all members are allocated to an interviewer
    if($orderCount1==$orderCount2)
    {
        //if Yes Change the status of the base round to complete 
        $db->rounds->updateMany(array("rid"=>$previousrid,'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]),array('$set'=>array("status"=>"rcomplete")));
        echo "Status Changed";
    }
    else
    {
        echo "Status not Changed";
    }
// 

//send mail to  interviewer 
        $candidates = [];
        for($i=0;$i<count($_POST['emails']);$i++)
        {
            $q = $db->tokens->findOne(array("email"=>$_POST['emails'][$i]));
            array_push($candidates,$q["full_name"]);
        }
        $candidates = implode(", ",$candidates);
        $dashurl="http://localhost/hrms/invdash.php";
        $mail->addAddress($intvmail);
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
                                    Dear '.$invname.',
                                    <br><br>
                                    Please find below the details for the interview for the post of '.$result3['position'].' and Confirm on the site portal.
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
                                    '.$credentials.'
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

// 

}
else
{
    header("refresh:0;url=notfound.php");
}

?>