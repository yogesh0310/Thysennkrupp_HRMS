
<?php
include 'api/db.php';
include 'api/maildetails.php';
$mail->setFrom('thyssenkrupp@tkep.com', 'tkei');
$mail->addReplyTo(Email, 'Information');
$mail->isHTML(true);


$cursor = $db->rounds->findOne(array("prf" => "441194"));

echo($cursor['prf']);


if($cursor["status"] == "withdraw")
{
    echo($cursor["status"]);

    $members = $cursor["members"];
    $members2 = $cursor["selected"];
    
    foreach($members as $member){
        $mail->addAddress($member);
        $mail->Subject = 'Your Application at tkEI ';
        $mail->Body    = nl2br('Dear Candidate,

                 The position that you have applied for is withdrawn and applications are no longer accepted or processed further.
               
                Thank you for your interest in working with us.
               
               In-case of any query, feel free to reach out to recruitment@tkeap.com
               
                tkEI Recruiting Team.');     
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send(); 
        $mail->ClearAddresses();
    }

    foreach($members2 as $member){
        $mail->addAddress($member);
        $mail->Subject = 'Your Application at tkEI ';
        $mail->Body    = nl2br('Dear Candidate,

                 The position that you have applied for is withdrawn and applications are no longer accepted or processed further.
               
                Thank you for your interest in working with us.
               
               In-case of any query, feel free to reach out to recruitment@tkeap.com
               
                tkEI Recruiting Team.');     
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send(); 
        $mail->ClearAddresses();
    }
    
    

}




// $cursor = $db->prfs->updateOne(array("prf"=>$csv[$i][0]),array('$set'=>array("status"=>$csv[$i][27])));
// $cursor = $db->rounds->updateOne(array("prf"=>$csv[$i][0]),array('$set'=>array("status"=>$csv[$i][27])));
// $cursor = $db->interviews->updateOne(array("prf"=>$csv[$i][0]),array('$set'=>array("status"=>$csv[$i][27])));
// $cursor = $db->intereval->updateOne(array("prf"=>$csv[$i][0]),array('$set'=>array("status"=>$csv[$i][27])));
?>

