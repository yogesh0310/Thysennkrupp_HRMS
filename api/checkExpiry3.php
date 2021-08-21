<?php 

// Connection to Database
include 'db.php';
error_reporting(0);

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
  $token=$_POST['token'];


    $cursor=$db->tokens->findOne(array("email"=>$token));

    $expdate = date($_POST['expdate']);
    if($cursor)
    {
      $currentdate = date("Y.m.d");
  
      // check current date with expiry and number of documents (after selection inclusive)
      if(($currentdate > $expdate) or ($cursor["progress"] == "Revalidation Form Submitted"))
      {
        echo "expired";
      }
      else
      {
          echo "success";
      }
    }
    else
    {
      echo "404";
    }
 
}
else
{
    header("refresh:0;url=notfound.php");
}

?>