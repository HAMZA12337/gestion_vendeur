<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['add'])){
    header('location:manageprofile.php');
}
    


if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['update']))
{
$did=intval($_GET['deptid']);    
$NameProfile=$_POST['NameProfile'];
$choix1=$_POST['choix1'];
$choix2=$_POST['choix2'];   
$sql="update profile set NameProfile=:NameProfile,stateV=:choix1,stateA=:choix2 where IdProfile=:did";
$query = $dbh->prepare($sql);
$query->bindParam(':NameProfile',$NameProfile,PDO::PARAM_STR);
$query->bindParam(':choix1',$choix1,PDO::PARAM_STR);
$query->bindParam(':choix2',$choix2,PDO::PARAM_STR);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();
$msg="profile updated Successfully";
header('location:manageprofile.php');
}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Update Department</title>
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
  <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>
    <body>
  <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Modification profile</div>
                    </div>
                    <div class="col s12 m12 l6">
                        <div class="card">
                            <div class="card-content">
                              
                                <div class="row">
                                    <form class="col s12" name="chngpwd" method="post">
                                          <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
<?php 
$did=intval($_GET['deptid']);
$sql = "SELECT * from profile WHERE IdProfile=:did";
$query = $dbh -> prepare($sql);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

                                        <div class="row">
                                            <div class="input-field col s12">
                                            <p style="color:#008B8B;">Nom de profile</p>
<input id="departmentname" type="text"  class="validate" autocomplete="off" name="NameProfile" value="<?php echo htmlentities($result->NameProfile);?>"  required>
                                               
                                            </div>


                                            <div class="input-field col s12">
<select name="choix1"  autocomplete="off">
<option disabled selected>C'est un Validateur?</option>
<option value="1">Oui</option>
<option value="0">Non</option>
</select>
<select name="choix2"  autocomplete="off">
<option disabled selected>C'est un Administrateur ?</option>
<option value="1">Oui</option>
<option value="0">Non</option>
</select>
                                               
                                            </div>
                                           
                                           
                                           
                                           
                                           
                                           
                                            </div>

<?php }} ?>

<div class="col m6">
<div class="row">
<div class="input-field col m6 s12">
<button type="submit" name="update" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>

</div>
<div class="input-field col m6 s12">
<button  name="add" class="waves-effect waves-light btn indigo m-b-xs" >Retour</button>
</div>





                                        </div>
                                       
                                    </form>
                                </div>
                            </div>
                        </div>
                     
             
                   
                    </div>
                
                </div>
            </main>

        </div>
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/form_elements.js"></script>
        
    </body>
</html>
<?php } ?> 