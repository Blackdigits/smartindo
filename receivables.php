<?php
// include header
include "header.php";
// set the tpl page
$page = "receivables.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '24'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if the module is receivable and the act is add
	if ($module == 'receivable' && $act == 'add')
	{
		
		// assign to the tpl
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Hutang Toko");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan toko kepada perusahaan.");
		$smarty->assign("breadcumbMenuName", "Hutang");
		$smarty->assign("breadcumbMenuSubName", "Add Hutang");
		$smarty->assign("pageNumber", $_GET['page']);
	} // close bracket
	
	// if the module is receivable and the act is input
	elseif ($module == 'receivable' && $act == 'input')
	{ 
		$staffID = $_POST['sfaid'];
		$sName = $_POST['sfaname'];
		$createdDate = date('Y-m-d');
		
		// variables
		$receiveID = mysqli_real_escape_string($connect, $_POST['receiveID']);
		$receiveNo = mysqli_real_escape_string($connect, $_POST['receiveNo']);
		$paymentNo = mysqli_real_escape_string($connect, $_POST['paymentNo']);
		$soNo = mysqli_real_escape_string($connect, $_POST['soNo']);
		$invoiceID = mysqli_real_escape_string($connect, $_POST['invoiceID']);
		$invoiceNo = mysqli_real_escape_string($connect, $_POST['invoiceNo']);
		$customerID = mysqli_real_escape_string($connect, $_POST['customerID']);
		$customerName = mysqli_real_escape_string($connect, $_POST['customerName']);
		$customerAddress = mysqli_real_escape_string($connect, $_POST['customerAddress']);
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
		$queryPayment = "INSERT INTO as_sales_payments (	paymentNo,
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
															'$_SESSION[staffID]',
															'',
															'')";
		$save = mysqli_query($connect, $queryPayment);
		
		$paymentID = mysqli_insert_id($connect);
		
		if ($save) {
			$queryReceive = "UPDATE as_receivables SET incomingTotal=incomingTotal+$total WHERE receiveID = '$receiveID' AND receiveNo = '$receiveNo'";
			mysqli_query($connect, $queryReceive); 
		    header("Location: receivables.php?module=receivable&act=finish&receiveID=".$receiveID."&receiveNo=".$receiveNo."&paymentID=".$paymentID."&paymentNo=".$paymentNo."&msg=Pembayaran berhasil disimpan.");
		} else { var_dump($_POST); } 
	}
	
	// if the module is receivable and the act is finish
	elseif ($module == 'receivable' && $act == 'finish')
	{
		$receiveID = mysqli_real_escape_string($connect, $_GET['receiveID']);
		$receiveNo = mysqli_real_escape_string($connect, $_GET['receiveNo']);
		$paymentID = mysqli_real_escape_string($connect, $_GET['paymentID']);
		$paymentNo = mysqli_real_escape_string($connect, $_GET['paymentNo']);
		
		// show the receive
		$queryReceive = "SELECT * FROM as_receivables WHERE receiveID = '$receiveID' AND receiveNo = '$receiveNo'";
		$sqlReceive = mysqli_query($connect, $queryReceive);
		$dataReceive = mysqli_fetch_array($sqlReceive);
		
		$sisa = $dataReceive['receiveTotal'] - ($dataReceive['incomingTotal'] + $dataReceive['reductionTotal']);
		if ($sisa === 0) {
            mysqli_query($connect, "UPDATE as_sales_order SET status = 'Lunas' WHERE soFaktur = $dataReceive[invoiceNo]");
        }
		// assign to the tpl
		$smarty->assign("receiveID", $dataReceive['receiveID']);
		$smarty->assign("receiveNo", $dataReceive['receiveNo']);
		$smarty->assign("invoiceID", $dataReceive['invoiceID']);
		$smarty->assign("invoiceNo", $dataReceive['invoiceNo']);
		$smarty->assign("customerID", $dataReceive['customerID']);
		$smarty->assign("customerName", $dataReceive['customerName']);
		$smarty->assign("customerAddress", $dataReceive['customerAddress']);
		$smarty->assign("receiveTotal", $dataReceive['receiveTotal']);
		$smarty->assign("receiveTotalRp", rupiah($dataReceive['receiveTotal']));
		$smarty->assign("incomingTotal", $dataReceive['incomingTotal']);
		$smarty->assign("incomingTotalRp", rupiah($dataReceive['incomingTotal']));
		$smarty->assign("reductionTotal", $dataReceive['reductionTotal']);
		$smarty->assign("reductionTotalRp", rupiah($dataReceive['reductionTotal']));
        $smarty->assign("pajak", rupiah($dataReceive['pajak']));
		$smarty->assign("sisa", rupiah($sisa));
		
		$queryPay = "SELECT * FROM as_sales_payments WHERE paymentID = '$paymentID' AND paymentNo = '$paymentNo'";
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
		
		// show the receive payment
		$i = 1;
		$queryPayment = "SELECT * FROM as_sales_payments WHERE invoiceID = '$dataReceive[invoiceID]' AND invoiceNo = '$dataReceive[invoiceNo]' ORDER BY paymentDate DESC";
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
		$smarty->assign("receiveDate", tgl_indo2(date('Y-m-d')));
		
		// assign to the tpl
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Kartu Piutang");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan kartu piutang perusahaan kepada customer.");
		$smarty->assign("breadcumbMenuName", "Kartu Piutang");
		$smarty->assign("breadcumbMenuSubName", "Detail Pembayaran");
		$smarty->assign("pageNumber", $_GET['page']);
	}
	
	// if the module is receivables and the act is history
	elseif ($module == 'receivable' && $act == 'history')
	{
		$receiveID = mysqli_real_escape_string($connect, $_GET['receiveID']);
		$receiveNo = mysqli_real_escape_string($connect, $_GET['receiveNo']);
		
		// show the receive
		$queryReceive = "SELECT * FROM as_receivables WHERE receiveID = '$receiveID' AND receiveNo = '$receiveNo'";
		$sqlReceive = mysqli_query($connect, $queryReceive);
		$dataReceive = mysqli_fetch_array($sqlReceive);
		
		$sisa = $dataReceive['receiveTotal'] - ($dataReceive['incomingTotal'] + $dataReceive['reductionTotal']);
		
		$querySales = "SELECT soNo FROM as_sales_transactions WHERE invoiceID = '$dataReceive[invoiceID]' AND invoiceNo = '$dataReceive[invoiceNo]'";
		$sqlSales = mysqli_query($connect, $querySales);
		$dataSales = mysqli_fetch_array($sqlSales);
		
        $querySt = "SELECT supplierName, supplierCode, supplierID FROM `as_suppliers` WHERE supplierID = '$dataReceive[createdUserID]'";
		$sqlSt = mysqli_query($connect, $querySt);
		$dataSt = mysqli_fetch_array($sqlSt); 
		// assign to the tpl
		$smarty->assign("receiveID", $dataReceive['receiveID']);
		$smarty->assign("receiveNo", $dataReceive['receiveNo']);
		$smarty->assign("soNo", $dataReceive['soNo']);
		$smarty->assign("invoiceID", $dataReceive['invoiceID']);
		$smarty->assign("invoiceNo", $dataReceive['invoiceNo']);
		$smarty->assign("customerID", $dataReceive['customerID']);
		$smarty->assign("customerName", $dataReceive['customerName']);
		$smarty->assign("customerAddress", $dataReceive['customerAddress']);
        $smarty->assign("salesName", $dataSt['supplierName']);
		$smarty->assign("salesId", $dataSt['supplierID']);
		$smarty->assign("receiveTotal", $dataReceive['receiveTotal']);
		$smarty->assign("receiveTotalRp", rupiah($dataReceive['receiveTotal']));
		$smarty->assign("incomingTotal", $dataReceive['incomingTotal']);
		$smarty->assign("incomingTotalRp", rupiah($dataReceive['incomingTotal']));
		$smarty->assign("reductionTotal", $dataReceive['reductionTotal']);
		$smarty->assign("reductionTotalRp", rupiah($dataReceive['reductionTotal']));
        $smarty->assign("pajak", rupiah($dataReceive['pajak']));
		$smarty->assign("sisa", rupiah($sisa));
		
		// show the receive payment
		$i = 1;
		$queryPayment = "SELECT * FROM as_sales_payments WHERE invoiceID = '$dataReceive[invoiceID]' AND invoiceNo = '$dataReceive[invoiceNo]' ORDER BY paymentDate DESC";
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
		$queryNoPay = "SELECT paymentNo FROM as_sales_payments ORDER BY paymentNo DESC LIMIT 1";
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
		
		$paymentNo = "PJ".$payNo.$next;
		
		$smarty->assign("paymentNo", $paymentNo);
		
		// assign to the tpl
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Kartu Piutang");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan kartu piutang perusahaan kepada customer.");
		$smarty->assign("breadcumbMenuName", "Kartu Piutang");
		$smarty->assign("breadcumbMenuSubName", "History Pembayaran");
		$smarty->assign("pageNumber", $_GET['page']);
	}

	// if the module is receive and the act is delete
	elseif ($module == 'receive' && $act == 'deletepayment')
	{
		$receiveID = $_GET['receiveID'];
		$receiveNo = $_GET['receiveNo'];
		$paymentID = $_GET['paymentID'];
		$paymentNo = $_GET['paymentNo'];
		
		$queryPayment = "SELECT total FROM as_sales_payments WHERE paymentID = '$paymentID' AND paymentNo = '$paymentNo'";
		$sqlPayment = mysqli_query($connect, $queryPayment);
		$dataPayment = mysqli_fetch_array($sqlPayment);
		$total = $dataPayment['total'];
		
		// update incoming
		$queryReceive = "UPDATE as_receivables SET incomingTotal=incomingTotal-$total WHERE receiveID = '$receiveID' AND receiveNo = '$receiveNo'";
		$sqlReceive = mysqli_query($connect, $queryReceive);
		
		if ($sqlReceive)
		{
			$queryDelete = "DELETE FROM as_sales_payments WHERE paymentID = '$paymentID' AND paymentNo = '$paymentNo'";
			mysqli_query($connect, $queryDelete);
		}
		
		// redirect to the history page
		header("Location: receivables.php?module=receivable&act=history&receiveID=".$receiveID."&receiveNo=".$receiveNo."&page=&msg=Pembayaran berhasil dibatalkan.");
	}
	
	// if the module is receive and act is search
	elseif ($module == 'receivable' && $act == 'search')
	{
		$invoiceNo = mysqli_real_escape_string($connect, $_GET['invoiceNo']);
		$customerID = $_GET['customerID'];
		$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
		$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
		
		$smarty->assign("startDate", $sDate);
		$smarty->assign("endDate", $eDate);
		$smarty->assign("invoiceNo", $invoiceNo);
		$smarty->assign("customerID", $customerID);
		
		$s2Date = explode("-", $sDate);
		$e2Date = explode("-", $eDate);
		
		$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
		$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
		
		// showing up the receivable data
		if ($_GET['startDate'] != '' && $_GET['endtDate'] != '')
		{
			if ($invoiceNo != '' && $customerID == '')
			{
				$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE A.invoiceNo LIKE '%$invoiceNo%' AND B.invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.createdDate DESC";
			}
			elseif ($invoiceNo == '' && $customerID != '')
			{
				$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE A.customerID = '$customerID' AND B.invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.createdDate DESC";
			}
			else
			{
				$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE A.invoiceNo LIKE '%$invoiceNo%' AND A.customerID = '$customerID' AND B.invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.createdDate DESC";
			}
			
		}
		else
		{
			if ($invoiceNo != '' && $customerID == '')
			{
				$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE A.invoiceNo LIKE '%$invoiceNo%' ORDER BY A.createdDate DESC";
			}
			elseif ($invoiceNo == '' && $customerID != '')
			{
				$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE A.customerID = '$customerID' ORDER BY A.createdDate DESC";
			}
			else
			{
				$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE A.invoiceNo LIKE '%$invoiceNo%' AND A.customerID = '$customerID' ORDER BY A.createdDate DESC";
			}
		}
		
		$sqlReceive = mysqli_query($connect, $queryReceive);
		
		// fetch data
		$i = 1;
		while ($dtReceive = mysqli_fetch_array($sqlReceive))
		{
			$sisa = $dtReceive['receiveTotal'] - ($dtReceive['incomingTotal'] + $dtReceive['reductionTotal']);
			
			if ($sisa <= 0)
			{
				$sisarp = 0;
			}
			else
			{
				$sisarp = rupiah($sisa);
			}
			
			$dataReceive[] = array(	'receiveID' => $dtReceive['receiveID'],
									'receiveNo' => $dtReceive['receiveNo'],
									'invoiceNo' => $dtReceive['invoiceNo'],
									'customerName' => $dtReceive['customerName'],
									'customerID' => $dtReceive['customerID'],
									'receiveTotal' => rupiah($dtReceive['receiveTotal']),
									'incomingTotal' => rupiah($dtReceive['incomingTotal']),
									'reductionTotal' => rupiah($dtReceive['reductionTotal']),
									'sisa' => $sisarp,
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataReceive", $dataReceive);
		
		// show the customer data
		$queryCustomer = "SELECT * FROM as_customers ORDER BY customerName ASC";
		$sqlCustomer = mysqli_query($connect, $queryCustomer);
		
		while ($dtCustomer = mysqli_fetch_array($sqlCustomer))
		{
			$dataCustomer[] = array('customerID' => $dtCustomer['customerID'],
									'customerCode' => $dtCustomer['customerCode'],
									'customerName' => $dtCustomer['customerName']);
		}
		
		$smarty->assign("dataCustomer", $dataCustomer);
		
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Kartu Piutang");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan kartu piutang perusahaan kepada customer.");
		$smarty->assign("breadcumbMenuName", "Kartu Piutang");
		$smarty->assign("breadcumbMenuSubName", "Pencarian");
	} 
	
	else
	{
		// show the customer data
		$queryCustomer = "SELECT * FROM as_customers ORDER BY customerName ASC";
		$sqlCustomer = mysqli_query($connect, $queryCustomer);
		
		while ($dtCustomer = mysqli_fetch_array($sqlCustomer))
		{
			$dataCustomer[] = array('customerID' => $dtCustomer['customerID'],
									'customerCode' => $dtCustomer['customerCode'],
									'customerName' => $dtCustomer['customerName']);
		}
		
		$smarty->assign("dataCustomer", $dataCustomer);
		
		// create new object pagination
		$p = new PaginationReceivable;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the receivable data
		$queryReceivable = "SELECT * FROM as_receivables ORDER BY createdDate DESC LIMIT $position,$limit";
		$sqlReceivable = mysqli_query($connect, $queryReceivable);
		
		// fetch data
		$i = 1 + $position;
		while ($dtReceive = mysqli_fetch_array($sqlReceivable))
		{
			$sisa = $dtReceive['receiveTotal'] - ($dtReceive['incomingTotal'] + $dtReceive['reductionTotal']);
			
			if ($sisa <= 0)
			{
				$sisarp = 0;
			}
			else
			{
				$sisarp = rupiah($sisa);
			}
			
			$dataReceive[] = array(	'receiveID' => $dtReceive['receiveID'],
									'receiveNo' => $dtReceive['receiveNo'],
									'invoiceNo' => $dtReceive['invoiceNo'],
									'customerName' => $dtReceive['customerName'],
									'customerID' => $dtReceive['customerID'],
									'receiveTotal' => rupiah($dtReceive['receiveTotal']),
									'incomingTotal' => rupiah($dtReceive['incomingTotal']),
									'reductionTotal' => rupiah($dtReceive['reductionTotal']),
									'sisa' => $sisarp,
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataReceive", $dataReceive);
		
		// count data
		$queryCountReceive = "SELECT * FROM as_receivables";
		$sqlCountReceive = mysqli_query($connect, $queryCountReceive);
		$amountData = mysqli_num_rows($sqlCountReceive);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Kartu Piutang");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan kartu piutang perusahaan kepada customer.");
		$smarty->assign("breadcumbMenuName", "Kartu Piutang");
		$smarty->assign("breadcumbMenuSubName", "Piutang");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>