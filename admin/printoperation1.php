<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{  
    // echo"<script>window.print()</script>";
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title> DRH | Gestion des vendeurs</title>
        <link rel="shortcut icon" type="image/x-icon" href="../assets/images/logo.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
     
<style>
    size: {landscape}
  table, th, td {
  border: 1px solid black;
  border-collapse: collapse;

}
th,td{
    width:200px;
    text-align:center;
    height:80px;
}
        </style>
    </head>
    <body>
    <?php
$did=$_GET['del'];

$sql = "SELECT v.id,v.pda,v.solde_ant,v.chiffre,v.encaissement,v.solde_clie,v.stc,a.nom,r.nom_secteur from operation1 v join vendeur s on v.pda=s.pda join secteur r on s.pda=r.pda join region a on r.id_region=a.id where v.id=:did";
$query = $dbh -> prepare($sql);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;

if($query->rowCount() > 0)
{
foreach($results as $result)
{            
    $ecart=$result->solde_ant+$result->chiffre-$result->encaissement;
    $state;

echo $state;
    ?> 
    <main class="mn-inner">
                <div class="row">
                  
                    <div class="col-12 py-5">
     
                   <center> <h2>Arrête de la Situation - Récapitulatif Provisoire<h2> <center>
                   </div>

                   <div class="col-12  py-2 px-5">
     
                        <h5>Agence :<?php echo htmlentities($result->nom);?> <h5> <center>
                  </div>

<div>
 
</main>
<div class="container pt-5 ">
  <div class="row">
    <div class="col-4 px-0">
      <b>Periode du   :</b>
    </div>
    <div class="col-4">
     <b> Code Assabil :<?php echo htmlentities($result->pda);?></b>
    </div>
    <div class="col-4 ">
    <b> xxxxxxxxxxxxxxxxxxxxxxxx :</b>
    </div>
  </div>
  <div class="row"  >
    <div class="col-4 mx-0 px-0">
    <b>Realise le :</b>
    </div>
    <div class="col-8">
    <b> Code Sage :</b>
</div>
        


<div class="container pt-5 ">
  <div class="row">
    <div class="col-6 px-0">
    <table >
  <tr>
    <th>Solde Anterieur</th>
    <th>Chiffre d'affaire</th>
    <th>Encaissement</th>
    <th>Solde Client</th>
  </tr>
  <tr>
    <td><?php echo htmlentities($result->solde_ant);?></td>
    <td><?php echo htmlentities($result->chiffre);?></td>
    <td><?php echo htmlentities($result->encaissement);?></td>
    <td><?php echo htmlentities($result->solde_clie);?></td>
  </tr>
  
</table>
    </div>
    <div class="col-4 px-0" >
    <center><table >
  <tr>
    <th>Ecart</th>
    
  </tr>
  <tr>
    <td><?php echo htmlentities($ecart);?></td>
    
  </tr>
  
</table></center>
    </div>
    
  </div>
  
</div>

<?php $cnt++;} }?>





<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </body>
</html>
<?php } ?>