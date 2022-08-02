<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{  
    header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=Arrête de la Situation Récapitulatif Provisoire.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");

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
        
      

    </head>
    <body>
     
                                <table id="example" class="display responsive-table " border="2" >
                                    <thead>
                                        <tr>
                                            <th>Numéro</th>
                                            <th>Code Assabil</th>
                                            <th>Région</th>
                                            <th>Secteur</th>
                                            <th>Solde Antérieur</th>
                                            <th>Chiffre d'Affaire</th>
                                            <th>Encaissement</th>
                                            <th>Solde Client</th>
                                             <th >Ecart</th>
                                            <th>Stc</th>
                                            
                                             
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
                                            <td><?php echo htmlentities($result->chiffre);?></td>
                                            <td><?php echo htmlentities($result->encaissement);?></td>
                                            <td><?php echo htmlentities($result->solde_clie);?></td>
                                            <td><?php echo htmlentities($ecart);?></td>
                                           
                                            <td><?php echo htmlentities($result->stc);?></td>
                                           
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
        
       
        
    </body>
</html>
<?php } ?>