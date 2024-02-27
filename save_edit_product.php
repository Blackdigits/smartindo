<?php
// include header
include "header.php";

$modified_date = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];
$productID = $_POST['productID'];
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
$picture = $_POST['picture'];
$minimumStock = mysqli_real_escape_string($connect, $_POST['minimumStock']);

if ($productID != '' && $productName != '' && $unit != '' && $purchasePrice != '' && $hpp != '' && $unitPrice1 != '' && $unitPrice2 != '' && $unitPrice3 != '' && $minimumStock != ''){
	
	// set image to thumbnail
	if ($image != '')
	{
		unlink("img/products/".$picture);
		unlink("img/products/thumb/small_".$picture);
		
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
			
		$queryProduct = "UPDATE as_products SET	productName = '$productName',
												categoryID = '$categoryID',
												unit = '$unit',
												unitPrice1 = '$unitPrice1',
												unitPrice2 = '$unitPrice2',
												unitPrice3 = '$unitPrice3',
												hpp = '$hpp',
												purchasePrice = '$purchasePrice',
												note = '$note',
												image = '$image',
												minimumStock = '$minimumStock',
												modifiedDate = '$modified_date',
												modifiedUserID = '$staffID'
												WHERE productID = '$productID'";
	}

	else
	{
		$queryProduct = "UPDATE as_products SET	productName = '$productName',
												categoryID = '$categoryID',
												unit = '$unit',
												unitPrice1 = '$unitPrice1',
												unitPrice2 = '$unitPrice2',
												unitPrice3 = '$unitPrice3',
												hpp = '$hpp',
												purchasePrice = '$purchasePrice',
												note = '$note',
												minimumStock = '$minimumStock',
												modifiedDate = '$modified_date',
												modifiedUserID = '$staffID'
												WHERE productID = '$productID'";
	}
	
	$sqlProduct = mysqli_query($connect, $queryProduct);
	
	if ($sqlProduct)
	{
		echo json_encode('OK');	
	}
}
exit();
?>