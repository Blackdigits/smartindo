<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_customers.tpl";

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
	
	if ($module == 'customer' && $act == 'edit')
	{
		// insert method into a variable
		$customerID = $_GET['customerID'];
		
		// showing up the customer data based on customer id
		$queryCustomer = "SELECT * FROM as_customers WHERE customerID = '$customerID'";
		$sqlCustomer = mysqli_query($connect, $queryCustomer);
		
		// fetch data
		$dataCustomer = mysqli_fetch_array($sqlCustomer);
		
		// assign fetch data to the tpl
		$smarty->assign("customerID", $dataCustomer['customerID']);
		$smarty->assign("customerCode", $dataCustomer['customerCode']);
		$smarty->assign("customerName", $dataCustomer['customerName']);
		$smarty->assign("contactPerson", $dataCustomer['contactPerson']);
		$smarty->assign("address", $dataCustomer['address']);
		$smarty->assign("address2", $dataCustomer['address2']);
		$smarty->assign("village", $dataCustomer['village']);
		$smarty->assign("district", $dataCustomer['district']);
		$smarty->assign("city", $dataCustomer['city']);
		$smarty->assign("zipCode", $dataCustomer['zipCode']);
		$smarty->assign("province", $dataCustomer['province']);
		$smarty->assign("phone1", $dataCustomer['phone1']);
		$smarty->assign("phone2", $dataCustomer['phone2']);
		$smarty->assign("phone3", $dataCustomer['phone3']);
		$smarty->assign("fax1", $dataCustomer['fax1']);
		$smarty->assign("fax2", $dataCustomer['fax2']);
		$smarty->assign("fax3", $dataCustomer['fax3']);
		$smarty->assign("phonecp1", $dataCustomer['phonecp1']);
		$smarty->assign("phonecp2", $dataCustomer['phonecp2']);
		$smarty->assign("email", $dataCustomer['email']);
		$smarty->assign("limitBalance", $dataCustomer['limitBalance']);
		$smarty->assign("disc1", $dataCustomer['disc1']);
		$smarty->assign("disc2", $dataCustomer['disc2']);
		$smarty->assign("disc3", $dataCustomer['disc3']);
		$smarty->assign("note", $dataCustomer['note']);
		$smarty->assign("npwp", $dataCustomer['npwp']);
		$smarty->assign("pkpName", $dataCustomer['pkpName']);
		$smarty->assign("staffCode", $dataCustomer['staffCode']);
		$smarty->assign("privat", $dataCustomer['otorisasi']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>