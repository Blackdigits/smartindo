<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_suppliers.tpl";

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
	
	if ($module == 'supplier' && $act == 'edit')
	{
		// insert method into a variable
		$supplierID = $_GET['supplierID'];
		
		// showing up the supplier data based on supplier id
		$querySupplier = "SELECT * FROM as_suppliers WHERE supplierID = '$supplierID'";
		$sqlSupplier = mysqli_query($connect, $querySupplier);
		
		// fetch data
		$dataSupplier = mysqli_fetch_array($sqlSupplier);
		
		// assign fetch data to the tpl
		$smarty->assign("supplierID", $dataSupplier['supplierID']);
		$smarty->assign("supplierCode", $dataSupplier['supplierCode']);
		$smarty->assign("supplierName", $dataSupplier['supplierName']);
		$smarty->assign("address", $dataSupplier['address']);
		$smarty->assign("city", $dataSupplier['city']);
		$smarty->assign("phone", $dataSupplier['phone']);
		$smarty->assign("fax", $dataSupplier['fax']);
		$smarty->assign("contactPerson", $dataSupplier['contactPerson']);
		$smarty->assign("email", $dataSupplier['email']);
		$smarty->assign("otorisasi", $dataSupplier['privat']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>