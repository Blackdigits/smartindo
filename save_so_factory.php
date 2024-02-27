<?php
// include header
include "header.php";

$createdDate = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];
$soFaktur = $_SESSION['soFaktur'];
$factoryID = $_POST['factory'];

if ($factoryID != '' && $soFaktur != ''){
	
	$dataFactory = mysqli_fetch_array(mysqli_query($connect, "SELECT factoryName FROM as_factories WHERE factoryID = '$factoryID'")); 
	
	$querySo = "UPDATE as_sales_order SET factory = '$dataFactory[factoryName]' WHERE soFaktur = '$soFaktur'";
	$sqlSo = mysqli_query($connect, $querySo);
	 
    $_SESSION['factory'] = $_POST['factory'];
    echo json_encode('OK');  

}
exit();
?>