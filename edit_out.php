<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_out.tpl";

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
	
	if ($module == 'out' && $act == 'edit')
	{
		// insert method into a variable
		$detailID = $_GET['detailID'];
		$doNo = $_GET['doNo'];
		$val = explode("|", $_GET['valas']);
		$kursID = $val[0];
		$valas = $val[1];
		$kurs = $val[2];
		
		// showing up the category data based on category id
		$queryDo = "SELECT * FROM as_detail_do WHERE doID = '$detailID' AND doNo = '$doNo'";
		$sqlDo = mysqli_query($connect, $queryDo);
		
		// fetch data
		$dataDo = mysqli_fetch_array($sqlDo);
		
		// assign fetch data to the tpl
		$smarty->assign("detailID", $dataDo['doID']);
		$smarty->assign("productName", $dataDo['productName']);
		$smarty->assign("doNo", $doNo);
		$smarty->assign("price", $dataDo['price']);
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