<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_factories.tpl";

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
	
	if ($module == 'factory' && $act == 'edit')
	{
		// insert method into a variable
		$factoryID = $_GET['factoryID'];
		
		// showing up the factory data based on factory id
		$queryFactory = "SELECT * FROM as_factories WHERE factoryID = '$factoryID'";
		$sqlFactory = mysqli_query($connect, $queryFactory);
		
		// fetch data
		$dataFactory = mysqli_fetch_array($sqlFactory);
		
		// assign fetch data to the tpl
		$smarty->assign("factoryID", $dataFactory['factoryID']);
		$smarty->assign("factoryCode", $dataFactory['factoryCode']);
		$smarty->assign("factoryName", $dataFactory['factoryName']);
		$smarty->assign("factoryType", $dataFactory['factoryType']);
		$smarty->assign("status", $dataFactory['status']);
		$smarty->assign("note", $dataFactory['note']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>