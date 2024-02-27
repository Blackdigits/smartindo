<?php
// include header
include "header.php";
// set the tpl page
$page = "assembly.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '15'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is assembly and action is delete
	if ($module == 'assembly' && $act == 'delete')
	{
		// insert method into a variable
		$assemblyID = $_GET['assemblyID'];
		$assemblyFaktur = $_GET['assemblyFaktur'];
		$assemblyCode = $_GET['assemblyCode'];
		
		// show up the detail assembly
		$querySP = "SELECT productID, qty, factoryID FROM as_detail_assembly WHERE assemblyID = '$assemblyID' AND assemblyFaktur = '$assemblyFaktur'";
		$sqlSP = mysqli_query($connect, $querySP);
		
		while ($dataSP = mysqli_fetch_array($sqlSP))
		{
			$qty = $dataSP['qty'];
			// update stock product
			$queryStock = "UPDATE as_stock_products SET stock=stock+$qty WHERE productID = '$dataSP[productID]' AND factoryID = '$dataSP[factoryID]'";
			mysqli_query($connect, $queryStock);
		}
		
		// delete assembly
		$queryAssembly = "DELETE FROM as_assembly WHERE assemblyID = '$assemblyID' AND assemblyFaktur = '$assemblyFaktur' AND assemblyCode = '$assemblyCode'";
		$sqlAsembly = mysqli_query($connect, $queryAssembly);
		
		// delete assembly detail
		$queryAssemblyDetail = "DELETE FROM as_detail_assembly WHERE assemblyID = '$assemblyID' AND assemblyFaktur = '$assemblyFaktur'";
		$sqlAssemblyDetail = mysqli_query($connect, $queryAssemblyDetail);
		
		// redirect to the assembly page
		header("Location: assembly.php?msg=Data assembly berhasil dihapus");
	} // close bracket
	
	// if module is assembly and act is finish
	elseif ($module == 'assembly' && $act == 'finish')
	{
		$assemblyID = $_GET['assemblyID'];
		$assemblyFaktur = $_GET['assemblyFaktur'];
		
		// showing up the main assembly
		$queryAssembly = "SELECT * FROM as_assembly WHERE assemblyID = '$assemblyID' AND assemblyFaktur = '$assemblyFaktur'";
		$sqlAssembly = mysqli_query($connect, $queryAssembly);
		$dataAssembly = mysqli_fetch_array($sqlAssembly);
		
		// assign to the tpl
		$smarty->assign("assemblyID", $dataAssembly['assemblyID']);
		$smarty->assign("assemblyFaktur", $dataAssembly['assemblyFaktur']);
		$smarty->assign("assemblyCode", $dataAssembly['assemblyCode']);
		$smarty->assign("assemblyDate", tgl_indo2($dataAssembly['assemblyDate']));
		$smarty->assign("productCode", $dataAssembly['productCode']);
		$smarty->assign("productName", $dataAssembly['productName']);
		$smarty->assign("qty", $dataAssembly['qty']);
		$smarty->assign("subtotal", rupiah($dataAssembly['subtotal']));
		$smarty->assign("cost", rupiah($dataAssembly['cost']));
		$smarty->assign("grandtotal", rupiah($dataAssembly['grandtotal']));
		$smarty->assign("note", $dataAssembly['note']);
		$smarty->assign("staffID", $dataAssembly['staffID']);
		$smarty->assign("staffName", $dataAssembly['staffName']);
		
		// showing up the detail assembly
		$queryDetail = "SELECT * FROM as_detail_assembly WHERE assemblyID = '$assemblyID' AND assemblyFaktur = '$assemblyFaktur'";
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
									'factoryName' => $dtDetail['factoryName'],
									'no' => $i
									);
			$grandtotal += $subtotal;
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("grandtotal", rupiah($grandtotal));
		$smarty->assign("dataDetail", $dataDetail);
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Assembly");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi assembly.");
		$smarty->assign("breadcumbMenuName", "Assembly");
		$smarty->assign("breadcumbMenuSubName", "Detail Assembly");
		$smarty->assign("pageNumber", $_GET['page']);
	}
	
	// if module is assembly and act is detailassembly
	elseif ($module == 'assembly' && $act == 'detailassembly')
	{
		$assemblyID = $_GET['assemblyID'];
		$assemblyFaktur = $_GET['assemblyFaktur'];
		
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		// showing up the main assembly
		$queryAssembly = "SELECT * FROM as_assembly WHERE assemblyID = '$assemblyID' AND assemblyFaktur = '$assemblyFaktur'";
		$sqlAssembly = mysqli_query($connect, $queryAssembly);
		$dataAssembly = mysqli_fetch_array($sqlAssembly);
		
		// assign to the tpl
		$smarty->assign("assemblyID", $dataAssembly['assemblyID']);
		$smarty->assign("assemblyFaktur", $dataAssembly['assemblyFaktur']);
		$smarty->assign("assemblyCode", $dataAssembly['assemblyCode']);
		$smarty->assign("assemblyDate", tgl_indo2($dataAssembly['assemblyDate']));
		$smarty->assign("productCode", $dataAssembly['productCode']);
		$smarty->assign("productName", $dataAssembly['productName']);
		$smarty->assign("qty", $dataAssembly['qty']);
		$smarty->assign("subtotal", rupiah($dataAssembly['subtotal']));
		$smarty->assign("cost", rupiah($dataAssembly['cost']));
		$smarty->assign("grandtotal", rupiah($dataAssembly['grandtotal']));
		$smarty->assign("note", $dataAssembly['note']);
		$smarty->assign("staffID", $dataAssembly['staffID']);
		$smarty->assign("staffName", $dataAssembly['staffName']);
		
		// TYPE HERE UNDER
		// showing up the detail assembly
		$queryDetail = "SELECT * FROM as_detail_assembly WHERE assemblyID = '$dataAssembly[assemblyID]' AND assemblyFaktur = '$dataAssembly[assemblyFaktur]'";
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
									'factoryName' => $dtDetail['factoryName'],
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
		$smarty->assign("breadcumbTitle", "Assembly");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi assembly.");
		$smarty->assign("breadcumbMenuName", "Assembly");
		$smarty->assign("breadcumbMenuSubName", "Detail Assembly");
		$smarty->assign("pageNumber", $_GET['page']);
	}
	
	//if module is assembly and act is input
	elseif ($module == 'assembly' && $act == 'input')
	{
		$createdDate = date('Y-m-d H:i:s');
		$assemblyFaktur = $_SESSION['assemblyFaktur'];
		$assemblyCode = mysqli_real_escape_string($connect, $_POST['assemblyCode']);
		$productID = mysqli_real_escape_string($connect, $_POST['productID']);
		$productCode = mysqli_real_escape_string($connect, $_POST['productCode']);
		$productName1 = mysqli_real_escape_string($connect, $_POST['productName1']);
		$qty = mysqli_real_escape_string($connect, $_POST['qty']);
		$subtotal = mysqli_real_escape_string($connect, $_POST['subtotal']);
		$cost = mysqli_real_escape_string($connect, $_POST['cost']);
		$grandtotal = mysqli_real_escape_string($connect, $_POST['grandtotal']);
		$note1 = mysqli_real_escape_string($connect, $_POST['note1']);
		$staffID = $_SESSION['staffID'];
		$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
		$date = explode("-", $_POST['assemblyDate']);
		$assemblyDate = $date[2]."-".$date[1]."-".$date[0];
		
		// save into the asembly
		$queryAssembly = "INSERT INTO as_assembly (	assemblyFaktur, 
													assemblyCode,
													assemblyDate,
													productCode,
													productName,
													qty,
													subtotal,
													cost,
													grandtotal,
													note,
													staffID,
													staffName,
													createdDate,
													createdUserID,
													modifiedDate,
													modifiedUserID)
											VALUES(	'$assemblyFaktur',
													'$assemblyCode',
													'$assemblyDate',
													'$productCode',
													'$productName1',
													'$qty',
													'$subtotal',
													'$cost',
													'$grandtotal',
													'$note1',
													'$staffID',
													'$sName',
													'$createdDate',
													'$staffID',
													'',
													'')";
		$sqlAssembly = mysqli_query($connect, $queryAssembly);
		
		$assemblyID = mysqli_insert_id($connect);
		
		$detailID = $_POST['detailID'];
		$countDetailID = COUNT($detailID);
		$productID = $_POST['productID'];
		$productName = $_POST['productName'];
		$price = $_POST['price'];
		$kuantiti = $_POST['kuantiti'];
		$factory = $_POST['factory'];
		$note = $_POST['note'];
		
		for ($i = 0; $i < $countDetailID; $i++)
		{
			$facexp = explode("#", $factory[$i]);
			$factoryID = $facexp[0];
			$factoryName = $facexp[1];
			
			$queryInsert = "INSERT INTO as_detail_assembly (assemblyID,
															assemblyFaktur,
															productID,
															productName,
															price,
															qty,
															factoryID,
															factoryName,
															note,
															createdDate,
															createdUserID,
															modifiedDate,
															modifiedUserID
															)
													VALUES(	'$assemblyID',
															'$assemblyFaktur',
															'$productID[$i]',
															'$productName[$i]',
															'$price[$i]',
															'$kuantiti[$i]',
															'$factoryID',
															'$factoryName',
															'$note[$i]',
															'$createdDate',
															'$staffID',
															'',
															'')";
			$sqlInsert = mysqli_query($connect, $queryInsert);
			
			if ($sqlInsert)
			{
				$querySP = "UPDATE as_stock_products SET stock=stock-$kuantiti[$i] WHERE productID = '$productID[$i]' AND factoryID = '$factoryID'";
				mysqli_query($connect, $querySP);
			}
		}
		
		// delete temp detail assembly
		$queryDelete = "DELETE FROM as_temp_detail_assembly WHERE assemblyFaktur = '$assemblyFaktur'";
		$delete = mysqli_query($connect, $queryDelete);
		
		if ($delete)
		{
			$_SESSION['assemblyFaktur'] = "";
		}
		
		// redirect to the finish page
		header("Location: assembly.php?module=assembly&act=finish&assemblyID=".$assemblyID."&assemblyFaktur=".$assemblyFaktur."&msg=Data assembly berhasil disimpan, silahkan tambahkan ke dalam data produk melalui menu manajemen produk.");
	}
	
	// if module is assembly and act is deletedetail
	elseif ($module == 'assembly' && $act == 'deletedetail')
	{
		$detailID = $_GET['detailID'];
		
		// delete data
		$queryAssembly = "DELETE FROM as_temp_detail_assembly WHERE detailID = '$detailID'";
		$sqlAssembly = mysqli_query($connect, $queryAssembly);
		
		// redirect to the add add assembly page
		header("Location: assembly.php?module=assembly&act=add&msg=Data item berhasil dihapus");
	}
	
	// if module is assembly and act is cancel
	elseif ($module == 'assembly' && $act == 'cancel')
	{
		$assemblyFaktur = $_SESSION['assemblyFaktur'];
		
		$queryDetail = "DELETE FROM as_temp_detail_assembly WHERE assemblyFaktur = '$assemblyFaktur'";
		$sqlDetail = mysqli_query($connect, $queryDetail);

		// redirect to the assembly page
		header("Location: assembly.php?msg=Data assembly berhasil dibatalkan");
	} 
	
	// if module is assembly and act is add
	elseif ($module == 'assembly' && $act == 'add')
	{
		$assemblyFaktur = $_SESSION['assemblyFaktur'];
		
		$smarty->assign("breadcumbTitle", "Assembly");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi assembly.");
		$smarty->assign("breadcumbMenuName", "Assembly");
		$smarty->assign("breadcumbMenuSubName", "Tambah Transaksi Assembly");
		
		// assign to the tpl
		$smarty->assign("assemblyDate", date('d-m-Y'));
		
		$queryTempAssembly = "SELECT * FROM as_temp_detail_assembly WHERE assemblyFaktur = '$assemblyFaktur'";
		$sqlTempAssembly = mysqli_query($connect, $queryTempAssembly);
		$numsTempAssembly = mysqli_num_rows($sqlTempAssembly);
		
		// fetch data
		$i = 1;
		while ($dtTempAssembly = mysqli_fetch_array($sqlTempAssembly))
		{
			// query stock product
			$querySP = "SELECT B.stock, A.factoryID, A.factoryCode, A.factoryName FROM as_factories A LEFT JOIN as_stock_products B ON A.factoryID = B.factoryID WHERE B.productID = '$dtTempAssembly[productID]' ORDER BY A.factoryCode ASC";
			$sqlSP = mysqli_query($connect, $querySP);
			
			$stock = array();
			while ($dataSP = mysqli_fetch_array($sqlSP))
			{
				$stock[] = array(	'factoryID' => $dataSP['factoryID'],
									'factoryCode' => $dataSP['factoryCode'],
									'factoryName' => $dataSP['factoryName'],
									'stock' => $dataSP['stock']);
			}
		
			$subt = $dtTempAssembly['price'] * $dtTempAssembly['qty'];
			
			$dataTempAssembly[] = array('detailID' => $dtTempAssembly['detailID'],
										'assemblyFaktur' => $dtTempAssembly['assemblyFaktur'],
										'productID' => $dtTempAssembly['productID'],
										'productName' => $dtTempAssembly['productName'],
										'price' => rupiah($dtTempAssembly['price']),
										'priceori' => $dtTempAssembly['price'],
										'qty' => $dtTempAssembly['qty'],
										'note' => $dtTempAssembly['note'],
										'subtotal' => rupiah($subt),
										'stok' => $stock,
										'no' => $i);
										
			$subtotal = $subtotal + $subt; 
			$i++;
		}
		
		$smarty->assign("dataDetilAssembly", $dataTempAssembly);
		$smarty->assign("numsDetilAssembly", $numsTempAssembly);
		$smarty->assign("subtotal", $subtotal);
		$smarty->assign("subtotalrp", rupiah($subtotal));
		
		// query factory
		$queryFactory = "SELECT * FROM as_factories WHERE status = 'Y' ORDER BY factoryCode ASC";
		$sqlFactory = mysqli_query($connect, $queryFactory);
		// fetch data
		while ($dtFactory = mysqli_fetch_array($sqlFactory))
		{
			$dataFactory[] = array(	'factoryID' => $dtFactory['factoryID'],
									'factoryCode' => $dtFactory['factoryCode'],
									'factoryName' => $dtFactory['factoryName']
									);
		}
		
		$smarty->assign("dataFactory", $dataFactory);
	} // close bracket
	
	// if the module is assembly and act is search
	elseif ($module == 'assembly' && $act == 'search')
	{
		$_SESSION['assemblyFaktur'] = date('Ymdhis');
		$smarty->assign("assemblyFaktur", $_SESSION['assemblyFaktur']);
		
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
			$queryAssembly = "SELECT * FROM as_assembly WHERE assemblyCode LIKE '%$q%' AND assemblyDate BETWEEN '$startDate' AND '$endDate' ORDER BY createdDate DESC";
		}
		else
		{
			$queryAssembly = "SELECT * FROM as_assembly WHERE assemblyCode LIKE '%$q%' ORDER BY createdDate DESC";
		}
		
		$sqlAssembly = mysqli_query($connect, $queryAssembly);
		
		// fetch data
		$i = 1 + $position;
		while ($dtAssembly = mysqli_fetch_array($sqlAssembly))
		{
			$dataAssembly[] = array('assemblyID' => $dtAssembly['assemblyID'],
									'assemblyFaktur' => $dtAssembly['assemblyFaktur'],
									'assemblyCode' => $dtAssembly['assemblyCode'],
									'assemblyDate' => tgl_indo2($dtAssembly['assemblyDate']),
									'productName' => $dtAssembly['productCode']." ".$dtAssembly['productName'],
									'qty' => $dtAssembly['qty'],
									'grandtotal' => rupiah($dtAssembly['grandtotal']),
									'staffName' => $dtAssembly['staffName'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataAssembly", $dataAssembly);
		
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Assembly");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi assembly.");
		$smarty->assign("breadcumbMenuName", "Assembly");
		$smarty->assign("breadcumbMenuSubName", "Assembly");
	} 
	
	else
	{
		$_SESSION['assemblyFaktur'] = date('Ymdhis');
		$smarty->assign("assemblyFaktur", $_SESSION['assemblyFaktur']);
		// create new object pagination
		$p = new PaginationAssembly;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the assembly data
		$queryAssembly = "SELECT * FROM as_assembly ORDER BY createdDate DESC LIMIT $position,$limit";
		$sqlAssembly = mysqli_query($connect, $queryAssembly);
		
		// fetch data
		$i = 1 + $position;
		while ($dtAssembly = mysqli_fetch_array($sqlAssembly))
		{
			$dataAssembly[] = array('assemblyID' => $dtAssembly['assemblyID'],
									'assemblyFaktur' => $dtAssembly['assemblyFaktur'],
									'assemblyCode' => $dtAssembly['assemblyCode'],
									'assemblyDate' => tgl_indo2($dtAssembly['assemblyDate']),
									'productName' => $dtAssembly['productCode']." ".$dtAssembly['productName'],
									'qty' => $dtAssembly['qty'],
									'grandtotal' => rupiah($dtAssembly['grandtotal']),
									'staffName' => $dtAssembly['staffName'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataAssembly", $dataAssembly);
		
		// count data
		$queryCountAssembly = "SELECT * FROM as_assembly";
		$sqlCountAssembly = mysqli_query($connect, $queryCountAssembly);
		$amountData = mysqli_num_rows($sqlCountAssembly);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Assembly");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi assembly.");
		$smarty->assign("breadcumbMenuName", "Assembly");
		$smarty->assign("breadcumbMenuSubName", "Assembly");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>