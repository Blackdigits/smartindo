<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_categories.tpl";

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
	
	if ($module == 'category' && $act == 'edit')
	{
		// insert method into a variable
		$categoryID = $_GET['categoryID'];
		
		// showing up the category data based on category id
		$queryCategory = "SELECT * FROM as_categories WHERE categoryID = '$categoryID'";
		$sqlCategory = mysqli_query($connect, $queryCategory);
		
		// fetch data
		$dataCategory = mysqli_fetch_array($sqlCategory);
		
		// assign fetch data to the tpl
		$smarty->assign("categoryID", $dataCategory['categoryID']);
		$smarty->assign("categoryName", $dataCategory['categoryName']);
		$smarty->assign("categoryStatus", $dataCategory['status']);
		$smarty->assign("categoryprivat", $dataCategory['privat']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>