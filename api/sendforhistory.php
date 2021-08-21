<?php 

// include database
include 'db.php';
error_reporting(0);

//check for login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if(isset($_POST) and $cursor)
{
    // get prf in required format
    $digit13 = preg_split('/[-]/', $_POST['prf']);
    
    // update rounds with status as completed
    $q1 = $db->rounds->updateMany(array("rid"=>$digit13[3],"prf"=>$digit13[0],"iid"=>$digit13[2],"pos"=>$digit13[1]),array('$set'=>array("status"=>"completed")));
    
    // update prfs with status as completed
    $q2 = $db->prfs->updateMany(array("prf"=>$digit13[0]),array('$set'=>array("status"=>"completed")));     
    if($q1 and $q2)
    {
        echo "success";
    }
    else
    {
        echo "fail";
    }
}
else
{
    header("refresh:0;url=notfound.php");
}

?>