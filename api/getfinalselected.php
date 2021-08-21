<?php 
    include "db.php";
   $digit13 = explode("-",$_POST['digit13']);
   $prf = $digit13[0];
   $pos = $digit13[1];
   $iid = $digit13[2];
   $rid = $digit13[3];

    
   $cursor = $db->rounds->findOne(array("prf"=>$digit13[0],"iid"=>$digit13[2],"rid"=>$digit13[3],"status"=>"invcomplete"));
   $arr = array();
   $i=0;
   $members = iterator_to_array($cursor['selected']);
    if(count($members)>0)
    {
        foreach($members as $d)
        {
            $getselectednames =  $db->tokens->findOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"email"=>$d));
            $arr[$i]=array($getselectednames['full_name'],$d);
            $i++;
        }
         echo json_encode($arr);
    }
    else
    {
      
        echo json_encode($members);

    }


?>