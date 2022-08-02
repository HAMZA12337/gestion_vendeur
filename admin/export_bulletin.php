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
	header("Content-Disposition: attachment; filename=Bulletin de paie - provisoire .xls");  
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
                                            <th>pda</th>
                                            <th>Vendeur</th>
                                            <th>Nombre du Jour</th>
                                            <th>Versement precedent</th>
                                            <th>Date</th>
                                            <th>Comission</th>
                                            <th>Salaire Net</th>
                                            
                                             
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
                                        
<?php
if(isset($_POST['add']))
{
    $date=$_POST['date'];
    $sql = "SELECT * from operation2 v join vendeur s on v.pda=s.pda where v.date_ver=:date ";
    $query = $dbh->prepare($sql);
    $query->bindParam(':date',$date,PDO::PARAM_STR);
}else{
    $date=date("Y");
    $sql = "SELECT * from operation2 v join vendeur s on v.pda=s.pda where year(v.date_ver)=:date";
    $query = $dbh -> prepare($sql);
    $query->bindParam(':date',$date,PDO::PARAM_STR);
}

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
                                        <tr id='emailid-availability'>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->pda);?></td>
                                            <td><?php echo htmlentities($result->nomp).' '.htmlentities($result->prenom);?></td>
                                            
                                            <td><?php echo htmlentities($result->nb_jour);?></td>
                                            <td><?php echo htmlentities($result->versment_prec);?></td>
                                            <td><?php echo htmlentities($result->date_ver);?></td>
                                            
                                            
                                           
                                            <td><?php echo htmlentities($result->comission);?></td>
                                            <td><?php echo htmlentities($result->net_pay);?></td>
                                           
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