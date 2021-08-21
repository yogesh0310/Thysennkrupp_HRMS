<?php 

// Connection to Database
include 'db.php';
error_reporting(0);


$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    $hr2=$_POST["hr2"];
    $i=0;
    $cnt=$db->users->count(["dsg"=>"hr2","mail"=>$hr2]);
    if($cnt>0){
    $result=$db->users->find(array("dsg"=>"hr2","mail"=>$hr2));
    $hr2s=[];
   
    foreach($result as $key=>$val)
    {
      $hr2s[]=$val->mail;
      $hr2s[]=$val->name;
      
      $hr2s[]=$val->dsg;
      
      $hr2s[]=$val->dept;


    }

    echo json_encode(["sucess"=>true,"hr2s"=>$hr2s]);
    }else{
        echo json_encode(["sucess"=>false]);
    }
    
}
else
{
    header("refresh:0;url=notfound.php");
}

?>