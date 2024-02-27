<?php
// include header
include "header.php";
// set the tpl page
$page = "product_autocomplete.tpl";

// if session is null, showing up the text and exit
if ($_SESSION['staffID'] == '' && $_SESSION['email'] == '')
{
	// show up the text and exit
	echo "You have not authorization for access the modules.";
	exit();
}

else 
{	
	$staffID = $_SESSION['staffID'];
	$bbmFaktur = $_SESSION['bbmFaktur'];
	$q = mysqli_real_escape_string($connect, $_GET['q']);
	$queryProduct = "SELECT A.productID, A.productCode, A.purchasePrice, A.productName FROM as_products A WHERE (A.productCode LIKE '%$q%' OR A.productName LIKE '%$q%') AND A.productID NOT IN (SELECT productID FROM `as_temp_detail_bbm` WHERE `bbmFaktur` = '$bbmFaktur')";
	$sqlProduct = mysqli_query($connect, $queryProduct);
	
	// fetch data
	while ($dtProduct = mysqli_fetch_array($sqlProduct))
	{					
		echo "$dtProduct[productCode] # $dtProduct[productName] # $dtProduct[productID] # $dtProduct[purchasePrice]\n";	
	}
}
?>