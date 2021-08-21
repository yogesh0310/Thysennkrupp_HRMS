<?php

include "db.php";
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
 
if($cursor)
{
    if(isset($_POST))
    {
        $arr = array();
        $result = $db->intereval->find(array("offerletter"=>array('$exists'=>true)));
        $i = 0;
        foreach($result as $doc)
        {
            if($doc["offerletter"] == "requested")
            {
                $q = $db->tokens->findOne(array("email"=>$doc['email']));
                $q2 = $db->users->findOne(array("mail"=>$doc['requester']));
                $arr[$i] = array($doc['prf'],$doc['pos'],$doc['iid'],$doc['rid'],$q['full_name'],$doc['email'],$q2['name'],$doc['requester'],$doc['offerletter']);
                $i += 1;
            }
            else if($doc["offerletter"] == "sent")
            {
                $q = $db->tokens->findOne(array("email"=>$doc['email']));
                $q2 = $db->users->findOne(array("mail"=>$doc['requester']));
                $arr[$i] = array($doc['prf'],$doc['pos'],$doc['iid'],$doc['rid'],$q['full_name'],$doc['email'],$q2['name'],$doc['requester'],$doc['offerletter']);
                $i += 1;
            }
            else if($doc['offerletter'] == "joined")
            {
                $arr = array("No Data");
            }
        }
        if(count($arr)==0)
        {
           echo "No Data";
        }
        else
        {
            echo json_encode($arr);
        }
       
    }
}
else
{
    header("refresh:0;url=notfound.php");    
}

?>