<?php

include 'db.php';


$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
$digit13 = preg_split('/[-]/', $_POST['id']);

if($cursor)
{
    $date = date_default_timezone_set('Asia/Kolkata');
           
                    $today = date("Y-m-d H-i-s");

               
    $db->interviews->updateOne(array("intvmail"=>$cursor["mail"],"rid"=>$digit13[3],'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]),array('$set'=>array("status"=>"1")));
    
    $db->interviews->aggregate([
        ['$match'=>['prf'=>$digit13[0],'iid'=>$digit13[2],'rid'=>$digit13[3]]],
        ['$addFields'=>["inv_ctime"=>$today]]]);
    
    $result = $db->interviews->find(array("rid"=>$digit13[3],'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]));
    $element = "start;";

    $check = "1";

    foreach($result as $doc)
    {
        $element = $element.";grest;".$doc["status"];
        if($doc["status"] == "0")
        {
            $check = "0";
        }
    }
    
    if($check == "1")
    {
        
       $db->rounds->updateOne(array("rid"=>$digit13[3],'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]),array('$set'=>array("status"=>"invcomplete")));
       
       $db->rounds->aggregate([
        ['$match'=>['prf'=>$digit13[0],'iid'=>$digit13[2],'rid'=>$digit13[3]]],
        ['$addFields'=>["inv_ctime"=>$today]]]);
    
       echo "we succeded";

    }
    else{
        echo "we failed";
    }
    
}
else
{
    echo "you are not logged in ";
}
?>