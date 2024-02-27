<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_so.tpl";

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
	
	if ($module == 'so' && $act == 'edit')
	{
		// insert method into a variable
		$detailID = $_GET['detailID'];
		
		// showing up the sales order data based on sales order id
		$querySo = "SELECT * FROM as_temp_detail_so WHERE detailID = '$detailID'";
		$sqlSo = mysqli_query($connect, $querySo);
		
		// fetch data
		$dataSo = mysqli_fetch_array($sqlSo);
		
		// count sales order based on soFaktur
		$showSo = "SELECT * FROM as_sales_order WHERE soFaktur = '$_SESSION[soFaktur]'";
		$sqlSo = mysqli_query($connect, $showSo);
		$dtSo = mysqli_fetch_array($sqlSo);
		$numsSo = mysqli_num_rows($sqlSo);
		
		$queryProduct = "SELECT unitPrice1, unitPrice2, unitPrice3, productCode FROM as_products WHERE productID = '$dataSo[productID]'";
		$sqlProduct = mysqli_query($connect, $queryProduct);
		$dataProduct = mysqli_fetch_array($sqlProduct);
		
		// assign fetch data to the tpl
		$smarty->assign("detailID", $dataSo['detailID']);
		$smarty->assign("soNo", $dataSo['soNo']);
		$smarty->assign("soFaktur", $dataSo['soFaktur']);
		$smarty->assign("productID", $dataProduct['productCode']);
		$smarty->assign("productName", $dataSo['productName']);
		$smarty->assign("unitPrice1", rupiah($dataProduct['unitPrice1']));
		$smarty->assign("unitPrice2", rupiah($dataProduct['unitPrice2']));
		$smarty->assign("unitPrice3", rupiah($dataProduct['unitPrice3']));
		$smarty->assign("qty", $dataSo['qty']);
		$smarty->assign("price", $dataSo['price']);
		$smarty->assign("note", $dataSo['note']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>