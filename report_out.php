<?php
// include header
include "header.php";
// set the tpl page
$page = "report_out.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '20'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	if ($module == 'out' && $act == 'search')
	{
		$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
		$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
		
		$smarty->assign("startDate", $sDate);
		$smarty->assign("endDate", $eDate);
		
		$s2Date = explode("-", $sDate);
		$e2Date = explode("-", $eDate);
		
		$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
		$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
		
		// create new object pagination
		$p = new PaginationReportOut;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the sales data
		if ($_GET['startDate'] != '' && $_GET['endDate'] != '')
		{
			$querySales = "SELECT A.*,B.customerName,B.staffName,SUM(A.price*A.qty) as total FROM as_detail_so A INNER JOIN as_sales_order B WHERE A.soNo = B.soNo and A.createdDate BETWEEN '$startDate' AND '$endDate' GROUP by A.soFaktur ORDER BY A.createdDate DESC LIMIT $position,$limit";
		}
		else
		{
			$querySales = "SELECT A.*,B.customerName,B.staffName,SUM(A.price*A.qty) as total FROM as_detail_so A INNER JOIN as_sales_order B WHERE A.soNo = B.soNo GROUP BY A.soFaktur ORDER BY A.createdDate DESC LIMIT $position,$limit";
		}
		
		$sqlSales = mysqli_query($connect, $querySales);
		
		// fetch data
		$i = 1 + $position;
		while ($dtSales = mysqli_fetch_array($sqlSales))
		{ /*
			if ($dtSales['paymentType'] == '1')
			{
				$paymentType = "TUNAI";
				$expiredPayment = "";
			}
			else
			{
				$paymentType = "TERMIN";
				$expiredPayment = tgl_indo2($dtSales['expiredPayment']);
			}
			
			if ($dtSales['ppnType'] == '1')
			{
				$ppnType = "PPN";
				$ppn = rupiah($dtSales['ppn']);
			}
			else
			{
				$ppnType = "NO PPN";
				$ppn = "";
			}
			*/
			$dataSales[] = array(	'invoiceID' => $dtSales['invoiceID'],
									'invoiceNo' => $dtSales['soFaktur'],
									'invoiceDate' => tgl_indo2($dtSales['createdDate']),
									'doNo' => $dtSales['customerName'],
									'soNo' => $dtSales['soNo'],
									'paymentType' => $paymentType,
									'expiredPayment' => $expiredPayment,
									'ppnType' => $ppnType,
									'ppn' => $ppn,
									'total' => rupiah($dtSales['total']),
									'grandtotal' => rupiah($dtSales['total']),
									'pay' => rupiah($dtSales['pay']),
									'staffID' => $dtSales['staffID'],
									'staffName' => $dtSales['staffName'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataSales", $dataSales);
		// count data
		if ($_GET['startDate'] != '' && $_GET['endDate'] != '')
		{
			$queryCountSales = "SELECT * FROM as_sales_transactions WHERE invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY invoiceNo DESC";
		}
		else
		{
			$queryCountSales = "SELECT * FROM as_sales_transactions ORDER BY invoiceNo DESC";
		}
		
		$sqlCountSales = mysqli_query($connect, $queryCountSales);
		$amountData = mysqli_num_rows($sqlCountSales);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Laporan Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melihat laporan transaksi penjualan.");
		$smarty->assign("breadcumbMenuName", "Laporan");
		$smarty->assign("breadcumbMenuSubName", "Penjualan");
	}
	
	else
	{
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Laporan Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melihat laporan transaksi penjualan.");
		$smarty->assign("breadcumbMenuName", "Laporan");
		$smarty->assign("breadcumbMenuSubName", "Penjualan");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>