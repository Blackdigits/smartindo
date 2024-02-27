<?php
// include header
include "header.php";
// set the tpl page
$page = "report_in.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '19'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	if ($module == 'in' && $act == 'search')
	{
		$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
		$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
		
		$smarty->assign("startDate", $sDate);
		$smarty->assign("endDate", $eDate);
		
		$s2Date = explode("-", $sDate);
		$e2Date = explode("-", $eDate);
		
		$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
		$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
		
		$p = new PaginationReportIn;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the buy data
		if ($_GET['startDate'] != '' || $_GET['endDate'] != '')
		{
			$queryBuy = "SELECT * FROM as_buy_transactions WHERE invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY invoiceNo DESC LIMIT $position,$limit";
		}
		else
		{
			$queryBuy = "SELECT * FROM as_buy_transactions ORDER BY invoiceNo DESC LIMIT $position,$limit";	
		}
		$sqlBuy = mysqli_query($connect, $queryBuy);
		
		// fetch data
		$i = 1 + $position;
		while ($dtBuy = mysqli_fetch_array($sqlBuy))
		{
			if ($dtBuy['paymentType'] == '1')
			{
				$paymentType = "TUNAI";
				$expiredPayment = "";
			}
			else
			{
				$paymentType = "TERMIN";
				$expiredPayment = tgl_indo2($dtBuy['expiredPayment']);
			}
			
			if ($dtBuy['ppnType'] == '1')
			{
				$ppnType = "PPN";
				$ppn = rupiah($dtBuy['ppn']);
			}
			else
			{
				$ppnType = "NO PPN";
				$ppn = "";
			}
			
			$dataBuy[] = array(	'invoiceID' => $dtBuy['invoiceID'],
								'invoiceNo' => $dtBuy['invoiceNo'],
								'invoiceDate' => tgl_indo2($dtBuy['invoiceDate']),
								'bbmNo' => $dtBuy['bbmNo'],
								'spbNo' => $dtBuy['spbNo'],
								'paymentType' => $paymentType,
								'expiredPayment' => $expiredPayment,
								'ppnType' => $ppnType,
								'ppn' => $ppn,
								'total' => rupiah($dtBuy['total']),
								'grandtotal' => rupiah($dtBuy['grandtotal']),
								'pay' => rupiah($dtBuy['pay']),
								'staffID' => $dtBuy['staffID'],
								'staffName' => $dtBuy['staffName'],
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataBuy", $dataBuy);
		
		if ($_GET['startDate'] != '' || $_GET['endDate'] != '')
		{
			$queryCountBuy = "SELECT * FROM as_buy_transactions WHERE invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY invoiceNo DESC";
		}
		else
		{
			$queryCountBuy = "SELECT * FROM as_buy_transactions ORDER BY invoiceNo DESC";	
		}
		$sqlCountBuy = mysqli_query($connect, $queryCountBuy);
		$amountData = mysqli_num_rows($sqlCountBuy);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Laporan Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melihat laporan transaksi pembelian.");
		$smarty->assign("breadcumbMenuName", "Laporan");
		$smarty->assign("breadcumbMenuSubName", "Pembelian");
	}
	
	else
	{
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Laporan Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melihat laporan transaksi pembelian.");
		$smarty->assign("breadcumbMenuName", "Laporan");
		$smarty->assign("breadcumbMenuSubName", "Pembelian");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>