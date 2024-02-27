<?php
// include header
include "header.php";
 
$spbFaktur = $_SESSION['spbFaktur'];
$factoryID = $_POST['factoryID'];

if ($factoryID != '' && $spbFaktur != ''){
	 
	 
		$_SESSION['SPBfactoryID'] = $factoryID;
		echo json_encode('oke'); 
	
}
exit();
?>