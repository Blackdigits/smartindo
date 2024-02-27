<?php
// include header
include "header.php";

$createdDate = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];
$productCode = $_POST['productCode'];
$productName = mysqli_real_escape_string($connect, $_POST['productName']);
$categoryID = $_POST['categoryID'];
$unit = $_POST['unit'];
$unitPrice1 = mysqli_real_escape_string($connect, $_POST['unitPrice1']);
$unitPrice2 = mysqli_real_escape_string($connect, $_POST['unitPrice2']);
$unitPrice3 = mysqli_real_escape_string($connect, $_POST['unitPrice3']);
$hpp = mysqli_real_escape_string($connect, $_POST['hpp']);
$purchasePrice = mysqli_real_escape_string($connect, $_POST['purchasePrice']);
$note = mysqli_real_escape_string($connect, $_POST['note']);
$image = $_POST['image'];
$minimumStock = mysqli_real_escape_string($connect, $_POST['minimumStock']);


if ($productCode != '' && $productName != '' && $unit != '' && $purchasePrice != '' && $hpp != '' && $unitPrice1 != '' && $unitPrice2 != '' && $unitPrice3 != '' && $minimumStock != ''){
	
	// set image to thumbnail
	if ($image != '')
	{
		$file = "img/products/".$image;
		$realPic = imagecreatefromjpeg($file);
		$width = imagesx($realPic);
		$height = imagesy($realPic);
		
		$thumbWidth = 100;
		$thumbHeight = 70;
		
		$thumbPic = imagecreatetruecolor($thumbWidth, $thumbHeight);
		imagecopyresampled($thumbPic, $realPic, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
		
		imagejpeg($thumbPic, "img/products/thumb/small_".$image);
		
		imagedestroy($realPic);
		imagedestroy($thumbPic);
	} // close bracket
		
	$queryProduct = "INSERT INTO as_products(	productCode,
												productName,
												categoryID,
												unit,
												unitPrice1,
												unitPrice2,
												unitPrice3,
												hpp,
												purchasePrice,
												note,
												image,
												minimumStock,
												createdDate,
												createdUserID,
												modifiedDate,
												modifiedUserID)
										VALUES(	'$productCode',
												'$productName',
												'$categoryID',
												'$unit',
												'$unitPrice1',
												'$unitPrice2',
												'$unitPrice3',
												'$hpp',
												'$purchasePrice',
												'$note',
												'$image',
												'$minimumStock',
												'$createdDate',
												'$staffID',
												'',
												'')";
											
	$sqlProduct = mysqli_query($connect, $queryProduct);
	
	if ($sqlProduct)
	{
		echo json_encode('OK');
	}
	
}
exit();
?>