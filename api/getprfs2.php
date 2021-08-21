<?php 
error_reporting(0);
include 'db.php';
// error_reporting(0);

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

if($cursor)
{
    $cursor = $db->rounds->findOne(array("rid"=>$_POST['rid'],"prf"=>$_POST['prf'],"iid"=>$_POST['iid'],"pos"=>$_POST['pos']));
    if($cursor)
    {
        $i = 0;
        $j=0;
        $k=0;
        $ctr = 0;
        $p = 0;
        $selected=$cursor['selected'];
        $rejected=$cursor['rejected'];
        $onhold=$cursor['onhold'];
        foreach($selected as $d)
        {
            $getselectednames =  $db->tokens->findOne(array("prf"=>$_POST['prf'],"pos"=>$_POST['pos'],"email"=>$d));
            $selected[$i]=array($d,$getselectednames['full_name'],$getselectednames['progress']);
            $i++;
        }
         
        foreach($rejected as $d)
        {
            $d = explode(",",$d);
            $getrejectednames =  $db->tokens->findOne(array("prf"=>$_POST['prf'],"pos"=>$_POST['pos'],"email"=>$d[0]));
            $reason_reject =  $db->intereval->findOne(array("prf"=>$_POST['prf'],"iid"=>$_POST['iid'],"rid"=>$_POST['rid'],"result"=>"rejected","email"=> $d[0]));

            $rejected[$j]=array($d,$getrejectednames['full_name'],$reason_reject['remark']);
            $j++;
        }
        foreach($onhold as $d)
        {
            $holdmail=explode(',',$d);
            $getonholdnames =  $db->tokens->findOne(array("prf"=>$_POST['prf'],"pos"=>$_POST['pos'],"email"=> $holdmail[0]));
            $reason_hold =  $db->intereval->findOne(array("prf"=>$_POST['prf'],"iid"=>$_POST['iid'],"rid"=>$_POST['rid'],"result"=>"onhold","email"=> $holdmail[0]));

            if($getonholdnames['reallocate'])
            {
                $onhold[$k]=array($d,$getonholdnames['full_name'],$getonholdnames['reallocate'],$reason_hold['remark']);
            }
            else
            {
                $onhold[$k]=array($d,$getonholdnames['full_name'],0,$reason_hold['remark']);
               
            }

            $k++;
        }
            $query = $db->prfs->findOne(array("prf"=>$_POST['prf']));
            $roundcount = $db->rounds->count(array("prf"=>$_POST['prf'],"iid"=>$_POST['iid']));
            $prfdata = array($query['prf'],$query['position'],$query['zone'],$query['department'],$query['pos'],$roundcount-1,$_POST['rid']);
            $arr =array("selected"=>$selected,"rejected"=>$rejected,"onhold"=>$onhold,"prfdata"=>$prfdata) ;
            
        echo json_encode($arr);
    }
}
else
{
    header("refresh:0;url=notfound.php");
}

?>