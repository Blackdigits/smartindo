<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_in.tpl";

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
	
	if ($module == 'in' && $act == 'edit')
	{
		// insert method into a variable
		$detailID = $_GET['detailID'];
		$bbmNo = $_GET['bbmNo'];
		$val = explode("|", $_GET['valas']);
		$kursID = $val[0];
		$valas = $val[1];
		$kurs = $val[2];
		
		// showing up the category data based on category id
		$queryBbm = "SELECT * FROM as_detail_bbm WHERE detailID = '$detailID' AND bbmNo = '$bbmNo'";
		$sqlBbm = mysqli_query($connect, $queryBbm);
		
		// fetch data
		$dataBbm = mysqli_fetch_array($sqlBbm);
		
		// assign fetch data to the tpl
		$smarty->assign("detailID", $dataBbm['detailID']);
		$smarty->assign("productName", $dataBbm['productName']);
		$smarty->assign("bbmNo", $bbmNo);
		$smarty->assign("price", $dataBbm['price']);
		$smarty->assign("kursID", $kursID);
		$smarty->assign("valas", $valas);
		$smarty->assign("kurs", $kurs);
		$smarty->assign("kursrp", rupiah($kurs));
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>