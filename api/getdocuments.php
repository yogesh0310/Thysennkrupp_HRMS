<?php 

// Connection to Database
include 'db.php';

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    $mail=$_POST['mail'];

    // get documents of particular user
    $cursor = $db->tokens->find(array('email'=>$mail));
    $cursor1 = $db->tokens->find(array("email"=>$mail,"valid"=>array('$exists'=>true)));
    $i=0;
    foreach($cursor1 as $d)
    {
        $i++;
    }
    if($i > 0)
    {
        foreach($cursor as $d)
        {
            $valid = $d['valid'];
            $arr = array($d['usercv'],$d['idproof'],$d['adhaar'],$d['userphoto'],$d['proof_address'],$d['appletter'],$d['pastpayslip'],$d['uan'],$d['cancelledcheck'],$d['marks10'],$d['marks12'],$d['itidiploma'],$d['ugcert'],$d['pgcert'],$d['nom1'],$d['nom2'],$d['nom3'],$d['nom4'],$d['n1dob'],$d['n2dob'],$d['n3dob'],$d['n4dob'],$d['n1gender'],$d['n2gender'],$d['n3gender'],$d['n4gender']);
        }
        $arr1 = array($arr,$valid);
        echo json_encode($arr1);

    }
    else
    {
        $valid = array();
        foreach($cursor as $d)
        {
            $arr = array($d['usercv'],$d['idproof'],$d['adhaar'],$d['userphoto'],$d['proof_address'],$d['appletter'],$d['pastpayslip'],$d['uan'],$d['cancelledcheck'],$d['marks10'],$d['marks12'],$d['itidiploma'],$d['ugcert'],$d['pgcert'],$d['nom1'],$d['nom2'],$d['nom3'],$d['nom4'],$d['n1dob'],$d['n2dob'],$d['n3dob'],$d['n4dob'],$d['n1gender'],$d['n2gender'],$d['n3gender'],$d['n4gender']);
        }

        // send valid and all documents
        $arr1 = array($arr,$valid);
        echo json_encode($arr1);

    }
}
else
{
    header("refresh:0;url=notfound.php");
}
                   
?>