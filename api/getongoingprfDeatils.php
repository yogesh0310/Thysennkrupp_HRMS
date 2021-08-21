<?php

include 'db.php';
header('Content-Type: application/json');

$cursor=$db->interviews->find(array('accepted'=>'yes','status'=>'0'));

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

       echo json_encode(array("data"=>array("prf"=>$prf,"pos"=>$pos,"iid"=>$iid,"rid"=>$iid,"members"=>$allmembers,"interviewer"=>$allinterviewers)));
    

}
else{
      
    
    
    header("refresh:0;url=notfound.php");


}
?>