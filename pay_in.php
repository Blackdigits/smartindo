<?php
// include header
include "header.php";
// set the tpl page
$page = "pay_in.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '26'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is pay in and action is delete
	if ($module == 'payin' && $act == 'delete')
	{
		// insert method into a variable
		$invoiceNo = $_GET['invoiceNo'];
		$paymentID = $_GET['paymentID'];
		$paymentNo = $_GET['paymentNo'];
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		$queryPayment = "SELECT total, invoiceID FROM as_buy_payments WHERE paymentID = '$paymentID' AND paymentNo = '$paymentNo'";
		$sqlPayment = mysqli_query($connect, $queryPayment);
		$dataPayment = mysqli_fetch_array($sqlPayment);
		
		$total = $dataPayment['total'];
		
		$queryUpdate = "UPDATE as_debts SET incomingTotal=incomingTotal-$total WHERE invoiceNo = '$invoiceNo' AND invoiceID = '$dataPayment[invoiceID]'";
		$sqlUpdate = mysqli_query($connect, $queryUpdate);
		
		if ($sqlUpdate)
		{
			$queryPay = "DELETE FROM as_buy_payments WHERE paymentID = '$paymentID' AND paymentNo = '$paymentNo'";
			$sqlPay = mysqli_query($connect, $queryPay);
		}
		
		// redirect to the pay in page
		if ($q != '')
		{
			header("Location: pay_in.php?module=payin&act=search&q=".$q."&msg=Data transaksi pembelian berhasil dihapus");
		}
		else
		{
			header("Location: pay_in.php?msg=Data transaksi pembelian berhasil dihapus");
		}
	} // close bracket
	
	// if the module is in and action is cancel
	elseif ($module == 'in' && $act == 'cancel')
	{
		$bbmNo = $_GET['bbmNo'];
		
		$queryBbm = "SELECT productID, detailID, receiveQty FROM as_detail_bbm WHERE bbmNo = '$bbmNo'";
		$sqlBbm = mysqli_query($connect, $queryBbm);
		
		while ($dataBbm = mysqli_fetch_array($sqlBbm))
		{
			$queryProduct = "SELECT hpp FROM as_products WHERE productID = '$dataBbm[productID]'";
			$sqlProduct = mysqli_query($connect, $queryProduct);
			$dataProduct = mysqli_fetch_array($sqlProduct);
			
			$update = "UPDATE as_detail_bbm SET price = '$dataProduct[hpp]' WHERE detailID = '$dataBbm[detailID]' AND productID = '$dataBbm[productID]'";
			mysqli_query($connect, $update);
			
			$total = $dataProduct['hpp'] * $dataBbm['receiveQty'];
			$settotal += $total;
		}
		
		$queryUpdate = "UPDATE as_bbm SET total = '$settotal' WHERE bbmNo = '$bbmNo'";
		$sqlUpdate = mysqli_query($connect, $queryUpdate);
		
		// redirect to the in page
		header("Location: in.php?msg=Transaksi pembelian dibatalkan.");
	}
	
	// if the module is in and act is input
	elseif ($module == 'payin' && $act == 'input')
	{
		$createdDate = date('Y-m-d H:i:s');
		$staffID = $_SESSION['staffID'];
		$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
		
		$paymentNo = $_POST['paymentNo'];
		$pDate = explode("-", $_POST['paymentDate']);
		$paymentDate = $pDate[2]."-".$pDate[1]."-".$pDate[0];
		$invoiceID = $_POST['invoiceID'];
		$invoiceNo = mysqli_real_escape_string($connect, $_POST['invoiceNo']);
		$spbNo = $_POST['spbNo'];
		$payType = $_POST['payType'];
		$bankNo = mysqli_real_escape_string($connect, $_POST['bankNo']);
		$bankName = mysqli_real_escape_string($connect, $_POST['bankName']);
		$bankAC = mysqli_real_escape_string($connect, $_POST['bankAC']);
		$eDate = explode("-", $_POST['effectiveDate']);
		$effectiveDate = $eDate[2]."-".$eDate[1]."-".$eDate[0];
		$total = mysqli_real_escape_string($connect, $_POST['total']);
		$supplierID = $_POST['supplierID'];
		$supplierName = mysqli_real_escape_string($connect, $_POST['supplierName']);
		$supplierAddress = mysqli_real_escape_string($connect, $_POST['supplierAddress']);
		$ref = mysqli_real_escape_string($connect, $_POST['ref']);
		$note = mysqli_real_escape_string($connect, $_POST['note']);
		
		// save in to the database
		$queryPay = "INSERT INTO as_buy_payments (	paymentNo,
													invoiceID,
													invoiceNo,
													spbNo,
													paymentDate,
													payType,
													bankNo,
													bankName,
													bankAC,
													effectiveDate,
													total,
													supplierID,
													supplierName,
													supplierAddress,
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
													'$spbNo',
													'$paymentDate',
													'$payType',
													'$bankNo',
													'$bankName',
													'$bankAC',
													'$effectiveDate',
													'$total',
													'$supplierID',
													'$supplierName',
													'$supplierAddress',
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
			$queryUpdate = "UPDATE as_debts SET incomingTotal=incomingTotal+$total WHERE invoiceNo = '$invoiceNo' AND invoiceID = '$invoiceID'";
			$sqlUpdate = mysqli_query($connect, $queryUpdate);
		}
		
		header("Location: pay_in.php?module=payin&act=finish&paymentNo=".$paymentNo."&paymentID=".$paymentID."&invoiceNo=".$invoiceNo);
	}
	
	// if the module is pay in and act is detail pay in
	elseif ($module == 'payin' && $act == 'detailpayin')
	{
		$paymentID = $_GET['paymentID'];
		$paymentNo = $_GET['paymentNo'];
		$invoiceNo = $_GET['invoiceNo'];
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		// show the buy transaction
		$queryBuy = "SELECT * FROM as_buy_transactions WHERE invoiceNo = '$invoiceNo'";
		$sqlBuy = mysqli_query($connect, $queryBuy);
		$dataBuy = mysqli_fetch_array($sqlBuy);
		
		// show the debt
		$queryDebt = "SELECT * FROM as_debts WHERE invoiceNo = '$invoiceNo' AND invoiceID = '$dataBuy[invoiceID]'";
		$sqlDebt = mysqli_query($connect, $queryDebt);
		$dataDebt = mysqli_fetch_array($sqlDebt);
		
		// show the payment 
		$queryPay = "SELECT * FROM as_buy_payments WHERE paymentNo = '$paymentNo' AND paymentID = '$paymentID' AND invoiceNo = '$invoiceNo'";
		$sqlPay = mysqli_query($connect, $queryPay);
		$dataPay = mysqli_fetch_array($sqlPay);
		
		$queryTotal = "SELECT SUM(total) as total FROM as_buy_payments WHERE invoiceNo = '$invoiceNo'";
		$sqlTotal = mysqli_query($connect, $queryTotal);
		$dataTotal = mysqli_fetch_array($sqlTotal);
		
		// debt
		$debt = $dataTotal['total'] - $dataBuy['grandtotal'];
		
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
		$smarty->assign("debt", rupiah($debt));
		$smarty->assign("supplierName", $dataBuy['supplierName']);
		$smarty->assign("supplierAddress", $dataBuy['supplierAddress']);
		$smarty->assign("payType", $payType);
		$smarty->assign("bankNo", $dataPay['bankNo']);
		$smarty->assign("bankName", $dataPay['bankName']);
		$smarty->assign("effectiveDate", $effectiveDate);
		$smarty->assign("bankAC", $dataPay['bankAC']);
		$smarty->assign("total", rupiah($dataPay['total']));
		$smarty->assign("ref", $dataPay['ref']);
		$smarty->assign("note", $dataPay['note']);
		
	}
	
	// if module in and act is finish
	elseif ($module == 'payin' && $act == 'finish')
	{
		$paymentNo = $_GET['paymentNo'];
		$paymentID = $_GET['paymentID'];
		$invoiceNo = $_GET['invoiceNo'];
		
		// show the buy transaction
		$queryBuy = "SELECT * FROM as_buy_transactions WHERE invoiceNo = '$invoiceNo'";
		$sqlBuy = mysqli_query($connect, $queryBuy);
		$dataBuy = mysqli_fetch_array($sqlBuy);
		
		// show the debt
		$queryDebt = "SELECT * FROM as_debts WHERE invoiceNo = '$invoiceNo' AND invoiceID = '$dataBuy[invoiceID]'";
		$sqlDebt = mysqli_query($connect, $queryDebt);
		$dataDebt = mysqli_fetch_array($sqlDebt);
		
		// show the payment 
		$queryPay = "SELECT * FROM as_buy_payments WHERE paymentNo = '$paymentNo' AND paymentID = '$paymentID' AND invoiceNo = '$invoiceNo'";
		$sqlPay = mysqli_query($connect, $queryPay);
		$dataPay = mysqli_fetch_array($sqlPay);
		
		$queryTotal = "SELECT SUM(total) as total FROM as_buy_payments WHERE invoiceNo = '$invoiceNo'";
		$sqlTotal = mysqli_query($connect, $queryTotal);
		$dataTotal = mysqli_fetch_array($sqlTotal);
		
		// debt
		$debt = $dataBuy['grandtotal'] - $dataTotal['total'];
		
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
		$smarty->assign("debt", rupiah($debt));
		$smarty->assign("supplierName", $dataBuy['supplierName']);
		$smarty->assign("supplierAddress", $dataBuy['supplierAddress']);
		$smarty->assign("payType", $payType);
		$smarty->assign("bankNo", $dataPay['bankNo']);
		$smarty->assign("bankName", $dataPay['bankName']);
		$smarty->assign("effectiveDate", $effectiveDate);
		$smarty->assign("bankAC", $dataPay['bankAC']);
		$smarty->assign("total", rupiah($dataPay['total']));
		$smarty->assign("ref", $dataPay['ref']);
		$smarty->assign("note", $dataPay['note']);
		
		$smarty->assign("breadcumbTitle", "Pembayaran Transaksi Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pembayaran transaksi pembelian.");
		$smarty->assign("breadcumbMenuName", "Transaksi Pembelian");
		$smarty->assign("breadcumbMenuSubName", "Pembayaran Transaksi");
	}
	
	// if the module in and act is add
	elseif ($module == 'payin' && $act == 'add')
	{
		$invoiceNo = mysqli_real_escape_string($connect, $_GET['invoiceNo']);
		
		// get last sort in number pay ID
		$queryNoPayIn = "SELECT paymentNo FROM as_buy_payments ORDER BY paymentNo DESC LIMIT 1";
		$sqlNoPayIn = mysqli_query($connect, $queryNoPayIn);
		$numsNoPayIn = mysqli_num_rows($sqlNoPayIn);
		$dataNoPayIn = mysqli_fetch_array($sqlNoPayIn);
		
		$start = substr($dataNoPayIn['paymentNo'],2-7);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoPayIn == '0')
		{
			$inNo = "00000";
		}
		elseif ($tempNo == 1)
		{
			$inNo = "00000";
		}
		elseif ($tempNo == 2)
		{
			$inNo = "0000";
		}
		elseif ($tempNo == 3)
		{
			$inNo = "000";
		}
		elseif ($tempNo == 4)
		{
			$inNo = "00";
		}
		elseif ($tempNo == 5)
		{
			$inNo = "0";
		}
		elseif ($tempNo == 6)
		{
			$inNo = "";
		}
		
		$payInNo = "PP".$inNo.$next;
		
		// total grandtotal
		$queryTotal = "SELECT grandtotal, invoiceID, spbNo, supplierID, supplierName, supplierAddress FROM as_buy_transactions WHERE invoiceNo = '$invoiceNo'";
		$sqlTotal = mysqli_query($connect, $queryTotal);
		$numsTotal = mysqli_num_rows($sqlTotal);
		$dataTotal = mysqli_fetch_array($sqlTotal);
		
		// count payment
		$queryPay = "SELECT SUM(total) as total FROM as_buy_payments WHERE invoiceNo = '$invoiceNo'";
		$sqlPay = mysqli_query($connect, $queryPay);
		$dataPay = mysqli_fetch_array($sqlPay);
		
		$debt = $dataTotal['grandtotal'] - $dataPay['total'];
		
		$smarty->assign("payInNo", $payInNo);
		$smarty->assign("payInDate", tgl_indo2(date('Y-m-d')));
		$smarty->assign("invoiceNo", $invoiceNo);
		$smarty->assign("invoiceID", $dataTotal['invoiceID']);
		$smarty->assign("numsTotal", $numsTotal);
		$smarty->assign("spbNo", $dataTotal['spbNo']);
		$smarty->assign("debt", rupiah($debt));
		$smarty->assign("debto", $debt);
		$smarty->assign("supplierID", $dataTotal['supplierID']);
		$smarty->assign("supplierName", $dataTotal['supplierName']);
		$smarty->assign("supplierAddress", $dataTotal['supplierAddress']);
				
		$smarty->assign("breadcumbTitle", "Transaksi Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi pembelian, faktur pembelian.");
		$smarty->assign("breadcumbMenuName", "Transaksi Pembelian");
		$smarty->assign("breadcumbMenuSubName", "Transaksi Pembelian");
	}

	elseif ($module == 'payin' && $act == 'search')
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
		
		// showing up the pay in data
		if ($sDate != '' && $eDate != '')
		{
			$queryPay = "SELECT * FROM as_buy_payments WHERE paymentNo LIKE '%$q%' AND paymentDate BETWEEN '$startDate' AND '$endDate' ORDER BY paymentDate DESC";
		}
		else
		{
			$queryPay = "SELECT * FROM as_buy_payments WHERE paymentNo LIKE '%$q%' ORDER BY paymentDate DESC";
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
								'spbNo' => $dtPay['spbNo'],
								'invoiceNo' => $dtPay['invoiceNo'],
								'cek' => $dtPay['bankNo'],
								'total' => rupiah($dtPay['total']),
								'supplierName' => $dtPay['supplierName'],
								'staffName' => $dtPay['staffName'],
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataPay", $dataPay);
		$smarty->assign("q", $q);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Pembayaran Transaksi Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pembayaran transaksi pembelian.");
		$smarty->assign("breadcumbMenuName", "Transaksi Pembelian");
		$smarty->assign("breadcumbMenuSubName", "Pembayaran Transaksi");
	}
	
	else
	{
		// create new object pagination
		$p = new PaginationPayIn;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the pay in data
		$queryPay = "SELECT * FROM as_buy_payments ORDER BY paymentDate DESC LIMIT $position,$limit";
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
								'spbNo' => $dtPay['spbNo'],
								'invoiceNo' => $dtPay['invoiceNo'],
								'cek' => $dtPay['bankNo'],
								'total' => rupiah($dtPay['total']),
								'supplierName' => $dtPay['supplierName'],
								'staffName' => $dtPay['staffName'],
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataPay", $dataPay);
		
		// count data
		$queryCountPay = "SELECT * FROM as_buy_payments";
		$sqlCountPay = mysqli_query($connect, $queryCountPay);
		$amountData = mysqli_num_rows($sqlCountPay);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Pembayaran Transaksi Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pembayaran transaksi pembelian.");
		$smarty->assign("breadcumbMenuName", "Transaksi Pembelian");
		$smarty->assign("breadcumbMenuSubName", "Pembayaran Transaksi");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>