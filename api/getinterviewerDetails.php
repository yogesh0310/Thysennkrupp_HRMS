<?php 

// Connection to Database
include 'db.php';
error_reporting(0);


$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    $intv=$_POST["interviewer"];
    $user=$db->users->findOne(["mail"=>$intv]);
    $interviewer=array();
    $interviewer["name"]=$user->name;
    $interviewer["dept"]=$user->dept;
    $interviewer["uid"]=$user->uid;
    $interviewer["region"]=$user->rg;
    $interviewer["dsg"]=$user->dsg;
    echo json_encode(["sucess"=>true,"interviewer"=>$interviewer]);


}
else
{
    header("refresh:0;url=notfound.php");
}

?>