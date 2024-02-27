<?php
// include header // NEEDDATE = SUPPLIER/SALES ID
include "header.php";

$createdDate = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];
$soFaktur = $_SESSION['soFaktur'];
$soNo = $_POST['soNo'];
$needDate = $_POST['needDate'];

if ($soNo != '' && $soFaktur != '' && $needDate != ''){ 
	
	$querySo = "UPDATE as_sales_order SET needDate = '$needDate' WHERE soFaktur = '$soFaktur' AND soNo = '$soNo'";
	$sqlSo = mysqli_query($connect, $querySo);
	
	if ($sqlSo)
	{ 
		$_SESSION['supplierID'] = $needDate;
		echo json_encode('OK');
	}
	
}
exit();
?>