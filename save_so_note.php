<?php
// include header
include "header.php";

$createdDate = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];
$soFaktur = $_SESSION['soFaktur'];
$soNo = $_POST['soNo'];
$note = mysqli_real_escape_string($connect, $_POST['note']);

if ($soNo != '' && $soFaktur != '' && $note != ''){
		
	$querySo = "UPDATE as_sales_order SET note = '$note' WHERE soFaktur = '$soFaktur' AND soNo = '$soNo'";
	$sqlSo = mysqli_query($connect, $querySo);
	
	if ($sqlSo)
	{
		echo json_encode('OK');
	} else {
        
    }
	
}
exit();
?>