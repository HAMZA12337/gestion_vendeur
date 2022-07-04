<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}

else{
    if(isset($_POST['retour']))
{ 
    header('location:manageoperation1.php');

}
if(isset($_POST['add']))
{ 
    // pda
    $did=$_GET['deptid'];  
$IdCom=strval($_POST['IdCom']); 
// code sage
$empid=$_POST['empcode'];
$fname=$_POST['firstName'];
$lname=$_POST['lastName'];   
$cin=$_POST['cin']; 
$cnss=$_POST['cnss']; 
 
$ecart=$empid+$fname-$lname;

$sql=" update operation1 set pda=:IdCom, solde_ant=:empid, chiffre=:fname,encaissement=:lname,solde_clie=:cin,ecart=:ecart, stc=:cnss where  id=:did ";



$query = $dbh->prepare($sql);
$query->bindParam(':IdCom',$IdCom,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':cin',$cin,PDO::PARAM_STR);
$query->bindParam(':cnss',$cnss,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':ecart',$ecart,PDO::PARAM_STR);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();

 header('location:manageoperation1.php');

// // }

}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>DRH | ajouter des vendeurs</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        <link rel="shortcut icon" type="image/x-icon" href="../assets/images/logo.png" />
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
                  
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="addemp">
                                    <div>
                                       
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
                                                        <div class="row">
     <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

<div class="input-field col m6 s12">
<p style="color:#008B8B;">PDA</p>
<select  name="IdCom" autocomplete="on" size="2" required>
<option value="" disabled selected>Select PDA</option>
<?php $sql = "SELECT pda from secteur  ";
$query = $dbh -> prepare($sql);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>                                            
<option value="<?php echo htmlentities($result->pda);?>"><?php echo htmlentities($result->pda)?></option>
<?php }} ?>
</select>
</div>


<?php 
$did=$_GET['deptid'];
$sql = "SELECT * from operation1 WHERE id=:did";
$query = $dbh -> prepare($sql);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  



<div class="input-field col m6 s12">

<p style="color:#008B8B;">Solde Antérieur</p>
<input  name="empcode" id="empcode"  value="<?php echo htmlentities($result->solde_ant);?>" type="number" autocomplete="off" required>
<span id="empid-availability" style="font-size:12px;"></span> 
</div>
   


<div class="input-field col m6 s12">
<p style="color:#008B8B;">Chiffre D'affaire</p>
<input id="firstName" name="firstName" value="<?php echo htmlentities($result->chiffre);?>"  type="text" required>
</div>

<div class="input-field col m6 s12">
<p style="color:#008B8B;">Encaissement</p>
<input id="lastName" name="lastName" type="number"  value="<?php echo htmlentities($result->encaissement);?>" autocomplete="off" required>
</div>

<div class="input-field col m6 s12">
<p style="color:#008B8B;">Solde Client </p>
<input id="cin" name="cin" type="number" value="<?php echo htmlentities($result->solde_clie);?>" required>
</div>

<div class="input-field col m6 s12">
<p style="color:#008B8B;">Stc</p>
<input id="cnss" name="cnss" type="number" value="<?php echo htmlentities($result->stc);?>"  autocomplete="off" required>
</div>



                                                    
<?php }} ?>











<div class="input-field col m6 s12">
<button type="submit" name="add"  id="add" class="waves-effect waves-light btn indigo m-b-xs">Update</button>

</div>

 <div class="input-field col m6 s12">
<a href="manageemployee.php"><button  name="retour" onclick="history.back();" class="waves-effect waves-light btn indigo m-b-xs">Retour</button></a>

</div>                                                       


                                                       
                                                </div>
                                            </div>
                                        </section>
                                     
                                    
                                        </section>
                                    </div>
                                </form>
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