<?php 

include 'db.php';
error_reporting(0);

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

if($cursor)
{
    if($_POST['dept'] != "All")
    {
        $result = $db->interviews->find(array("intvmail"=>$cursor['mail']));
        if($result)
        {
            $i = 0;
            $ctr = 0;
            $p = 0;
        
            foreach($result as $doc)
            {
                $c=$db->rounds->findOne(array("prf"=>$doc['prf'],"iid"=>$doc['iid'],"rid"=>$doc['rid'],"dept"=>$_POST['dept'],"poszone"=>$_POST['zone']));
                if($c)
                {
                    $arr[$i] =array($doc['prf'],$c['position'],$c['poszone'],$c['dept'],$doc['pos'],$doc['iid'],$doc['rid']);
                    $i++;
                }
                else
                {
                    $ctr=1;
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
}
else
{
    header("refresh:0;url=notfound.php");
}



?>