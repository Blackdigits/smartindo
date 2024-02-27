<?php
include "../header.php";
if( isset($_POST['detailID']) ) {

    $detailID = $_POST['detailID'];
	$sql = "DELETE FROM as_temp_detail_bbm WHERE detailID = $detailID;";
	$query = mysqli_query($connect, $sql);
	
	if ($query) {	 
		echo json_encode('OK');
	} else { echo json_encode('NOK'); }
	
}
?>