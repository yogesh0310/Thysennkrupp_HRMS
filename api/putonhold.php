<?php 

include 'db.php';
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
 
if($cursor)
{
    $mail=$_POST['mail'];
    $digit13=$_POST['id'];
    $digit13 = explode("-",$digit13);
    
    $criteria=array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>$digit13[3]);
    $criteria2 = array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>$digit13[3],"intvmail"=>$cursor['mail'],"invname"=>$cursor['name']);
    $abc = $db->interviews->findOne($criteria2);
    $m = $mail.",absent";
    $result=$db->rounds->updateOne($criteria,array('$addToSet'=>array("onhold"=>$m)));
    if($result)
    {
        $q1 = $db->rounds->updateOne($criteria,array('$pull'=>array('members'=>$mail)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
        $q2 = $db->interviews->updateOne($criteria2,array('$pull'=>array('members'=>$mail)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
        $q3 = $db->interviews->updateOne($criteria2,array('$addToSet'=>array("evaluated"=>$m)));

        $response = array();
        $res = $db->interviews->findOne($criteria2,array('projection' => array('members' => 1)));
        $count = count(iterator_to_array($res['members']));
        if($count == 0)
        {
             $q4 = $db->interviews->updateOne($criteria2,array('$set'=>array("accepted"=>"alleval")));
             $response[1] = "alleval";
        }
        else
        {
            $response[1] = "noeval";
        }
        if($q1 and $q2 and $q3)
        {
            $response[0] = "success";
            echo json_encode($response);
        }
        else
        {
            echo "error";
        }
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