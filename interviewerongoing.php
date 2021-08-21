
<?php
include 'maildetails.php';
include 'db.php';

$mail->setFrom("thyssenkrupp", 'tkei');
$mail->addReplyTo(Email, 'Information');
$mail->isHTML(true);   

$invname=$_POST['intv'];
$date=$_POST['date'];
$time=$_POST['time'];

$ctr = 0;
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
foreach($_POST['emails'] as $d)
{
   
    $mail->addAddress($d);
    //"Invitation to interview with thyssenkrupp for the ". $position." position";
    $mail->Subject = 'Your Application at tkEI : Interview Schedule';
    $mail->Body    = 'You have been shortlisted for the interview. 
    You have an interview on this '.$date.'Time : '.$time.' by '.$invname;
    
   

    if(!$mail->send()) 
    {
        $ctr = 1;
    }
   
    $mail->ClearAddresses();
}

if($ctr == 0)
{
    $digit13 = preg_split('/[-]/', $_POST['prf']);

    $result = $db->rounds->find(array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2]),array('sort' => array('_id' => -1)));

    $i = 0;
    
    foreach($result as $doc)
    {
        $arr[$i] = $doc;
        $i++;
    }

$result = $arr[0];

$rid =(string) sprintf("%02s",$result["rid"]+1);

$db->interviews->insertOne(array("rid"=>$rid,"prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"members"=>$_POST['emails'],"evaluated"=>array(),"intvmail"=>$_POST['intv'],"date"=>$_POST['date'],"time"=>$_POST['time'],"status"=>"0","invstatus"=>"0"));

//updating status of base round
//deleting tokens
$db->tokens->updateMany(array("prf"=>$digit13[0],'iid'=>$digit13[2],"pos"=>$digit13[1]),array('$set'=>array("token"=>"1")));

// update base rounds status and create new document
    $db->rounds->updateMany(array("rid"=>$result["rid"],'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]),array('$set'=>array("status"=>"1")));

    $db->rounds->insertOne(array("status"=>"1","prf"=>$digit13[0],"pos"=>$digit13[1],"rid"=>$rid,'iid'=>$digit13[2],"members"=>array(),"selected"=>array(),"rejected"=>array(),"onhold"=>array()));
    


    //send mail to interviewer to notify him about interview.
    $dashurl="http://localhost/hrms/invdash.php";
    $mail->addAddress($invname);
    $mail->Subject = ' Interview schedule on'.$date ;
    $mail->Body    = 'You are assigned a interview .
     You have an interview on this '.$date.'Time : '.$time.'
     To access your dashboard for more details, please click <a href='.$dashurl.'>here</a>';
    
   

    if(!$mail->send()) 
    {
       echo "not sent";
    }
    else
    {
        echo "sent";
    }






echo "sent"; 
}
else
{
    echo "notsent";
}
?>