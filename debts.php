<?php 
// include header
include "header.php";
// set the tpl page
$page = "debts.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '23'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if the module is debts and the act is add
	if ($module == 'debt' && $act == 'add')
	{
		
		// assign to the tpl
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Kartu Hutang");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan kartu hutang sales kepada perusahaan.");
		$smarty->assign("breadcumbMenuName", "Hutang");
		$smarty->assign("breadcumbMenuSubName", "Add Hutang");
		$smarty->assign("pageNumber", $_GET['page']);
	} // close bracket
	
	// if the module is debt and the act is input
	elseif ($module == 'debt' && $act == 'input')
	{
		$staffID = $_SESSION['staffID'];
		$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
		$createdDate = date('Y-m-d H:i:s');
		
		// variables
		$debtID = mysqli_real_escape_string($connect, $_POST['debtID']);
		$debtNo = mysqli_real_escape_string($connect, $_POST['debtNo']);
		$paymentNo = mysqli_real_escape_string($connect, $_POST['paymentNo']);
		$spbNo = mysqli_real_escape_string($connect, $_POST['spbNo']);
		$invoiceID = mysqli_real_escape_string($connect, $_POST['invoiceID']);
		$invoiceNo = mysqli_real_escape_string($connect, $_POST['invoiceNo']);
		$supplierID = mysqli_real_escape_string($connect, $_POST['supplierID']);
		$supplierName = mysqli_real_escape_string($connect, $_POST['supplierName']);
		$supplierAddress = mysqli_real_escape_string($connect, $_POST['supplierAddress']);
		$pDate = explode("-", $_POST['paymentDate']);
		$paymentDate = $pDate[2]."-".$pDate[1]."-".$pDate[0];
		$payType = mysqli_real_escape_string($connect, $_POST['payType']);
		$bankNo = mysqli_real_escape_string($connect, $_POST['bankNo']);
		$bankName = mysqli_real_escape_string($connect, $_POST['bankName']);
		$bankAC = mysqli_real_escape_string($connect, $_POST['bankAC']);
		$eDate = explode("-", $_POST['effectiveDate']);
		$effectiveDate = $eDate[2]."-".$eDate[1]."-".$eDate[0];
		$total = mysqli_real_escape_string($connect, $_POST['total']);
		$ref = mysqli_real_escape_string($connect, $_POST['ref']);
		$note = mysqli_real_escape_string($connect, $_POST['note']);
		
		// insert into the database
		$queryPayment = "INSERT INTO as_buy_payments (	paymentNo,
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
														'$createdDate',
														'')";
		$save = mysqli_query($connect, $queryPayment);
		
		$paymentID = mysqli_insert_id($connect);
		
		if ($save)
		{
			$queryDebt = "UPDATE as_debts SET incomingTotal=incomingTotal+$total WHERE debtID = '$debtID' AND debtNo = '$debtNo'";
			mysqli_query($connect, $queryDebt);
		}
		
		// redirect to the finish page
		header("Location: debts.php?module=debt&act=finish&debtID=".$debtID."&debtNo=".$debtNo."&paymentID=".$paymentID."&paymentNo=".$paymentNo."&msg=Pembayaran berhasil disimpan.");
	}
	
	// if the module is debt and the act is finish
	elseif ($module == 'debt' && $act == 'finish')
	{
		$debtID = mysqli_real_escape_string($connect, $_GET['debtID']);
		$debtNo = mysqli_real_escape_string($connect, $_GET['debtNo']);
		$paymentID = mysqli_real_escape_string($connect, $_GET['paymentID']);
		$paymentNo = mysqli_real_escape_string($connect, $_GET['paymentNo']);
		
		// show the debt
		$queryDebt = "SELECT * FROM as_debts WHERE debtID = '$debtID' AND debtNo = '$debtNo'";
		$sqlDebt = mysqli_query($connect, $queryDebt);
		$dataDebt = mysqli_fetch_array($sqlDebt);
		
		$sisa = $dataDebt['debtTotal'] - ($dataDebt['incomingTotal'] + $dataDebt['reductionTotal']);
		mysqli_query($connect, "UPDATE as_suppliers SET balance = balance - $dataDebt[incomingTotal] WHERE supplierID = $dataDebt[supplierID]");
        if ($sisa <= 0) {
            mysqli_query($connect, "UPDATE as_sales_order SET status = 'Lunas' WHERE soFaktur = $dataDebt[invoiceNo]");
        }
       

		// assign to the tpl
		$smarty->assign("debtID", $dataDebt['debtID']);
		$smarty->assign("debtNo", $dataDebt['debtNo']);
		$smarty->assign("invoiceID", $dataDebt['invoiceID']);
		$smarty->assign("invoiceNo", $dataDebt['invoiceNo']);
		$smarty->assign("supplierID", $dataDebt['supplierID']);
		$smarty->assign("supplierName", $dataDebt['supplierName']);
		$smarty->assign("supplierAddress", $dataDebt['supplierAddress']);
		$smarty->assign("debtTotal", $dataDebt['debtTotal']);
		$smarty->assign("debtTotalRp", rupiah($dataDebt['debtTotal']));
		$smarty->assign("incomingTotal", $dataDebt['incomingTotal']);
		$smarty->assign("incomingTotalRp", rupiah($dataDebt['incomingTotal']));
		$smarty->assign("reductionTotal", $dataDebt['reductionTotal']);
		$smarty->assign("reductionTotalRp", rupiah($dataDebt['reductionTotal'])); 
        $smarty->assign("reductionTotal", $dataDebt['reductionTotal']);
		$smarty->assign("pajak", rupiah($dataDebt['pajak']));
		$smarty->assign("sisa", rupiah($sisa));
		
		$queryPay = "SELECT * FROM as_buy_payments WHERE paymentID = '$paymentID' AND paymentNo = '$paymentNo'";
		$sqlPay = mysqli_query($connect, $queryPay);
		$dataPay = mysqli_fetch_array($sqlPay);
		
		if ($dataPay['payType'] == '1')
		{
			$pType = "TUNAI";
		}
		elseif ($dataPay['payType'] == '2')
		{
			$pType = "TRANSFER";
		}
		elseif ($dataPay['payType'] == '3')
		{
			$pType = "CEK";
		}
		else
		{
			$pType = "GIRO";
		}
		
		if ($dataPay['effectiveDate'] == '0000-00-00')
		{
			$effectiveDate = "-";
		}
		else
		{
			$effectiveDate = tgl_indo2($dataPay['effectiveDate']);
		}
		
		$smarty->assign("paymentID", $dataPay['paymentID']);
		$smarty->assign("paymentNo", $dataPay['paymentNo']);
		$smarty->assign("paymentDate", tgl_indo2($dataPay['paymentDate']));
		$smarty->assign("payType", $pType);
		$smarty->assign("bankNo", $dataPay['bankNo']);
		$smarty->assign("bankName", $dataPay['bankName']);
		$smarty->assign("bankAC", $dataPay['bankAC']);
		$smarty->assign("effectiveDate", $effectiveDate);
		$smarty->assign("total", rupiah($dataPay['total']));
		$smarty->assign("ref", $dataPay['ref']);
		$smarty->assign("note", $dataPay['note']);
		
		// show the debt payment
		$i = 1;
		$queryPayment = "SELECT * FROM as_buy_payments WHERE invoiceID = '$dataDebt[invoiceID]' AND invoiceNo = '$dataDebt[invoiceNo]' ORDER BY paymentDate DESC";
		$sqlPayment = mysqli_query($connect, $queryPayment);
		while ($dtPayment = mysqli_fetch_array($sqlPayment))
		{
			// pay type
			if ($dtPayment['payType'] == '1')
			{
				$payType = "TUNAI";
			}
			elseif ($dtPayment['payType'] == '2')
			{
				$payType = "TRANSFER";
			}
			elseif ($dtPayment['payType'] == '3')
			{
				$payType = "CEK";
			}
			else
			{
				$payType = "GIRO";
			}
			
			$dataPayment[] = array(	'paymentID' => $dtPayment['paymentID'],
									'paymentNo' => $dtPayment['paymentNo'],
									'paymentDate' => tgl_indo2($dtPayment['paymentDate']),
									'effectiveDate' => tgl_indo2($dtPayment['effectiveDate']),
									'payType' => $payType,
									'total' => rupiah($dtPayment['total']),
									'no' => $i);
			
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataPayment", $dataPayment);
		$smarty->assign("debtDate", tgl_indo2(date('Y-m-d')));
		
		// assign to the tpl
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Kartu Hutang");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan kartu hutang sales kepada perusahaan.");
		$smarty->assign("breadcumbMenuName", "Kartu Hutang");
		$smarty->assign("breadcumbMenuSubName", "Detail Pembayaran");
		$smarty->assign("pageNumber", $_GET['page']);
	}
	
	// if the module is debt and the act is history
	elseif ($module == 'debt' && $act == 'history')
	{
		$debtID = mysqli_real_escape_string($connect, $_GET['debtID']);
		$debtNo = mysqli_real_escape_string($connect, $_GET['debtNo']);
		
		// show the debt
		$queryDebt = "SELECT * FROM as_debts WHERE debtID = '$debtID' AND debtNo = '$debtNo'";
		$sqlDebt = mysqli_query($connect, $queryDebt);
		$dataDebt = mysqli_fetch_array($sqlDebt);
		
		$sisa = $dataDebt['debtTotal'] - ($dataDebt['incomingTotal'] + $dataDebt['reductionTotal']);
		
		$queryBuy = "SELECT spbNo FROM as_buy_transactions WHERE invoiceID = '$dataDebt[invoiceID]' AND invoiceNo = '$dataDebt[invoiceNo]'";
		$sqlBuy = mysqli_query($connect, $queryBuy);
		$dataBuy = mysqli_fetch_array($sqlBuy);
		
		// assign to the tpl
		$smarty->assign("debtID", $dataDebt['debtID']);
		$smarty->assign("debtNo", $dataDebt['debtNo']);
		$smarty->assign("spbNo", $dataBuy['spbNo']);
		$smarty->assign("invoiceID", $dataDebt['invoiceID']);
		$smarty->assign("invoiceNo", $dataDebt['invoiceNo']);
		$smarty->assign("supplierID", $dataDebt['supplierID']);
		$smarty->assign("supplierName", $dataDebt['supplierName']);
		$smarty->assign("supplierAddress", $dataDebt['supplierAddress']);
		$smarty->assign("debtTotal", $dataDebt['debtTotal']);
		$smarty->assign("debtTotalRp", rupiah($dataDebt['debtTotal']));
		$smarty->assign("incomingTotal", $dataDebt['incomingTotal']);
		$smarty->assign("incomingTotalRp", rupiah($dataDebt['incomingTotal']));
		$smarty->assign("reductionTotal", $dataDebt['reductionTotal']);
		$smarty->assign("reductionTotalRp", rupiah($dataDebt['reductionTotal']));
        $smarty->assign("pajak", rupiah($dataDebt['pajak']));
		$smarty->assign("sisa", rupiah($sisa));
		
		// show the debt payment
		$i = 1;
		$queryPayment = "SELECT * FROM as_buy_payments WHERE invoiceID = '$dataDebt[invoiceID]' AND invoiceNo = '$dataDebt[invoiceNo]' ORDER BY paymentDate DESC";
		$sqlPayment = mysqli_query($connect, $queryPayment);
		while ($dtPayment = mysqli_fetch_array($sqlPayment))
		{
			// pay type
			if ($dtPayment['payType'] == '1')
			{
				$payType = "TUNAI";
			}
			elseif ($dtPayment['payType'] == '2')
			{
				$payType = "TRANSFER";
			}
			elseif ($dtPayment['payType'] == '3')
			{
				$payType = "CEK";
			}
			else
			{
				$payType = "GIRO";
			}
			
			$dataPayment[] = array(	'paymentID' => $dtPayment['paymentID'],
									'paymentNo' => $dtPayment['paymentNo'],
									'paymentDate' => tgl_indo2($dtPayment['paymentDate']),
									'effectiveDate' => tgl_indo2($dtPayment['effectiveDate']),
									'payType' => $payType,
									'total' => rupiah($dtPayment['total']),
									'no' => $i);
			
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataPayment", $dataPayment);
		$smarty->assign("paymentDate", tgl_indo2(date('Y-m-d')));
		
		// get last sort in number ID
		$queryNoPay = "SELECT paymentNo FROM as_buy_payments ORDER BY paymentNo DESC LIMIT 1";
		$sqlNoPay = mysqli_query($connect, $queryNoPay);
		$numsNoPay = mysqli_num_rows($sqlNoPay);
		$dataNoPay = mysqli_fetch_array($sqlNoPay);
		
		$start = substr($dataNoPay['paymentNo'],2-7);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoPay == '0')
		{
			$payNo = "00000";
		}
		elseif ($tempNo == 1)
		{
			$payNo = "00000";
		}
		elseif ($tempNo == 2)
		{
			$payNo = "0000";
		}
		elseif ($tempNo == 3)
		{
			$payNo = "000";
		}
		elseif ($tempNo == 4)
		{
			$payNo = "00";
		}
		elseif ($tempNo == 5)
		{
			$payNo = "0";
		}
		elseif ($tempNo == 6)
		{
			$payNo = "";
		}
		
		$paymentNo = "PP".$payNo.$next;
		
		$smarty->assign("paymentNo", $paymentNo);
		
		// assign to the tpl
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Kartu Hutang");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan kartu hutang sales kepada perusahaan.");
		$smarty->assign("breadcumbMenuName", "Kartu Hutang");
		$smarty->assign("breadcumbMenuSubName", "History Pembayaran");
		$smarty->assign("pageNumber", $_GET['page']);
	}

	// if the module is debt and the act is delete
	elseif ($module == 'debt' && $act == 'deletepayment')
	{
		$debtID = $_GET['debtID'];
		$debtNo = $_GET['debtNo'];
		$paymentID = $_GET['paymentID'];
		$paymentNo = $_GET['paymentNo'];
		
		$queryPayment = "SELECT total FROM as_buy_payments WHERE paymentID = '$paymentID' AND paymentNo = '$paymentNo'";
		$sqlPayment = mysqli_query($connect, $queryPayment);
		$dataPayment = mysqli_fetch_array($sqlPayment);
		$total = $dataPayment['total'];
		
		// update incoming
		$queryDebt = "UPDATE as_debts SET incomingTotal=incomingTotal-$total WHERE debtID = '$debtID' AND debtNo = '$debtNo'";
		$sqlDebt = mysqli_query($connect, $queryDebt);
		
		if ($sqlDebt)
		{
			$queryDelete = "DELETE FROM as_buy_payments WHERE paymentID = '$paymentID' AND paymentNo = '$paymentNo'";
			mysqli_query($connect, $queryDelete);
		}
		
		// redirect to the history page
		header("Location: debts.php?module=debt&act=history&debtID=".$debtID."&debtNo=".$debtNo."&page=&msg=Pembayaran berhasil dibatalkan.");
	}
	
	// if the module is debt and act is search
	elseif ($module == 'debt' && $act == 'search')
	{
		$invoiceNo = mysqli_real_escape_string($connect, $_GET['invoiceNo']);
		$supplierID = $_GET['supplierID'];
		$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
		$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
		
		$smarty->assign("startDate", $sDate);
		$smarty->assign("endDate", $eDate);
		$smarty->assign("invoiceNo", $invoiceNo);
		$smarty->assign("supplierID", $supplierID);
		
		$s2Date = explode("-", $sDate);
		$e2Date = explode("-", $eDate);
		
		$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
		$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
		
		// showing up the sales order data
		if ($_GET['startDate'] != '' && $_GET['endtDate'] != '')
		{
			if ($invoiceNo != '' && $supplierID == '')
			{
				$queryDebt = "SELECT * FROM as_debts A INNER JOIN as_buy_transactions B ON A.invoiceID=B.invoiceID WHERE A.invoiceNo LIKE '%$invoiceNo%' AND B.invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.createdDate DESC";
			}
			elseif ($invoiceNo == '' && $supplierID != '')
			{
				$queryDebt = "SELECT * FROM as_debts A INNER JOIN as_buy_transactions B ON A.invoiceID=B.invoiceID WHERE A.supplierID = '$supplierID' AND B.invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.createdDate DESC";
			}
			else
			{
				$queryDebt = "SELECT * FROM as_debts A INNER JOIN as_buy_transactions B ON A.invoiceID=B.invoiceID WHERE A.invoiceNo LIKE '%$invoiceNo%' AND A.supplierID = '$supplierID' AND B.invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.createdDate DESC";
			}
			
		}
		else
		{
			if ($invoiceNo != '' && $supplierID == '')
			{
				$queryDebt = "SELECT * FROM as_debts A INNER JOIN as_buy_transactions B ON A.invoiceID=B.invoiceID WHERE A.invoiceNo LIKE '%$invoiceNo%' ORDER BY A.createdDate DESC";
			}
			elseif ($invoiceNo == '' && $supplierID != '')
			{
				$queryDebt = "SELECT * FROM as_debts A INNER JOIN as_buy_transactions B ON A.invoiceID=B.invoiceID WHERE A.supplierID = '$supplierID' ORDER BY A.createdDate DESC";
			}
			else
			{
				$queryDebt = "SELECT * FROM as_debts A INNER JOIN as_buy_transactions B ON A.invoiceID=B.invoiceID WHERE A.invoiceNo LIKE '%$invoiceNo%' AND A.supplierID = '$supplierID' ORDER BY A.createdDate DESC";
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
		
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Data TOP SFA");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan hutang sales kepada perusahaan.");
		$smarty->assign("breadcumbMenuName", "Data TOP");
		$smarty->assign("breadcumbMenuSubName", "Pencarian");
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
		
		// create new object pagination
		$p = new PaginationDebts;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the debts data
		$queryDebt = "SELECT * FROM as_debts ORDER BY createdDate DESC LIMIT $position,$limit";
		$sqlDebt = mysqli_query($connect, $queryDebt);
		
		// fetch data
		$i = 1 + $position;
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
		
		// count data
		$queryCountDebt = "SELECT * FROM as_debts";
		$sqlCountDebt = mysqli_query($connect, $queryCountDebt);
		$amountData = mysqli_num_rows($sqlCountDebt);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Data TOP SFA");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan hutang sales kepada perusahaan.");
		$smarty->assign("breadcumbMenuName", "Data TOP");
		$smarty->assign("breadcumbMenuSubName", "Daftar Hutang");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>