<?php
// include header
include "header.php";

$createdDate = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];
$transferFaktur = $_SESSION['transferFaktur'];
$transferTo = $_POST['transferTo'];

if ($transferTo != '' && $transferFaktur != ''){
	
	$queryTransfer = "UPDATE as_transfers SET transferTo = '$transferTo' WHERE transferFaktur = '$transferFaktur'";
	$sqlTransfer = mysqli_query($connect, $queryTransfer);
	
	if ($sqlTransfer)
	{
		echo json_encode(OK);
	}
	
}
exit();
?>