<?php

include 'db.php';
header('Content-Type: application/json');

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

if($cursor){
foreach($cursor as $doc=>$value)
        {
            if($doc=='mail'){
                $mail=$value;
            }
           
        }

//echo "Current interviewer ".$mail."<br>";

$collection=$db->interviews;

$completed=$collection->count(array('intvmail'=>$mail,'status'=>'1','accepted'=>'yes'));

$ongoing=$collection->count(array('intvmail'=>$mail,'status'=>'0','accepted'=>'yes'));

$notstarted=$collection->count(array('accepted'=>'pending','intvmail'=>$mail));


//echo "ongoing rounds: ".$ongoing."<br>";

//echo "rounds not strated yet: ".$notstarted."<br>";

//echo "completd rounds: ".$completed."<br><br>";
//completed interviews for interviwer
$completed_cand=$collection->find(array('intvmail'=>$mail,'status'=>'1','accepted'=>'yes'));


$compl_cand=array();


foreach($completed_cand as $doc)
{
           $time=$doc->date;
           $roundname=$doc->prf."-".$doc->rid."-".$doc->iid."-".$doc->pos;
           $roundid=$doc->prf."-".$doc->rid;

           $introundsarray=array($roundid,$roundname,$time);

           $compl_cand[]=$introundsarray;           
           
}

//pending interviews for interviwer
$pendings=$collection->find(array('accepted'=>'pending','intvmail'=>$mail));

$pending_int=array();


foreach($pendings as $doc)
{
           $time=$doc->date;
           $roundname=$doc->prf."-".$doc->rid."-".$doc->iid."-".$doc->pos;
           $roundid=$doc->prf."-".$doc->rid;

           $introundsarray=array($roundid,$roundname,$time);

           $pending_int[]=$introundsarray;           
           
}


$ongoings=$collection->find(array('intvmail'=>$mail,'status'=>'0','accepted'=>'yes'));


$ongoing_int=array();

//ongoing interviews for interviwer
foreach($ongoings as $doc)
{
           $time=$doc->date;
           $roundname=$doc->prf."-".$doc->rid."-".$doc->iid."-".$doc->pos;
           $roundid=$doc->prf."-".$doc->rid;

           $introundsarray=array($roundid,$roundname,$time);

           $ongoing_int[]=$introundsarray;           
           
}

        $currentrounds=array("invterviwer"=>$mail,"ongoing"=>$ongoing,"pending"=>$notstarted,"completed"=>$completed,'compl_array'=>$compl_cand,'ongoings'=>$ongoing_int,"pendings"=>$pending_int);
//echo $compl_cand;

echo json_encode($currentrounds);
}
else{

    header("refresh:0;url=notfound.php");
}


?>