<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_products.tpl";

// if session is null, showing up the text and exit
if ($_SESSION['staffID'] == '' && $_SESSION['email'] == '')
{
	// show up the text and exit
	echo "Anda tidak berhak akses modul ini.";
	exit();
}

else 
{
	// get variable
	$module = $_GET['module'];
	$act = $_GET['act'];
	
	if ($module == 'product' && $act == 'edit')
	{
		// insert method into a variable
		$productID = $_GET['productID'];
		
		// showing up the product data based on product id
		$queryProduct = "SELECT * FROM as_products WHERE productID = '$productID'";
		$sqlProduct = mysqli_query($connect, $queryProduct);
		
		// fetch data
		$dataProduct = mysqli_fetch_array($sqlProduct);
		
		// assign fetch data to the tpl
		$smarty->assign("productID", $dataProduct['productID']);
		$smarty->assign("productCode", $dataProduct['productCode']);
		$smarty->assign("productName", $dataProduct['productName']);
		$smarty->assign("categoryID", $dataProduct['categoryID']);
		$smarty->assign("unit", $dataProduct['unit']);
		$smarty->assign("unitPrice1", $dataProduct['unitPrice1']);
		$smarty->assign("unitPrice2", $dataProduct['unitPrice2']);
		$smarty->assign("unitPrice3", $dataProduct['unitPrice3']);
		$smarty->assign("hpp", $dataProduct['hpp']);
		$smarty->assign("purchasePrice", $dataProduct['purchasePrice']);
		$smarty->assign("note", $dataProduct['note']);
		$smarty->assign("stockAmount", $dataProduct['stockAmount']);
		$smarty->assign("image", $dataProduct['image']);
		$smarty->assign("minimumStock", $dataProduct['minimumStock']);
		
		// showing up the categories data 
		$queryCategory = "SELECT * FROM as_categories WHERE status = 'Y' ORDER BY categoryName ASC";
		$sqlCategory = mysqli_query($connect, $queryCategory);
		
		// fetch data
		while ($dtCategory = mysqli_fetch_array($sqlCategory))
		{
			$dataCategory[] = array('categoryID' => $dtCategory['categoryID'],
									'categoryName' => $dtCategory['categoryName']);
		}
		
		// assign to the tpl file
		$smarty->assign("dataCategory", $dataCategory);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>