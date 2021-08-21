<?php


include 'db.php';
header('Content-Type: application/json');




    $dataforinitiate=array();
    $prf=[];
    $iid=[];
    $rid=[];
    $pos=[];
    $allmembers=[];
    
    $all_prf=$db->rounds->find(array("status"=>"bstart"));

    if($all_prf){
            //echo "members".$cur_prf->$val;
            foreach($all_prf as $key=>$cur_prf){
            $members=array();

            foreach($cur_prf->selected as $member){
               //echo $member;
               $members[]=$member;
            }

            foreach($cur_prf->members as $member){
                $members[]=$member;
            }

            if(in_array($cur_prf->prf,$prf)){
                $prf[]="";
            }else{
                
            $prf[]=$cur_prf->prf;
            }     
            $pos[]=$cur_prf->pos;
            $iid[]=$cur_prf->iid;
            $rid[]=$cur_prf->rid;
            $allmembers[]=$members;
            
        }

        
    $dataforinitiate=array("prf"=>$prf,"iid"=>$iid,"rid"=>$rid,"pos"=>$pos,"members"=>$allmembers);

    echo json_encode(array("data"=>$dataforinitiate));
    }
    
else{
    header("refresh:0;url=notfound.php");


}

?>