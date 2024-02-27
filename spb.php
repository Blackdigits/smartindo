<?php 
include "header.php"; 
$page = "spb.tpl"; 
$module = $_GET['module'];
$act = $_GET['act'];
 
if ($_SESSION['staffID'] == '' && $_SESSION['email'] == '')
{ 
	echo "Anda tidak berhak akses modul ini.";
	exit();
}

else 
{ 
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '14'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is spb and action is delete
	if ($module == 'spb' && $act == 'delete')
	{  
		$spbID = $_GET['spbID'];
        $spbNo = $_GET['spbNo'];
		$spbFaktur = $_GET['spbFaktur']; 
		    
		$queryDetilSpb = "SELECT supplierID,staffID,factoryID FROM `as_spb` WHERE `spbID` = $spbID;";
		$sqlDetilSpb = mysqli_query($connect, $queryDetilSpb);
        $delDetailSpb = mysqli_fetch_array($sqlDetilSpb);
		$supplierID = $delDetailSpb['supplierID'];  
        $transferTo = $delDetailSpb['factoryID'];

        $daftarproduk = "SELECT productID, qty FROM `as_detail_spb` WHERE spbNo = '$spbNo' AND spbFaktur = $spbFaktur"; 
		$listproduct = mysqli_query($connect, $daftarproduk); 
		while ($produkrev = mysqli_fetch_array($listproduct)){  
            $qty = $produkrev['qty'];

            $queryStockPlus = "UPDATE as_stock_products SET stock = stock+$qty  WHERE productID = '$produkrev[productID]' AND factoryID = '$transferTo' AND supplierID IS NULL;";
            $StockUP = mysqli_query($connect, $queryStockPlus);

            $queryStockMin = "UPDATE as_stock_products SET stock = stock-$qty  WHERE productID = '$produkrev[productID]' AND factoryID = '$transferTo' AND supplierID = '$supplierID'";
            mysqli_query($connect, $queryStockMin);  
			var_dump($produkrev);
		} 
        var_dump($delDetailSpb);
        $querySpb = "DELETE FROM as_spb WHERE spbID = '$spbID' AND spbFaktur = '$spbFaktur'";
		$sqlSpb = mysqli_query($connect, $querySpb); 

		$querySpbDetail = "DELETE FROM as_detail_spb WHERE spbNo = '$spbNo' AND spbFaktur = '$spbFaktur'";
		$sqlSpbDetail = mysqli_query($connect, $querySpbDetail);

		header("Location: spb.php?msg=Data mutasi stok berhasil disimpan");
		  
	}  
	elseif ($module == 'spb' && $act == 'finish')
	{
		$spbNo = $_GET['spbNo'];
		$spbFaktur = $_GET['spbFaktur'];
		
		// showing up the main spb
		$querySpb = "SELECT * FROM as_spb WHERE spbNo = '$spbNo' AND spbFaktur = '$spbFaktur'";
		$sqlSpb = mysqli_query($connect, $querySpb);
		$dataSpb = mysqli_fetch_array($sqlSpb);
		
		// assign to the tpl
		$smarty->assign("spbID", $dataSpb['spbID']);
		$smarty->assign("spbNo", $dataSpb['spbNo']);
		$smarty->assign("supplierID", $dataSpb['supplierID']);
		$smarty->assign("supplierName", $dataSpb['supplierName']);
		$smarty->assign("staffID", $dataSpb['staffID']);
		$smarty->assign("staffName", $dataSpb['staffName']);
		$smarty->assign("orderDate", tgl_indo2($dataSpb['orderDate']));
		$smarty->assign("needDate", $dataSpb['needDate']);
		$smarty->assign("status", $dataSpb['status']);
		$smarty->assign("note", $dataSpb['note']);
		$smarty->assign("spbFaktur", $spbFaktur);
		
		// showing up the detail spb
		$queryDetail = "SELECT * FROM as_detail_spb WHERE spbNo = '$spbNo' AND spbFaktur = '$spbFaktur'";
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
		$smarty->assign("breadcumbTitle", "mutasi stok");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi mutasi stok.");
		$smarty->assign("breadcumbMenuName", "mutasi stok");
		$smarty->assign("breadcumbMenuSubName", "Detail mutasi stok");
		$smarty->assign("pageNumber", $_GET['page']);
	}
	
	// if module is spb and act is detailspb
	elseif ($module == 'spb' && $act == 'detailtrf')
	{
		$spbID = $_GET['spbID'];
		$spbFaktur = $_GET['spbFaktur'];
		
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		// showing up the main spb
		$querySpb = "SELECT * FROM as_spb WHERE spbID = '$spbID' AND spbFaktur = '$spbFaktur'";
		$sqlSpb = mysqli_query($connect, $querySpb);
		$dataSpb = mysqli_fetch_array($sqlSpb);
		
		// assign to the tpl
		$smarty->assign("spbID", $dataSpb['spbID']);
		$smarty->assign("spbNo", $dataSpb['spbNo']);
		$smarty->assign("supplierID", $dataSpb['supplierID']);
		$smarty->assign("supplierName", $dataSpb['supplierName']);
		$smarty->assign("staffID", $dataSpb['staffID']);
		$smarty->assign("staffName", $dataSpb['staffName']);
		$smarty->assign("orderDate", tgl_indo2($dataSpb['orderDate']));
		$smarty->assign("needDate", $dataSpb['needDate']);
		$smarty->assign("status", $dataSpb['status']);
		$smarty->assign("note", $dataSpb['note']);
		$smarty->assign("spbFaktur", $spbFaktur);
		
		// showing up the detail spb
		if($dataSpb['status'] == 'Invalid'){
			$queryDetail = "SELECT * FROM as_temp_detail_spb WHERE spbNo = '$dataSpb[spbNo]' AND spbFaktur = '$spbFaktur'";
		} else {
			$queryDetail = "SELECT * FROM as_detail_spb WHERE spbNo = '$dataSpb[spbNo]' AND spbFaktur = '$spbFaktur'";
		}
		
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
		$smarty->assign("breadcumbTitle", "Mutasi Stok");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk mutasi stok produk ke sales.");
		$smarty->assign("breadcumbMenuName", "Mutasi Stok");
		$smarty->assign("breadcumbMenuSubName", "Tambah stok Sales");
		$smarty->assign("pageNumber", $_GET['page']);
	}
	
	//if module is spb and act is input
	elseif ($module == 'spb' && $act == 'input')
	{
		$spbFaktur = $_SESSION['spbFaktur'];
		$spbNo = $_POST['spbNo']; 
		$needDate = $_POST['needDate'];
		$note = mysqli_real_escape_string($connect, $_POST['note']); 
		$oDate = explode("-", $_POST['orderDate']); 
		$orderDate = $oDate[2]."-".$oDate[1]."-".$oDate[0];
		$transferFrom = $_SESSION['SPBfactoryID'];
		$transferTo = $_SESSION['SPBsupplierID'];

		// update spb
		$querySpb = "UPDATE as_spb SET note = '$note',factoryID = '$transferFrom' WHERE spbFaktur = '$spbFaktur' AND spbNo = '$spbNo'";
		mysqli_query($connect, $querySpb);
		
		// showing up the temp detail spb
		$queryTempSpb = "SELECT * FROM as_temp_detail_spb WHERE spbNo = '$spbNo' AND spbFaktur = '$spbFaktur'";
		$sqlTempSpb = mysqli_query($connect, $queryTempSpb);
		// fetch data
		while ($dataSpb = mysqli_fetch_array($sqlTempSpb))
		{
			$querySaveSpb = "INSERT INTO as_detail_spb (	spbNo,
															spbFaktur,
															productID,
															productName,
															price,
															qty,
															note,
															createdDate,
															createdUserID,
															modifiedDate,
															modifiedUserID)
													VALUES(	'$dataSpb[spbNo]',
															'$dataSpb[spbFaktur]',
															'$dataSpb[productID]',
															'$dataSpb[productName]',
															'$dataSpb[price]',
															'$dataSpb[qty]',
															'$dataSpb[note]',
															'$dataSpb[createdDate]',
															'$dataSpb[createdUserID]',
															'',
															'$transferTo')";
			$save = mysqli_query($connect, $querySaveSpb);
			
			$queryStockSupplier = "SELECT stockProductID FROM as_stock_products WHERE productID = '$dataSpb[productID]' AND factoryID = '$transferFrom' AND SupplierID = '$transferTo'";
			$sqlSupplierStock = mysqli_query($connect, $queryStockSupplier);
            $qty = $dataSpb['qty'];
 


			if (mysqli_num_rows($sqlSupplierStock) == 0) {  
				$queryStock = "INSERT INTO as_stock_products (	productID,
																factoryID,
																supplierID,
																staffID,
																stock,
																createdDate,
																createdUserID,
																modifiedDate,
																modifiedUserID)
														VALUES(	'$dataSpb[productID]',
																 $transferFrom,
																 $transferTo,
																 $_SESSION[staffID],
																 $qty,
																'$dataSpb[createdDate]',
																'$dataSpb[createdUserID]',
																'',
																'')";
																
				$sqlStock = mysqli_query($connect, $queryStock);
				if ($sqlStock) { 
					$queryStockMin = "UPDATE as_stock_products SET stock = stock-$qty WHERE productID = '$dataSpb[productID]' AND factoryID = '$transferFrom'  AND supplierID IS NULL;";
					$saves = mysqli_query($connect, $queryStockMin);
				}
			} else {  
                $queryStockMin = "UPDATE as_stock_products SET stock = stock-$qty WHERE productID = '$dataSpb[productID]' AND factoryID = '$transferFrom' AND supplierID IS NULL;";
                mysqli_query($connect, $queryStockMin); 
                $queryStockPlus = "UPDATE as_stock_products SET stock = stock+$qty  WHERE productID = '$dataSpb[productID]' AND factoryID = '$transferFrom' AND supplierID = '$transferTo'";
                mysqli_query($connect, $queryStockPlus);  
			}
		} 
				$querySpb = "UPDATE as_spb SET status = 'Sukses' WHERE spbFaktur = '$spbFaktur' AND spbNo = '$spbNo'";
				mysqli_query($connect, $querySpb);

				$queryDelete = "DELETE FROM as_temp_detail_spb WHERE spbNo = '$spbNo' AND spbFaktur = '$spbFaktur'";
				mysqli_query($connect, $queryDelete); 

			
				 
		// redirect to the spb page
		header("Location: spb.php?module=spb&act=finish&spbNo=".$spbNo."&spbFaktur=".$spbFaktur."&msg=Data mutasi stok berhasil disimpan");
	}
	
	// if module is spb and act is deletedetail
	elseif ($module == 'spb' && $act == 'deletedetail')
	{
		$detailID = $_GET['detailID'];
		$transferTo = $_SESSION['staffID'];
		$daftarproduk = "SELECT productID, qty FROM `as_temp_detail_spb` WHERE `detailID` = $detailID";
		$listproduct = mysqli_query($connect, $daftarproduk); 
		$produkrev = mysqli_fetch_array($listproduct);
		$qty = $produkrev['qty'];
		$queryStockPlus = "UPDATE as_stock_products SET stock = stock+$qty  WHERE productID = '$produkrev[productID]' AND staffID = '$transferTo' AND supplierID IS NULL;";
		mysqli_query($connect, $queryStockPlus);

		// delete data
		$querySpb = "DELETE FROM as_temp_detail_spb WHERE detailID = '$detailID'";
		$sqlSpb = mysqli_query($connect, $querySpb);
		
		// redirect to the add transfer page
		header("Location: spb.php?module=spb&act=add&msg=Data item berhasil dihapus");
	}
	
	// if module is spb and act is cancel
	elseif ($module == 'spb' && $act == 'cancel')
	{
		$spbFaktur = $_SESSION['spbFaktur'];
		
		$queryDetilSpb = "SELECT detailID FROM as_temp_detail_spb WHERE spbFaktur = '$spbFaktur' ORDER BY detailID ASC";
		$sqlDetilSpb = mysqli_query($connect, $queryDetilSpb);

		while ($delDetailSpb = mysqli_fetch_array($sqlDetilSpb)) {
		$detailID = $delDetailSpb['detailID'];
		$transferTo = $_SESSION['staffID'];

		$daftarproduk = "SELECT productID, qty FROM `as_temp_detail_spb` WHERE `detailID` = $detailID";

		$listproduct = mysqli_query($connect, $daftarproduk); 
		$produkrev = mysqli_fetch_array($listproduct);
		$qty = $produkrev['qty'];
		$queryStockPlus = "UPDATE as_stock_products SET stock = stock+$qty  WHERE productID = '$produkrev[productID]' AND staffID = '$transferTo' AND supplierID IS NULL;";
		$StockUP = mysqli_query($connect, $queryStockPlus);
		}
		  
			$queryDetail = "DELETE FROM as_temp_detail_spb WHERE spbFaktur = '$spbFaktur'";
			$sqlDetail = mysqli_query($connect, $queryDetail); 
		
		
		if ($sqlDetail)
		{
			$querySpb = "DELETE FROM as_spb WHERE spbFaktur = '$spbFaktur'";
			$sqlSpb = mysqli_query($connect, $querySpb);
		}

		// redirect to the spb page
		header("Location: spb.php?msg=Data mutasi stok berhasil dibatalkan");
	} 
	
	// if module is spb and act is add
	elseif ($module == 'spb' && $act == 'add')
	{
		$staffID = $_SESSION['staffID'];
		$createdDate = date('Y-m-d H:i:s');
		
		if(isset($_GET['faktur'])){
			$_SESSION['spbFaktur'] = $_GET['faktur'];
		}
		
		// get last sort spb number ID
		$queryNoSpb = "SELECT spbNo FROM as_detail_spb ORDER BY spbNo DESC LIMIT 1";
		$sqlNoSpb = mysqli_query($connect, $queryNoSpb);
		$numsNoSpb = mysqli_num_rows($sqlNoSpb);
		$dataNoSpb = mysqli_fetch_array($sqlNoSpb);
		
		$start = substr($dataNoSpb['spbNo'],0-5);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		// SpbNo Generator
		if ($numsNoSpb == '0')
		{
			$spbNo = "00000";
		}
		elseif ($tempNo == 1)
		{
			$spbNo = "00000";
		}
		elseif ($tempNo == 2)
		{
			$spbNo = "0000";
		}
		elseif ($tempNo == 3)
		{
			$spbNo = "000";
		}
		elseif ($tempNo == 4)
		{
			$spbNo = "00";
		}
		elseif ($tempNo == 5)
		{
			$spbNo = "0";
		}
		elseif ($tempNo == 6)
		{
			$spbNo = "";
		}
		$spbCode = "PO".$spbNo.$next;
		
		$smarty->assign("breadcumbTitle", "Mutasi Stok");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk mutasi stok produk ke sales.");
		$smarty->assign("breadcumbMenuName", "Mutasi Stok");
		$smarty->assign("breadcumbMenuSubName", "Tambah stok Sales");
		
		// save into the transfer table
		$date = date('Y-m-d');
		
		// Menu Pilih Sales
		$querySupplier = "SELECT * FROM as_suppliers ORDER BY supplierName ASC";
		$sqlSupplier = mysqli_query($connect, $querySupplier);
		while ($dtSupplier = mysqli_fetch_array($sqlSupplier))
		{
			$dataSupplier[] = array('supplierID' => $dtSupplier['supplierID'],
									'supplierCode' => $dtSupplier['supplierCode'],
									'supplierName' => $dtSupplier['supplierName']);
		} 
		$smarty->assign("dataSupplier", $dataSupplier);
		
		// Menu Pilih Gudang
        $queryFactory = "SELECT * FROM as_factories WHERE factoryID IN (SELECT factoryID FROM as_stock_products WHERE stock > 0) ORDER BY factoryID ASC; ";
		$sqlFactory = mysqli_query($connect, $queryFactory);
		while ($dtFactory = mysqli_fetch_array($sqlFactory))
		{
			$dataFactory[] = array('supplierID' => $dtFactory['factoryID'],
									'supplierCode' => $dtFactory['factoryCode'],
									'supplierName' => $dtFactory['factoryName']);
		}
		$smarty->assign("factoryID", $_SESSION['SPBfactoryID']);
		$smarty->assign("dataFactory", $dataFactory);
		
		// count spb based on spbFaktur
		$showSpb1 = "SELECT * FROM as_spb WHERE spbFaktur = '$_SESSION[spbFaktur]'";
		$sqlSpb1 = mysqli_query($connect, $showSpb1);
		$numsSpb = mysqli_num_rows($sqlSpb1);
		
		if ($numsSpb == 0) {
			$orderDate = date('Y-m-d');
			$orderTime = date('H:i:s');
			$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
			$querySpb = "INSERT INTO as_spb(spbNo,
											spbFaktur,
											supplierID,
											supplierName,
											staffID,
											staffName,
											orderDate,
											needDate,
											note,
											status,
											createdDate,
											createdUserID,
											modifiedDate,
											modifiedUserID)
									VALUES(	'$spbCode',
											'$_SESSION[spbFaktur]',
											'',
											'',
											'$_SESSION[staffID]',
											'$sName',
											'$orderDate',
											'$orderTime',
											'',
											'Invalid',
											'$createdDate',
											'$staffID',
											'',
											'')";
			mysqli_query($connect, $querySpb);
		}
		
		// count spb based on spbFaktur
		$showSpb = "SELECT * FROM as_spb WHERE spbFaktur = '$_SESSION[spbFaktur]'";
		$sqlSpb = mysqli_query($connect, $showSpb);
		$dataSpb = mysqli_fetch_array($sqlSpb);
		$numsSpb = mysqli_num_rows($sqlSpb);
		
		$smarty->assign("supplierID", $dataSpb['supplierID']);
		  
		if ($dataSpb['orderDate'] == '0000-00-00')
		{
			$orderDate = tgl_indo2(date('Y-m-d'));
		}
		else
		{
			$orderDate = tgl_indo2($dataSpb['orderDate']);
		}
		
		$smarty->assign("spbNo", $spbCode);
		$smarty->assign("orderDateIndo", $orderDate);
		$smarty->assign("needDateIndo", $dataSpb['needDate']);
		$smarty->assign("spbFaktur", $_SESSION['spbFaktur']);
		$smarty->assign("note", $dataSpb['note']);

		// query detil spb
		$queryDetilSpb = "SELECT * FROM as_temp_detail_spb WHERE spbFaktur = '$_SESSION[spbFaktur]' AND spbNo = '$spbCode' ORDER BY detailID ASC";
		$sqlDetilSpb = mysqli_query($connect, $queryDetilSpb);
		$numsDetilSpb = mysqli_num_rows($sqlDetilSpb);
		
		// fetch data
		$i = 1;
		while ($dtDetilSpb = mysqli_fetch_array($sqlDetilSpb))
		{
			$subtotal = $dtDetilSpb['price'] * $dtDetilSpb['qty'];
			$dataDetilSpb[] = array(	'detailID' => $dtDetilSpb['detailID'],
										'productName' => $dtDetilSpb['productName'],
										'price' => rupiah($dtDetilSpb['price']),
										'qty' => $dtDetilSpb['qty'],
										'note' => $dtDetilSpb['note'],
										'subtotal' => rupiah($subtotal),
										'no' => $i);
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataDetilSpb", $dataDetilSpb);
		$smarty->assign("numsDetilSpb", $numsDetilSpb);
	} // close bracket
	
	// if the module is spb and act is search
	elseif ($module == 'spb' && $act == 'search')
	{
		$_SESSION['spbFaktur'] = date('Ymdhis');
		$smarty->assign("spbFaktur", $_SESSION['spbFaktur']);
		
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
		$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
		
		$smarty->assign("startDate", $sDate);
		$smarty->assign("endDate", $eDate);
		
		$s2Date = explode("-", $sDate);
		$e2Date = explode("-", $eDate);
		
		$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
		$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
		
		// showing up the spb data
		if ($sDate != '' || $eDate != '')
		{
			$querySpb = "SELECT * FROM as_spb WHERE spbNo LIKE '%$q%' AND orderDate BETWEEN '$startDate' AND '$endDate' ORDER BY spbID DESC";
		}
		else
		{
			$querySpb = "SELECT * FROM as_spb WHERE spbNo LIKE '%$q%' ORDER BY spbID DESC";
		}
		
		$sqlSpb = mysqli_query($connect, $querySpb);
		
		// fetch data
		$i = 1 + $position;
		while ($dtSpb = mysqli_fetch_array($sqlSpb))
		{
			$dataSpb[] = array(	'spbID' => $dtSpb['spbID'],
								'spbNo' => $dtSpb['spbNo'],
								'spbFaktur' => $dtSpb['spbFaktur'],
								'supplierName' => $dtSpb['supplierName'],
								'staffName' => $dtSpb['staffName'],
								'orderDate' => tgl_indo2($dtSpb['orderDate']),
								'needDate' => $dtSpb['needDate'],
								'total' => rupiah($dtSpb['total']),
								'status' => $dtSpb['status'],
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataSpb", $dataSpb);
		
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Mutasi Stok");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk mutasi stok produk ke sales.");
		$smarty->assign("breadcumbMenuName", "Mutasi Stok");
		$smarty->assign("breadcumbMenuSubName", "Tambah stok Sales");
	} 
	
	else
	{
		$_SESSION['spbFaktur'] = date('Ymdhis');
		$staffID = $_SESSION['staffID'];
		$smarty->assign("spbFaktur", $_SESSION['spbFaktur']);
		// create new object pagination
		$p = new PaginationSpb;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the spb data
		// FILTER BY STATUS
		$querySpb = "SELECT * FROM as_spb WHERE status != '0' AND status != '' AND staffID = '$staffID' ORDER BY spbID DESC LIMIT $position,$limit";
		$sqlSpb = mysqli_query($connect, $querySpb);
		
		// fetch data
		$i = 1 + $position;
		while ($dtSpb = mysqli_fetch_array($sqlSpb))
		{
			$dataSpb[] = array(	'spbID' => $dtSpb['spbID'],
								'spbNo' => $dtSpb['spbNo'],
								'spbFaktur' => $dtSpb['spbFaktur'],
								'supplierName' => $dtSpb['supplierName'],
								'staffName' => $dtSpb['staffName'],
								'orderDate' => tgl_indo2($dtSpb['orderDate']),
								'needDate' => $dtSpb['needDate'],
								'total' => rupiah($dtSpb['total']),
								'status' => $dtSpb['status'],
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataSpb", $dataSpb);
		
		// count data
		$queryCountSpb = "SELECT * FROM as_spb";
		$sqlCountSpb = mysqli_query($connect, $queryCountSpb);
		$amountData = mysqli_num_rows($sqlCountSpb);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Penyerahaan Stok");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk transaksi stok ke sales.");
		$smarty->assign("breadcumbMenuName", "Stok Sales");
		$smarty->assign("breadcumbMenuSubName", "Stok Sales");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>