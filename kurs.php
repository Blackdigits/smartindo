<?php
// include header
include "header.php";
// set the tpl page
$page = "kurs.tpl";

$module = $_GET['module'];
$act = $_GET['act'];

// if session is null, showing up the text and exit
if ($_SESSION['staffID'] == '' && $_SESSION['email'] == '')
{
	// show up the text and exit
	echo "Anda tidak berhak akses modul ini.";
	exit();
}

else 
{
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '3'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is kurs and action is delete
	if ($module == 'kurs' && $act == 'delete')
	{
		// insert method into a variable
		$currencyID = $_GET['currencyID'];
		
		// delete currency
		$queryCurrency = "DELETE FROM as_kurs WHERE kursID = '$currencyID'";
		$sqlCurrency = mysqli_query($connect, $queryCurrency);
		
		// redirect to the currency page
		header("Location: kurs.php?msg=Data kurs berhasil dihapus");
	} // close bracket
	
	else
	{
		// create new object pagination
		$p = new PaginationKurs;
		// limit 20 data for page
		$limit  = 20;
		$position = $p->searchPosition($limit);
		
		// showing up the kurs data
		$queryCurrency = "SELECT * FROM as_kurs ORDER BY kursID ASC LIMIT $position,$limit";
		$sqlCurrency = mysqli_query($connect, $queryCurrency);
		
		// fetch data
		$i = 1 + $position;
		while ($dtCurrency = mysqli_fetch_array($sqlCurrency))
		{
			$dataCurrency[] = array('kursID' => $dtCurrency['kursID'],
									'valas' => $dtCurrency['valas'],
									'kurs' => rupiah($dtCurrency['kurs']),
									'status' => $dtCurrency['status'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataCurrency", $dataCurrency);
		
		// count data
		$queryCountCurrency = "SELECT * FROM as_kurs";
		$sqlCountCurrency = mysqli_query($connect, $queryCountCurrency);
		$amountData = mysqli_num_rows($sqlCountCurrency);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
	}
	
	$smarty->assign("msg", $_GET['msg']);
	$smarty->assign("breadcumbTitle", "Manajemen Kurs / Valas");
	$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan data master kurs valuta asing.");
	$smarty->assign("breadcumbMenuName", "Master Data");
	$smarty->assign("breadcumbMenuSubName", "Kurs / Valas");
}

// include footer
include "footer.php";
?>