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
	header("Content-Disposition: attachment; filename=La liste des vendeurs actifs.xls");  
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
                                        <tr>
                                            <th>Numéro</th>
                                            <th>Région</th>
                                            <th>Salarié</th>
                                            <th>N° CIN</th>
                                            <th>N° CNSS</th>
                                            <th>Date de Naissance</th>
                                            <th>Date Entrée</th>
                                            <th>Code Assabil</th>
                                            <th>Code Sage</th>
                                             
                                        </tr>
                                            
                                             
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
                                    <?php


$sql = "SELECT v.nomp,v.prenom,v.cin,v.cnss,v.date_naissance,v.date_entree,v.code_sage,s.nom_secteur,v.pda,r.nom from vendeur v join secteur s on v.pda=s.pda join region r on s.id_region=r.id where v.STATUS=0";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                        <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->nom);?></td>
                                            <td><?php echo htmlentities($result->nomp).' '.htmlentities($result->prenom);?></td>
                                            
                                            <td><?php echo htmlentities($result->cin);?></td>
                                            <td><?php echo htmlentities($result->cnss);?></td>
                                            <td><?php echo htmlentities($result->date_naissance);?></td>
                                            <td><?php echo htmlentities($result->date_entree);?></td>
                                            <td><?php echo htmlentities($result->pda);?></td>
                                            <td><?php echo htmlentities($result->code_sage);?></td>
                                          
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