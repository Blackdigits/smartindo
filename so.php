<?php

// include header
include "header.php";
// set the tpl page
$page = "so.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '28'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is so and action is delete
	if ($module == 'so' && $act == 'delete')
	{
		// insert method into a variable
		$soID = $_GET['soID'];
		$soFaktur = $_GET['soFaktur'];
		$soNo = $_GET['soNo'];
		
        $queryTrx = "SELECT * FROM as_sales_order WHERE soID = '$soID' AND soFaktur = '$soFaktur'";
		$sqlTrx = mysqli_query($connect, $queryTrx);
		$dataTrx = mysqli_fetch_array($sqlTrx);  
        $note = $dataTrx['note'];
        $queryTrf = "SELECT productID,qty FROM as_detail_so WHERE soNo = '$soNo'";
		$sqlTrf = mysqli_query($connect, $queryTrf);
		while ($dataTrf = mysqli_fetch_array($sqlTrf)) {
			$qty = $dataTrf['qty']; 
			if ($dataTrx['factory'] == '' OR $dataTrx['factory'] == 'SFA') {
				$queryUpdateMin = "UPDATE as_stock_products SET stock = stock+$qty WHERE productID = '$dataTrf[productID]' AND supplierID = $dataTrx[needDate]";
			} else {
				$queryfactoryID = "SELECT factoryID FROM `as_factories` WHERE `factoryName` LIKE '$dataTrx[factory]'"; 
				$factory = mysqli_fetch_array(mysqli_query($connect, $queryfactoryID)); 
				$queryUpdateMin = "UPDATE as_stock_products SET stock = stock+$qty WHERE factoryID = $factory[factoryID] AND productID = '$dataTrf[productID]' AND supplierID IS NULL "; 
			} $sqlUpdateMin = mysqli_query($connect, $queryUpdateMin);
		}
 
        // invalidate hutang
        if ($note == "Tunai") {
            $querySoDetails = "DELETE FROM as_debts WHERE debtNo = '$soNo' AND invoiceNo = '$soFaktur'";
		    $sqlSoDetails = mysqli_query($connect, $querySoDetails);
        } else {
            $querySoDetails = "DELETE FROM as_receivables WHERE receiveNo = '$soNo' AND invoiceNo = '$soFaktur'";
		    $sqlSoDetails = mysqli_query($connect, $querySoDetails);
        }

		// delete sales order
		$querySo = "DELETE FROM as_sales_order WHERE soID = '$soID' AND soFaktur = '$soFaktur'";
		$sqlSo = mysqli_query($connect, $querySo);
		
		// delete sales order detail
		$querySoDetail = "DELETE FROM as_detail_so WHERE soNo = '$soNo' AND soFaktur = '$soFaktur'";
		$sqlSoDetail = mysqli_query($connect, $querySoDetail);
		
		// redirect to the sales order page
	    header("Location: so.php?msg=Data purchase order berhasil dihapus");
	} // close bracket
	
	// if module is sales order and act is finish
	elseif ($module == 'so' && $act == 'finish')
	{
		$soNo = $_GET['soNo'];
		$soFaktur = $_GET['soFaktur'];
		
		// showing up the main sales order
		$querySo = "SELECT * FROM as_sales_order WHERE soNo = '$soNo' AND soFaktur = '$soFaktur'";
		$sqlSo = mysqli_query($connect, $querySo);
		$dataSo = mysqli_fetch_array($sqlSo);
		
		$salesid = $dataSo['needDate'];
		$querySt = "SELECT supplierName, supplierCode FROM `as_suppliers` WHERE supplierID = '$salesid'";
		$sqlSt = mysqli_query($connect, $querySt);
		$dataSt = mysqli_fetch_array($sqlSt);

		// assign to the tpl
		$smarty->assign("soID", $dataSo['soID']);
		$smarty->assign("soNo", $dataSo['soNo']);
		$smarty->assign("customerID", $dataSo['customerID']);
		$smarty->assign("customerName", $dataSo['customerName']);
		$smarty->assign("customerAddress", $dataSo['customerAddress']);
		$smarty->assign("factory", $dataSo['factory']);
		$smarty->assign("staffID", $dataSo['staffID']);
		$smarty->assign("staffName", $dataSo['staffName']);
		$smarty->assign("orderDate", tgl_indo2($dataSo['orderDate']));
		$smarty->assign("needDate", $dataSt['supplierName']);
		$smarty->assign("status", $dataSo['status']);
		$smarty->assign("note", $dataSo['note']);
		$smarty->assign("soFaktur", $soFaktur);
		
		// showing up the detail sales order
		$queryDetail = "SELECT * FROM as_detail_so WHERE soNo = '$soNo' AND soFaktur = '$soFaktur'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// fetch data
		$i = 1;
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			$subtotal = $dtDetail['qty'] * $dtDetail['price'];
			
			$dataDetail[] = array(	'detailID' => $dtDetail['detailID'],
									'productID' => $dtDetail['productID'],
									'productName' => $dtDetail['productName'],
									'price' => rupiah($dtDetail['price']),
									'subtotal' => rupiah($subtotal),
									'qty' => $dtDetail['qty'],
									'note' => $dtDetail['note'],
									'no' => $i
									);
			$grandtotal += $subtotal;
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("grandtotal", rupiah($grandtotal));
		$smarty->assign("dataDetail", $dataDetail);
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Sales Order");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi sales order.");
		$smarty->assign("breadcumbMenuName", "Sales Order");
		$smarty->assign("breadcumbMenuSubName", "Detail Sales Order");
		$smarty->assign("pageNumber", $_GET['page']);
	}
	
	// if module is sales order and act is detailso
	elseif ($module == 'so' && $act == 'detailso')
	{
		$soID = $_GET['soID'];
		$soFaktur = $_GET['soFaktur'];
		
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		// showing up the main so
		$querySo = "SELECT * FROM as_sales_order WHERE soID = '$soID' AND soFaktur = '$soFaktur'";
		$sqlSo = mysqli_query($connect, $querySo);
		$dataSo = mysqli_fetch_array($sqlSo);
		
		$salesid = $dataSo['needDate'];
		$querySt = "SELECT supplierName, supplierCode FROM `as_suppliers` WHERE supplierID = '$salesid'";
		$sqlSt = mysqli_query($connect, $querySt);
		$dataSt = mysqli_fetch_array($sqlSt);

		// assign to the tpl
		$smarty->assign("soID", $dataSo['soID']);
		$smarty->assign("soNo", $dataSo['soNo']);
		$smarty->assign("customerID", $dataSo['supplierID']);
		$smarty->assign("customerName", $dataSo['customerName']);
		$smarty->assign("customerAddress", $dataSo['customerAddress']);
		$smarty->assign("staffID", $dataSo['staffID']);
		$smarty->assign("factory", $dataSo['factory']);
		$smarty->assign("staffName", $dataSo['staffName']);
		$smarty->assign("orderDate", tgl_indo2($dataSo['orderDate']));
		$smarty->assign("needDate", $dataSt['supplierName']);
		$smarty->assign("status", $dataSo['status']);
		$smarty->assign("note", $dataSo['note']);
		$smarty->assign("soFaktur", $soFaktur);
		
		// showing up the detail so
		$queryDetail = "SELECT * FROM as_detail_so WHERE soNo = '$dataSo[soNo]' AND soFaktur = '$soFaktur'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// fetch data
		$i = 1;
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			$subtotal = $dtDetail['qty'] * $dtDetail['price'];
			
			$dataDetail[] = array(	'detailID' => $dtDetail['detailID'],
									'productID' => $dtDetail['productID'],
									'productName' => $dtDetail['productName'],
									'price' => rupiah($dtDetail['price']),
									'subtotal' => rupiah($subtotal),
									'qty' => $dtDetail['qty'],
									'note' => $dtDetail['note'],
									'no' => $i
									);
			$grandtotal += $subtotal;
			$i++;
		}
		
		$smarty->assign("q", $q);
		
		// assign to the tpl
		$smarty->assign("grandtotal", rupiah($grandtotal));
		$smarty->assign("dataDetail", $dataDetail);
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Sales Order");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi sales order.");
		$smarty->assign("breadcumbMenuName", "Sales Order");
		$smarty->assign("breadcumbMenuSubName", "Detail Sales Order");
		$smarty->assign("pageNumber", $_GET['page']);
	}
	
	//if module is so and act is input
	elseif ($module == 'so' && $act == 'input')
	{
		$soFaktur = $_SESSION['soFaktur']; 
		$factoryID = $_SESSION['factory']; 
		$staffID = $_SESSION['staffID'];  
        $pajak = $_POST['pajak']; // alternative get from pajak session
		$soNo = $_POST['soNo']; // move from add if possible
		$note = mysqli_real_escape_string($connect, $_POST['note']); 
		$querySo = "UPDATE as_sales_order SET note = '$note', status = 'Validasi' WHERE soFaktur = '$soFaktur' AND soNo = '$soNo'";
		mysqli_query($connect, $querySo);

		$queryTempSos = "SELECT * FROM as_sales_order WHERE soNo = '$soNo' AND soFaktur = '$soFaktur'";
		$sqlTempSos = mysqli_query($connect, $queryTempSos);
		$dataSos = mysqli_fetch_array($sqlTempSos);
		
		if ($note == 'Hutang' OR $note == 'Transfer') {
			if ($note == 'Transfer') { $income = $dataSpb['Total']; } else { $income = 0; }
			$dataSpb = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(price*qty) AS Total FROM `as_temp_detail_so` WHERE soNo = '$soNo' AND soFaktur = '$soFaktur';"));
			$total = $dataSpb[Total] + $pajak;
            $queryReceive = "INSERT INTO as_receivables(receiveNo,
															invoiceID,
															invoiceNo,
															customerID,
															customerName,
															customerAddress,
															receiveTotal,
															incomingTotal,
                                                            pajak,
                                                            diskon,
															status,
															staffID,
															staffName,
															createdDate,
															createdUserID,
															modifiedDate,
															modifiedUserID)
													VALUES(	'$dataSos[soNo]',
															'$dataSos[soID]',
															'$dataSos[soFaktur]',
															'$dataSos[customerID]',
															'$dataSos[customerName]',
															'$dataSos[customerAddress]',
															'$total',
															'$income',
															'$pajak',
                                                            '0',
                                                            '1',
															'$dataSos[staffID]',
															'$dataSos[staffName]',
															'$dataSos[createdDate]',
															'$dataSos[needDate]',
															'',
															'')";
													
				mysqli_query($connect, $queryReceive);
		} else { 
            $dataSFA = mysqli_fetch_array(mysqli_query($connect, "SELECT supplierID,supplierCode,supplierName FROM `as_suppliers` WHERE `supplierID` = $dataSos[needDate]"));
            $dataSpb = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(price*qty) AS Total FROM `as_temp_detail_so` WHERE soNo = '$soNo' AND soFaktur = '$soFaktur';"));
			$total = $dataSpb[Total] + $pajak;
			$queryReceive = "INSERT INTO as_debts( 
                                                        debtNo,
                                                        invoiceID,
                                                        invoiceNo,
                                                        supplierID,
                                                        supplierName,
                                                        supplierAddress,
                                                        debtTotal,
                                                        incomingTotal,
                                                        pajak,
                                                        diskon,
                                                        status,
                                                        staffID,
                                                        staffName,
                                                        createdDate,
                                                        createdUserID,
                                                        modifiedDate,
                                                        modifiedUserID)
                                                        VALUES('$dataSos[soNo]',
                                                        '$dataSos[soID]',
                                                        '$dataSos[soFaktur]',
                                                        '$dataSos[needDate]',
                                                        '$dataSFA[supplierName]',
                                                        '$dataSFA[supplierCode]',
                                                        '$total',
                                                        '0', 
                                                        '$pajak',
                                                        '0', 
                                                        'Verifikasi',
                                                        '$dataSos[needDate]',
                                                        '$dataSos[staffName]',
                                                        '$dataSos[createdDate]',
                                                        '$dataSos[createdUserID]',
                                                        '',
                                                        '')";  
													
				mysqli_query($connect, $queryReceive);
        }
		
		// showing up the temp detail sales order
		$queryTempSo = "SELECT * FROM as_temp_detail_so WHERE soNo = '$soNo' AND soFaktur = '$soFaktur'";
		$sqlTempSo = mysqli_query($connect, $queryTempSo);
		// fetch data
		while ($dataSo = mysqli_fetch_array($sqlTempSo))
		{
			$querySaveSo = "INSERT INTO as_detail_so (	soNo,
														soFaktur,
														productID,
														productName,
														price,
														qty,
														note,
														createdDate,
														createdUserID,
														modifiedDate,
														modifiedUserID)
												VALUES(	'$dataSo[soNo]',
														'$dataSo[soFaktur]',
														'$dataSo[productID]',
														'$dataSo[productName]',
														'$dataSo[price]',
														'$dataSo[qty]',
														'$dataSo[note]',
														'$dataSo[createdDate]',
														'$dataSo[createdUserID]',
														'',
														'$dataSos[needDate]')";
			$save = mysqli_query($connect, $querySaveSo);
            $qty = $dataSo['qty'];
			if ($dataSos['factory'] == '' OR $dataSos['factory'] == 'SFA') {
				$queryUpdateMin = "UPDATE as_stock_products SET stock = stock-$qty WHERE supplierID = $dataSos[needDate] AND productID = '$dataSo[productID]'";  
			} else {
				$queryUpdateMin = "UPDATE as_stock_products SET stock = stock-$qty WHERE factoryID = $factoryID AND productID = '$dataSo[productID]' AND supplierID IS NULL "; 
			} $sqlUpdateMin = mysqli_query($connect, $queryUpdateMin);
		}
		
		// delete temp detail sales order
		$queryDelete = "DELETE FROM as_temp_detail_so WHERE soNo = '$soNo'";
		mysqli_query($connect, $queryDelete); 
		// redirect to the finish page
		header("Location: so.php?module=so&act=finish&soNo=".$soNo."&soFaktur=".$soFaktur."&msg=Data sales order berhasil disimpan");
	}
	
	// if module is so and act is deletedetail
	elseif ($module == 'so' && $act == 'deletedetail')
	{
		$detailID = $_GET['detailID'];
		
		// delete data
		$querySo = "DELETE FROM as_temp_detail_so WHERE detailID = '$detailID'";
		$sqlSo = mysqli_query($connect, $querySo);
		
		// redirect to the add add sales order page
		header("Location: so.php?module=so&act=add&msg=Data item berhasil dihapus");
	}
	
	// if module is so and act is cancel
	elseif ($module == 'so' && $act == 'cancel')
	{
		$soFaktur = $_SESSION['soFaktur'];
		
		$queryDetail = "DELETE FROM as_temp_detail_so WHERE soFaktur = '$soFaktur'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		if ($sqlDetail)
		{
			$querySo = "DELETE FROM as_sales_order WHERE soFaktur = '$soFaktur'";
			$sqlSo = mysqli_query($connect, $querySo);
		}

		// redirect to the sales order page 
		header("Location: so.php?msg=Data sales order berhasil dibatalkan");
	} 
	
	// if module is so and act is add
	elseif ($module == 'so' && $act == 'add')
	{	

        if (isset($_POST['faktur']) AND !empty($_POST['faktur'])) {
            $fakturNo = $_POST['faktur'];
            $querySf = "SELECT soFaktur FROM `as_sales_order` WHERE `soFaktur` = $fakturNo AND status NOT LIKE 'Invalid';";
            $sqlNoSf = mysqli_query($connect, $querySf);
            $numsNoSf = mysqli_num_rows($sqlNoSf); 
            if ($numsNoSf == 0){
                $_SESSION['soFaktur'] = $_POST['faktur'];
                header('Location: so.php?module=so&act=add'); 
            } else {
                header('Location: so.php?msg=Nomor Faktur sudah dipakai, Coba lagi!');
            }
        }
        
		
		$staffID = $_SESSION['staffID'];
		$createdDate = date('Y-m-d H:i:s'); 
		// get last sort sales order number ID
		$queryNoSo = "SELECT soNo FROM as_detail_so ORDER BY soNo DESC LIMIT 1";
		$sqlNoSo = mysqli_query($connect, $queryNoSo);
		$numsNoSo = mysqli_num_rows($sqlNoSo);
		$dataNoSo = mysqli_fetch_array($sqlNoSo);
		
		$start = substr($dataNoSo['soNo'],0-5);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoSo == '0')
		{
			$sNo = "00000";
		}
		elseif ($tempNo == 1)
		{
			$sNo = "00000";
		}
		elseif ($tempNo == 2)
		{
			$sNo = "0000";
		}
		elseif ($tempNo == 3)
		{
			$sNo = "000";
		}
		elseif ($tempNo == 4)
		{
			$sNo = "00";
		}
		elseif ($tempNo == 5)
		{
			$sNo = "0";
		}
		elseif ($tempNo == 6)
		{
			$sNo = "";
		}
		
		$soNo = "SO".$sNo.$next;
		
		$smarty->assign("breadcumbTitle", "Sales Order");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi penjualan.");
		$smarty->assign("breadcumbMenuName", "Sales Order");
		$smarty->assign("breadcumbMenuSubName", "Tambah Transaksi Penjualan");
		
		// save into the transfer table
		$date = date('Y-m-d');

        if (!empty($_SESSION["pajak"])) {
            $pajak = $_SESSION['pajak'];
            $smarty->assign("pajak", $pajak);
        } else { 
            $smarty->assign("pajak", '0');
        }
        
		
		// showing up the customers
		$queryCustomer = "SELECT * FROM as_customers ORDER BY customerName ASC";
		$sqlCustomer = mysqli_query($connect, $queryCustomer);
		while ($dtCustomer = mysqli_fetch_array($sqlCustomer))
		{
			$dataCustomer[] = array('customerID' => $dtCustomer['customerID'],
									'customerCode' => $dtCustomer['customerCode'],
									'customerName' => $dtCustomer['customerName']);
		}
		
		$smarty->assign("dataCustomer", $dataCustomer);
		$smarty->assign("customerID", $_SESSION['customerID']);  
		
		// showing up the Supplier
		$querySupplier = "SELECT * FROM `as_suppliers` ORDER BY `supplierID` ASC";
		$sqlSupplier = mysqli_query($connect, $querySupplier);
		while ($dtSupplier = mysqli_fetch_array($sqlSupplier))
		{
			$dataSupplier[] = array('supplierID' => $dtSupplier['supplierID'],
									'supplierCode' => $dtSupplier['supplierCode'],
									'supplierName' => $dtSupplier['supplierName']);
		}
		
		$smarty->assign("dataSupplier", $dataSupplier);
		$smarty->assign("supplierID", $_SESSION['supplierID']);  

        // showing up the factory
		$queryFactory = "SELECT * FROM `as_factories` WHERE `status` = 'Y'";
		$sqlFactory = mysqli_query($connect, $queryFactory);
		while ($dtFactory = mysqli_fetch_array($sqlFactory))
		{
			$dataFactory[] = array('factoryID' => $dtFactory['factoryID'],
									'factoryCode' => $dtFactory['factoryCode'],
									'factoryName' => $dtFactory['factoryName']);
		}
		
		$smarty->assign("dataFactory", $dataFactory);
		$smarty->assign("factory", $_SESSION['factory']); 
		 

		// count so based on soFaktur
		$showSo1 = "SELECT * FROM as_sales_order WHERE soFaktur = '$_SESSION[soFaktur]'";
		$sqlSo1 = mysqli_query($connect, $showSo1);
		$numsSo = mysqli_num_rows($sqlSo1);
		
		if ($numsSo == 0) { 
			$orderDate = date('Y-m-d');
			$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
			$querySo = "INSERT INTO as_sales_order(	soNo,
													soFaktur,
													customerID,
													customerName,
													customerAddress,
													staffID,
													staffName,
													orderDate,
													needDate,
													factory,
													note,
													status,
													createdDate,
													createdUserID,
													modifiedDate,
													modifiedUserID)
											VALUES(	'$soNo',
													'$_SESSION[soFaktur]',
													'',
													'',
													'',
													'$_SESSION[staffID]',
													'$sName',
													'$orderDate',
													'',
													'SFA',
													'',
													'Invalid',
													'$createdDate',
													'$staffID',
													'',
													'')";
			mysqli_query($connect, $querySo);
		}
		
		// count sales order based on soFaktur
		$showSo = "SELECT * FROM as_sales_order WHERE soFaktur = '$_SESSION[soFaktur]'";
		$sqlSo = mysqli_query($connect, $showSo);
		$dataSo = mysqli_fetch_array($sqlSo);
		$numsSo = mysqli_num_rows($sqlSo);
		

		if ($dataSo['orderDate'] == '0000-00-00') {
			$orderDate = tgl_indo2(date('Y-m-d'));
		} else {
			$orderDate = tgl_indo2($dataSo['orderDate']);
		}
		
		$smarty->assign("soNo", $soNo);
		$smarty->assign("orderDateIndo", $orderDate);
		$smarty->assign("needDateIndo", $dataSo['needDate']);
		$smarty->assign("soFaktur", $_SESSION['soFaktur']);
		$smarty->assign("note", $dataSo['note']);

		// query detil sales order
		$queryDetilSo = "SELECT * FROM as_temp_detail_so WHERE soFaktur = '$_SESSION[soFaktur]' AND soNo = '$soNo' ORDER BY detailID ASC";
		$sqlDetilSo = mysqli_query($connect, $queryDetilSo);
		$numsDetilSo = mysqli_num_rows($sqlDetilSo);
		
		// fetch data
		$i = 1;
		while ($dtDetilSo = mysqli_fetch_array($sqlDetilSo)) {
			$subtotal = $dtDetilSo['price'] * $dtDetilSo['qty'];
			$dataDetilSo[] = array(	'detailID' => $dtDetilSo['detailID'],
									'productName' => $dtDetilSo['productName'],
									'price' => rupiah($dtDetilSo['price']),
									'qty' => $dtDetilSo['qty'],
									'note' => $dtDetilSo['note'],
									'subtotal' => rupiah($subtotal),
									'no' => $i);
			$i++;
		} 
		// assign to the tpl
		$smarty->assign("dataDetilSo", $dataDetilSo);
		$smarty->assign("numsDetilSo", $numsDetilSo);
	} // close bracket
	
	// if the module is so and act is search
	elseif ($module == 'so' && $act == 'search')
	{
		//$_SESSION['soFaktur'] = date('Ymdhis');
		$smarty->assign("soFaktur", $_SESSION['soFaktur']);
		
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
		$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
		
		$smarty->assign("startDate", $sDate);
		$smarty->assign("endDate", $eDate);
		
		$s2Date = explode("-", $sDate);
		$e2Date = explode("-", $eDate);
		
		$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
		$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
		
		// showing up the sales order data
		if ($sDate != '' && $eDate != '')
		{
			$querySo = "SELECT * FROM as_sales_order WHERE soNo LIKE '%$q%' AND orderDate BETWEEN '$startDate' AND '$endDate' ORDER BY soID DESC";
		}
		else
		{
			$querySo = "SELECT * FROM as_sales_order WHERE soNo LIKE '%$q%' ORDER BY soID DESC";
		}
		
		$sqlSo = mysqli_query($connect, $querySo);
		
		// fetch data
		$i = 1 + $position;
		while ($dtSo = mysqli_fetch_array($sqlSo))
		{
			
			$querySs = "SELECT supplierName FROM `as_suppliers` WHERE `supplierID` = $dtSo[needDate]";
            $sqlSs = mysqli_query($connect, $querySs);
            $dtSs = mysqli_fetch_array($sqlSs);
			$dataSo[] = array(	'soID' => $dtSo['soID'],
								'soNo' => $dtSo['soNo'],
								'soFaktur' => $dtSo['soFaktur'],
								'customerName' => $dtSo['customerName'],
								'staffName' => $dtSo['staffName'],
								'orderDate' => tgl_indo2($dtSo['orderDate']),
								'needDate' => $dtSs['supplierName'],
								'total' => rupiah($dtSo['total']),
								'status' => $dtSo['status'],
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataSo", $dataSo);
		
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Sales Order");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi sales order.");
		$smarty->assign("breadcumbMenuName", "Sales Order");
		$smarty->assign("breadcumbMenuSubName", "Sales Order");
	} 
	
	else
	{	 
        unset($_SESSION["customerID"]);
        unset($_SESSION["pajak"]);
		unset($_SESSION["factory"]);
        unset($_SESSION["supplierID"]); 

		$smarty->assign("soFaktur", $_SESSION['soFaktur']);
		// create new object pagination
		$p = new PaginationSo;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the sales order data
		$querySo = "SELECT * FROM as_sales_order WHERE status NOT LIKE 'Invalid' ORDER BY soID DESC LIMIT $position,$limit";
		$sqlSo = mysqli_query($connect, $querySo);
		 
		// fetch data
		$i = 1 + $position;
		while ($dtSo = mysqli_fetch_array($sqlSo))
		{
            $querySs = "SELECT supplierName FROM `as_suppliers` WHERE `supplierID` = $dtSo[needDate]";
            $sqlSs = mysqli_query($connect, $querySs);
            $dtSs = mysqli_fetch_array($sqlSs);
    
			$dataSo[] = array(	'soID' => $dtSo['soID'],
								'soNo' => $dtSo['soNo'],
								'soFaktur' => $dtSo['soFaktur'],
								'customerName' => $dtSo['customerName'],
								'staffName' => $dtSo['staffName'],
								'orderDate' => tgl_indo2($dtSo['orderDate']),
								'needDate' => $dtSs['supplierName'],
								'total' => rupiah($dtSo['total']),
								'status' => $dtSo['status'],
								'no' => $i);
			$i++;
		}
		 
		$smarty->assign("dataSo", $dataSo);
		
		// count data
		$queryCountSo = "SELECT * FROM as_sales_order";
		$sqlCountSo = mysqli_query($connect, $queryCountSo);
		$amountData = mysqli_num_rows($sqlCountSo);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Sales Order");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi sales order.");
		$smarty->assign("breadcumbMenuName", "Sales Order");
		$smarty->assign("breadcumbMenuSubName", "Sales Order");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>