<?php
header('Content-Type: application/json');
$conn = mysqli_connect("localhost","root","","vendeur_rh");
$sqlQuery = "SELECT count(*) as 'counter',month(date_entree) as 'mois' from vendeur where STATUS=0 and year(date_entree)=YEAR(CURRENT_DATE()) group BY(month(date_entree));";
$result = mysqli_query($conn,$sqlQuery);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
mysqli_close($conn);
echo json_encode($data);  




?>