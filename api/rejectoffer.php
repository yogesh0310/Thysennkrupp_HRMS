<?php

include "db.php";
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
 
if($cursor)
{
    $digit13 = preg_split('/[-]/', $_POST['id']);
    $criteria = array("prf"=>$digit13[1],"pos"=>$digit13[2],"iid"=>$digit13[3],"email"=>$_POST['email']);
    $result = $db->intereval->findOne($criteria);
    if($result)
    {
        $q = $db->intereval->updateOne($criteria,array('$set'=>array("offerletter"=>"Rejected")));
        $db->tokens->updateOne(array("email"=>$_POST['email']),array('$set'=>array("progress"=>"Candidate Not Joined","afterselection"=>"8")));

        if($q)
        {
            echo "success";
        }
        else
        {
            echo "fail";
        }
    }
}
else
{
    header("refresh:0;url=notfound.php");    
}

?>