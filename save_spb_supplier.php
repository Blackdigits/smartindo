<?php
// include header
include "header.php";

$createdDate = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];
$spbFaktur = $_SESSION['spbFaktur'];
$supplierID = $_POST['supplierID'];

if ($supplierID != '' && $spbFaktur != ''){
	
	$dataSupplier = mysqli_fetch_array(mysqli_query($connect, "SELECT supplierCode, supplierName, address, city FROM as_suppliers WHERE supplierID = '$supplierID'"));
	$supplierName = $dataSupplier['supplierCode']." ".$dataSupplier['supplierName'];
	
	$address = $dataSupplier['address']." ".$dataSupplier['city'];
	
	$querySpb = "UPDATE as_spb SET supplierID = '$supplierID', supplierName = '$supplierName', supplierAddress = '$address' WHERE spbFaktur = '$spbFaktur'";
	$sqlSpb = mysqli_query($connect, $querySpb);
	
	if ($sqlSpb)
	{
		$_SESSION['SPBsupplierID'] = $supplierID;
		echo json_encode('OK');
	}
	
}
exit();
?>