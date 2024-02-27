<?php
// include header
include "header.php";

$createdDate = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];
$soFaktur = $_SESSION['soFaktur'];
$soNo = $_POST['soNo'];
$oDate = explode("-", $_POST['orderDate']);

if ($soNo != '' && $soFaktur != '' && $oDate != ''){
	$orderDate = $oDate[2]."-".$oDate[1]."-".$oDate[0];
	
	$querySo = "UPDATE as_sales_order SET orderDate = '$orderDate' WHERE soFaktur = '$soFaktur' AND soNo = '$soNo'";
	$sqlSo = mysqli_query($connect, $querySo);
	
	if ($sqlSo)
	{
		echo json_encode('OK');
	}
	
}
exit();
?>