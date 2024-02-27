<?php
include "../header.php"; 

 
	$query1 = mysqli_query($connect, "DELETE FROM as_temp_detail_bbm");
	$query2 = mysqli_query($connect, "DELETE FROM as_temp_detail_so");
	$query3 = mysqli_query($connect, "DELETE FROM as_temp_detail_spb");
	$query4 = mysqli_query($connect, "DELETE FROM as_temp_detail_transfers");
	
	$query5 = mysqli_query($connect, "DELETE FROM as_bbm WHERE supplierName = '' OR supplierID = 0");
	$query6 = mysqli_query($connect, "DELETE FROM as_sales_order WHERE status = 'invalid'");
	
	if ($query4) {	 
		echo json_encode('OK');
	} else { echo json_encode('NOK'); }
	 
?>