<?php
// include header
include "header.php";
// set the tpl page
$page = "out.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '9'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is out and action is delete
	if ($module == 'out' && $act == 'delete')
	{
		// insert method into a variable
		$inID = $_GET['invoiceID'];
		$inNo = $_GET['invoiceNo'];
		
		// delete invoice
		$queryInvoice = "DELETE FROM as_sales_transactions WHERE invoiceID = '$inID' AND invoiceNo = '$inNo'";
		$sqlInvoice = mysqli_query($connect, $queryInvoice);
		
		// delete receive
		$queryReceive = "DELETE FROM as_receivables WHERE invoiceID = '$inID' AND invoiceNo = '$inNo'";
		$sqlReceive = mysqli_query($connect, $queryReceive);
		
		// redirect to the in page
		header("Location: out.php?msg=Data transaksi penjualan berhasil dihapus");
	} // close bracket
	
	// if the module is out and action is cancel
	elseif ($module == 'out' && $act == 'cancel')
	{
		$doNo = $_GET['doNo'];
		
		$queryDo = "SELECT productID, detailID, deliveredQty FROM as_detail_do WHERE doNo = '$doNo'";
		$sqlDo = mysqli_query($connect, $queryDo);
		
		while ($dataDo = mysqli_fetch_array($sqlDo))
		{
			$queryProduct = "SELECT hpp FROM as_products WHERE productID = '$dataDo[productID]'";
			$sqlProduct = mysqli_query($connect, $queryProduct);
			$dataProduct = mysqli_fetch_array($sqlProduct);
			
			$update = "UPDATE as_detail_do SET price = '$dataProduct[hpp]' WHERE detailID = '$dataDo[detailID]' AND productID = '$dataDo[productID]'";
			mysqli_query($connect, $update);
			
			$total = $dataProduct['hpp'] * $dataDo['deliveredQty'];
			$settotal += $total;
		}
		
		$queryUpdate = "UPDATE as_delivery_order SET total = '$settotal' WHERE doNo = '$doNo'";
		$sqlUpdate = mysqli_query($connect, $queryUpdate);
		
		// redirect to the out page
		header("Location: out.php?msg=Transaksi penjualan dibatalkan.");
	}
	
	// if the module is out and act is input
	elseif ($module == 'out' && $act == 'input')
	{
		$createdDate = date('Y-m-d H:i:s');
		$staffID = $_SESSION['staffID'];
		$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
		$invoiceNo = mysqli_real_escape_string($connect, $_POST['invoiceNo']);
		$iDate = explode("-", $_POST['invoiceDate']);
		$invoiceDate = $iDate[2]."-".$iDate[1]."-".$iDate[0];
		$doNo = mysqli_real_escape_string($connect, $_POST['doNo']);
		$soNo = mysqli_real_escape_string($connect, $_POST['soNo']);
		$customerID = $_POST['customerID'];
		$customerName = mysqli_real_escape_string($connect, $_POST['customerName']);
		$customerAddress = mysqli_real_escape_string($connect, $_POST['customerAddress']);
		$paymentType = $_POST['paymentType'];
		$xDate = explode("-", $_POST['expiredDate']);
		$expiredDate = $xDate[2]."-".$xDate[1]."-".$xDate[0];
		$ppnType = $_POST['ppnType'];
		$ppn = $_POST['ppn'];
		$total = $_POST['total'];
		$basic = $_POST['basic'];
		$grandtotal = $_POST['grandtotal'];
		//$pay = $_POST['pay'];
		//$debt = $_POST['debt'];
		$discount = $_POST['discount'];
		
		// get last sort receive 
		$queryNoReceive = "SELECT receiveNo FROM as_receivables ORDER BY receiveNo DESC LIMIT 1";
		$sqlNoReceive = mysqli_query($connect, $queryNoReceive);
		$numsNoReceive = mysqli_num_rows($sqlNoReceive);
		$dataNoReceive = mysqli_fetch_array($sqlNoReceive);
		
		$start = substr($dataNoReceive['receiveNo'],2-7);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoReceive == '0')
		{
			$reNo = "00000";
		}
		elseif ($tempNo == 1)
		{
			$reNo = "00000";
		}
		elseif ($tempNo == 2)
		{
			$reNo = "0000";
		}
		elseif ($tempNo == 3)
		{
			$reNo = "000";
		}
		elseif ($tempNo == 4)
		{
			$reNo = "00";
		}
		elseif ($tempNo == 5)
		{
			$reNo = "0";
		}
		elseif ($tempNo == 6)
		{
			$reNo = "";
		}
		
		$receiveNo = "DB".$reNo.$next;
		
		$querySales = "INSERT INTO as_sales_transactions (	invoiceNo,
															invoiceDate,
															doNo,
															soNo,
															paymentType,
															expiredPayment,
															ppnType,
															ppn,
															total,
															basic,
															discount,
															grandtotal,
															customerID,
															customerName,
															customerAddress,
															staffID,
															staffName,
															createdDate,
															createdUserID,
															modifiedDate,
															modifiedUserID)
													VALUES(	'$invoiceNo',
															'$invoiceDate',
															'$doNo',
															'$soNo',
															'$paymentType',
															'$expiredDate',
															'$ppnType',
															'$ppn',
															'$total',
															'$basic',
															'$discount',
															'$grandtotal',
															'$customerID',
															'$customerName',
															'$customerAddress',
															'$staffID',
															'$sName',
															'$createdDate',
															'$staffID',
															'',
															'')";
		
		$sqlSales = mysqli_query($connect, $querySales);
		
		$invoiceID = mysqli_insert_id($connect);
		
		if ($sqlSales)
		{
			//if ($paymentType == '2')
			//{
				$queryReceive = "INSERT INTO as_receivables(receiveNo,
															invoiceID,
															invoiceNo,
															customerID,
															customerName,
															customerAddress,
															receiveTotal,
															incomingTotal,
															status,
															staffID,
															staffName,
															createdDate,
															createdUserID,
															modifiedDate,
															modifiedUserID)
													VALUES(	'$receiveNo',
															'$invoiceID',
															'$invoiceNo',
															'$customerID',
															'$customerName',
															'$customerAddress',
															'$grandtotal',
															'0',
															'1',
															'$staffID',
															'$sName',
															'$createdDate',
															'$staffID',
															'',
															'')";
													
				mysqli_query($connect, $queryReceive);
			//}
		}
		
		header("Location: out.php?module=out&act=finish&doNo=".$doNo."&invoiceNo=".$invoiceNo."&invoiceID=".$invoiceID);
	}
	
	// if the module is out and act is detailin
	elseif ($module == 'out' && $act == 'detailout')
	{
		$doNo = $_GET['doNo'];
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		$invoiceID = $_GET['invoiceID'];
		$invoiceNo = $_GET['invoiceNo'];
		
		$querySales = "SELECT * FROM as_sales_transactions WHERE doNo = '$doNo' AND invoiceID = '$invoiceID' AND invoiceNo = '$invoiceNo'";
		$sqlSales = mysqli_query($connect, $querySales);
		$dataSales = mysqli_fetch_array($sqlSales);
		
		if ($dataSales['paymentType'] == '1')
		{
			$paymentType = "TUNAI";
			$expiredPayment = "";
		}
		else
		{
			$paymentType = "TERMIN";
			$expiredPayment = tgl_indo2($dataSales['expiredPayment']);
		}
		
		if ($dataSales['ppnType'] == '1')
		{
			$ppnType = "PPN";
			$ppn = rupiah($dataSales['ppn']);
		}
		else
		{
			$ppnType = "NO PPN";
			$ppn = rupiah(0);
		}
		
		// assign to the tpl
		$smarty->assign("invoiceID", $dataSales['invoiceID']);
		$smarty->assign("invoiceNo", $dataSales['invoiceNo']);
		$smarty->assign("invoiceDate", tgl_indo2($dataSales['invoiceDate']));
		$smarty->assign("doNo", $dataSales['doNo']);
		$smarty->assign("soNo", $dataSales['soNo']);
		$smarty->assign("paymentType", $paymentType);
		$smarty->assign("expiredPayment", $expiredPayment);
		$smarty->assign("ppnType", $ppnType);
		$smarty->assign("ppn", $ppn);
		$smarty->assign("discount", rupiah($dataSales['discount']));
		$smarty->assign("basic", rupiah($dataSales['basic']));
		$smarty->assign("total", rupiah($dataSales['total']));
		$smarty->assign("grandtotal", rupiah($dataSales['grandtotal']));
		$smarty->assign("pay", rupiah($dataSales['pay']));
		$smarty->assign("customerID", $dataSales['customerID']);
		$smarty->assign("customerName", $dataSales['customerName']);
		$smarty->assign("customerAddress", $dataSales['customerAddress']);
		$smarty->assign("staffID", $dataSales['staffID']);
		$smarty->assign("staffName", $dataSales['staffName']);
		
		// show receivable
		$queryReceive = "SELECT receiveTotal FROM as_receivables WHERE invoiceNo = '$_GET[invoiceNo]' AND invoiceID = '$_GET[invoiceID]'";
		$sqlReceive = mysqli_query($connect, $queryReceive);
		$dataReceive = mysqli_fetch_array($sqlReceive);
		
		$smarty->assign("receive", rupiah($dataReceive['receiveTotal']));
		
		// show the do detail
		$queryDoDetail = "SELECT * FROM as_detail_do WHERE doNo = '$dataSales[doNo]' ORDER BY doID ASC";
		$sqlDoDetail = mysqli_query($connect, $queryDoDetail);
		
		$i = 1;
		while ($dtDoDetail = mysqli_fetch_array($sqlDoDetail))
		{
			$subtotal = rupiah($dtDoDetail['deliveredQty'] * $dtDoDetail['price']);
			
			$dataDoDetail[] = array(	'detailID' => $dtDoDetail['doID'],
										'doNo' => $dtDoDetail['doNo'],
										'doFaktur' => $dtDoDetail['doFaktur'],
										'productID' => $dtDoDetail['productID'],
										'productName' => $dtDoDetail['productName'],
										'pricerp' => rupiah($dtDoDetail['price']),
										'qty' => $dtDoDetail['qty'],
										'deliveredQty' => $dtDoDetail['deliveredQty'],
										'subtotal' => $subtotal,
										'no' => $i
										);
			$i++;
		}
		
		$smarty->assign("dataDoDetail", $dataDoDetail);
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		
		$smarty->assign("breadcumbTitle", "Transaksi Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi penjualan, faktur penjualan.");
		$smarty->assign("breadcumbMenuName", "Transaksi Penjualan");
		$smarty->assign("breadcumbMenuSubName", "Transaksi Penjualan");
	}
	
	// if module out and act is finish
	elseif ($module == 'out' && $act == 'finish')
	{
		$doNo = $_GET['doNo'];
		$invoiceID = $_GET['invoiceID'];
		$invoiceNo = $_GET['invoiceNo'];
		
		$querySales = "SELECT * FROM as_sales_transactions WHERE doNo = '$doNo' AND invoiceID = '$invoiceID' AND invoiceNo = '$invoiceNo'";
		$sqlSales = mysqli_query($connect, $querySales);
		$dataSales = mysqli_fetch_array($sqlSales);
		
		if ($dataSales['paymentType'] == '1')
		{
			$paymentType = "TUNAI";
			$expiredPayment = "";
		}
		else
		{
			$paymentType = "TERMIN";
			$expiredPayment = tgl_indo2($dataSales['expiredPayment']);
		}
		
		if ($dataSales['ppnType'] == '1')
		{
			$ppnType = "PPN";
			$ppn = rupiah($dataSales['ppn']);
		}
		else
		{
			$ppnType = "NO PPN";
			$ppn = rupiah(0);
		}
		
		// assign to the tpl
		$smarty->assign("invoiceID", $dataSales['invoiceID']);
		$smarty->assign("invoiceNo", $dataSales['invoiceNo']);
		$smarty->assign("invoiceDate", tgl_indo2($dataSales['invoiceDate']));
		$smarty->assign("doNo", $dataSales['doNo']);
		$smarty->assign("soNo", $dataSales['soNo']);
		$smarty->assign("paymentType", $paymentType);
		$smarty->assign("expiredPayment", $expiredPayment);
		$smarty->assign("ppnType", $ppnType);
		$smarty->assign("ppn", $ppn);
		$smarty->assign("discount", rupiah($dataSales['discount']));
		$smarty->assign("basic", rupiah($dataSales['basic']));
		$smarty->assign("total", rupiah($dataSales['total']));
		$smarty->assign("grandtotal", rupiah($dataSales['grandtotal']));
		$smarty->assign("pay", rupiah($dataSales['pay']));
		$smarty->assign("customerID", $dataSales['customerID']);
		$smarty->assign("customerName", $dataSales['customerName']);
		$smarty->assign("customerAddress", $dataSales['customerAddress']);
		$smarty->assign("staffID", $dataSales['staffID']);
		$smarty->assign("staffName", $dataSales['staffName']);
		
		// show receive
		$queryReceive = "SELECT receiveTotal FROM as_receivables WHERE invoiceNo = '$_GET[invoiceNo]' AND invoiceID = '$_GET[invoiceID]'";
		$sqlReceive = mysqli_query($connect, $queryReceive);
		$dataReceive = mysqli_fetch_array($sqlReceive);
		
		$smarty->assign("receive", rupiah($dataReceive['receiveTotal']));
		
		// show the do detail
		$queryDoDetail = "SELECT * FROM as_detail_do WHERE doNo = '$dataSales[doNo]' ORDER BY doID ASC";
		$sqlDoDetail = mysqli_query($connect, $queryDoDetail);
		
		$i = 1;
		while ($dtDoDetail = mysqli_fetch_array($sqlDoDetail))
		{
			$subtotal = rupiah($dtDoDetail['deliveredQty'] * $dtDoDetail['price']);
			
			$dataDoDetail[] = array(	'detailID' => $dtDoDetail['doID'],
										'doNo' => $dtDoDetail['doNo'],
										'doFaktur' => $dtDoDetail['doFaktur'],
										'productID' => $dtDoDetail['productID'],
										'productName' => $dtDoDetail['productName'],
										'pricerp' => rupiah($dtDoDetail['price']),
										'qty' => $dtDoDetail['qty'],
										'deliveredQty' => $dtDoDetail['deliveredQty'],
										'subtotal' => $subtotal,
										'no' => $i
										);
			$i++;
		}
		
		$smarty->assign("dataDoDetail", $dataDoDetail);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("breadcumbTitle", "Transaksi Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi penjualan, faktur penjualan.");
		$smarty->assign("breadcumbMenuName", "Transaksi Penjualan");
		$smarty->assign("breadcumbMenuSubName", "Transaksi Penjualan");
	}
	
	// if the module out and act is add
	elseif ($module == 'out' && $act == 'add')
	{
		// get last sort out number ID
		$queryNoOut = "SELECT invoiceNo FROM as_sales_transactions ORDER BY invoiceNo DESC LIMIT 1";
		$sqlNoOut = mysqli_query($connect, $queryNoOut);
		$numsNoOut = mysqli_num_rows($sqlNoOut);
		$dataNoOut = mysqli_fetch_array($sqlNoOut);
		
		$start = substr($dataNoOut['invoiceNo'],2-7);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoOut == '0')
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
		
		$invoiceNo = "TJ".$outNo.$next;
		
		$smarty->assign("invoiceNo", $invoiceNo);
		$smarty->assign("invoiceDate", tgl_indo2(date('Y-m-d')));
		
		$doNo = $_GET['doNo'];
		
		// show the bbm
		$queryDo = "SELECT * FROM as_delivery_order WHERE doNo = '$doNo'";
		$sqlDo = mysqli_query($connect, $queryDo);
		$dataDo = mysqli_fetch_array($sqlDo);
		$numsDo = mysqli_num_rows($sqlDo);
		
		$smarty->assign("numsDo", $numsDo);
		
		// show the do data
		$querySSales = "SELECT invoiceID FROM as_sales_transactions WHERE doNo = '$doNo'";
		$sqlSSales = mysqli_query($connect, $querySSales);
		$numsSSales = mysqli_num_rows($sqlSSales);
		
		$smarty->assign("numsSSales", $numsSSales);
		
		// assign to the tpl
		$smarty->assign("doID", $dataDo['doID']);
		$smarty->assign("doNo", $_GET['doNo']);
		$smarty->assign("soID", $dataDo['soID']);
		$smarty->assign("soNo", $dataDo['soNo']);
		$smarty->assign("customerID", $dataDo['customerID']);
		$smarty->assign("customerName", $dataDo['customerName']);
		$smarty->assign("customerAddress", $dataDo['customerAddress']);
		$smarty->assign("staffID", $dataDo['staffID']);
		$smarty->assign("staffName", $dataDo['staffName']);
		$smarty->assign("deliveredDate", tgl_indo2($dataDo['deliveredDate']));
		$smarty->assign("orderDate", tgl_indo2($dataDo['orderDate']));
		$smarty->assign("needDate", tgl_indo2($dataDo['needDate']));
		$smarty->assign("total", number_format($dataDo['total'], 2, '.', ''));
		$smarty->assign("totalrp", rupiah($dataDo['total']));
		$smarty->assign("note", $dataDo['note']);
		
		// show up the do detail
		// show the do detail
		$queryDoDetail = "SELECT * FROM as_detail_do WHERE doNo = '$dataDo[doNo]' AND doFaktur = '$dataDo[doFaktur]' ORDER BY doID ASC";
		$sqlDoDetail = mysqli_query($connect, $queryDoDetail);
		
		$i = 1;
		while ($dtDoDetail = mysqli_fetch_array($sqlDoDetail))
		{
			$subtotal = $dtDoDetail['deliveredQty'] * $dtDoDetail['price'];
			
			$dataDoDetail[] = array(	'detailID' => $dtDoDetail['doID'],
										'doNo' => $dtDoDetail['doNo'],
										'doFaktur' => $dtDoDetail['doFaktur'],
										'productID' => $dtDoDetail['productID'],
										'productName' => $dtDoDetail['productName'],
										'price' => $dtDoDetail['price'],
										'pricerp' => rupiah($dtDoDetail['price']),
										'qty' => $dtDoDetail['qty'],
										'deliveredQty' => $dtDoDetail['deliveredQty'],
										'status' => $dtDoDetail['deliveredStatus'],
										'factoryID' => $dtDoDetail['factoryID'],
										'factoryName' => $dtDoDetail['factoryName'],
										'subtotal' => rupiah($subtotal),
										'note' => $dtDoDetail['note'],
										'no' => $i
										);
			$i++;
		}
		
		$smarty->assign("dataDoDetail", $dataDoDetail);
			
		$smarty->assign("breadcumbTitle", "Transaksi Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi penjualan, faktur penjualan.");
		$smarty->assign("breadcumbMenuName", "Transaksi Penjualan");
		$smarty->assign("breadcumbMenuSubName", "Transaksi Penjualan");
	}

	elseif ($module == 'out' && $act == 'search')
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
		
		// showing up the sales data
		if ($sDate != '' && $eDate != '')
		{
			$querySales = "SELECT * FROM as_sales_transactions WHERE invoiceNo LIKE '%$q%' AND invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY invoiceNo DESC";
		}
		else
		{
			$querySales = "SELECT * FROM as_sales_transactions WHERE invoiceNo LIKE '%$q%' ORDER BY invoiceNo DESC";
		}
		
		$sqlSales = mysqli_query($connect, $querySales);
		
		// fetch data
		$i = 1 + $position;
		while ($dtSales = mysqli_fetch_array($sqlSales))
		{
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
			
			$dataSales[] = array(	'invoiceID' => $dtSales['invoiceID'],
									'invoiceNo' => $dtSales['invoiceNo'],
									'invoiceDate' => tgl_indo2($dtSales['invoiceDate']),
									'doNo' => $dtSales['doNo'],
									'soNo' => $dtSales['soNo'],
									'paymentType' => $paymentType,
									'expiredPayment' => $expiredPayment,
									'ppnType' => $ppnType,
									'ppn' => $ppn,
									'total' => rupiah($dtSales['total']),
									'grandtotal' => rupiah($dtSales['grandtotal']),
									'pay' => rupiah($dtSales['pay']),
									'staffID' => $dtSales['staffID'],
									'staffName' => $dtSales['staffName'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataSales", $dataSales);
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Transaksi Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi penjualan, faktur penjualan.");
		$smarty->assign("breadcumbMenuName", "Transaksi Penjualan");
		$smarty->assign("breadcumbMenuSubName", "Transaksi Penjualan");
	}
	
	else
	{
		// create new object pagination
		$p = new PaginationOut;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the sales data
		$querySales = "SELECT * FROM as_sales_transactions ORDER BY invoiceID DESC LIMIT $position,$limit";
		$sqlSales = mysqli_query($connect, $querySales);
		
		// fetch data
		$i = 1 + $position;
		while ($dtSales = mysqli_fetch_array($sqlSales))
		{
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
			
			$dataSales[] = array(	'invoiceID' => $dtSales['invoiceID'],
									'invoiceNo' => $dtSales['invoiceNo'],
									'invoiceDate' => tgl_indo2($dtSales['invoiceDate']),
									'doNo' => $dtSales['doNo'],
									'soNo' => $dtSales['soNo'],
									'paymentType' => $paymentType,
									'expiredPayment' => $expiredPayment,
									'ppnType' => $ppnType,
									'ppn' => $ppn,
									'total' => rupiah($dtSales['total']),
									'grandtotal' => rupiah($dtSales['grandtotal']),
									'pay' => rupiah($dtSales['pay']),
									'staffID' => $dtSales['staffID'],
									'staffName' => $dtSales['staffName'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataSales", $dataSales);
		
		// count data
		$queryCountSales = "SELECT * FROM as_sales_transactions";
		$sqlCountSales = mysqli_query($connect, $queryCountSales);
		$amountData = mysqli_num_rows($sqlCountSales);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Transaksi Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi penjualan, faktur penjualan.");
		$smarty->assign("breadcumbMenuName", "Transaksi Penjualan");
		$smarty->assign("breadcumbMenuSubName", "Transaksi Penjualan");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>