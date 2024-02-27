<?php
// include header
include "header.php";
// set the tpl page
$page = "in.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '8'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is in and action is delete
	if ($module == 'in' && $act == 'delete')
	{
		// insert method into a variable
		$inID = $_GET['invoiceID'];
		$inNo = $_GET['invoiceNo'];
		
		// delete invoice
		$queryInvoice = "DELETE FROM as_buy_transactions WHERE invoiceID = '$inID' AND invoiceNo = '$inNo'";
		$sqlInvoice = mysqli_query($connect, $queryInvoice);
		
		// delete debt
		$queryDebt = "DELETE FROM as_debts WHERE invoiceID = '$inID' AND invoiceNo = '$inNo'";
		$sqlDebt = mysqli_query($connect, $queryDebt);
		
		// redirect to the in page
		header("Location: in.php?msg=Data transaksi pembelian berhasil dihapus");
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
	elseif ($module == 'in' && $act == 'input')
	{
		$createdDate = date('Y-m-d H:i:s');
		$staffID = $_SESSION['staffID'];
		$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
		$invoiceNo = mysqli_real_escape_string($connect, $_POST['invoiceNo']);
		$iDate = explode("-", $_POST['invoiceDate']);
		$invoiceDate = $iDate[2]."-".$iDate[1]."=".$iDate[0];
		$bbmNo = mysqli_real_escape_string($connect, $_POST['bbmNo']);
		$spbNo = mysqli_real_escape_string($connect, $_POST['spbNo']);
		$supplierID = $_POST['supplierID'];
		$supplierName = mysqli_real_escape_string($connect, $_POST['supplierName']);
		$supplierAddress = mysqli_real_escape_string($connect, $_POST['supplierAddress']);
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
		
		// get last sort debt 
		$queryNoDebt = "SELECT debtNo FROM as_debts ORDER BY debtNo DESC LIMIT 1";
		$sqlNoDebt = mysqli_query($connect, $queryNoDebt);
		$numsNoDebt = mysqli_num_rows($sqlNoDebt);
		$dataNoDebt = mysqli_fetch_array($sqlNoDebt);
		
		$start = substr($dataNoDebt['debtNo'],2-7);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoDebt == '0')
		{
			$deNo = "00000";
		}
		elseif ($tempNo == 1)
		{
			$deNo = "00000";
		}
		elseif ($tempNo == 2)
		{
			$deNo = "0000";
		}
		elseif ($tempNo == 3)
		{
			$deNo = "000";
		}
		elseif ($tempNo == 4)
		{
			$deNo = "00";
		}
		elseif ($tempNo == 5)
		{
			$deNo = "0";
		}
		elseif ($tempNo == 6)
		{
			$deNo = "";
		}
		
		$debtNo = "DB".$deNo.$next;
		
		$queryBuy = "INSERT INTO as_buy_transactions (	invoiceNo,
														invoiceDate,
														bbmNo,
														spbNo,
														paymentType,
														expiredPayment,
														ppnType,
														ppn,
														total,
														basic,
														discount,
														grandtotal,
														supplierID,
														supplierName,
														supplierAddress,
														staffID,
														staffName,
														createdDate,
														createdUserID,
														modifiedDate,
														modifiedUserID)
												VALUES(	'$invoiceNo',
														'$invoiceDate',
														'$bbmNo',
														'$spbNo',
														'$paymentType',
														'$expiredDate',
														'$ppnType',
														'$ppn',
														'$total',
														'$basic',
														'$discount',
														'$grandtotal',
														'$supplierID',
														'$supplierName',
														'$supplierAddress',
														'$staffID',
														'$sName',
														'$createdDate',
														'$staffID',
														'',
														'')";
		
		$sqlBuy = mysqli_query($connect, $queryBuy);
		
		$invoiceID = mysqli_insert_id($connect);
		
		if ($sqlBuy)
		{
			//if ($paymentType == '2')
			//{
				$queryDebt = "INSERT INTO as_debts (debtNo,
													invoiceID,
													invoiceNo,
													supplierID,
													supplierName,
													supplierAddress,
													debtTotal,
													incomingTotal,
													status,
													staffID,
													staffName,
													createdDate,
													createdUserID,
													modifiedDate,
													modifiedUserID)
											VALUES(	'$debtNo',
													'$invoiceID',
													'$invoiceNo',
													'$supplierID',
													'$supplierName',
													'$supplierAddress',
													'$grandtotal',
													'0',
													'1',
													'$staffID',
													'$sName',
													'$createdDate',
													'$staffID',
													'',
													'')";
													
				mysqli_query($connect, $queryDebt);
			//}
			
			$queryDetailBbm = "SELECT productID, price FROM as_detail_bbm WHERE bbmNo = '$bbmNo'";
			$sqlDetailBbm = mysqli_query($connect, $queryDetailBbm);
			
			while ($dataDetailBbm = mysqli_fetch_array($sqlDetailBbm))
			{
				$queryProduct = "UPDATE as_products SET purchasePrice = '$dataDetailBbm[price]', hpp = '$dataDetailBbm[price]' WHERE productID = '$dataDetailBbm[productID]'";
				mysqli_query($connect, $queryProduct);
			}
		}
		
		header("Location: in.php?module=in&act=finish&bbmNo=".$bbmNo."&invoiceNo=".$invoiceNo."&invoiceID=".$invoiceID);
	}
	
	// if the module is in and act is detailin
	elseif ($module == 'in' && $act == 'detailin')
	{
		$bbmNo = $_GET['bbmNo'];
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		$invoiceID = $_GET['invoiceID'];
		$invoiceNo = $_GET['invoiceNo'];
		
		$queryBuy = "SELECT * FROM as_buy_transactions WHERE bbmNo = '$bbmNo' AND invoiceID = '$invoiceID' AND invoiceNo = '$invoiceNo'";
		$sqlBuy = mysqli_query($connect, $queryBuy);
		$dataBuy = mysqli_fetch_array($sqlBuy);
		
		if ($dataBuy['paymentType'] == '1')
		{
			$paymentType = "TUNAI";
			$expiredPayment = "";
		}
		else
		{
			$paymentType = "TERMIN";
			$expiredPayment = tgl_indo2($dataBuy['expiredPayment']);
		}
		
		if ($dataBuy['ppnType'] == '1')
		{
			$ppnType = "PPN";
			$ppn = rupiah($dataBuy['ppn']);
		}
		else
		{
			$ppnType = "NO PPN";
			$ppn = rupiah(0);
		}
		
		// assign to the tpl
		$smarty->assign("invoiceID", $dataBuy['invoiceID']);
		$smarty->assign("invoiceNo", $dataBuy['invoiceNo']);
		$smarty->assign("invoiceDate", tgl_indo2($dataBuy['invoiceDate']));
		$smarty->assign("bbmNo", $dataBuy['bbmNo']);
		$smarty->assign("spbNo", $dataBuy['spbNo']);
		$smarty->assign("paymentType", $paymentType);
		$smarty->assign("expiredPayment", $expiredPayment);
		$smarty->assign("ppnType", $ppnType);
		$smarty->assign("ppn", $ppn);
		$smarty->assign("discount", rupiah($dataBuy['discount']));
		$smarty->assign("basic", rupiah($dataBuy['basic']));
		$smarty->assign("total", rupiah($dataBuy['total']));
		$smarty->assign("grandtotal", rupiah($dataBuy['grandtotal']));
		$smarty->assign("pay", rupiah($dataBuy['pay']));
		$smarty->assign("supplierID", $dataBuy['supplierID']);
		$smarty->assign("supplierName", $dataBuy['supplierName']);
		$smarty->assign("supplierAddress", $dataBuy['supplierAddress']);
		$smarty->assign("staffID", $dataBuy['staffID']);
		$smarty->assign("staffName", $dataBuy['staffName']);
		
		// show debt
		$queryDebt = "SELECT debtTotal FROM as_debts WHERE invoiceNo = '$_GET[invoiceNo]' AND invoiceID = '$_GET[invoiceID]'";
		$sqlDebt = mysqli_query($connect, $queryDebt);
		$dataDebt = mysqli_fetch_array($sqlDebt);
		
		$smarty->assign("debt", rupiah($dataDebt['debtTotal']));
		
		// show the bbm detail
		$queryBbmDetail = "SELECT * FROM as_detail_bbm WHERE bbmNo = '$dataBuy[bbmNo]' ORDER BY detailID ASC";
		$sqlBbmDetail = mysqli_query($connect, $queryBbmDetail);
		
		$i = 1;
		while ($dtBbmDetail = mysqli_fetch_array($sqlBbmDetail))
		{
			$subtotal = rupiah($dtBbmDetail['receiveQty'] * $dtBbmDetail['price']);
			
			$dataBbmDetail[] = array(	'detailID' => $dtBbmDetail['detailID'],
										'bbmNo' => $dtBbmDetail['bbmNo'],
										'bbmFaktur' => $dtBbmDetail['bbmFaktur'],
										'productID' => $dtBbmDetail['productID'],
										'productName' => $dtBbmDetail['productName'],
										'pricerp' => rupiah($dtBbmDetail['price']),
										'qty' => $dtBbmDetail['qty'],
										'receiveQty' => $dtBbmDetail['receiveQty'],
										'subtotal' => $subtotal,
										'no' => $i
										);
			$i++;
		}
		
		$smarty->assign("dataBbmDetail", $dataBbmDetail);
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		$smarty->assign("breadcumbTitle", "Transaksi Pembelian");
		$smarty->assign("breadcumbMenuName", "Transaksi Pembelian");
	}
	
	// if module in and act is finish
	elseif ($module == 'in' && $act == 'finish')
	{
		$bbmNo = $_GET['bbmNo'];
		$invoiceID = $_GET['invoiceID'];
		$invoiceNo = $_GET['invoiceNo'];
		
		$queryBuy = "SELECT * FROM as_buy_transactions WHERE bbmNo = '$bbmNo' AND invoiceID = '$invoiceID' AND invoiceNo = '$invoiceNo'";
		$sqlBuy = mysqli_query($connect, $queryBuy);
		$dataBuy = mysqli_fetch_array($sqlBuy);
		
		if ($dataBuy['paymentType'] == '1')
		{
			$paymentType = "TUNAI";
			$expiredPayment = "";
		}
		else
		{
			$paymentType = "TERMIN";
			$expiredPayment = tgl_indo2($dataBuy['expiredPayment']);
		}
		
		if ($dataBuy['ppnType'] == '1')
		{
			$ppnType = "PPN";
			$ppn = rupiah($dataBuy['ppn']);
		}
		else
		{
			$ppnType = "NO PPN";
			$ppn = rupiah(0);
		}
		
		// assign to the tpl
		$smarty->assign("invoiceID", $dataBuy['invoiceID']);
		$smarty->assign("invoiceNo", $dataBuy['invoiceNo']);
		$smarty->assign("invoiceDate", tgl_indo2($dataBuy['invoiceDate']));
		$smarty->assign("bbmNo", $dataBuy['bbmNo']);
		$smarty->assign("spbNo", $dataBuy['spbNo']);
		$smarty->assign("paymentType", $paymentType);
		$smarty->assign("expiredPayment", $expiredPayment);
		$smarty->assign("ppnType", $ppnType);
		$smarty->assign("ppn", $ppn);
		$smarty->assign("discount", rupiah($dataBuy['discount']));
		$smarty->assign("basic", rupiah($dataBuy['basic']));
		$smarty->assign("total", rupiah($dataBuy['total']));
		$smarty->assign("grandtotal", rupiah($dataBuy['grandtotal']));
		$smarty->assign("pay", rupiah($dataBuy['pay']));
		$smarty->assign("supplierID", $dataBuy['supplierID']);
		$smarty->assign("supplierName", $dataBuy['supplierName']);
		$smarty->assign("supplierAddress", $dataBuy['supplierAddress']);
		$smarty->assign("staffID", $dataBuy['staffID']);
		$smarty->assign("staffName", $dataBuy['staffName']);
		
		// show debt
		$queryDebt = "SELECT debtTotal FROM as_debts WHERE invoiceNo = '$_GET[invoiceNo]' AND invoiceID = '$_GET[invoiceID]'";
		$sqlDebt = mysqli_query($connect, $queryDebt);
		$dataDebt = mysqli_fetch_array($sqlDebt);
		
		$smarty->assign("debt", rupiah($dataDebt['debtTotal']));
		
		// show the bbm detail
		$queryBbmDetail = "SELECT * FROM as_detail_bbm WHERE bbmNo = '$dataBuy[bbmNo]' ORDER BY detailID ASC";
		$sqlBbmDetail = mysqli_query($connect, $queryBbmDetail);
		
		$i = 1;
		while ($dtBbmDetail = mysqli_fetch_array($sqlBbmDetail))
		{
			$subtotal = rupiah($dtBbmDetail['receiveQty'] * $dtBbmDetail['price']);
			
			$dataBbmDetail[] = array(	'detailID' => $dtBbmDetail['detailID'],
										'bbmNo' => $dtBbmDetail['bbmNo'],
										'bbmFaktur' => $dtBbmDetail['bbmFaktur'],
										'productID' => $dtBbmDetail['productID'],
										'productName' => $dtBbmDetail['productName'],
										'pricerp' => rupiah($dtBbmDetail['price']),
										'qty' => $dtBbmDetail['qty'],
										'receiveQty' => $dtBbmDetail['receiveQty'],
										'subtotal' => $subtotal,
										'no' => $i
										);
			$i++;
		}
		
		$smarty->assign("dataBbmDetail", $dataBbmDetail);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("breadcumbTitle", "Transaksi Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi pembelian, faktur pembelian.");
		$smarty->assign("breadcumbMenuName", "Transaksi Pembelian");
		$smarty->assign("breadcumbMenuSubName", "Transaksi Pembelian");
	}
	
	// if the module in and act is add
	elseif ($module == 'in' && $act == 'add')
	{
		// get last sort in number ID
		$queryNoIn = "SELECT invoiceNo FROM as_buy_transactions ORDER BY invoiceNo DESC LIMIT 1";
		$sqlNoIn = mysqli_query($connect, $queryNoIn);
		$numsNoIn = mysqli_num_rows($sqlNoIn);
		$dataNoIn = mysqli_fetch_array($sqlNoIn);
		
		$start = substr($dataNoIn['invoiceNo'],2-7);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoIn == '0')
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
		
		$invoiceNo = $inNo.$next;
		
		$smarty->assign("invoiceNo", $invoiceNo);
		$smarty->assign("invoiceDate", tgl_indo2(date('Y-m-d')));
		
		$bbmNo = $_GET['bbmNo'];
		
		// show the bbm
		$queryBbm = "SELECT * FROM as_bbm WHERE bbmNo = '$bbmNo'";
		$sqlBbm = mysqli_query($connect, $queryBbm);
		$dataBbm = mysqli_fetch_array($sqlBbm);
		$numsBbm = mysqli_num_rows($sqlBbm);
		
		$smarty->assign("numsBbm", $numsBbm);
		
		// show the bbm data
		$queryBBuy = "SELECT invoiceID FROM as_buy_transactions WHERE bbmNo = '$bbmNo'";
		$sqlBBuy = mysqli_query($connect, $queryBBuy);
		$numsBBuy = mysqli_num_rows($sqlBBuy);
		
		$smarty->assign("numsBBuy", $numsBBuy);
		
		// assign to the tpl
		$smarty->assign("bbmID", $dataBbm['bbmID']);
		$smarty->assign("bbmNo", $_GET['bbmNo']);
		$smarty->assign("spbID", $dataBbm['spbID']);
		$smarty->assign("spbNo", $dataBbm['spbNo']);
		$smarty->assign("supplierID", $dataBbm['supplierID']);
		$smarty->assign("supplierName", $dataBbm['supplierName']);
		$smarty->assign("supplierAddress", $dataBbm['supplierAddress']);
		$smarty->assign("staffID", $dataBbm['staffID']);
		$smarty->assign("staffName", $dataBbm['staffName']);
		$smarty->assign("receiveDate", tgl_indo2($dataBbm['receiveDate']));
		$smarty->assign("orderDate", tgl_indo2($dataBbm['orderDate']));
		$smarty->assign("needDate", tgl_indo2($dataBbm['needDate']));
		$smarty->assign("total", number_format($dataBbm['total'], 2, '.', ''));
		$smarty->assign("totalrp", rupiah($dataBbm['total']));
		$smarty->assign("note", $dataBbm['note']);
		
		// show up the bbm detail
		// show the bbm detail
		$queryBbmDetail = "SELECT * FROM as_detail_bbm WHERE bbmNo = '$dataBbm[bbmNo]' AND bbmFaktur = '$dataBbm[bbmFaktur]' ORDER BY detailID ASC";
		$sqlBbmDetail = mysqli_query($connect, $queryBbmDetail);
		
		$i = 1;
		while ($dtBbmDetail = mysqli_fetch_array($sqlBbmDetail))
		{
			$subtotal = $dtBbmDetail['receiveQty'] * $dtBbmDetail['price'];
			
			$dataBbmDetail[] = array(	'detailID' => $dtBbmDetail['detailID'],
										'bbmNo' => $dtBbmDetail['bbmNo'],
										'bbmFaktur' => $dtBbmDetail['bbmFaktur'],
										'productID' => $dtBbmDetail['productID'],
										'productName' => $dtBbmDetail['productName'],
										'price' => $dtBbmDetail['price'],
										'pricerp' => rupiah($dtBbmDetail['price']),
										'qty' => $dtBbmDetail['qty'],
										'receiveQty' => $dtBbmDetail['receiveQty'],
										'status' => $dtBbmDetail['receiveStatus'],
										'factoryID' => $dtBbmDetail['factoryID'],
										'factoryName' => $dtBbmDetail['factoryName'],
										'subtotal' => rupiah($subtotal),
										'note' => $dtBbmDetail['note'],
										'no' => $i
										);
			$i++;
		}
		
		$smarty->assign("dataBbmDetail", $dataBbmDetail);
			
		$smarty->assign("breadcumbTitle", "Transaksi Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi pembelian, faktur pembelian.");
		$smarty->assign("breadcumbMenuName", "Transaksi Pembelian");
		$smarty->assign("breadcumbMenuSubName", "Transaksi Pembelian");
	}

	elseif ($module == 'in' && $act == 'search')
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
		
		// showing up the buy data
		if ($sDate != '' || $eDate != '')
		{
			$queryBuy = "SELECT * FROM as_buy_transactions WHERE invoiceNo LIKE '%$q%' AND invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY invoiceNo DESC";
		}
		else
		{
			$queryBuy = "SELECT * FROM as_buy_transactions WHERE invoiceNo LIKE '%$q%' ORDER BY invoiceNo DESC";	
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
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Transaksi Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi pembelian, faktur pembelian.");
		$smarty->assign("breadcumbMenuName", "Transaksi Pembelian");
		$smarty->assign("breadcumbMenuSubName", "Transaksi Pembelian");
	}
	
	else
	{
		// create new object pagination
		$p = new PaginationIn;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the buy data
		$queryBuy = "SELECT * FROM as_buy_transactions ORDER BY invoiceID DESC LIMIT $position,$limit";
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
		
		// count data
		$queryCountBuy = "SELECT * FROM as_buy_transactions";
		$sqlCountBuy = mysqli_query($connect, $queryCountBuy);
		$amountData = mysqli_num_rows($sqlCountBuy);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Transaksi Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi pembelian, faktur pembelian.");
		$smarty->assign("breadcumbMenuName", "Transaksi Pembelian");
		$smarty->assign("breadcumbMenuSubName", "Transaksi Pembelian");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>