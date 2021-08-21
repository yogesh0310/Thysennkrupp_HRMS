<?php
error_reporting();
include 'maildetails.php';
include 'db.php';

$mail->setFrom('thyssenkrupp@tkep.com', 'tkei');
$mail->addReplyTo(Email, 'Information');
  
$mail->SMTPDebug = 4;   

$mail->addAddress("rabhosale@mitaoe.ac.in");
                   
                    
$mail->Subject = "Update on your application at thyssenkrupp for ";

                    
$mail->Body ='hello';
                   

$mail->send();
                    
                     

$mail->ClearAddresses();

?>