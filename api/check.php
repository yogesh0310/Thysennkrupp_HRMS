​<?php
include 'db.php';
//error_reporting(0);
$result = $db->tokens->findOne(array("aadharno"=>$_POST["aadharno"]));
$currentdate = date("Y.m.d");
$expdate = date($result['expdate_6month']);
//echo($currentdate);

//echo($expdate);
if($result["aadharno"])
{
  if($currentdate>$expdate)
    {
      echo("expired");
    }
    else
    {
      echo("notexpired");
    }
}
else{
  echo("continue");
}
?>
​
