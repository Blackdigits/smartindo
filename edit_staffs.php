<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_staffs.tpl";

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
	
	if ($module == 'staff' && $act == 'edit')
	{
		// insert method into a variable
		$staffID = $_GET['staffID'];
		
		// showing up the staff data based on staff id
		$queryStaff = "SELECT * FROM as_staffs WHERE staffID = '$staffID'";
		$sqlStaff = mysqli_query($connect, $queryStaff);
		
		// fetch data
		$dataStaff = mysqli_fetch_array($sqlStaff);
		
		// assign fetch data to the tpl
		$smarty->assign("staffID", $dataStaff['staffID']);
		$smarty->assign("staffCode", $dataStaff['staffCode']);
		$smarty->assign("staffName", $dataStaff['staffName']);
		$smarty->assign("address", $dataStaff['address']);
		$smarty->assign("address2", $dataStaff['address2']);
		$smarty->assign("village", $dataStaff['village']);
		$smarty->assign("district", $dataStaff['district']);
		$smarty->assign("city", $dataStaff['city']);
		$smarty->assign("zipCode", $dataStaff['zipCode']);
		$smarty->assign("province", $dataStaff['province']);
		$smarty->assign("phone", $dataStaff['phone']);
		$smarty->assign("position", $dataStaff['position']);
		$smarty->assign("part", $dataStaff['part']);
		$smarty->assign("statusStaff", $dataStaff['status']);
		$smarty->assign("level", $dataStaff['level']);
		$smarty->assign("photo", $dataStaff['photo']);
		$smarty->assign("email", $dataStaff['email']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>