<?php

include 'db.php';
header('Content-Type: application/json');

$cursor=$db->interviews->find(array('status'=>'0','accepted'=>array('$in'=>array('pending','yes'))));

if($cursor){

    $prf=[];
    $pos=[];
    $iid=[];
    $rid=[];
    $allmembers=[];
    $allinterviewers=[];


    foreach($cursor as $key=>$val){

        $members=[];

        foreach($val->members as $mem){

            $members[]=$mem;

        }

        
        
        if(in_array($val->prf,$prf)){
            $prf[]="";
        }else{
        $prf[]=$val->prf;
        }
        
        
        $pos[]=$val->pos;
        $iid[]=$val->iid;
        $rid[]=$val->rid;
        $allmembers[]=$members;
        $allinterviewers[]=$val->intvmail;


       }

       echo json_encode(array("data"=>array("prf"=>$prf,"pos"=>$pos,"iid"=>$iid,"rid"=>$rid,"members"=>$allmembers,"interviewer"=>$allinterviewers)));
    

}
else{
        header("refresh:0;url=notfound.php");
    
    
}
?>