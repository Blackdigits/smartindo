<?php
// include header
include "header.php";

$createdDate = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];

$productID = $_POST['productID'];
$bbmNo = $_POST['bbmNo'];
$productName = mysqli_real_escape_string($connect, $_POST['productName1']);
$qty = $_POST['qty'];
$price = $_POST['price'];
$note = mysqli_real_escape_string($connect, $_POST['desc']);
$bbmFaktur = $_SESSION['bbmFaktur'];

if ($productID != '' && $bbmNo != '' && $qty != ''){
		
	$querybbm = "INSERT INTO as_temp_detail_bbm (	bbmNo,
													bbmFaktur,
													productID,
													productName,
													price,
													qty,
													note,
													createdDate,
													createdUserID,
													modifiedDate,
													modifiedUserID)
											VALUES(	'$bbmNo',
													'$bbmFaktur',
													'$productID',
													'$productName',
													'$price',
													'$qty',
													'$note',
													'$createdDate',
													'$staffID',
													'',
													'')";	
	
	$sqlbbm = mysqli_query($connect, $querybbm);
	
	if ($sqlbbm)
	{	 
		echo json_encode('OK');
	}
	
}
exit();
?>