<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

echo"<script>window.print()</script>";

 

 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title> </title>
        <link rel="shortcut icon" type="image/x-icon" href="../assets/images/logo.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
      

<style>

body{
  margin-top:30px;
  margin-left:30px;
}
    
    
@page { margin: 0; }
    
    
    .tb2{
       
 margin-top: 20px;

    }
    .tb1{
       
       margin-top: 19px;
      
          }
    table {
  border-collapse: collapse;
  padding-left:10px;
  margin-top:100px;
} 
table td th{
  padding-left:10px;
} 
   .div1{
font-size:16px;
padding-left:10px;
margin-top: 0px;
padding-top:0px;
border:1px solid black;
width:90%;

} 
  input{  
transform: scale(2);
        margin: 30px;
  }
    </style>
    </head>
    <body>
   
            
                                
                                <table  class="tb1" border="1" style="width:91%">
                               
                                 
                                    <tbody>
<?php 
$lid=intval($_GET['lid']);
$sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblemployees.Gender,tblemployees.Phonenumber,tblemployees.EmailId,tblleaves.LeaveType,tblleaves.ToDate,tblleaves.FromDate,tblleaves.Description,tblleaves.PostingDate,tblleaves.Status,tblleaves.AdminRemark,tblleaves.AdminRemarkDate,tblemployees.functions, tbldepartments.DepartmentName,tblleaves.NbDay from tblleaves join tblemployees on tblleaves.empid=tblemployees.id join tbldepartments on tblemployees.IdDepartment=tbldepartments.id    where tblleaves.id=:lid";
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
                                   <th  width="200px"><img src="../assets/images/logo.png" height="60px" width="200px"/></th>
                                   <th>DEMANDE DE CONGE</th>
                                    </tr>
                                    <tr>
                                   <td ></td>
                                   <td align="center">Ressources Humaines</td>
                                    </tr>
                       
                       </table>


                  <table class="tb2" border="1" style="width:90.8%">
                 <tr>
                  <td width="90.8%" align="center"><b>Demandeur</b></td>
                  </tr>
                 </table>

<div class="div1" >
<pre>
<b>- Nom et Prénom         :</b>                      <?php echo htmlentities($result->FirstName." ".$result->LastName);?><br>
<b>- Matricule             :</b>                      <?php echo htmlentities($result->EmpId);?><br>
<b>- Fonction              :</b>                      <?php echo htmlentities($result->functions);?><br>
<b>- Département           :</b>                      <?php echo htmlentities($result->DepartmentName);?><br>
<b>- Durée Congé           :</b>                      <?php echo htmlentities($result->NbDay)." jours";?><br>
<b>- Période souhaitée Du  :</b>                      <?php echo htmlentities($result->ToDate);?><b>     Au</b>     <?php echo htmlentities($result->FromDate);?> <br>
<b>- Type de congé         :</b>                      <?php echo htmlentities($result->LeaveType);?><br>
<b>- Intérim assuré par    : </b>                     <?php echo htmlentities($result->Description);?><br>
<b>- Contact lors du congé :</b>                      <?php echo htmlentities($result->Phonenumber);?><br>
</pre>
</div>

<table class="tb2" border="1" style="width:90.8%">
                 <tr>
                  <td  align="center" style="padding-left:10px;width:90.8%"><b>Partie réservée au département RH</b></td>
                  </tr>
                 </table>

<div class="div1" >
<pre>
<b>- Refusé     :</b> <?php $stats=$result->Status;if($stats==2){echo "<input type='checkbox' checked class='check' width='100px'; />".'      <b> Motif :</b>';echo htmlentities($result->AdminRemark);}else{  echo "<input type='checkbox' class='check' />".'      <b> Motif :</b>';}?></pre> 
<pre>
<b>- Accordé    :</b> <?php $stats=$result->Status;if($stats==1){echo "<input type='checkbox' checked class='check' width='100px'; />".'<b> Durée :</b>';echo htmlentities($result->NbDay).' jours    <b> Du :</b>';echo htmlentities($result->ToDate).'      <b> Au :</b>';echo htmlentities($result->FromDate);}else{ echo "<pre><input type='checkbox'  class='check' width='100px'; />".'<b> Durée :   Du :    AU :</b></pre>'; }?></pre>
<pre><b>- Observation : </b><?php echo htmlentities($result->AdminRemark);?><br></pre>


</div>

<table class="tb2" border="1" style="width:90.8%">

<tr >
<th width="200px">Circuit</th>
<th width="200px">Demandeur</th>
<th width="200px">Chef Direct</th>
<th width="200px">DRH</th>
</tr>
<tr height="50px">
<td style="padding-left:10px;"><b>Nom</b></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr height="50px">
<td style="padding-left:10px;"><b>Signature</b></td>
<td></td>
<td></td>
<td></td>
</tr>





</table>



                                         <?php $cnt++;} }?>
                                    
   
                             
                                
                          
        
        
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