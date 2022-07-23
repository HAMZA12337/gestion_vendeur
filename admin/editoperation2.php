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
    header('location:manageoperation2.php');

}
if(isset($_POST['add']))
{ 
    $did=$_GET['deptid'];  
    $pda=$_POST['pda']; 
// code sage
$nb_jour=$_POST['nb_jour'];
$versement=$_POST['versement'];
$crax=$_POST['crax']; 
$maintenance=$_POST['maintenance']; 
$date_=$_POST['date'];
$garde=$_POST['garde'];
$comission=0;
$prime=0;
$net_pay=0; 
if($versement>=49000 && $versement<69000 ){
    $comission=0.01*$versement;
}
if($versement>=69000 && $versement<80000 ){
    $comission=0.02*$versement;
}
if($versement>=80000 && $versement<100000 ){
    $prime=0.02*$versement+1000;
}
if($versement>=100000 ){
    $prime=0.02*$versement+2000;
}

$net_pay=((2638*$nb_jour)/26)+$comission+$maintenance+$prime+110;


echo $pda.'/'.$nb_jour.'/'.$versement.'/'.$crax.'/'.$maintenance.'/'.$date_.'/'.$garde.'/'.$comission.'/'.$prime.'/'.$net_pay;


$sql=" update operation2 set nb_jour=:nb_jour,versment_prec=:versement, date_ver=:date_,comission=:comission,prime=:prime,pda=:pda, prime_crax=:crax,frais_maintenance=:maintenance,frais_garde=:garde,net_pay=:net_pay  where  id=:did ";



$query = $dbh->prepare($sql);
$query->bindParam(':nb_jour',$nb_jour,PDO::PARAM_STR);
$query->bindParam(':versement',$versement,PDO::PARAM_STR);
$query->bindParam(':date_',$date_,PDO::PARAM_STR);
$query->bindParam(':comission',$comission,PDO::PARAM_STR);
$query->bindParam(':prime',$prime,PDO::PARAM_STR);
$query->bindParam(':pda',$pda,PDO::PARAM_STR);
$query->bindParam(':crax',$crax,PDO::PARAM_STR);
$query->bindParam(':maintenance',$maintenance,PDO::PARAM_STR);
$query->bindParam(':garde',$garde,PDO::PARAM_STR);
$query->bindParam(':net_pay',$net_pay,PDO::PARAM_STR);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();

 header('location:manageoperation2.php');

// // }

}

    ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>DRH | ajouter des employés</title>
        
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
                    <div class="col s12">
                        <div class="page-title">Arrête de la Situation</div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="addemp">
                                    <div>
                                        <h3>Bulletin de paie provisoire</h3>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
                                                        <div class="row">
     <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

<div class="input-field col m6 s12">
<select  name="pda" autocomplete="on" size="2">
<option value="" disabled selected>Select PDA</option>
<?php $sql = "SELECT pda from secteur ";
$query = $dbh -> prepare($sql);
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
$sql = "SELECT * from operation2 WHERE id=:did";
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
<p style="color:#008B8B;">Nombre du jour </p>
<input  name="nb_jour" id="empcode" type="number" step="0.01"   value="<?php echo htmlentities($result->nb_jour);?>"  autocomplete="off" required>
<span id="empid-availability" style="font-size:12px;"></span> 
</div>
   


<div class="input-field col m6 s12">
<p style="color:#008B8B;">versement du mois precedent </p>
<input id="firstName" name="versement" value="<?php echo htmlentities($result->versment_prec);?>"  step="0.01" type="number" required>
</div>



<div class="input-field col m6 s12">
<p style="color:#008B8B;">Prime Crax  </p>
<input id="cin" name="crax" type="number" value="<?php echo htmlentities($result->prime_crax);?>"  step="0.01" required>
</div>



<div class="input-field col m6 s12">
<p style="color:#008B8B;">Frais de maintenance</p>
<input id="cnss" name="maintenance" type="number" value="<?php echo htmlentities($result->frais_maintenance);?>"  value='0' step="0.01" autocomplete="off" required>
</div>
<div class="input-field col m6 s12">
<p style="color:#008B8B;">Date d'operation</p>
<input id="cnss" name="date" type="date"  value="<?php echo htmlentities($result->date_ver);?>"  autocomplete="off" required>
</div>
<div class="input-field col m6 s12">
<p style="color:#008B8B;">Frais de Gardiennage</p>
<input id="cnss" name="garde" type="number" value="<?php echo htmlentities($result->frais_garde);?>" value='110' step="0.01" autocomplete="off" required>
</div>

</div>
<?php }} ?>

<div class="row">
<div class="input-field col m6 s12">
<button type="submit" name="add"  id="add" class="waves-effect waves-light btn indigo m-b-xs">Update</button>

</div>



 <div class="input-field col m6 s12">
<a href="manageoperation2.php"><button  name="retour" class="waves-effect waves-light btn indigo m-b-xs">Retour</button></a>

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