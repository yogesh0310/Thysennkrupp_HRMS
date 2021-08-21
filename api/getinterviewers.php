<?php 

// Connection to Database
include 'db.php';
error_reporting(0);


$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    $i=0;
    $cnt=$db->users->count(["dsg"=>"inv"]);
    if($cnt>0){
    $result=$db->users->find(array("dsg"=>"inv"));
    $interviewers=[];
    $names=[];
    foreach($result as $key=>$val)
    {
      $interviewers[]=$val->mail;
      $names[]=$val->name;

    }

    echo json_encode(["sucess"=>true,"interviewers"=>$interviewers,"names"=>$names]);
    }else{
        echo json_encode(["sucess"=>false]);
    }
    
}
else
{
    header("refresh:0;url=notfound.php");
}

?>