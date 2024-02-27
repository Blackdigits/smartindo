<?php
// include header
include "header.php";

$createdDate = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];
$soFaktur = $_SESSION['soFaktur'];
$customerID = $_POST['customerID'];

if ($customerID != '' && $soFaktur != ''){
	
	$dataCustomer = mysqli_fetch_array(mysqli_query($connect, "SELECT customerCode, customerName, address, city FROM as_customers WHERE customerID = '$customerID'"));
	$customerName = $dataCustomer['customerCode']." ".$dataCustomer['customerName'];
	
	$address = $dataCustomer['address']." ".$dataCustomer['city'];
	
	$querySo = "UPDATE as_sales_order SET customerID = '$customerID', customerName = '$customerName', customerAddress = '$address' WHERE soFaktur = '$soFaktur'";
	$sqlSo = mysqli_query($connect, $querySo);
	
	if ($sqlSo)
	{
		$_SESSION['customerID'] = $customerID;
		echo json_encode('OK');
	}
	
}
exit();
?>