<?php
// include header
include "header.php";
// set the tpl page
$page = "authorize.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '25'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// showing up the modules data
	$queryModule = "SELECT * FROM as_modules ORDER BY modulID ASC";
	$sqlModule = mysqli_query($connect, $queryModule);
	
	// fetch data
	$i = 1;
	while ($dtModule = mysqli_fetch_array($sqlModule))
	{
		$a = str_replace("1", " Administrator", $dtModule['authorize']);
		$b = str_replace("2", " Sales", $a);
		$c = str_replace("3", " Kasir", $b);
		$d = str_replace("4", " Spv", $c);
		$e = str_replace("5", " Top", $d); 
		$f = str_replace("0", "", $e);
		$g = str_replace(",,,", ",", $f);
		$h = str_replace(",,", ",", $g);
		
		$dataModule[] = array(	'modulID' => $dtModule['modulID'],
								'modulName' => $dtModule['modulName'],
								'authorize' => $h,
								'status' => $dtModule['status'],
								'no' => $i);
		$i++;
	}
	
	$smarty->assign("dataModul", $dataModule);
		
	$smarty->assign("msg", $_GET['msg']);
	$smarty->assign("breadcumbTitle", "Manajemen Level Authorize");
	$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan data master otorisasi level.");
	$smarty->assign("breadcumbMenuName", "Master Data");
	$smarty->assign("breadcumbMenuSubName", "Level Authorize");
}

// include footer
include "footer.php";
?>