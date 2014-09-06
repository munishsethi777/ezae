<?php
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers\\AdminMgr.php");
                                        
$div = "";
if($_POST["submit"]<>"")
{
    $username = $_POST["username"];
    $password = $_POST["password"];
    $adminMgr = new AdminMgr();
    $adminMgr->logInAdmin($username,$password);
    if($pass == $password){
                session_register("adminlogged");
                $_SESSION["adminlogged"]=1;
                header("Location:adminHome.php");
                $msg="Welcome";    
    }
    else
    {
                $msg="-Invalid Password"; 
                 $div = "         <div class='ui-widget'>
                       <div  class='ui-state-error ui-corner-all' style='padding: 0 .7em;'> 
                               <p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span> 
                               <strong>Error During Admin login :</strong> <br/>" . $msg . "</p>
                       </div></div>" ;     
    }
}
?>


 
<!DOCTYPE html>
<html>
    <head>
        <link type="text/css" href="styles/bootstrap.css" rel="stylesheet" />
    </head> 
<body>

<div style="width:450px;margin:50px auto;padding:20px;border:1px silver solid">
    <?php echo($div) ?>
    <form class="form-horizontal" role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">Username</label>
        <div class="col-sm-9">
          <input type="text" class="form-control input-lg" id="formGroupInputLarge">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
        <div class="col-sm-9">
          <input type="password" class="form-control input-lg" id="formGroupInputLarge">
        </div>
      </div>
      
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="submit" name="submit" value="submit" class="btn btn-default">Sign in</button>
        </div>
      </div>
    </form>
    <a href="forgotPassword.php">Forgot Password</a>
    
    
 </div>           

 
 </body>
</html>


