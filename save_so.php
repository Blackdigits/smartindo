<?php
// include header
include "header.php";

$createdDate = date('Y-m-d H:i:s');
$staffID = $_SESSION['supplierID'];

$productID = $_POST['productID'];
$soNo = $_POST['soNo'];
$productName = mysqli_real_escape_string($connect, $_POST['productName1']);
$qty = $_POST['qty'];
$price = $_POST['price'];
$note = mysqli_real_escape_string($connect, $_POST['desc']);
$soFaktur = $_SESSION['soFaktur'];

if ($productID != '' && $soNo != '' && $qty != ''){ 
    $isEload = mysqli_query($connect,  "SELECT categoryID FROM `as_products` WHERE `productID` = $productID;");
    $eLoad = mysqli_fetch_array($isEload);
    if ($eLoad['categoryID'] == 3) {
        $price = $price * 0.99;
    }
	$querySo = "INSERT INTO as_temp_detail_so (	soNo,
												soFaktur,
												productID,
												productName,
												price,
												qty,
												note,
												createdDate,
												createdUserID,
												modifiedDate,
												modifiedUserID)
										VALUES(	'$soNo',
												'$soFaktur',
												'$productID',
												'$productName',
												'$price',
												'$qty',
												'$note',
												'$createdDate',
												'$staffID',
												'',
												'')";	
	
	$sqlSo = mysqli_query($connect, $querySo);
	
	if ($sqlSo)
	{
		echo json_encode('OK');
	}
	
}
exit();
?>