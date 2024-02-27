<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_spb.tpl";

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
	
	if ($module == 'spb' && $act == 'edit')
	{
		// insert method into a variable
		$detailID = $_GET['detailID'];
		
		// showing up the spb data based on spb id
		$querySpb = "SELECT * FROM as_temp_detail_spb WHERE detailID = '$detailID'";
		$sqlSpb = mysqli_query($connect, $querySpb);
		
		// fetch data
		$dataSpb = mysqli_fetch_array($sqlSpb);
		
		// count spb based on spbFaktur
		$showSpb = "SELECT * FROM as_spb WHERE spbFaktur = '$_SESSION[spbFaktur]'";
		$sqlSpb = mysqli_query($connect, $showSpb);
		$dtSpb = mysqli_fetch_array($sqlSpb);
		$numsTransfer = mysqli_num_rows($sqlTransfer);
		
		// assign fetch data to the tpl
		$smarty->assign("detailID", $dataSpb['detailID']);
		$smarty->assign("spbNo", $dataSpb['spbNo']);
		$smarty->assign("spbFaktur", $dataSpb['spbFaktur']);
		$smarty->assign("productID", $dataSpb['productID']);
		$smarty->assign("productName", $dataSpb['productName']);
		$smarty->assign("qty", $dataSpb['qty']);
		$smarty->assign("price", $dataSpb['price']);
		$smarty->assign("note", $dataSpb['note']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>