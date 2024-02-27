<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_stock.tpl";

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
    $level = $_SESSION['level'];
	$act = $_GET['act'];
	
	if ($module == 'product' && $act == 'stock' && $level == 1)
	{
		// insert method into a variable
		$productID = $_GET['productID'];
		
		// showing up the factory data based on product id
		$queryProduct = "SELECT A.productID, A.productCode, A.unit, A.unitPrice1, A.unitPrice2, A.unitPrice3, A.hpp, A.productName, B.categoryName FROM as_products A LEFT JOIN as_categories B ON B.categoryID=A.categoryID WHERE A.productID = '$productID'";
		$sqlProduct = mysqli_query($connect, $queryProduct);
		
		// fetch data
		$dataProduct = mysqli_fetch_array($sqlProduct);
		
		if ($dataProduct['unit'] == '1')
		{
			$unit = "SET";
		}
		else
		{
			$unit = "PCS";
		}
		
		// assign fetch data to the tpl
		$smarty->assign("productID", $dataProduct['productID']);
		$smarty->assign("productCode", $dataProduct['productCode']);
		$smarty->assign("productName", $dataProduct['productName']);
		$smarty->assign("categoryName", $dataProduct['categoryName']);
		$smarty->assign("unit", $unit);
		$smarty->assign("unitPrice1", rupiah($dataProduct['unitPrice1']));
		$smarty->assign("unitPrice2", rupiah($dataProduct['unitPrice2']));
		$smarty->assign("unitPrice3", rupiah($dataProduct['unitPrice3']));
		$smarty->assign("hpp", rupiah($dataProduct['hpp']));
		
		// showing up the stock @ factory
		$queryFactory = "SELECT * FROM as_factories WHERE status = 'Y' ORDER BY factoryName ASC";
		$sqlFactory = mysqli_query($connect, $queryFactory);
		$nums = mysqli_num_rows($sqlFactory);
		
		// fetch data
		$i = 1;
		while ($dtFactory = mysqli_fetch_array($sqlFactory))
		{
			$queryStock = "SELECT * FROM as_stock_products WHERE productID = '$productID' AND factoryID = '$dtFactory[factoryID]' AND supplierID IS NULL";
			$sqlStock = mysqli_query($connect, $queryStock);
			$dataStock = mysqli_fetch_array($sqlStock);
			
			$dataFactory[] = array(	'factoryID' => $dtFactory['factoryID'],
									'factoryCode' => $dtFactory['factoryCode'],
									'factoryName' => $dtFactory['factoryName'],
									'stock' => $dataStock['stock'],
									'no' => $i);
			$i++;
		}
		
		// assign fetch data to the tpl
		$smarty->assign("dataFactory", $dataFactory);
		$smarty->assign("numsFactory", $nums);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>