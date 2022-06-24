<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

// code for update the read notification status
$isread=1;
$did=intval($_GET['leaveid']);  
date_default_timezone_set('Europe/Paris');
$admremarkdate=date('Y-M-d G:i:s ', strtotime("now"));
$sql="update tblleaves set IsRead=:isread where id=:did";
$query = $dbh->prepare($sql);
$query->bindParam(':isread',$isread,PDO::PARAM_STR);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();

// code for action taken on leave
if(isset($_POST['update']))
{ 
$did=intval($_GET['leaveid']);
$description=$_POST['description'];
$status=$_POST['status'];   
date_default_timezone_set('Europe/Paris');
$admremarkdate=date('Y-M-d G:i:s ', strtotime("now"));
$sql="update tblleaves set AdminRemark=:description,Status=:status,AdminRemarkDate=:admremarkdate where id=:did";
$query = $dbh->prepare($sql);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':admremarkdate',$admremarkdate,PDO::PARAM_STR);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();
$msg="Leave updated Successfully";
}



 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Details de congé </title>
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

                <link href="../assets/plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css"/>  
        <!-- Theme Styles -->
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

.idd{

    cursor: pointer;
    transform: scale(1);


}



        </style>
    </head>
    <body>
       <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title" style="font-size:24px;">Details de congé</div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Details de congé</span><i class="material-icons idd"><a  href="Wordfile.php?lid=<?php echo intval($_GET['leaveid']);?>">print</a></i>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                               
                                 
                                    <tbody>
<?php 
$lid=intval($_GET['leaveid']);
$sql = "SELECT  tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblemployees.Gender,tblemployees.Phonenumber,tblemployees.EmailId,tblleaves.LeaveType,tblleaves.ToDate,tblleaves.FromDate,tblleaves.Description,tblleaves.PostingDate,tblleaves.Status,tblleaves.AdminRemark,tblleaves.AdminRemarkDate,tblemployees.functions, tbldepartments.DepartmentName,tblleaves.NbDay,tblleaves.StateChef from tblleaves join tblemployees on tblleaves.empid=tblemployees.id join tbldepartments on tblemployees.IdDepartment=tbldepartments.id    where tblleaves.id=:lid";
$query = $dbh -> prepare($sql);
$query->bindParam(':lid',$lid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{         
      ?>  
      

                                        <tr>
                                            <td style="font-size:16px;"> <b>Nom et Prénom :</b></td>
                                              <td><a href="editemployee.php?empid=<?php echo htmlentities($result->id);?>" target="_blank">
                                                <?php echo htmlentities($result->FirstName." ".$result->LastName);?></a></td>
                                              <td style="font-size:16px;"><b>Matricule :</b></td>
                                              <td><?php echo htmlentities($result->EmpId);?></td>
                                              <td style="font-size:16px;"><b>Sex :</b></td>
                                              <td><?php echo htmlentities($result->Gender);?></td>
                                          </tr>

                                          <tr>
                                             <td style="font-size:16px;"><b>Email d'Employé :</b></td>
                                            <td><?php echo htmlentities($result->EmailId);?></td>
                                             <td style="font-size:16px;"><b>Numéro de téléphone. :</b></td>
                                            <td><?php echo htmlentities($result->Phonenumber);?></td>
                                            <td style="font-size:16px;"><b>Fonction:</b></td>
                                            <td><?php echo htmlentities($result->functions);?></td>
                        
                                            <td>&nbsp;</td>
                                             <td>&nbsp;</td>
                                        </tr>

  <tr>
                                         <td style="font-size:16px;"><b>Département :</b></td>
                                            <td> <?php echo htmlentities($result->DepartmentName);?></td>
                                             <td style="font-size:16px;"><b>Type de congé(Motif) :</b></td>
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                             
                                            <td style="font-size:16px;"><b>Date de demande</b></td>
                                           <td><?php echo htmlentities($result->PostingDate);?></td>
                                        </tr>

<tr>
                                             <td style="font-size:16px;"><b>intérim assuré par: : </b></td>
                                            <td ><?php echo htmlentities($result->Description);?></td>
                                            <td style="font-size:16px;"><b>Durée Congé. :</b></td>
                                            <td>De <?php echo htmlentities($result->FromDate);?> à <?php echo htmlentities($result->ToDate);?></td>
                                            <td style="font-size:16px;"><b>Nombre du jours :</b></td>
                                            <td><?php echo htmlentities($result->NbDay).'  jours';?> </td>    
                                    
                                        </tr>

<tr>
<td style="font-size:16px;"><b>statut de congé :</b></td>
<td><?php $stats=$result->Status;
if($stats==1){
?>
<span style="color: green">Accordé</span>
 <?php } if($stats==2)  { ?>
<span style="color: red">Refusé</span>
<?php } if($stats==0)  { ?>
 <span style="color: blue">Nouveau demande</span>
 <?php } ?>
</td>
<td style="font-size:16px;"><b>Décision Chef Direct:</b></td>
<td><?php $stats=$result->StateChef;
if($stats==1){
?>
<span style="color: green">Accordé</span>
 <?php } if($stats==2)  { ?>
<span style="color: red">Refusé</span>
<?php } if($stats==0)  { ?>
 <span style="color: blue">Nouveau demande</span>
 <?php } ?>
</td>
</tr>

<tr>
<td style="font-size:16px;"><b>Observation DRH: </b></td>
<td colspan="5"><?php
if($result->AdminRemark==""){
  echo "Nouveau demande";  
}
else{
echo htmlentities($result->AdminRemark);
}
?></td>
 </tr>

 <tr>
<td style="font-size:16px;"><b>Date de l'action de DRH : </b></td>
<td colspan="5"><?php
if($result->AdminRemarkDate==""){
  echo "Vide";  
}
else{
echo htmlentities($result->AdminRemarkDate);
}
?></td>
 </tr>
<?php 
if($result->Status==0)
{

?>
<tr>
 <td colspan="5">
  <a class="modal-trigger waves-effect waves-light btn right" href="#modal1">passer à l'action&nbsp;</a>
  
<form name="adminaction" method="post">
<div id="modal1" class="modal modal-fixed-footer" style="height: 60%">
    <div class="modal-content" style="width:90%">
        <h4>Confirmer la demande de congé</h4>
          <select class="browser-default" name="status" required="">
                                            <option value="">Choisissez votre option</option>
                                            <option value="1">Accordé</option>
                                            <option value="2">Refusé</option>
                                        </select></p>
                                        <p><textarea id="textarea1" name="description" class="materialize-textarea" name="description" placeholder="Description" length="500" maxlength="500" required></textarea></p>
    </div>
    <div class="modal-footer" style="width:90%">
       <input type="submit" class="waves-effect waves-light btn blue m-b-xs" name="update" value="Submit">
       
    </div>

</div>   

 </td>
</tr>
<?php } ?>
   </form>                                     </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
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
        <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
         <script src="assets/js/pages/ui-modals.js"></script>
        <script src="assets/plugins/google-code-prettify/prettify.js"></script>
        
    </body>
</html>
<?php } ?>