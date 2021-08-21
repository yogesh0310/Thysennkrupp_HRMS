<?php 

include 'db.php';
error_reporting(0);

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

if($cursor)
{
    $result = $db->interviews->find(array("intvmail"=>$cursor['mail']));

    if($result)
    {
        $i = 0;
        $ctr = 0;
        $p = 0;
       
        foreach($result as $doc)
        {
            if(count($doc['evaluated']) > 0)
            {
                $c=$db->prfs->findOne(array("prf"=>$doc['prf']));
                $arr[$i] =array($doc['prf'],$c['position'],$c['zone'],$c['department'],$doc['pos'],$doc['iid'],$doc['rid']);
                $i++;
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