<?php

include 'db.php';
header('Content-Type: application/json');

$getiids=$db->generalized->find();

if($getiids){
   
    $iids=[];

    foreach($getiids as $key=>$val){
        $iids[]=$val->prf;
        
    }

    echo json_encode(array("data"=>$iids));
}
else{
    header("refresh:0;url=notfound.php");

}






?>