<?php
// include header
include "header.php";
// set the tpl page
$page = "report_debts.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '21'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if the module is debt and act is search
	if ($module == 'debt' && $act == 'search')
	{
		$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
		$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
		$supplierID = $_GET['supplierID'];
		
		$smarty->assign("startDate", $sDate);
		$smarty->assign("endDate", $eDate);
		$smarty->assign("supplierID", $supplierID);
		
		$s2Date = explode("-", $sDate);
		$e2Date = explode("-", $eDate);
		
		$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
		$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
		
		// create new object pagination
		$p = new PaginationReportDebt;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the debts data
		if ($sDate != '' && $eDate != '')
		{
			if ($supplierID != '')
			{
				$queryDebt = "SELECT * FROM as_debts A INNER JOIN as_buy_transactions B ON A.invoiceID=B.invoiceID WHERE A.supplierID = '$supplierID' AND B.invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.createdDate DESC LIMIT $position,$limit";
			}
			else
			{
				$queryDebt = "SELECT * FROM as_debts A INNER JOIN as_buy_transactions B ON A.invoiceID=B.invoiceID WHERE B.invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.createdDate DESC LIMIT $position,$limit";
			}
						
		}
		else
		{
			if ($supplierID != '')
			{
				$queryDebt = "SELECT * FROM as_debts A INNER JOIN as_buy_transactions B ON A.invoiceID=B.invoiceID WHERE A.supplierID = '$supplierID' ORDER BY A.createdDate DESC LIMIT $position,$limit";
			}
			else
			{
				$queryDebt = "SELECT * FROM as_debts A INNER JOIN as_buy_transactions B ON A.invoiceID=B.invoiceID ORDER BY A.createdDate DESC LIMIT $position,$limit";
			}
		}
		
		$sqlDebt = mysqli_query($connect, $queryDebt);
		
		// fetch data
		$i = 1;
		while ($dtDebt = mysqli_fetch_array($sqlDebt))
		{
			$sisa = $dtDebt['debtTotal'] - ($dtDebt['incomingTotal'] + $dtDebt['reductionTotal']);
			
			if ($sisa <= 0)
			{
				$sisarp = 0;
			}
			else
			{
				$sisarp = rupiah($sisa);
			}
			
			$dataDebt[] = array(	'debtID' => $dtDebt['debtID'],
									'debtNo' => $dtDebt['debtNo'],
									'invoiceNo' => $dtDebt['invoiceNo'],
									'supplierName' => $dtDebt['supplierName'],
									'supplierID' => $dtDebt['supplierID'],
									'debtTotal' => rupiah($dtDebt['debtTotal']),
									'incomingTotal' => rupiah($dtDebt['incomingTotal']),
									'reductionTotal' => rupiah($dtDebt['reductionTotal']),
									'sisa' => $sisarp,
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataDebt", $dataDebt);
		
		// show the supplier data
		$querySupplier = "SELECT * FROM as_suppliers ORDER BY supplierName ASC";
		$sqlSupplier = mysqli_query($connect, $querySupplier);
		
		while ($dtSupplier = mysqli_fetch_array($sqlSupplier))
		{
			$dataSupplier[] = array('supplierID' => $dtSupplier['supplierID'],
									'supplierCode' => $dtSupplier['supplierCode'],
									'supplierName' => $dtSupplier['supplierName']);
		}
		
		$smarty->assign("dataSupplier", $dataSupplier);
		
		// count data
		if ($sDate != '' && $eDate != '')
		{
			if ($supplierID != '')
			{
				$queryCountDebt = "SELECT * FROM as_debts A INNER JOIN as_buy_transactions B ON A.invoiceID=B.invoiceID WHERE A.supplierID = '$supplierID' AND B.invoiceDate BETWEEN '$startDate' AND '$endDate'";
			}
			else
			{
				$queryCountDebt = "SELECT * FROM as_debts A INNER JOIN as_buy_transactions B ON A.invoiceID=B.invoiceID WHERE B.invoiceDate BETWEEN '$startDate' AND '$endDate'";
			}
						
		}
		else
		{
			if ($supplierID != '')
			{
				$queryCountDebt = "SELECT * FROM as_debts A INNER JOIN as_buy_transactions B ON A.invoiceID=B.invoiceID WHERE A.supplierID = '$supplierID'";
			}
			else
			{
				$queryCountDebt = "SELECT * FROM as_debts A INNER JOIN as_buy_transactions B ON A.invoiceID=B.invoiceID";
			}
		}
		
		$sqlCountDebt = mysqli_query($connect, $queryCountDebt);
		$amountData = mysqli_num_rows($sqlCountDebt);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Laporan Hutang Dagang");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melihat laporan hutang dagang.");
		$smarty->assign("breadcumbMenuName", "Laporan");
		$smarty->assign("breadcumbMenuSubName", "Hutang Dagang");
	} 
	
	else
	{
		// show the supplier data
		$querySupplier = "SELECT * FROM as_suppliers ORDER BY supplierName ASC";
		$sqlSupplier = mysqli_query($connect, $querySupplier);
		
		while ($dtSupplier = mysqli_fetch_array($sqlSupplier))
		{
			$dataSupplier[] = array('supplierID' => $dtSupplier['supplierID'],
									'supplierCode' => $dtSupplier['supplierCode'],
									'supplierName' => $dtSupplier['supplierName']);
		}
		
		$smarty->assign("dataSupplier", $dataSupplier);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Laporan Hutang Dagang");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melihat laporan hutang dagang.");
		$smarty->assign("breadcumbMenuName", "Laporan");
		$smarty->assign("breadcumbMenuSubName", "Hutang Dagang");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>