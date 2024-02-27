<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_assembly.tpl";

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
	
	if ($module == 'assembly' && $act == 'edit')
	{
		// insert method into a variable
		$detailID = $_GET['detailID'];
		
		// showing up the assembly data based on detail id
		$queryAssembly = "SELECT * FROM as_temp_detail_assembly WHERE detailID = '$detailID'";
		$sqlAssembly = mysqli_query($connect, $queryAssembly);
		
		// fetch data
		$dataAssembly = mysqli_fetch_array($sqlAssembly);
		
		$queryProduct = "SELECT unitPrice1, unitPrice2, unitPrice3, productCode FROM as_products WHERE productID = '$dataAssembly[productID]'";
		$sqlProduct = mysqli_query($connect, $queryProduct);
		$dataProduct = mysqli_fetch_array($sqlProduct);
		
		// assign fetch data to the tpl
		$smarty->assign("detailID", $dataAssembly['detailID']);
		$smarty->assign("assemblyFaktur", $dataAssembly['assemblyFaktur']);
		$smarty->assign("productCode", $dataProduct['productCode']);
		$smarty->assign("productName", $dataAssembly['productName']);
		$smarty->assign("unitPrice1", rupiah($dataProduct['unitPrice1']));
		$smarty->assign("unitPrice2", rupiah($dataProduct['unitPrice2']));
		$smarty->assign("unitPrice3", rupiah($dataProduct['unitPrice3']));
		$smarty->assign("qty", $dataAssembly['qty']);
		$smarty->assign("price", $dataAssembly['price']);
		$smarty->assign("note", $dataAssembly['note']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>