<?php 

// Connection to Database
include 'db.php';
error_reporting(0);


$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    $i=0;
    $cnt=$db->users->count(["dsg"=>"hr2"]);
    if($cnt>0){
    $result=$db->users->find(array("dsg"=>"hr2"));
    $hr2s=[];
    $names=[];
    foreach($result as $key=>$val)
    {
      $hr2s[]=$val->mail;
      $names[]=$val->name;

    }

    echo json_encode(["sucess"=>true,"interviewers"=>$hr2s,"names"=>$names]);
    }else{
        echo json_encode(["sucess"=>false]);
    }
    
}
else
{
    header("refresh:0;url=notfound.php");
}

?>