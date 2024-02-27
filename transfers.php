<?php
// include header
include "header.php";
// set the tpl page
$page = "transfers.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '7'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is transfer and action is delete
	if ($module == 'transfer' && $act == 'delete')
	{
		// insert method into a variable
		$transferID = $_GET['transferID'];
		$transferFaktur = $_GET['transferFaktur'];
		
		// showing up the trf
		$queryTrf = "SELECT A.transferFrom, A.transferTo, B.detailID, B.qty, B.productID FROM as_transfers A INNER JOIN as_detail_transfers B ON B.transferCode=A.transferCode WHERE A.transferID = '$transferID' AND A.transferFaktur = '$transferFaktur'";
		$sqlTrf = mysqli_query($connect, $queryTrf);
		while ($dataTrf = mysqli_fetch_array($sqlTrf))
		{
			$qty = $dataTrf['qty'];

			$queryUpdateMin = "UPDATE as_stock_products SET stock = stock-$qty WHERE factoryID = '$dataTrf[transferTo]' AND productID = '$dataTrf[productID]' AND supplierID IS NULL";
			$sqlUpdateMin = mysqli_query($connect, $queryUpdateMin);
			 
            $queryUpdatePlus = "UPDATE as_stock_products SET stock = stock+$qty WHERE factoryID = '$dataTrf[transferFrom]' AND productID = '$dataTrf[productID]' AND supplierID IS NULL;";
            $sqlUpdatePlus = mysqli_query($connect, $queryUpdatePlus);
		}
		
		// delete transfer
		$queryTransfer = "DELETE FROM as_transfers WHERE transferID = '$transferID' AND transferFaktur = '$transferFaktur'";
		$sqlTransfer = mysqli_query($connect, $queryTransfer);
		
		if ($sqlTransfer)
		{
			// delete transfer detail
			$queryDetail = "DELETE FROM as_detail_transfers WHERE transferFaktur = '$transferFaktur'";
			$sqlDetail = mysqli_query($connect, $queryDetail);
			
			// delete transfer detail
			$queryDetailTrf = "DELETE FROM as_temp_detail_transfers WHERE transferFaktur = '$transferFaktur'";
			$sqlDetailTrf = mysqli_query($connect, $queryDetailTrf);
		}
		
		// redirect to the transfer page
		header("Location: transfers.php?msg=Data transfer berhasil dihapus");
	} // close bracket
	
	// if module is transfer and act is detailtrf
	elseif ($module == 'transfer' && $act == 'detailtrf')
	{
		$transferID = $_GET['transferID'];
		$transferFaktur = $_GET['transferFaktur'];
		
		// showing up the main transfer data
		$queryMain = "SELECT * FROM as_transfers WHERE transferID = '$transferID' AND transferFaktur = '$transferFaktur'";
		$sqlMain = mysqli_query($connect, $queryMain);
		$dataMain = mysqli_fetch_array($sqlMain);
		
		// transferFrom
		$queryFrom = "SELECT factoryName FROM as_factories WHERE factoryID = '$dataMain[transferFrom]'";
		$sqlFrom = mysqli_query($connect, $queryFrom);
		$dataFrom = mysqli_fetch_array($sqlFrom);
		
		// transfer to
		$queryTo = "SELECT staffName FROM as_staffs WHERE staffID = '$dataMain[transferTo]'";
		$sqlTo = mysqli_query($connect, $queryTo);
		$dataTo = mysqli_fetch_array($sqlTo);
		
		// assign to the tpl
		$smarty->assign("transferID", $dataMain['transferID']);
		$smarty->assign("transferCode", $dataMain['transferCode']);
		$smarty->assign("ref", $dataMain['ref']);
		$smarty->assign("trxIndo", tgl_indo2($dataMain['trxDate']));
		$smarty->assign("note", $dataMain['note']);
		$smarty->assign("transferFrom", $dataFrom['factoryName']);
		$smarty->assign("transferTo", $dataTo['staffName']);
		$smarty->assign("pageNumber", $_GET['page']);
		$smarty->assign("transferFaktur", $_GET['transferFaktur']);
		
		// showing up the detail transfer
		$queryDetail = "SELECT * FROM as_detail_transfers WHERE transferFaktur = '$transferFaktur' AND transferCode = '$dataMain[transferCode]'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// fetch data
		$i = 1;
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			$dataDetail[] = array(	'detailID' => $dtDetail['detailID'],
									'transferCode' => $dtDetail['transferCode'],
									'transferFaktur' => $dtDetail['transferFaktur'],
									'productID' => $dtDetail['productID'],
									'productName' => $dtDetail['productName'],
									'qty' => $dtDetail['qty'],
									'note' => $dtDetail['note'],
									'no' => $i
									);
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataDetail", $dataDetail);
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Transfer Gudang");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi atau mutasi transfer gudang.");
		$smarty->assign("breadcumbMenuName", "Transfer Gudang");
		$smarty->assign("breadcumbMenuSubName", "Detail Transfer Gudang");
	}
	
	//if module is transfer and act is input
	elseif ($module == 'transfer' && $act == 'input')
	{
		$transferFaktur = $_SESSION['transferFaktur'];
		$transferCode = $_POST['transferCode'];
		$transferFrom = $_POST['transferFrom'];
		$transferTo = $_POST['transferTo'];
		$ref = mysqli_real_escape_string($connect, $_POST['ref']);
		$note = mysqli_real_escape_string($connect, $_POST['note']);
		
		// update transfer
		$queryTrf = "UPDATE as_transfers SET ref = '$ref', note = '$note' WHERE transferFaktur = '$transferFaktur' AND transferCode = '$transferCode'";
		mysqli_query($connect, $queryTrf);
		
		// showing up the temp detail transfer
		$queryTransfer = "SELECT * FROM as_temp_detail_transfers WHERE transferCode = '$transferCode' AND transferFaktur = '$transferFaktur'";
		$sqlTransfer = mysqli_query($connect, $queryTransfer);
		
		// fetch data
		while ($dataTransfer = mysqli_fetch_array($sqlTransfer))
		{
			$querySaveTransfer = "INSERT INTO as_detail_transfers (	transferCode,
																	transferFaktur,
																	productID,
																	productName,
																	qty,
																	note,
																	createdDate,
																	createdUserID,
																	modifiedDate,
																	modifiedUserID)
															VALUES(	'$dataTransfer[transferCode]',
																	'$dataTransfer[transferFaktur]',
																	'$dataTransfer[productID]',
																	'$dataTransfer[productName]',
																	'$dataTransfer[qty]',
																	'$dataTransfer[note]',
																	'$dataTransfer[createdDate]',
																	'$dataTransfer[createdUserID]',
																	'',
																	'')";
			$save = mysqli_query($connect, $querySaveTransfer);

			$queryStockStaff = "SELECT stockProductID FROM as_stock_products WHERE productID = '$dataTransfer[productID]' AND factoryID = '$transferTo' AND supplierID IS NULL";
			$sqlStaffStock = mysqli_query($connect, $queryStockStaff);

			if (mysqli_num_rows($sqlStaffStock) == 0) {
				$qty = $dataTransfer['qty'];
				$queryStock = "INSERT INTO as_stock_products (	productID,
																factoryID, 
																stock,
																createdDate,
																createdUserID,
																modifiedDate,
																modifiedUserID)
														VALUES(	'$dataTransfer[productID]', 
																 $transferTo,
																 $qty,
																'$dataTransfer[createdDate]',
																'$dataTransfer[createdUserID]',
																'',
																'')";
																
				$sqlStock = mysqli_query($connect, $queryStock);
				if ($sqlStock) {
					$qty = $dataTransfer['qty'];
					$queryStockMin = "UPDATE as_stock_products SET stock = stock-$qty WHERE productID = '$dataTransfer[productID]' AND factoryID = '$transferFrom' AND supplierID IS NULL;";
					$save1 = mysqli_query($connect, $queryStockMin);
				}
				
			} else { 

			if ($save) {
					$qty = $dataTransfer['qty'];
					$queryStockMin = "UPDATE as_stock_products SET stock = stock-$qty WHERE productID = '$dataTransfer[productID]' AND factoryID = '$transferFrom' AND supplierID IS NULL;";
					$save1 = mysqli_query($connect, $queryStockMin);
					
					if ($save1)
					{
						$queryStockPlus = "UPDATE as_stock_products SET stock = stock+$qty  WHERE productID = '$dataTransfer[productID]' AND factoryID = '$transferTo' AND supplierID IS NULL";
						mysqli_query($connect, $queryStockPlus);
					}
				}
			}
		}
		
		// delete temp detail transfer
		$queryDelete = "DELETE FROM as_temp_detail_transfers WHERE transferCode = '$transferCode' AND transferFaktur = '$transferFaktur'";
		mysqli_query($connect, $queryDelete);
		
		// redirect to the transfer page
		header("Location: transfers.php?msg=Data transfer berhasil disimpan");
	}
	
	// if module is transfer and act is deletedetail
	elseif ($module == 'transfer' && $act == 'deletedetail')
	{
		$detailID = $_GET['detailID'];
		
		// delete data
		$queryTrf = "DELETE FROM as_temp_detail_transfers WHERE detailID = '$detailID'";
		$sqlTrf = mysqli_query($connect, $queryTrf);
		
		// redirect to the add transfer page
		header("Location: transfers.php?module=transfer&act=add&msg=Data item berhasil dihapus");
	}
	
	// if module is transfer and act is cancel
	elseif ($module == 'transfer' && $act == 'cancel')
	{
		$transferFaktur = $_SESSION['transferFaktur'];
		
		$queryDetail = "DELETE FROM as_temp_detail_transfers WHERE transferFaktur = '$transferFaktur'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		if ($sqlDetail)
		{
			$queryTransfer = "DELETE FROM as_transfers WHERE transferFaktur = '$transferFaktur'";
			$sqlTransfer = mysqli_query($connect, $queryTransfer);
		}

		// redirect to the transfer page
		header("Location: transfers.php?msg=Data transfer berhasil dibatalkan");
	} 
	
	// if module is transfer and act is add
	elseif ($module == 'transfer' && $act == 'add')
	{
		$staffID = $_SESSION['staffID'];
		$createdDate = date('Y-m-d H:i:s');
		
		// get last sort transfer number ID
		$queryNoTransfer = "SELECT transferCode FROM as_detail_transfers ORDER BY transferCode DESC LIMIT 1";
		$sqlNoTransfer = mysqli_query($connect, $queryNoTransfer);
		$numsNoTransfer = mysqli_num_rows($sqlNoTransfer);
		$dataNoTransfer = mysqli_fetch_array($sqlNoTransfer);
		
		$start = substr($dataNoTransfer['transferCode'],0-5);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoTransfer == '0')
		{
			$transferNo = "00000";
		}
		elseif ($tempNo == 1)
		{
			$transferNo = "00000";
		}
		elseif ($tempNo == 2)
		{
			$transferNo = "0000";
		}
		elseif ($tempNo == 3)
		{
			$transferNo = "000";
		}
		elseif ($tempNo == 4)
		{
			$transferNo = "00";
		}
		elseif ($tempNo == 5)
		{
			$transferNo = "0";
		}
		elseif ($tempNo == 6)
		{
			$transferNo = "";
		}
		
		$transferCode = $transferNo.$next;
		
		$smarty->assign("transferCode", $transferCode);
		$smarty->assign("trxDate", date('Y-m-d'));
		$smarty->assign("trxIndo", tgl_indo2(date('Y-m-d')));
		$smarty->assign("transferFaktur", $_SESSION['transferFaktur']);
		
		$smarty->assign("breadcumbTitle", "Transfer Gudang");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk transaksi atau mutasi transfer gudang.");
		$smarty->assign("breadcumbMenuName", "Transfer Gudang");
		$smarty->assign("breadcumbMenuSubName", "Tambah Transaksi Transfer Gudang");
		
		// showing up the factories
		$queryFatory = "SELECT factoryID, factoryCode, factoryName FROM as_factories WHERE status = 'Y' ORDER BY factoryName ASC;";
		$sqlFactory = mysqli_query($connect, $queryFatory);
		
		// fetch data
		while ($dtFactory = mysqli_fetch_array($sqlFactory))
		{
			$dataFactory[] = array(	'factoryID' => $dtFactory['factoryID'],
									'factoryCode' => $dtFactory['factoryCode'],
									'factoryName' => $dtFactory['factoryName']);
		}
		
		// assign to the tpl
		$smarty->assign("dataFactory", $dataFactory);
		
		// showing up the staff
		$queryStaff = "SELECT factoryID, factoryCode, factoryName FROM as_factories WHERE status = 'Y' ORDER BY factoryName ASC;";
		$sqlStaff = mysqli_query($connect, $queryStaff);
		
		// fetch data
		while ($dtStaff = mysqli_fetch_array($sqlStaff))
		{
			$dataStaff[] = array(	'staffID' => $dtStaff['factoryID'],
									'staffCode' => $dtStaff['factoryCode'],
									'staffName' => $dtStaff['factoryName']);
		}
		
		// assign to the tpl
		$smarty->assign("dataStaff", $dataStaff);

		// save into the transfer table
		$date = date('Y-m-d');
		
		// count transfer based on transferFaktur
		$showTransfer = "SELECT * FROM as_transfers WHERE transferFaktur = '$_SESSION[transferFaktur]'";
		$sqlTransfer = mysqli_query($connect, $showTransfer);
		$dataTransfer = mysqli_fetch_array($sqlTransfer);
		$numsTransfer = mysqli_num_rows($sqlTransfer);
		
		$smarty->assign("transferFrom", $dataTransfer['transferFrom']);
		$smarty->assign("transferTo", $dataTransfer['transferTo']);
		
		if ($numsTransfer == 0)
		{
			$queryTransfer = "INSERT INTO as_transfers (transferCode,
														transferFaktur,
														ref,
														trxDate,
														note,
														transferFrom,
														transferTo,
														createdDate,
														createdUserID,
														modifiedDate,
														modifiedUserID)
												VALUES(	'$transferCode',
														'$_SESSION[transferFaktur]',
														'',
														'$date',
														'',
														'',
														'',
														'$createdDate',
														'$staffID',
														'',
														'')";
			mysqli_query($connect, $queryTransfer);
		}

		// query detil transfer
		$queryDetilTransfer = "SELECT * FROM as_temp_detail_transfers WHERE transferFaktur = '$_SESSION[transferFaktur]' AND transferCode = '$transferCode' ORDER BY detailID ASC";
		$sqlDetilTransfer = mysqli_query($connect, $queryDetilTransfer);
		$numsDetilTransfer = mysqli_num_rows($sqlDetilTransfer);
		
		// fetch data
		$i = 1;
		while ($dtDetilTransfer = mysqli_fetch_array($sqlDetilTransfer))
		{
			$dataDetilTransfer[] = array(	'detailID' => $dtDetilTransfer['detailID'],
											'productName' => $dtDetilTransfer['productName'],
											'qty' => $dtDetilTransfer['qty'],
											'note' => $dtDetilTransfer['note'],
											'no' => $i);
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataDetilTransfer", $dataDetilTransfer);
		$smarty->assign("numsDetilTransfer", $numsDetilTransfer);
	} // close bracket
	
	else
	{
		$_SESSION['transferFaktur'] = date('Ymdhis');
		$smarty->assign("transferFaktur", $_SESSION['transferFaktur']);
		// create new object pagination
		$p = new PaginationTransfer;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the transfer data
		$queryTransfer = "SELECT * FROM as_transfers ORDER BY transferID DESC LIMIT $position,$limit";
		$sqlTransfer = mysqli_query($connect, $queryTransfer);
		
		// fetch data
		$i = 1 + $position;
		while ($dtTransfer = mysqli_fetch_array($sqlTransfer))
		{
			// factory from
			$queryFrom = "SELECT factoryName FROM as_factories WHERE factoryID = '$dtTransfer[transferFrom]'";
			$sqlFrom = mysqli_query($connect, $queryFrom);
			$dataFrom = mysqli_fetch_array($sqlFrom);
			
			// factory to
			$queryTo = "SELECT factoryName FROM as_factories WHERE factoryID = '$dtTransfer[transferTo]'";
			$sqlTo = mysqli_query($connect, $queryTo);
			$dataTo = mysqli_fetch_array($sqlTo);
			
			$dataTransfer[] = array('transferID' => $dtTransfer['transferID'],
									'ref' => $dtTransfer['ref'],
									'transferFaktur' => $dtTransfer['transferFaktur'],
									'transferCode' => $dtTransfer['transferCode'],
									'trxDate' => tgl_indo2($dtTransfer['trxDate']),
									'note' => $dtTransfer['note'],
									'from' => $dataFrom['factoryName'],
									'to' => $dataTo['factoryName'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataTransfer", $dataTransfer);
		
		// count data
		$queryCountTransfer = "SELECT * FROM as_transfers";
		$sqlCountTransfer = mysqli_query($connect, $queryCountTransfer);
		$amountData = mysqli_num_rows($sqlCountTransfer);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Transfer Stok");
		$smarty->assign("breadcumbTitleSmall", "Halaman transaksi atau mutasi transfer stok.");
		$smarty->assign("breadcumbMenuName", "Transfer stok");
		$smarty->assign("breadcumbMenuSubName", "Transfer stok");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>