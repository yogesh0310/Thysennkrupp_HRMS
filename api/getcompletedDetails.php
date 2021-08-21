<?php


include 'db.php';
header('Content-Type: application/json');

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid'],"dsg"=>"hr"));
if($cursor)
{


    // $initiateprfs=$db->generalized->find(array("status"=>"completed"));
    // $prfs=array();
    // foreach($initiateprfs as $doc=>$docval){        
    //             $prfs[]=$docval->prf;
    //         //var_dump($docval);     
    // }

     $dataforinitiate=array();

    // foreach($prfs as $val){
        $cur_prf=$db->rounds->find(array("status"=>"completed","completevalidate"=>"inprocess"));

        if($cur_prf){

            $prf=[];

            foreach ($cur_prf as $key => $value) {
                //$prfval="";
                //if(in_array($value->prf,$prf)==FALSE){
                //    $prfval=$value->prf;
                //    $prf[]=$prfval;
                //}
                $object=array(
                    $value->prf,
                    //"position"=>$cur_prf->position,
                    $value->pos,
                    $value->iid,
                    $value->rid
                );
    
                $dataforinitiate[]=$object;
            
                
            }
           }   
    

    echo json_encode(array("data"=>$dataforinitiate));

}
else{
    header("refresh:0;url=notfound.php");


}

?>