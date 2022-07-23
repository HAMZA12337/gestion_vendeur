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
   
$id=$_GET['del'];

$sql = "delete from operation2   WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);

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

#wrapper_1 {
    width: 500px;

margin-left:760px;
    overflow: hidden; /* will contain if #first is longer than #second */
}
#first {
    width: 250px;
    float:left; /* add this */
   
}
#second {
   
    overflow: hidden; /* if you don't want #second to wrap below #first */
    margin-top:12px;
    padding-right:100p !important;
     color:black;
}
.ico{
   display:none;
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
                             <marquee>   <span class="card-title">Historique-Bulletin de paie - provisoire </span></marquee>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                               
                                <div class="col-md-3">  
                     <form  method="post">

                     <div class="container">
  <div class="row" id="wrapper_1" >
   
  <div  id='first'>  <input type="date" id='email'  name="date"  ></div>
 <div id='second' class="ico"> <button type='submit' name="add">S</button></div>
  </div>
                </div>  
</form>
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
                                            
                                            
                                             <th>Action</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody class="evenTd" id='hamza'>
<?php
if(isset($_POST['add']))
{
    $date=$_POST['date'];
    $sql = "SELECT * from operation2 v join vendeur s on v.pda=s.pda where v.date_ver=:date ";
    $query = $dbh->prepare($sql);
    $query->bindParam(':date',$date,PDO::PARAM_STR);
}else{
    $date=date("Y");
    $sql = "SELECT * from operation2 v join vendeur s on v.pda=s.pda where year(v.date_ver)<:date";
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
                                            <td><a href="manageoperation2.php?del=<?php echo htmlentities($result->id);?>" > <i class="material-icons">delete_forever</i></a></td>
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
