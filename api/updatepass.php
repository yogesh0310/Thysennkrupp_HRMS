<?php



include 'db.php';

header('Content-Type: application/json');

$newpass=$_POST['pass'];

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
 
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    
    $mymail=$cursor["mail"];

    $result=$db->users->updateOne(array("mail"=>$mymail),array('$set'=>array("password"=>$newpass)));

    if($result){
    echo json_encode(["mail"=>$mymail,"pass"=>$newpass,"success"=>"true"]);
    }
?>