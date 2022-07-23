<?php 
require_once("includes/config.php");
// code for empid availablity
if(!empty($_POST["empcode"])) {
	$empid=$_POST["empcode"];
	
$sql ="SELECT code_sage FROM vendeur WHERE code_sage=:empid";
$query= $dbh->prepare($sql);
$query-> bindParam(':empid',$empid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
echo "<span style='color:red'> Cette personne déja existe .</span>";
 echo "<script>$('#add').prop('disabled',true);</script>";
} else{
	
echo "<span style='color:green'> Employee id available for Registration .</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}

// code for emailid availablity
if(!empty($_POST["emailid"])) {
$empid= $_POST["emailid"];
$sql ="SELECT EmailId FROM tblemployees WHERE EmailId=:emailid";
$query= $dbh -> prepare($sql);
$query-> bindParam(':emailid',$empid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
echo "<span style='color:red'> Email id already exists .</span>";
 echo "<script>$('#add').prop('disabled',true);</script>";
} else{
	
echo "<span style='color:green'>  .</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}

//date test
if(!empty($_POST["date"])) {
	$empid= $_POST["date"];

	$sql ="SELECT * from operation2 v join vendeur s on v.pda=s.pda WHERE v.date_ver=:emailid";
	$query= $dbh -> prepare($sql);

	$query-> bindParam(':emailid',$empid, PDO::PARAM_STR);
	$query-> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);
	if($query -> rowCount() > 0)
	{
		foreach($results as $result)
		{
			echo "<tr>
			<td>12</td>
			<td>$result->pda</td>
			<td>$result->nomp</td>
			<td>$result->nb_jour</td>
			<td>$result->versment_prec</td>
			<td>$result->date_ver</td>
			<td>$result->comission</td>
			<td>$result->net_pay</td>
			<td><a href='printoperation1.php?del=<?php echo htmlentities($result->id);?>'><i class='material-icons'>print</i></a><a href='editoperation1.php?deptid=<?php echo htmlentities($result->id);?>"><i class="material-icons'>mode_edit</i></a><a href='manageoperation1.php?del=<?php echo htmlentities($result->id);?> <i class='material-icons'>delete_forever</i></a></td>
			</tr>";

		}
		
	} else{
		
	echo "<span style='color:green'>  .</span>";
	echo "<script>$('#add').prop('disablmmmmed',false);</script>";

	}
	}
	

?>
