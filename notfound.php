<?php
error_reporting(0);
if($_COOKIE)
{
  setcookie("sid",$_COOKIE['sid'] , time()-3600 , '/');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" media="screen" href="css/materialize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="css/materialize.min.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
  <script src="jquery-3.2.1.min.js"></script>  
  <script src="js/materialize.js"></script>
  <script src="js/materialize.min.js"></script>

</head>

<style>
body
{
  background-color: #007aff; 
  color: #fff;
  font-size: 100%;
  line-height: 1.5;
  font-family: "Roboto";
}
p {
  font-size: 2em;
  text-align: center;
  font-weight: 100;
  font-family: "Roboto";
  animation: slidein 2s

}
h1
{
  font-size:10em; 
  font-weight: 100;    
  
}


#thy
{
  border:white;
  border-radius: 10px;
  padding: 10px;
  width: 15%;
}

</style>
<body>
  
    <div class="row">
        <div class="col s12 center">
          <center>
              <h1 class="animated tada infinite">404</h1>
              <p class="animated pulse infinite">Sorry Page Not Found...!</p>
              <h3 class="animated pulse infinite">Please Login To Stay On Site</h3>
              <a class="animated slideInRight btn-medium white"  href="http://localhost/hrms/" id="thy">LOGIN</a>         
          </center>
          
        </div>
    </div>
    </div>
</body>
</html>