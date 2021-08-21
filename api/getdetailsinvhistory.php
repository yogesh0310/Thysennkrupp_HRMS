<?php 

include 'db.php';
error_reporting(0);

$cursor1 = $db->session->findOne(array("sid" => $_COOKIE['sid']));

if($cursor1)
{
    $cursor = $db->interviews->find(array("intvmail"=>$cursor1['mail'],'prf'=>$_POST['prf'],'pos'=>$_POST['pos'],'iid'=>$_POST['iid'],'rid'=>$_POST['rid']));
    if($cursor)
    {
        $i = 0;
        $ctr = 0;
        $p = 0;
        $s = 0;
        $r = 0;
        $h = 0;
        
        foreach($cursor as $doc)
        {
            for($j=0;$j<count($doc['evaluated']);$j++)
            {
                $getselectedStatus = $db->rounds->findOne(array('iid'=>$doc['iid'],"prf"=>$doc['prf'],"pos"=>$doc['pos'],"rid"=>$doc['rid']));
                $getStatus=$db->tokens->findOne(array('iid'=>$doc['iid'],"prf"=>$doc['prf'],"pos"=>$doc['pos'],"email"=>$doc['evaluated'][$j]));
                $q = $db->tokens->findOne(array("email"=>$doc['evaluated'][$j]));
                $orderCount1 = iterator_to_array($getselectedStatus['selected']);
                $orderCount2 = iterator_to_array($getselectedStatus['rejected']);
                $orderCount3 = iterator_to_array($getselectedStatus['onhold']);


                if(in_array($doc['evaluated'][$j],$orderCount1))
                {
                    $getselectedname =  $db->tokens->findOne(array("prf"=>$_POST['prf'],"pos"=>$_POST['pos'],"email"=>$doc['evaluated'][$j]));
                    $selected[$s] = array($doc['evaluated'][$j],$getselectedname['full_name']);
                    $s++;
                }
                else if(in_array($doc['evaluated'][$j],$orderCount2))
                {
                    $getrejectedname =  $db->tokens->findOne(array("prf"=>$_POST['prf'],"pos"=>$_POST['pos'],"email"=>$doc['evaluated'][$j]));
                    $rejected[$r] = array($doc['evaluated'][$j],$getrejectedname['full_name']);
                    $r++;
                }
                else if(in_array($doc['evaluated'][$j],$orderCount3))
                {
                    $m = explode(",",$doc['evaluated'][$j])[0];
                    $getholdname =  $db->tokens->findOne(array("email"=>$m,"prf"=>$_POST['prf'],"pos"=>$_POST['pos'],"iid"=>$_POST['iid']));
                    $onhold[$h] = array($doc['evaluated'][$j],$getholdname['full_name']);
                    $h++;
                } 
            }
            $query = $db->prfs->findOne(array("prf"=>$_POST['prf']));
            $prfdata = array($query['prf'],$query['position'],$query['zone'],$query['department'],$query['pos'],$_POST['rid']);
            $arr =array("selected"=>$selected,"rejected"=>$rejected,"onhold"=>$onhold,"prfdata"=>$prfdata) ;
        
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