<?php
// include header
include "header.php";

$createdDate = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];

$productID = $_POST['productID'];
$transferCode = $_POST['transferCode'];
$productName = mysqli_real_escape_string($connect, $_POST['productName1']);
$qty = $_POST['qty'];
$note = mysqli_real_escape_string($connect, $_POST['desc']);
$stock = $_POST['stock1'];
$transferFaktur = $_SESSION['transferFaktur'];

if ($productID != '' && $transferCode != '' && $qty != ''){
		
	$queryTransfer = "INSERT INTO as_temp_detail_transfers (transferCode,
															transferFaktur,
															productID,
															productName,
															qty,
															note,
															createdDate,
															createdUserID,
															modifiedDate,
															modifiedUserID)
													VALUES(	'$transferCode',
															'$transferFaktur',
															'$productID',
															'$productName',
															'$qty',
															'$note',
															'$createdDate',
															'$staffID',
															'',
															'')";	
	
	$sqlTransfer = mysqli_query($connect, $queryTransfer);
	
	if ($sqlTransfer)
	{
		echo json_encode('OK');
	}
	
}
exit();
?>