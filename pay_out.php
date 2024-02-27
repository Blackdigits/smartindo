<?php
// include header
include "header.php";
// set the tpl page
$page = "pay_out.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '27'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is pay out and action is delete
	if ($module == 'payout' && $act == 'delete')
	{
		// insert method into a variable
		$invoiceNo = $_GET['invoiceNo'];
		$paymentID = $_GET['paymentID'];
		$paymentNo = $_GET['paymentNo'];
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		$queryPayment = "SELECT total, invoiceID FROM as_sales_payments WHERE paymentID = '$paymentID' AND paymentNo = '$paymentNo'";
		$sqlPayment = mysqli_query($connect, $queryPayment);
		$dataPayment = mysqli_fetch_array($sqlPayment);
		
		$total = $dataPayment['total'];
		
		$queryUpdate = "UPDATE as_receivables SET incomingTotal=incomingTotal-$total WHERE invoiceNo = '$invoiceNo' AND invoiceID = '$dataPayment[invoiceID]'";
		$sqlUpdate = mysqli_query($connect, $queryUpdate);
		
		if ($sqlUpdate)
		{
			$queryPay = "DELETE FROM as_sales_payments WHERE paymentID = '$paymentID' AND paymentNo = '$paymentNo'";
			$sqlPay = mysqli_query($connect, $queryPay);
		}
		
		// redirect to the pay in page
		if ($q != '')
		{
			header("Location: pay_out.php?module=payout&act=search&q=".$q."&msg=Data transaksi penjualan berhasil dihapus");
		}
		else
		{
			header("Location: pay_out.php?msg=Data transaksi penjualan berhasil dihapus");
		}
	} // close bracket
	
	// if the module is pay out and act is input
	elseif ($module == 'payout' && $act == 'input')
	{
		$createdDate = date('Y-m-d H:i:s');
		$staffID = $_SESSION['staffID'];
		$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
		
		$paymentNo = $_POST['paymentNo'];
		$pDate = explode("-", $_POST['paymentDate']);
		$paymentDate = $pDate[2]."-".$pDate[1]."-".$pDate[0];
		$invoiceID = $_POST['invoiceID'];
		$invoiceNo = mysqli_real_escape_string($connect, $_POST['invoiceNo']);
		$soNo = $_POST['soNo'];
		$payType = $_POST['payType'];
		$bankNo = mysqli_real_escape_string($connect, $_POST['bankNo']);
		$bankName = mysqli_real_escape_string($connect, $_POST['bankName']);
		$bankAC = mysqli_real_escape_string($connect, $_POST['bankAC']);
		$eDate = explode("-", $_POST['effectiveDate']);
		$effectiveDate = $eDate[2]."-".$eDate[1]."-".$eDate[0];
		$total = mysqli_real_escape_string($connect, $_POST['total']);
		$customerID = $_POST['customerID'];
		$customerName = mysqli_real_escape_string($connect, $_POST['customerName']);
		$customerAddress = mysqli_real_escape_string($connect, $_POST['customerAddress']);
		$ref = mysqli_real_escape_string($connect, $_POST['ref']);
		$note = mysqli_real_escape_string($connect, $_POST['note']);
		
		// save in to the database
		$queryPay = "INSERT INTO as_sales_payments (paymentNo,
													invoiceID,
													invoiceNo,
													soNo,
													paymentDate,
													payType,
													bankNo,
													bankName,
													bankAC,
													effectiveDate,
													total,
													customerID,
													customerName,
													customerAddress,
													ref,
													note,
													staffID,
													staffName,
													createdDate,
													createdUserID,
													modifiedDate,
													modifiedUserID)
											VALUES(	'$paymentNo',
													'$invoiceID',
													'$invoiceNo',
													'$soNo',
													'$paymentDate',
													'$payType',
													'$bankNo',
													'$bankName',
													'$bankAC',
													'$effectiveDate',
													'$total',
													'$customerID',
													'$customerName',
													'$customerAddress',
													'$ref',
													'$note',
													'$staffID',
													'$sName',
													'$createdDate',
													'$staffID',
													'',
													'')";
		
		$sqlPay = mysqli_query($connect, $queryPay);
		
		$paymentID = mysqli_insert_id($connect);
		
		if ($sqlPay)
		{
			$queryUpdate = "UPDATE as_receivables SET incomingTotal=incomingTotal+$total WHERE invoiceNo = '$invoiceNo' AND invoiceID = '$invoiceID'";
			$sqlUpdate = mysqli_query($connect, $queryUpdate);
		}
		
		header("Location: pay_out.php?module=payout&act=finish&paymentNo=".$paymentNo."&paymentID=".$paymentID."&invoiceNo=".$invoiceNo);
	}
	
	// if the module is pay out and act is detail pay out
	elseif ($module == 'payout' && $act == 'detailpayout')
	{
		$paymentID = $_GET['paymentID'];
		$paymentNo = $_GET['paymentNo'];
		$invoiceNo = $_GET['invoiceNo'];
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		// show the sales transaction
		$querySales = "SELECT * FROM as_sales_transactions WHERE invoiceNo = '$invoiceNo'";
		$sqlSales = mysqli_query($connect, $querySales);
		$dataSales = mysqli_fetch_array($sqlSales);
		
		// show the receivables
		$queryReceive = "SELECT * FROM as_receivables WHERE invoiceNo = '$invoiceNo' AND invoiceID = '$dataBuy[invoiceID]'";
		$sqlReceive = mysqli_query($connect, $queryReceive);
		$dataReceive = mysqli_fetch_array($sqlReceive);
		
		// show the payment 
		$queryPay = "SELECT * FROM as_sales_payments WHERE paymentNo = '$paymentNo' AND paymentID = '$paymentID' AND invoiceNo = '$invoiceNo'";
		$sqlPay = mysqli_query($connect, $queryPay);
		$dataPay = mysqli_fetch_array($sqlPay);
		
		$queryTotal = "SELECT SUM(total) as total FROM as_sales_payments WHERE invoiceNo = '$invoiceNo'";
		$sqlTotal = mysqli_query($connect, $queryTotal);
		$dataTotal = mysqli_fetch_array($sqlTotal);
		
		// receive
		$receive = $dataTotal['total'] - $dataSales['grandtotal'];
		
		if ($dataPay['payType'] == '1')
		{
			$payType = "TUNAI";
		}
		elseif ($dataPay['payType'] == '2')
		{
			$payType = "TRANSFER";
		}
		elseif ($dataPay['payType'] == '3')
		{
			$payType = "CEK";
		}
		else
		{
			$payType = "GIRO";
		}
		
		if ($dataPay['effectiveDate'] == '0000-00-00')
		{
			$effectiveDate = "-";
		}
		else
		{
			$effectiveDate = tgl_indo2($dataPay['effectiveDate']);
		}
		
		// assign
		$smarty->assign("q", $q);
		$smarty->assign("paymentNo", $dataPay['paymentNo']);
		$smarty->assign("paymentID", $dataPay['paymentID']);
		$smarty->assign("paymentDate", tgl_indo2($dataPay['paymentDate']));
		$smarty->assign("invoiceNo", $dataPay['invoiceNo']);
		$smarty->assign("pay", rupiah($total));
		$smarty->assign("total", rupiah($dataPay['total']));
		$smarty->assign("receive", rupiah($receive));
		$smarty->assign("customerName", $dataSales['customerName']);
		$smarty->assign("customerAddress", $dataSales['customerAddress']);
		$smarty->assign("payType", $payType);
		$smarty->assign("bankNo", $dataPay['bankNo']);
		$smarty->assign("bankName", $dataPay['bankName']);
		$smarty->assign("effectiveDate", $effectiveDate);
		$smarty->assign("bankAC", $dataPay['bankAC']);
		$smarty->assign("total", rupiah($dataPay['total']));
		$smarty->assign("ref", $dataPay['ref']);
		$smarty->assign("note", $dataPay['note']);
		
		$smarty->assign("breadcumbTitle", "Pembayaran Transaksi Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pembayaran transaksi penjualan.");
		$smarty->assign("breadcumbMenuName", "Transaksi Penjualan");
		$smarty->assign("breadcumbMenuSubName", "Pembayaran Transaksi");
	}
	
	// if module out and act is finish
	elseif ($module == 'payout' && $act == 'finish')
	{
		$paymentNo = $_GET['paymentNo'];
		$paymentID = $_GET['paymentID'];
		$invoiceNo = $_GET['invoiceNo'];
		
		// show the sales transaction
		$querySales = "SELECT * FROM as_sales_transactions WHERE invoiceNo = '$invoiceNo'";
		$sqlSales = mysqli_query($connect, $querySales);
		$dataSales = mysqli_fetch_array($sqlSales);
		
		// show the receive
		$queryReceive = "SELECT * FROM as_receivables WHERE invoiceNo = '$invoiceNo' AND invoiceID = '$dataSales[invoiceID]'";
		$sqlReceive = mysqli_query($connect, $queryReceive);
		$dataReceive = mysqli_fetch_array($sqlReceive);
		
		// show the payment 
		$queryPay = "SELECT * FROM as_sales_payments WHERE paymentNo = '$paymentNo' AND paymentID = '$paymentID' AND invoiceNo = '$invoiceNo'";
		$sqlPay = mysqli_query($connect, $queryPay);
		$dataPay = mysqli_fetch_array($sqlPay);
		
		$queryTotal = "SELECT SUM(total) as total FROM as_sales_payments WHERE invoiceNo = '$invoiceNo'";
		$sqlTotal = mysqli_query($connect, $queryTotal);
		$dataTotal = mysqli_fetch_array($sqlTotal);
		
		// receive
		$receive = $dataSales['grandtotal'] - $dataTotal['total'];
		
		if ($dataPay['payType'] == '1')
		{
			$payType = "TUNAI";
		}
		elseif ($dataPay['payType'] == '2')
		{
			$payType = "TRANSFER";
		}
		elseif ($dataPay['payType'] == '3')
		{
			$payType = "CEK";
		}
		else
		{
			$payType = "GIRO";
		}
		
		if ($dataPay['effectiveDate'] == '0000-00-00')
		{
			$effectiveDate = "-";
		}
		else
		{
			$effectiveDate = tgl_indo2($dataPay['effectiveDate']);
		}
		
		// assign
		$smarty->assign("paymentNo", $dataPay['paymentNo']);
		$smarty->assign("paymentID", $dataPay['paymentID']);
		$smarty->assign("paymentDate", tgl_indo2($dataPay['paymentDate']));
		$smarty->assign("invoiceNo", $dataPay['invoiceNo']);
		$smarty->assign("pay", rupiah($total));
		$smarty->assign("total", rupiah($dataPay['total']));
		$smarty->assign("receive", rupiah($receive));
		$smarty->assign("customerName", $dataSales['customerName']);
		$smarty->assign("customerAddress", $dataSales['customerAddress']);
		$smarty->assign("payType", $payType);
		$smarty->assign("bankNo", $dataPay['bankNo']);
		$smarty->assign("bankName", $dataPay['bankName']);
		$smarty->assign("effectiveDate", $effectiveDate);
		$smarty->assign("bankAC", $dataPay['bankAC']);
		$smarty->assign("total", rupiah($dataPay['total']));
		$smarty->assign("ref", $dataPay['ref']);
		$smarty->assign("note", $dataPay['note']);
		
		$smarty->assign("breadcumbTitle", "Pembayaran Transaksi Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pembayaran transaksi penjualan.");
		$smarty->assign("breadcumbMenuName", "Transaksi Penjualan");
		$smarty->assign("breadcumbMenuSubName", "Pembayaran Transaksi");
	}
	
	// if the module out and act is add
	elseif ($module == 'payout' && $act == 'add')
	{
		$invoiceNo = mysqli_real_escape_string($connect, $_GET['invoiceNo']);
		
		// get last sort out number pay ID
		$queryNoPayOut = "SELECT paymentNo FROM as_sales_payments ORDER BY paymentNo DESC LIMIT 1";
		$sqlNoPayOut = mysqli_query($connect, $queryNoPayOut);
		$numsNoPayOut = mysqli_num_rows($sqlNoPayOut);
		$dataNoPayOut = mysqli_fetch_array($sqlNoPayOut);
		
		$start = substr($dataNoPayOut['paymentNo'],2-7);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoPayOut == '0')
		{
			$outNo = "00000";
		}
		elseif ($tempNo == 1)
		{
			$outNo = "00000";
		}
		elseif ($tempNo == 2)
		{
			$outNo = "0000";
		}
		elseif ($tempNo == 3)
		{
			$outNo = "000";
		}
		elseif ($tempNo == 4)
		{
			$outNo = "00";
		}
		elseif ($tempNo == 5)
		{
			$outNo = "0";
		}
		elseif ($tempNo == 6)
		{
			$outNo = "";
		}
		
		$payOutNo = "PJ".$outNo.$next;
		
		// showing up the customer
		$queryCustomer = "SELECT * FROM as_staffs ORDER BY staffName ASC;";
		$sqlCustomer = mysqli_query($connect, $queryCustomer);
		while ($dtCustomer = mysqli_fetch_array($sqlCustomer))
		{
			$dataCustomer[] = array('customerID' => $dtCustomer['staffID'],
									'customerCode' => $dtCustomer['staffCode'],
									'customerName' => $dtCustomer['staffName']);
		}
		
		$smarty->assign("dataCustomer", $dataCustomer);

		// total grandtotal
		$queryTotal = "SELECT grandtotal, invoiceID, soNo, customerID, customerName, customerAddress FROM as_sales_transactions WHERE invoiceNo = '$invoiceNo'";
		$sqlTotal = mysqli_query($connect, $queryTotal);
		$numsTotal = mysqli_num_rows($sqlTotal);
		$dataTotal = mysqli_fetch_array($sqlTotal);
		
		// count payment
		$queryPay = "SELECT SUM(total) as total FROM as_sales_payments WHERE invoiceNo = '$invoiceNo'";
		$sqlPay = mysqli_query($connect, $queryPay);
		$dataPay = mysqli_fetch_array($sqlPay);
		
		$receive = $dataTotal['grandtotal'] - $dataPay['total'];
		
		$smarty->assign("payOutNo", $payOutNo);
		$smarty->assign("payOutDate", tgl_indo2(date('Y-m-d')));
		$smarty->assign("invoiceNo", $invoiceNo);
		$smarty->assign("invoiceID", $dataTotal['invoiceID']);
		$smarty->assign("numsTotal", $numsTotal);
		$smarty->assign("soNo", $dataTotal['soNo']);
		$smarty->assign("receive", rupiah($receive));
		$smarty->assign("receiveo", $receive);
		$smarty->assign("customerID", $dataTotal['customerID']);
		$smarty->assign("customerName", $dataTotal['customerName']);
		$smarty->assign("customerAddress", $dataTotal['customerAddress']);
				
		$smarty->assign("breadcumbTitle", "Transaksi Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi penjualan, faktur penjualan.");
		$smarty->assign("breadcumbMenuName", "Transaksi Penjualan");
		$smarty->assign("breadcumbMenuSubName", "Transaksi Penjualan");
	}

	elseif ($module == 'payout' && $act == 'search')
	{
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
		$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
		
		$smarty->assign("startDate", $sDate);
		$smarty->assign("endDate", $eDate);
		
		$s2Date = explode("-", $sDate);
		$e2Date = explode("-", $eDate);
		
		$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
		$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
		
		// showing up the pay out data
		if ($sDate != '' && $eDate != '')
		{
			$queryPay = "SELECT * FROM as_sales_payments WHERE paymentNo LIKE '%$q%' AND paymentDate BETWEEN '$startDate' AND '$endDate' ORDER BY paymentDate DESC";
		}
		else
		{
			$queryPay = "SELECT * FROM as_sales_payments WHERE paymentNo LIKE '%$q%' ORDER BY paymentDate DESC";
		}
		
		$sqlPay = mysqli_query($connect, $queryPay);
		
		// fetch data
		$i = 1 + $position;
		while ($dtPay = mysqli_fetch_array($sqlPay))
		{
			if ($dtPay['payType'] == '1')
			{
				$payType = "TUNAI";
				$effectiveDate = "";
			}
			else
			{
				$payType = "CEK";
				$effectiveDate = tgl_indo2($dtPay['effectiveDate']);
			}
			
			$dataPay[] = array(	'paymentID' => $dtPay['paymentID'],
								'invoiceNo' => $dtPay['invoiceNo'],
								'invoiceID' => $dtPay['invoiceID'],
								'paymentNo' => $dtPay['paymentNo'],
								'paymentDate' => tgl_indo2($dtPay['paymentDate']),
								'payType' => $payType,
								'invoiceNo' => $dtPay['invoiceNo'],
								'soNo' => $dtPay['soNo'],
								'cek' => $dtPay['bankNo'],
								'total' => rupiah($dtPay['total']),
								'customerName' => $dtPay['customerName'],
								'staffName' => $dtPay['staffName'],
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataPay", $dataPay);
		$smarty->assign("q", $q);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Pembayaran Transaksi Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pembayaran transaksi penjualan.");
		$smarty->assign("breadcumbMenuName", "Transaksi Penjualan");
		$smarty->assign("breadcumbMenuSubName", "Pembayaran Transaksi");
	}
	
	else
	{
		// create new object pagination
		$p = new PaginationPayOut;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the pay out data
		$queryPay = "SELECT * FROM as_sales_payments ORDER BY paymentDate DESC LIMIT $position,$limit";
		$sqlPay = mysqli_query($connect, $queryPay);
		
		// fetch data
		$i = 1 + $position;
		while ($dtPay = mysqli_fetch_array($sqlPay))
		{
			if ($dtPay['payType'] == '1')
			{
				$payType = "TUNAI";
				$effectiveDate = "";
			}
			else
			{
				$payType = "CEK";
				$effectiveDate = tgl_indo2($dtPay['effectiveDate']);
			}
			
			$dataPay[] = array(	'paymentID' => $dtPay['paymentID'],
								'invoiceNo' => $dtPay['invoiceNo'],
								'invoiceID' => $dtPay['invoiceID'],
								'paymentNo' => $dtPay['paymentNo'],
								'paymentDate' => tgl_indo2($dtPay['paymentDate']),
								'payType' => $payType,
								'soNo' => $dtPay['soNo'],
								'invoiceNo' => $dtPay['invoiceNo'],
								'cek' => $dtPay['bankNo'],
								'total' => rupiah($dtPay['total']),
								'customerName' => $dtPay['customerName'],
								'staffName' => $dtPay['staffName'],
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataPay", $dataPay);
		
		// count data
		$queryCountPay = "SELECT * FROM as_sales_payments";
		$sqlCountPay = mysqli_query($connect, $queryCountPay);
		$amountData = mysqli_num_rows($sqlCountPay);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Pembayaran Transaksi Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pembayaran transaksi penjualan.");
		$smarty->assign("breadcumbMenuName", "Transaksi Penjualan");
		$smarty->assign("breadcumbMenuSubName", "Pembayaran Transaksi");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>