<?php
// include header
include "header.php";

$createdDate = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];
$spbFaktur = $_SESSION['spbFaktur'];
$spbNo = $_POST['spbNo'];
$needDate = $_POST['needDate'];

if ($spbNo != '' && $spbFaktur != '' && $needDate != ''){
	
	$querySpb = "UPDATE as_spb SET needDate = '$needDate' WHERE spbFaktur = '$spbFaktur' AND spbNo = '$spbNo'";
	$sqlSpb = mysqli_query($connect, $querySpb);
	
	if ($sqlSpb)
	{
		echo json_encode(OK);
	}
	
}
exit();
?>