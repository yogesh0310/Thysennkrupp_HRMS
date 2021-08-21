<?php


include 'db.php';
header('Content-Type: application/json');

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid'],"dsg"=>"hr"));
if($cursor)
{


    $initiateprfs=$db->generalized->find(array("status"=>"initiated"));
    $prfs=array();
    foreach($initiateprfs as $doc=>$docval){        
                $prfs[]=$docval->prf;
            //var_dump($docval);     
    }
    $duplicateprf=[];
    $dataforinitiate=array();

    foreach($prfs as $val){
        $cur_prf=$db->rounds->find(array("prf"=>$val,"rid"=>"00"));

        if($cur_prf){
            
            $members=array();
            foreach($cur_prf as $cur){
            foreach($cur->members as $member){
                $members[]=$member;
            }

            if(in_array($val,$duplicateprf)){
                $val='';
                //echo "true";
            }
            else{
                $duplicateprf[]=$val;
            }
            $object=array(
                "prf"=>$val,
                "position"=>$cur->position,
                "pos"=>$cur->pos,
                "iid"=>$cur->iid,
                "rid"=>$cur->rid,
              //  "members"=>$members

                
            );

            $dataforinitiate[]=$object;
        }
    }
    }

    echo json_encode(array("data"=>$dataforinitiate));

   // echo json_encode(array("general"=>$currentrounds,"initiateddata"=>$initiateddata,"completeddata"=>$completeddata,"para4"=>"ok","para5"=>"ok"));



}
else{
    header("refresh:0;url=notfound.php");


}

?>