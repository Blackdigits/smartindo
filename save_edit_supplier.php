<?php
// include header
include "header.php";

$modified_date = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];
$supplierID = $_POST['supplierID'];
$supplierCode = $_POST['supplierCode'];
$supplierName = mysqli_real_escape_string($connect, $_POST['supplierName']);
$contactPerson = mysqli_real_escape_string($connect, $_POST['contactPerson']);
$address = mysqli_real_escape_string($connect, $_POST['address']);
$city = mysqli_real_escape_string($connect, $_POST['city']);
$phone = mysqli_real_escape_string($connect, $_POST['phone']);
$fax = mysqli_real_escape_string($connect, $_POST['fax']);
$email = mysqli_real_escape_string($connect, $_POST['email']);

if ($supplierID != '' && $supplierName != ''){
	
	$querySupplier = "UPDATE as_suppliers SET	supplierCode = '$supplierCode',
                                                supplierName = '$supplierName',
												address = '$address',
												city = '$city',
												phone = '$phone',
												fax = '$fax',
												contactPerson = '$contactPerson',
												email = '$email',
												modifiedDate = '$modified_date',
												modifiedUserID = '$staffID'
												WHERE supplierID = '$supplierID'";
	
	$sqlSupplier = mysqli_query($connect, $querySupplier);
	
	if ($sqlSupplier)
	{
		echo json_encode('OK');	
	}
}
exit();
?>