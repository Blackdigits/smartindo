<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_kurs.tpl";

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
	
	if ($module == 'kurs' && $act == 'edit')
	{
		// insert method into a variable
		$currencyID = $_GET['currencyID'];
		
		// showing up the currency data based on currency id
		$queryCurrency = "SELECT * FROM as_kurs WHERE kursID = '$currencyID'";
		$sqlCurrency = mysqli_query($connect, $queryCurrency);
		
		// fetch data
		$dataCurrency = mysqli_fetch_array($sqlCurrency);
		
		// assign fetch data to the tpl
		$smarty->assign("kursID", $dataCurrency['kursID']);
		$smarty->assign("valas", $dataCurrency['valas']);
		$smarty->assign("kurs", $dataCurrency['kurs']);
		$smarty->assign("status", $dataCurrency['status']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>