<?php
// include header
include "header.php";

$createdDate = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];
$bbmNo = $_POST['bbmNo'];
$bbmFaktur = $_SESSION['bbmFaktur'];
$bbmID = $_POST['bbmID'];
$spbNo = mysqli_real_escape_string($connect, $_POST['spbNo']);

if ($bbmNo != '' && $bbmID != '' && $spbNo != ''){
		
	$queryBbm = "UPDATE as_bbm SET spbNo = '$spbNo' WHERE bbmNo = '$bbmNo' AND bbmID = '$bbmID' AND bbmFaktur = '$bbmFaktur'";
	$sqlBbm = mysqli_query($connect, $queryBbm);
	
	if ($sqlBbm)
	{
		echo json_encode(OK);
	}
	
}
exit();
?>