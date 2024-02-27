<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_authorize.tpl";

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
	
	if ($module == 'authorize' && $act == 'edit')
	{
		// insert method into a variable
		$modulID = $_GET['modulID'];
		
		// showing up the modules data based on modul id
		$queryModul = "SELECT * FROM as_modules WHERE modulID = '$modulID'";
		$sqlModul = mysqli_query($connect, $queryModul);
		
		// fetch data
		$dataModul = mysqli_fetch_array($sqlModul);
		
		$authorize = explode(",", $dataModul['authorize']);
		
		// assign fetch data to the tpl
		$smarty->assign("modulID", $dataModul['modulID']);
		$smarty->assign("modulName", $dataModul['modulName']);
		$smarty->assign("status", $dataModul['status']);
		$smarty->assign("adm", $authorize[0]);
		$smarty->assign("sls", $authorize[1]);
		$smarty->assign("ksr", $authorize[2]);
		$smarty->assign("spv", $authorize[3]);
		$smarty->assign("top", $authorize[4]);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>