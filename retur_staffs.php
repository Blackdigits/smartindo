<?php
// include header
include "header.php";
// set the tpl page
$page = "retur_staffs.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '11'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is retursale and action is delete
	if ($module == 'retursale' && $act == 'delete')
	{
		// insert method into a variable
		$returID = $_GET['returID'];
		$returNo = $_GET['returNo'];
		/* 
		// show the invoice no, retur type, grandtotal, customerID
		$queryRetur = "SELECT invoiceNo, returType, grandtotal, customerID FROM as_retur_staffs WHERE returID = '$returID' AND returNo = '$returNo'";
		$sqlRetur = mysqli_query($connect, $queryRetur);
		$dataRetur = mysqli_fetch_array($sqlRetur);
		
		// if the retur type is add to the balance, reduction in the balance based on supplier id on the supplier data 
		if ($dataRetur['returType'] == '2')
		{
			$grandtotal = $dataRetur['grandtotal'];
			$queryReturCash = "UPDATE as_customers SET balance=balance-$grandtotal WHERE customerID = '$dataRetur[customerID]'";
			$sqlReturCash = mysqli_query($connect, $queryReturCash);
		}
		// if the retur type is credit, reduction the debts about this transactions
		if ($dataRetur['returType'] == '3')
		{
			$grandtotal = $dataRetur['grandtotal'];
			$queryReturCash = "UPDATE as_receivables SET reductionTotal=reductionTotal-$grandtotal WHERE invoiceNo = '$dataRetur[invoiceNo]' AND customerID = '$dataRetur[customerID]'";
			$sqlReturCash = mysqli_query($connect, $queryReturCash);
		} */
		
		// show the detail of retur, factoryID, productID and qty based on retur id and retur no
		$queryDetail = "SELECT factoryID, productID, qty FROM as_detail_retur_staffs WHERE returID = '$returID' AND returNo = '$returNo'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		while ($dataDetail = mysqli_fetch_array($sqlDetail))
		{
			$qty = $dataDetail['qty'];
			
			// addition of the balance based on factory id and product id
			$querySP = "UPDATE as_stock_products SET stock=stock-$qty WHERE factoryID = '$dataDetail[factoryID]' AND productID = '$dataDetail[productID]'";
			mysqli_query($connect, $querySP);
		}
		
		// delete the retur data based on retur id and retur no
		$queryDelete = "DELETE FROM as_retur_staffs WHERE returID = '$returID' AND returNo = '$returNo'";
		$sqlDelete = mysqli_query($connect, $queryDelete);
		
		if ($sqlDelete)
		{
			// delete the detail retur data based on retur id and retur no
			$queryDeleteDetail = "DELETE FROM as_detail_retur_staffs WHERE returID = '$returID' AND returNo = '$returNo'";
			$sqlDeleteDetail = mysqli_query($connect, $queryDeleteDetail);
		}

		// redirect to the retur staff page
		header("Location: retur_staffs.php?msg=Data retur penjualan berhasil dihapus/dibatalkan");
	} // close bracket
	
	// if the module is retursale and action is cancel
	elseif ($module == 'retursale' && $act == 'cancel')
	{
		// redirect to the retur staff page
		header("Location: retur_staffs.php?msg=Transaksi retur penjualan dibatalkan.");
	}
	
	// if the module is retur sale and act is input
	elseif ($module == 'retursale' && $act == 'input')
	{   $subt = 0;
        $date = date('Y-m-d');
		$createdDate = date('Y-m-d H:i:s');
		$staffID = $_SESSION['staffID'];
		$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
		$returNo = mysqli_real_escape_string($connect, $_POST['returNo']);
		$rDate = mysqli_real_escape_string($connect, $_POST['returDate']);
		$r2Date = explode("-", $rDate);
		$returDate = $r2Date[2]."-".$r2Date[1]."-".$r2Date[0];
		$invoiceNo = mysqli_real_escape_string($connect, $_POST['invoiceNo']);
		$customerID = mysqli_real_escape_string($connect, $_POST['customerID']);
		$customerName = mysqli_real_escape_string($connect, $_POST['kustodian']); 
		$returType = mysqli_real_escape_string($connect, $_POST['returType']);
		$ppnType = mysqli_real_escape_string($connect, $_POST['ppnType']);
		$ref = mysqli_real_escape_string($connect, $_POST['ref']);
		$note = mysqli_real_escape_string($connect, $_POST['note']);
		
		$factoryID = $_POST['factoryID'];
		$factoryName = $_POST['factoryName'];
		$productID = $_POST['productID'];
		$productName = $_POST['productName'];
		$qty = $_POST['qty'];
		$unitPrice = $_POST['unitPrice'];
		$desc = $_POST['desc'];
		$detailID = $_POST['productID'];
		$countDetailID = COUNT($detailID);
		
		// save into the retur staff table
		$queryRetur = "INSERT INTO as_retur_staffs (	returNo,
														returDate,
														invoiceNo,
														customerID,
														customerName,
														customerAddress,
														returType,
														subtotal,
														ppnType,
														ppn,
														grandtotal,
														staffID,
														staffName,
														ref,
														note,
														createdDate,
														createdUserID,
														modifiedDate,
														modifiedUserID)
												VALUES(	'$returNo',
														'$returDate',
														'$factoryID',
														'$customerID',
														'$customerName',
														'$factoryName',
														'$returType',
														'0',
														'$ppnType',
														'0',
														'0',
														'$staffID',
														'$sName',
														'$ref',
														'$note',
														'$createdDate',
														'$staffID',
														'$date',
														'')";
														
		$sqlRetur = mysqli_query($connect, $queryRetur); 
		$returID = mysqli_insert_id($connect);
		
		if ($sqlRetur)
		{
			for ($i = 0; $i < $countDetailID; $i++)
			{
				if ($qty[$i] > 0)
				{
					$subt = $unitPrice[$i] * $qty[$i];
					
					$queryDetail = "INSERT INTO as_detail_retur_staffs (	returID,
																			returNo,
																			factoryID,
																			factoryName,
																			productID,
																			productName,
																			qty,
																			unitPrice,
																			note,
																			createdDate,
																			createdUserID,
																			modifiedDate,
																			modifiedUserID)
																	VALUES(	'$returID',
																			'$returNo',
																			'$factoryID',
																			'$factoryName',
																			'$productID[$i]',
																			'$productName[$i]',
																			'$qty[$i]',
																			'$unitPrice[$i]',
																			'$desc[$i]',
																			'$createdDate',
																			'$staffID',
																			'$date',
																			'')";
																			
					$save = mysqli_query($connect, $queryDetail);
					
					if ($save)
					{
						// reduction of the stock based on factory id and product id
						$querySP = "UPDATE as_stock_products SET stock=stock+$qty[$i] WHERE factoryID = '$factoryID' AND productID = '$productID[$i]' AND supplierID IS NULL;";
						mysqli_query($connect, $querySP);
					}
					
					$subtotal = $subtotal + $subt;
				}
			}

            $grandtotal = $subtotal; 
			$queryUpdate = "UPDATE as_retur_staffs SET subtotal = '$subtotal', ppn = '0', grandtotal = '$grandtotal' WHERE returID = '$returID'";
			mysqli_query($connect, $queryUpdate);
			
            /*
			if ($ppnType == '1')
			{
				$ppn = $subtotal * 0.1;
			}
			else
			{
				$ppn = 0;
			} 
            
			// if the retur type is add to the balance, reduction in the balance based on supplier id on the supplier data
			if ($returType == '2')
			{
				$queryReturSaldo = "UPDATE as_customers SET balance=balance+$grandtotal WHERE customerID = '$customerID'";
				$sqlReturSaldo = mysqli_query($connect, $queryReturSaldo);
			}
			// if the retur type is credit, reduction the debts about this transactions
			if ($returType == '3')
			{
				$queryReturCash = "UPDATE as_receivables SET reductionTotal=reductionTotal+$grandtotal WHERE invoiceNo = '$invoiceNo' AND customerID = '$customerID'";
				$sqlReturCash = mysqli_query($connect, $queryReturCash);
			} */
		} 
		header("Location: retur_staffs.php?module=retursale&act=finish&invoiceNo=".$invoiceNo."&returNo=".$returNo."&returID=".$returID);
	}
	
	// if the module is retursale and act is detailretur
	elseif ($module == 'retursale' && $act == 'detailretur')
	{
		$invoiceNo = $_GET['invoiceNo'];
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		$returID = $_GET['returID'];
		$returNo = $_GET['returNo'];
		
		$queryRetur = "SELECT * FROM as_retur_staffs WHERE invoiceNo = '$invoiceNo' AND returID = '$returID' AND returNo = '$returNo'";
		$sqlRetur = mysqli_query($connect, $queryRetur);
		$dataRetur = mysqli_fetch_array($sqlRetur);
		
		if ($dataRetur['returType'] == '1')
		{
			$returType = "CASHBACK";
		}
		elseif ($dataRetur['returType'] == '2')
		{
			$returType = "TUKAR BARU";
		}
		else
		{
			$returType = "VOUCHER";
		}
		
		if ($dataRetur['ppnType'] == '1')
		{
			$ppnType = "PPN";
			$ppn = rupiah($dataRetur['ppn']);
		}
		else
		{
			$ppnType = "NO PPN";
			$ppn = rupiah(0);
		}
		
		// assign to the tpl
		$smarty->assign("returID", $dataRetur['returID']);
		$smarty->assign("returNo", $dataRetur['returNo']);
		$smarty->assign("returDate", tgl_indo2($dataRetur['returDate']));
		$smarty->assign("invoiceNo", $dataRetur['invoiceNo']);
		$smarty->assign("customerID", $dataRetur['customerID']);
		$smarty->assign("customerName", $dataRetur['customerName']);
		$smarty->assign("customerAddress", $dataRetur['customerAddress']);
		$smarty->assign("returType", $returType);
		$smarty->assign("subtotal", rupiah($dataRetur['subtotal']));
		$smarty->assign("ppnType", $dataRetur['ppnType']);
		$smarty->assign("ppn", rupiah($dataRetur['ppnType']));
		$smarty->assign("grandtotal", rupiah($dataRetur['grandtotal']));
		$smarty->assign("ref", $dataRetur['ref']);
		$smarty->assign("note", $dataRetur['note']);
		
		// show the retur detail
		$queryReturDetail = "SELECT * FROM as_detail_retur_staffs WHERE returID = '$dataRetur[returID]' AND returNo = '$dataRetur[returNo]' ORDER BY detailID ASC";
		$sqlReturDetail = mysqli_query($connect, $queryReturDetail);
		
		$i = 1;
		while ($dtReturDetail = mysqli_fetch_array($sqlReturDetail))
		{
			$subtotal = rupiah($dtReturDetail['qty'] * $dtReturDetail['unitPrice']);
			
			$dataReturDetail[] = array(	'detailID' => $dtReturDetail['detailID'],
										'factoryName' => $dtReturDetail['factoryName'],
										'productName' => $dtReturDetail['productName'],
										'price' => rupiah($dtReturDetail['unitPrice']),
										'note' => $dtReturDetail['note'],
										'qty' => $dtReturDetail['qty'],
										'no' => $i
										);
			$i++;
		}
		
		$smarty->assign("dataReturDetail", $dataReturDetail);
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		
		$smarty->assign("breadcumbTitle", "Retur Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan retur penjualan.");
		$smarty->assign("breadcumbMenuName", "Retur");
		$smarty->assign("breadcumbMenuSubName", "Retur Penjualan");
	}
	
	// if module retur sale and act is finish
	elseif ($module == 'retursale' && $act == 'finish')
	{
		$invoiceNo = $_GET['invoiceNo'];
		$returID = $_GET['returID'];
		$returNo = $_GET['returNo'];
		
		$queryRetur = "SELECT * FROM as_retur_staffs WHERE returID = '$returID' AND returNo = '$returNo'";
		$sqlRetur = mysqli_query($connect, $queryRetur);
		$dataRetur = mysqli_fetch_array($sqlRetur);
		
		if ($dataRetur['returType'] == '1')
		{
			$returType = "CASHBACK";
		}
		elseif ($dataRetur['returType'] == '2')
		{
			$returType = "TUKAR BARU";
		}
		else
		{
			$returType = "Tidak ada";
		}
		
		if ($dataRetur['ppnType'] == '1')
		{
			$ppnType = "PPN";
			$ppn = rupiah($dataRetur['ppn']);
		}
		else
		{
			$ppnType = "NO PPN";
			$ppn = rupiah(0);
		}
		
		// assign to the tpl
		$smarty->assign("returID", $dataRetur['returID']);
		$smarty->assign("returNo", $dataRetur['returNo']);
		$smarty->assign("returDate", tgl_indo2($dataRetur['returDate']));
		$smarty->assign("invoiceNo", $dataRetur['invoiceNo']);
		$smarty->assign("customerID", $dataRetur['customerID']);
		$smarty->assign("customerName", $dataRetur['customerName']);
		$smarty->assign("customerAddress", $dataRetur['customerAddress']);
		$smarty->assign("returType", $returType);
		$smarty->assign("subtotal", rupiah($dataRetur['subtotal']));
		$smarty->assign("ppnType", $ppnType);
		$smarty->assign("ppn", rupiah($dataRetur['ppn']));
		$smarty->assign("grandtotal", rupiah($dataRetur['grandtotal']));
		$smarty->assign("ref", $dataRetur['ref']);
		$smarty->assign("note", $dataRetur['note']);
		
		// show the retur detail
		$queryReturDetail = "SELECT * FROM as_detail_retur_staffs WHERE returID = '$dataRetur[returID]' AND returNo = '$dataRetur[returNo]' ORDER BY detailID ASC";
		$sqlReturDetail = mysqli_query($connect, $queryReturDetail);
		
		$i = 1;
		while ($dtReturDetail = mysqli_fetch_array($sqlReturDetail))
		{
			$subtotal = rupiah($dtReturDetail['qty'] * $dtReturDetail['unitPrice']);
			
			$dataReturDetail[] = array(	'detailID' => $dtReturDetail['detailID'],
										'factoryName' => $dtReturDetail['factoryName'],
										'productName' => $dtReturDetail['productName'],
										'price' => rupiah($dtReturDetail['unitPrice']),
										'note' => $dtReturDetail['note'],
										'subtotal' => $subtotal,
										'qty' => $dtReturDetail['qty'],
										'no' => $i
										);
			$i++;
		}
		
		$smarty->assign("dataReturDetail", $dataReturDetail);
		$smarty->assign("page", $_GET['page']); 
		$smarty->assign("breadcumbTitle", "Retur Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan retur penjualan.");
		$smarty->assign("breadcumbMenuName", "Retur");
		$smarty->assign("breadcumbMenuSubName", "Retur Penjualan");
	}
	
	// if the module retursale and act is add
	elseif ($module == 'retursale' && $act == 'add')
	{
		// get last sort retur sale number ID
		$queryNoRetur = "SELECT returNo FROM as_retur_staffs ORDER BY returNo DESC LIMIT 1";
		$sqlNoRetur = mysqli_query($connect, $queryNoRetur);
		$numsNoRetur = mysqli_num_rows($sqlNoRetur);
		$dataNoRetur = mysqli_fetch_array($sqlNoRetur);
		
		$start = substr($dataNoRetur['returNo'],2-7);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoRetur == '0')
		{
			$retNo = "00000";
		}
		elseif ($tempNo == 1)
		{
			$retNo = "00000";
		}
		elseif ($tempNo == 2)
		{
			$retNo = "0000";
		}
		elseif ($tempNo == 3)
		{
			$retNo = "000";
		}
		elseif ($tempNo == 4)
		{
			$retNo = "00";
		}
		elseif ($tempNo == 5)
		{
			$retNo = "0";
		}
		elseif ($tempNo == 6)
		{
			$retNo = "";
		}
		
		$returNo = "RJ".$retNo.$next;
		
		$smarty->assign("returNo", $returNo);
		$smarty->assign("returDate", tgl_indo2(date('Y-m-d')));
		
		$invoiceNo = $_GET['invoiceNo'];
		
        $queryStaff = "SELECT customerID,customerCode,customerName FROM `as_customers` ORDER BY `as_customers`.`customerName` ASC ";  
		$sqlStaff = mysqli_query($connect, $queryStaff); 
		while ($dtStaff = mysqli_fetch_array($sqlStaff))
		{
			$dataStaff[] = array(	'supplierID' => $dtStaff['customerID'],
									'supplierName' => $dtStaff['customerName'],
									'supplierAddress' => $dtStaff['customerCode']);
		}
		$queryStaffs = "SELECT customerName FROM `as_customers` WHERE `customerID` = $invoiceNo";  
		$sqlStaffs = mysqli_query($connect, $queryStaffs); 
		$dtStaffs = mysqli_fetch_array($sqlStaffs);
		// assign to the tpl
        $smarty->assign("invoiceNo", $invoiceNo);
		$smarty->assign("dataStaff", $dataStaff); 
        $smarty->assign("supplierName", $dtStaffs['customerName']);

        $queryGudang = "SELECT factoryID,factoryCode,factoryName FROM `as_factories` ORDER BY `factoryCode` ASC";  
		$sqlGudang = mysqli_query($connect, $queryGudang); 
        while ($dtGudang = mysqli_fetch_array($sqlGudang))
		{
			$dataGudang[] = array(	'factoryID' => $dtGudang['factoryID'],
									'factoryName' => $dtGudang['factoryName'],
									'factoryCode' => $dtGudang['factoryCode']);
		}
        $smarty->assign("dataGudang", $dataGudang); 

		// show the bbm data
		$queryBSale = "SELECT * FROM as_sales_order WHERE customerID = '$invoiceNo'";
		$sqlBSale = mysqli_query($connect, $queryBSale);
		$dataBSale = mysqli_fetch_array($sqlBSale);
		$numsBSale = mysqli_num_rows($sqlBSale);
		
		$smarty->assign("numsBSale", $numsBSale);
		
		// assign to the tpl
		$smarty->assign("invoiceNo", $invoiceNo);
		$smarty->assign("customerID", $dataBSale['customerID']);
		$smarty->assign("customerName", $dataBSale['customerName']);
		$smarty->assign("customerAddress", $dataBSale['customerAddress']);
		$smarty->assign("ppnType", $dataBSale['ppnType']);
		$smarty->assign("ppn", $dataBSale['ppn']);
		
		// show the delivery order detail
		$queryDoDetail = "SELECT * FROM `as_products`";
		$sqlDoDetail = mysqli_query($connect, $queryDoDetail);
		
		$i = 1;
		while ($dtDoDetail = mysqli_fetch_array($sqlDoDetail))
		{
			$subtotal = $dtDoDetail['receiveQty'] * $dtDoDetail['price'];
			
			$dataDoDetail[] = array(	 
										'productID' => $dtDoDetail['productID'],
										'productName' => $dtDoDetail['productName'],
										'price' => $dtDoDetail['purchasePrice'],
										'pricerp' => rupiah($dtDoDetail['purchasePrice']),     
										'note' => $dtDoDetail['note'],
										'no' => $i
										);
			$i++;
		}
		
		$smarty->assign("dataDoDetail", $dataDoDetail);
			
		$smarty->assign("breadcumbTitle", "Retur Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan retur penjualan.");
		$smarty->assign("breadcumbMenuName", "Retur");
		$smarty->assign("breadcumbMenuSubName", "Retur Penjualan");
	}

	elseif ($module == 'retursale' && $act == 'search')
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
		
		// showing up the retur data
		if ($sDate != '' || $eDate != '')
		{
			$queryRetur = "SELECT * FROM as_retur_staffs WHERE customerName LIKE '%$q%' AND returDate BETWEEN '$startDate' AND '$endDate' ORDER BY returNo DESC";
		}
		else
		{
			$queryRetur = "SELECT * FROM as_retur_staffs WHERE customerName LIKE '%$q%' ORDER BY returNo DESC";	
		}
		$sqlRetur = mysqli_query($connect, $queryRetur);
		
		// fetch data
		$i = 1 + $position;
		while ($dtRetur = mysqli_fetch_array($sqlRetur))
		{
			if ($dtRetur['returType'] == '1')
			{
				$returType = "CASHBACK";
			}
			elseif ($dtRetur['returType'] == '2')
			{
				$returType = "TUKAR BARU";
			}
			else
			{
				$returType = "VOUCHER";
			}
			
			if ($dtRetur['ppnType'] == '1')
			{
				$ppnType = "PPN";
				$ppn = rupiah($dtRetur['ppn']);
			}
			else
			{
				$ppnType = "NO PPN";
				$ppn = "";
			}
			
			$dataRetur[] = array(	'returID' => $dtRetur['returID'],
									'returNo' => $dtRetur['returNo'],
									'returDate' => tgl_indo2($dtRetur['returDate']),
									'invoiceNo' => $dtRetur['invoiceNo'],
									'customerID' => $dtRetur['customerID'],
									'customerName' => $dtRetur['customerName'],
									'customerAddress' => $dtRetur['customerAddress'],
									'returType' => $returType,
									'subtotal' => rupiah($dtRetur['subtotal']),
									'ppnType' => $ppnType,
									'ppn' => rupiah($dtRetur['ppn']),
									'grandtotal' => rupiah($dtRetur['grandtotal']),
									'staffID' => $dtRetur['staffName'],
									'staffName' => $dtRetur['staffName'],
									'ref' => $dtRetur['ref'],
									'note' => $dtRetur['note'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataRetur", $dataRetur);
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Retur Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan retur penjualan.");
		$smarty->assign("breadcumbMenuName", "Retur");
		$smarty->assign("breadcumbMenuSubName", "Retur Penjualan");
	}
	
	else
	{
		// create new object pagination
		$p = new PaginationReturStaff;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the retur data
		$queryRetur = "SELECT * FROM as_retur_staffs ORDER BY returID DESC LIMIT $position,$limit";
		$sqlRetur = mysqli_query($connect, $queryRetur);
		
		// fetch data
		$i = 1 + $position;
		while ($dtRetur = mysqli_fetch_array($sqlRetur))
		{
			if ($dtRetur['returType'] == '1')
			{
				$returType = "CASHBACK";
			}
			elseif ($dtRetur['returType'] == '2')
			{
				$returType = "TUKAR BARU";
			}
			else
			{
				$returType = "VOUCHER";
			}
			
			if ($dtRetur['ppnType'] == '1')
			{
				$ppnType = "PPN";
				$ppn = rupiah($dtRetur['ppn']);
			}
			else
			{
				$ppnType = "NO PPN";
				$ppn = "";
			}
			
			$dataRetur[] = array(	'returID' => $dtRetur['returID'],
									'returNo' => $dtRetur['returNo'],
									'returDate' => tgl_indo2($dtRetur['returDate']),
									'invoiceNo' => $dtRetur['invoiceNo'],
									'customerID' => $dtRetur['customerID'],
									'customerName' => $dtRetur['customerName'],
									'customerAddress' => $dtRetur['customerAddress'],
									'returType' => $returType,
									'subtotal' => rupiah($dtRetur['subtotal']),
									'ppnType' => $ppnType,
									'ppn' => rupiah($dtRetur['ppn']),
									'grandtotal' => rupiah($dtRetur['grandtotal']),
									'staffID' => $dtRetur['staffName'],
									'staffName' => $dtRetur['staffName'],
									'ref' => $dtRetur['ref'],
									'note' => $dtRetur['note'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataRetur", $dataRetur);
		
		// count data
		$queryCountRetur = "SELECT * FROM as_retur_staffs";
		$sqlCountRetur = mysqli_query($connect, $queryCountRetur);
		$amountData = mysqli_num_rows($sqlCountRetur);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Retur Penjualan");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan retur barang dari Toko.");
		$smarty->assign("breadcumbMenuName", "Retur");
		$smarty->assign("breadcumbMenuSubName", "Retur Penjualan");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>