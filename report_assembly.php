<?php
// include header
include "header.php";
// set the tpl page
$page = "report_assembly.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '18'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
	
	// if the module is assembly and act is search
	if ($module == 'assembly' && $act == 'search')
	{
		$sDate = explode("-", $_GET['startDate']);
		$eDate = explode("-", $_GET['endDate']);
		
		$startDate = $sDate[2]."-".$sDate[1]."-".$sDate[0];
		$endDate = $eDate[2]."-".$eDate[1]."-".$eDate[0];
		
		$smarty->assign("startDate", $_GET['startDate']);
		$smarty->assign("endDate", $_GET['endDate']);
		$smarty->assign("sDate", $_GET['startDate']);
		$smarty->assign("eDate", $_GET['endDate']);
		
		// create new object pagination
		$p = new PaginationReportAssembly;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the assembly data
		if ($_GET['startDate'] != '' && $_GET['endDate'] != '')
		{
			$queryAssembly = "SELECT * FROM as_assembly WHERE assemblyDate BETWEEN '$startDate' AND '$endDate' ORDER BY assemblyDate DESC LIMIT $position,$limit";
		}
		else
		{
			$queryAssembly = "SELECT * FROM as_assembly ORDER BY assemblyDate DESC LIMIT $position,$limit";
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
		
		// count data
		if ($_GET['startDate'] != '' && $_GET['endDate'] != '')
		{
			$queryCountAssembly = "SELECT * FROM as_assembly WHERE assemblyDate BETWEEN '$startDate' AND '$endDate' ORDER BY assemblyDate DESC";
		}
		else
		{
			$queryCountAssembly = "SELECT * FROM as_assembly ORDER BY assemblyDate DESC";
		}
		
		$sqlCountAssembly = mysqli_query($connect, $queryCountAssembly);
		$amountData = mysqli_num_rows($sqlCountAssembly);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Laporan Assembly");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melihat laporan assembly.");
		$smarty->assign("breadcumbMenuName", "Laporan");
		$smarty->assign("breadcumbMenuSubName", "Assembly");
	} 
	
	else
	{
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Laporan Assembly");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melihat laporan assembly.");
		$smarty->assign("breadcumbMenuName", "Laporan");
		$smarty->assign("breadcumbMenuSubName", "Assembly");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>