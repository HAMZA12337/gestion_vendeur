<?php
header('Content-Type: application/json');
$conn = mysqli_connect("localhost","root","","vendeur_rh");
$sqlQuery = "SELECT count(*) as 'counter',month(date_sortie) as 'mois' from vendeur where STATUS=1 and year(date_sortie)=YEAR(CURRENT_DATE()) group BY(month(date_sortie));";
$result = mysqli_query($conn,$sqlQuery);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
mysqli_close($conn);
echo json_encode($data);  




?>