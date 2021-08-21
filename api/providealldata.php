<?php
include 'db.php';
header('Content-Type: application/json');



$fullprf= json_decode($_GET["prf"]);
//$iid = json_decode($_GET["iid"]);
$prf=substr($fullprf,0,6);
$iid=substr($fullprf,8,3);
$data=$db->rounds->find(array("prf"=>$prf,"iid"=>$iid));



foreach($data as $key=>$val){
    if($val->status=='rcomplete'){
        $allstatus[]=$val->status.'-'.$val->rid;
    }

    else if($val->status=='bcomplete'){
        $allstatus[]=$val->status.'-'.$val->rid;
    }


    else{
        $allstatus[]=$val->status.'-'.$val->rid;
   
    }
}

//echo json_encode(["prf"=>$prf,"iid"=>$iid]);

echo json_encode(["data"=>$allstatus]);
?>