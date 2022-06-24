<?php
include('includes/config.php');
if(isset($_POST['signin']))
{
   
$uname=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT EmpId,Password,idCa FROM tblemployees WHERE EmpId=:uname and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
   $id=$results->idCa; 
if($id==9){
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'admin/changepassword.php'; </script>";

}

if($results->idCa==1){
    $_SESSION['emplogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'emp-changepassword.php'; </script>";
}


} else{
  
  echo "<script>alert('Invalid Details'+$id);</script>";
  
}

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Systéme gestion de congé |  Finetti</title>
        <link rel="shortcut icon" type="image/x-icon" href="../assets/images/logo.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">        
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="signin-page" >

        <div class="mn-content valign-wrapper" >

            <main class="mn-inner container" >
  <h4 align="center"  id="bg"><a href="../index.php">Systéme gestion de congé |Espace DRH</a></h4>
                <div class="valign">
                      <div class="row">

                          <div class="col s12 m6 l4 offset-l4 offset-m3">
                              <div class="card white darken-1">
                                  <div class="card-content ">
                                      <span class="card-title">Connexion</span>
                                       <div class="row">
                                           <form class="col s12" name="signin" method="post">
                                               <div class="input-field col s12">
                                               <p >Matricule</p>
                                                   <input id="username" type="text" name="username" class="validate" autocomplete="off" required >
                                                   
                                               </div>
                                               <div class="input-field col s12">
                                               <p>Mot de passe</p>
                                                   <input id="password" type="password" class="validate" name="password" autocomplete="off" required>
                                                   
                                               </div>
                                               <div class="col s12 right-align m-t-sm">
                                                
                                                   <input type="submit" name="signin" value="Sign in" class="waves-effect waves-light btn teal">
                                               </div>
                                           </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                </div>
            </main>
        </div>
        
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        
    </body>
</html>