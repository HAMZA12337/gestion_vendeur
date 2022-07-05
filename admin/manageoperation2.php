<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{  
if(isset($_GET['del']))
{
    $date = date('Y-m-d');
$id=$_GET['del'];

$sql = "update operation1 set status=1 , realise_le=:date  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> bindParam(':date',$date, PDO::PARAM_STR);
$query -> execute();
$msg="operation record deleted";

}

    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title> DRH | Gestion des vendeurs</title>
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
        <link href="../assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

            
        <!-- code css Styles -->
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
#buttA:hover{
color:rgb(245, 224, 224);
background-color:black;
position: left;


}
        </style>
    </head>
    <body>
       <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Gestion Des Vendeurs</div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                             <marquee>   <span class="card-title">Bulletin de paie - provisoire</span></marquee>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <a href="addoperation2.php"><button type="button" class="btn btn-info" id="buttA" >+ Ajouter</button></a> 
                                <table id="example" class="display responsive-table " border="2" >
                                    <thead>
                                        <tr>
                                            <th>Numéro</th>
                                            <th>Vendeur</th>
                                            <th>Nombre du Jour</th>
                                            <th>Versement du mois precedent</th>
                                            <th>Date</th>
                                            <th>Comission</th>
                                            <th>Salaire Net</th>
                                            
                                            
                                             <th>Action</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php


$sql = "SELECT v.id,v.pda,v.solde_ant,v.chiffre,v.encaissement,v.solde_clie,v.stc,a.nom,r.nom_secteur from operation1 v join vendeur s on v.pda=s.pda join secteur r on s.pda=r.pda join region a on r.id_region=a.id where v.status =0";
$query = $dbh -> prepare($sql);
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
                                        <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->pda);?></td>
                                            <td><?php echo htmlentities($result->nom);?></t d>
                                            
                                            <td><?php echo htmlentities($result->nom_secteur);?></td>
                                            <td><?php echo htmlentities($result->solde_ant);?></td>
                                            
                                            
                                            
                                           
                                            <td><?php echo htmlentities($result->stc);?></td>
                                            <td><a href="printoperation1.php?del=<?php echo htmlentities($result->id);?>"><i class="material-icons">print</i></a><a href="editoperation1.php?deptid=<?php echo htmlentities($result->id);?>"><i class="material-icons">mode_edit</i></a><a href="manageoperation1.php?del=<?php echo htmlentities($result->id);?>" > <i class="material-icons">delete_forever</i></a></td>
                                        </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
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
        <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
        
    </body>
</html>
<?php } ?>