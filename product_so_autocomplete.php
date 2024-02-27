<?php
// include header
include "header.php";
// set the tpl page
$page = "product_so_autocomplete.tpl";

// if session is null, showing up the text and exit
if ($_SESSION['staffID'] == '' && $_SESSION['email'] == '')
{
	// show up the text and exit
	echo "You have not authorization for access the modules.";
	exit();
}

else 
{
	$q = mysqli_real_escape_string($connect, $_GET['q']);
	$customerID = $_SESSION['customerID'];
	$staffID = $_SESSION['supplierID'];
	
    if (isset($_SESSION['factory']) && is_numeric($_SESSION['factory'])){
        $queryProduct = "SELECT A.productID, A.productCode, A.unitPrice1, A.unitPrice2, A.unitPrice3, A.purchasePrice, A.productName, B.stock FROM as_products A INNER JOIN as_stock_products B ON B.productID=A.productID WHERE B.productID NOT IN (SELECT productID FROM `as_temp_detail_so` WHERE createdUserID = $staffID) AND (A.productCode LIKE '%$q%' OR A.productName LIKE '%$q%') AND B.factoryID = '$_SESSION[factory]' AND B.stock > 0";
    } else {
        $queryProduct = "SELECT A.productID, A.productCode, A.unitPrice1, A.unitPrice2, A.unitPrice3, A.purchasePrice, A.productName, B.stock FROM as_products A INNER JOIN as_stock_products B ON B.productID=A.productID WHERE B.productID NOT IN (SELECT productID FROM `as_temp_detail_so` WHERE createdUserID = $staffID) AND (A.productCode LIKE '%$q%' OR A.productName LIKE '%$q%') AND B.supplierID = '$staffID' AND B.stock > 0";
    }
    
	$sqlProduct = mysqli_query($connect, $queryProduct);
	
	// fetch data
	while ($dtProduct = mysqli_fetch_array($sqlProduct))
	{
		$sqlPrice = mysqli_query($connect, "SELECT A.price FROM as_detail_do A INNER JOIN as_sales_transactions B ON B.doNo=A.doNo WHERE A.productID = '$dtProduct[productID]' AND B.customerID = '$customerID' ORDER BY A.createdDate DESC LIMIT 1");
		$nums = mysqli_num_rows($sqlPrice); // SELECT A.disc1, A.disc2, A.disc3 FROM `as_customers` A WHERE A.`customerID` = 31;
		$dataPrice = mysqli_fetch_array($sqlPrice);
		
		$unitPrice1 = rupiah($dtProduct['unitPrice1']);
		$unitPrice2 = rupiah($dtProduct['unitPrice2']);
		$unitPrice3 = rupiah($dtProduct['unitPrice3']);
		
		if ($nums > 0)
		{
			$lastPrice = $dataPrice['price']; // if ada diskon kurangi
		}
		else
		{
			$lastPrice = 0; // kalau gk ada variable tetap
		}
							
		echo "$dtProduct[productCode] # $dtProduct[productName] # $dtProduct[productID] # $unitPrice1 # $unitPrice2 # $unitPrice3 # $dtProduct[purchasePrice] # $dtProduct[stock]\n";	
	}
}
?>