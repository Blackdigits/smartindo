<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_transfers.tpl";

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
	
	if ($module == 'transfer' && $act == 'edit')
	{
		// insert method into a variable
		$detailID = $_GET['detailID'];
		
		// showing up the transfer data based on transfer id
		$queryTransfer = "SELECT A.detailID, A.transferCode, A.transferFaktur, A.productID, A.productName, A.qty, A.note, B.productCode FROM as_temp_detail_transfers A INNER JOIN as_products B ON B.productID=A.productID WHERE A.detailID = '$detailID'";
		$sqlTransfer = mysqli_query($connect, $queryTransfer);
		
		// fetch data
		$dataTransfer = mysqli_fetch_array($sqlTransfer);
		
		// count transfer based on transferFaktur
		$showTransfer = "SELECT * FROM as_transfers WHERE transferFaktur = '$_SESSION[transferFaktur]'";
		$sqlTransfer = mysqli_query($connect, $showTransfer);
		$dtTransfer = mysqli_fetch_array($sqlTransfer);
		$numsTransfer = mysqli_num_rows($sqlTransfer);
		
		// find stock
		$queryStock = "SELECT stock FROM as_stock_products WHERE productID = '$dataTransfer[productID]' AND factoryID = '$dtTransfer[transferFrom]'";
		$sqlStock = mysqli_query($connect, $queryStock);
		$dataStock = mysqli_fetch_array($sqlStock);
		
		// assign fetch data to the tpl
		$smarty->assign("detailID", $dataTransfer['detailID']);
		$smarty->assign("transferCode", $dataTransfer['transferCode']);
		$smarty->assign("transferFaktur", $dataTransfer['transferFaktur']);
		$smarty->assign("productID", $dataTransfer['productID']);
		$smarty->assign("productCode", $dataTransfer['productCode']);
		$smarty->assign("productName", $dataTransfer['productName']);
		$smarty->assign("qty", $dataTransfer['qty']);
		$smarty->assign("stock", $dataStock['stock']);
		$smarty->assign("note", $dataTransfer['note']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>