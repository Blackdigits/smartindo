<?php
// include header
include "header.php";

$createdDate = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];

$productID = $_POST['productID'];
$spbNo = $_POST['spbNo'];
$productName = mysqli_real_escape_string($connect, $_POST['productName1']);
$qty = $_POST['qty'];
$price = $_POST['price'];
$note = mysqli_real_escape_string($connect, $_POST['desc']);
$spbFaktur = $_SESSION['spbFaktur'];

if ($productID != '' && $spbNo != '' && $qty != ''){
		
	$querySpb = "INSERT INTO as_temp_detail_spb (	spbNo,
													spbFaktur,
													productID,
													productName,
													price,
													qty,
													note,
													createdDate,
													createdUserID,
													modifiedDate,
													modifiedUserID)
											VALUES(	'$spbNo',
													'$spbFaktur',
													'$productID',
													'$productName',
													'$price',
													'$qty',
													'$note',
													'$createdDate',
													'$staffID',
													'',
													'')";	
	
	$sqlSpb = mysqli_query($connect, $querySpb);
	
	if ($sqlSpb)
	{	 
		echo json_encode('OK');
	}
	
}
exit();
?>