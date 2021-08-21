<?php
error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'api/db.php';
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg'];
    
    if($designation == "hr" || $designation == "ceo" || $designation == "hod" || $designation == "rghead" )
    {
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>this is ceo page</title>
    
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
        <script src="public/jquery-3.2.1.min.js"></script>
    
        <script src="public/js/materialize.js"></script>
        <script src="public/js/materialize.min.js"></script>
    
    </head>
    <style>
    .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}</style>
<body>
    <nav>
        <div class="nav-wrapper blue darken-1">
       
       
          <a href="#!" class="brand-logo center">thyssenkrupp Elevators</a>
          <div id="logoutuser" class="row">
    <button class="btn waves-effect blue darken-1" type="submit" name="action" style="float:right;margin-top: 18px;margin-right: 18px ">LOGOUT</button>
  </div>

        </div>
      </nav>
    <br>
    

    <br>


        <!-- main card starts here -->
                    <div class="row" id="attr">
                        <div class="col s12 m12 ">
                          <div class="card white">
                            <div class="card-content blue-text">
                                    
                                    
                                    <div class="row" id="cardsradius">
                                        <a href="http://localhost/hrms/createdepartment.php">
                                            <div class="col  m6 s6">
                                              <div class="card " style="background: #677E8C">
                                                <div class="card-content white-text">
                                                  <span class="card-title">Create Department and PRF </span>
                                                  <br><br>   <p></p>
                                                </div>
                                                
                                              </div>
                                            </div>
                                        </a>

                                        <a href="http://localhost/hrms/createiid.php">

                                            <div class="col  m6 s6">
                                              <div class="card " style="background: #EA5455;">
                                                <div class="card-content white-text">
                                                  <span class="card-title">Create Instance OR See History</span>
                                                  <br><br>  <p></p>
                                                </div>

                                                
                                                
                                              </div>
                                            </div>

                                        </a> 
                                        </div>
                                        <div class="row" id="cardsradius">
                                        <a href="http://localhost/hrms/initiateround.php">
                                            <div class="col  m6 s6">
                                              <div class="card " style="background: #28C76F;">
                                                <div class="card-content white-text">
                                                  <span class="card-title">Initiate rounds for instances  </span>
                                                  <br><br>  <p></p>
                                                </div>
                                                
                                              </div>
                                            </div>
                                        </a>
                                       
                                        <a href="http://localhost/hrms/allocateround.php">

                                            <div class="col  m6 s6">
                                              <div class="card " style="background: #9F44D3;">
                                                <div class="card-content white-text">
                                                  <span class="card-title">On going rounds  </span>
                                                  <br><br>             <p></p>
                                                </div>
                                              </div>
                                            </div>
                                        </a>

                                        <a href="http://localhost/hrms/allocateround2.php">

                                            <div class="col  m6 s6">
                                              <div class="card " style="background: #9F44D3;">
                                                <div class="card-content white-text">
                                                  <span class="card-title">Rescheduling  </span>
                                                  <br><br>             <p></p>
                                                </div>
                                              </div>
                                            </div>
                                        </a>

                                              
                                         
                                           

                                        
                  
                                    
                                            
                          </div>
                          </div>
                          </div>
                          </div>
                          </div>

                         
        
                         
                    
                        
                
            
                
            
            
            
            
            
            
      
    <!-- main card ends here -->

    <script>
    
    
$('#logoutuser').click(function(){

$.ajax({
url:"http://localhost/hrms/api/logout.php",
type:"POST",
success:function(para){

if(para=="success")
{
$("#row").hide()
$("#logout").show()
document.location.replace("http://localhost/hrms/index.php")
}
else
{
$("#notlogout").show()
document.location.replace("http://localhost/hrms/")
}
} 

})

});

    </script>
</body>
</html>

<?php
            }
            else
            {
                header("refresh:0;url=notfound.php");
            }
        }
        else
        {
            header("refresh:0;url=notfound.php");
        }
    }
    else
    {
        header("refresh:0;url=notfound.php");
    }  
?>
