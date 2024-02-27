<?php
// include header
include "header.php";
// set the tpl page
$page = "product_autocomplete.tpl";

// if session is null, showing up the text and exit
if ($_SESSION['staffID'] == '' && $_SESSION['SPBfactoryID'] == '')
{
	// show up the text and exit
	echo "You have not authorization for access the modules.";
	exit();
}

else 
{	
	$staffID = $_SESSION['staffID'];
	$spbFaktur = $_SESSION['spbFaktur'];
	$q = mysqli_real_escape_string($connect, $_GET['q']);
	$queryProduct = "SELECT A.productID, A.productCode, A.hpp, A.productName, B.stock FROM as_products A INNER JOIN as_stock_products B ON B.productID=A.productID WHERE B.productID NOT IN (SELECT productID FROM `as_temp_detail_spb` WHERE spbFaktur = $spbFaktur) AND (A.productCode LIKE '%$q%' OR A.productName LIKE '%$q%') AND B.stock > 0 AND B.supplierID IS NULL AND B.factoryID = $_SESSION[SPBfactoryID]";
	$sqlProduct = mysqli_query($connect, $queryProduct);
	
	// fetch data
	while ($dtProduct = mysqli_fetch_array($sqlProduct))
	{					
		echo "$dtProduct[productCode] # $dtProduct[productName] # $dtProduct[productID] # $dtProduct[hpp] # $dtProduct[stock]\n";	
	}
}
?>