<?php
include 'db.php';
header('Content-Type: application/json');



//$fullprf= $_GET["label"];
$fullprf =$_GET["digit13"];
$prfdetails=explode("-",$fullprf);
$iid=$prfdetails[2];
$prf=$prfdetails[0];
$rid=$prfdetails[3];
$aclabel=$_GET["label"];
$labels=explode("-",$aclabel);
$label=$labels[0];
$med_round=$labels[1];
$objno=$iid-1;


if($label=='bcomplete'){
$data=$db->generalized->findOne(array("prf"=>$prf));

if($data){
      $allstatus=$data->instances[$objno]->init_time;
 }
else{
     $allstatus="NA";
 }

$members=[];
$basecomplete=$db->rounds->findOne(["prf"=>$prf,"status"=>"bcomplete","iid"=>$iid]);
if($basecomplete){
    foreach($basecomplete->selected as $mem){
        $members[]=$mem;
    }

}
else{
    $members[]="NA";
}

$interviewer="NA";
$compl_time="NA";

$complete_data=$db->interviews->findOne(["prf"=>$prf,"rid"=>"01","iid"=>$iid]);
if($complete_data){
    $compl_time=$complete_data->dates[0]." ".$complete_data->times[0];
    $interviewer=$complete_data->intvmail;

}

$fullprftoshow=$prfdetails[0]."-".$prfdetails[1]."-".$prfdetails[2]."-"."00";
echo json_encode(["digit13"=>[$fullprftoshow],"start"=>[$allstatus],"end"=>[$compl_time],"invname"=>[$interviewer],"members"=>[$members]]);
}

else if($label=='rcomplete'){
//echo json_encode("here");
 $members=[];

  

$roundcomplete=$db->interviews->findOne(["prf"=>$prf,"iid"=>$iid,"rid"=>$med_round]);
if($roundcomplete){
    foreach($roundcomplete->evaluated as $mem){
        $members[]=$mem;
    }
    
}
else{
    $members[]="NA";
}


 $interviewer="NA";
 $compl_time="NA";

 $rrid="0".($med_round+1);
 $complete_data=$db->interviews->findOne(["prf"=>$prf,"rid"=>$rrid,"iid"=>$iid]);
 if($complete_data){
    
     $compl_time=$complete_data->dates[0]." ".$complete_data->times[0];
     $interviewer=$complete_data->intvmail;

 }

$starttime="";

$complete_data=$db->interviews->findOne(["prf"=>$prf,"rid"=>$med_round,"iid"=>$iid]);
 if($complete_data){
    
     $starttime=$complete_data->dates[0]." ".$complete_data->times[0];
    
 }
 $fullprftoshow=$prfdetails[0]."-".$prfdetails[1]."-".$prfdetails[2]."-".$rid;


 echo json_encode(["digit13"=>[$fullprftoshow],"start"=>[$starttime],"end"=>[$compl_time],"invname"=>[$interviewer],"members"=>[$members]]);

 
}



else if($label=='completed'){
    //echo json_encode("here");
     $members=[];
    $roundcomplete=$db->interviews->findOne(["prf"=>$prf,"iid"=>$iid,"rid"=>$rid]);
    if($roundcomplete){
        foreach($roundcomplete->evaluated as $mem){
            $members[]=$mem;
        }
        
    }
    else{
        $members[]="NA";
    }
    
    
     $interviewer="NA";
     $compl_time="NA";
    
     $complete_data=$db->interviews->findOne(["prf"=>$prf,"rid"=>$rid,"iid"=>$iid]);
     if($complete_data){
        
        // $compl_time=$complete_data->dates[0]." ".$complete_data->times[0];
         $interviewer=$complete_data->intvmail;
    
     }
    
    $starttime="";
   // $rid='0'.($rid-1);
    
    $complete_data=$db->interviews->findOne(["prf"=>$prf,"rid"=>$rid,"iid"=>$iid]);
     if($complete_data){
        
         $starttime=$complete_data->dates[0]." ".$complete_data->times[0];
        
     }
    
    
     echo json_encode(["digit13"=>[$fullprf],"start"=>[$starttime],"end"=>[$compl_time],"invname"=>[$interviewer],"members"=>[$members]]);
    
    
    }

else{
    echo json_encode(["digit13"=>["NA"],"start"=>["NA"],"end"=>["NA"],"invname"=>["NA"],"members"=>["NA"]]);

}
//echo "hi";
?>