<?php
// include header
include "header.php";
// set the tpl page
$page = "categories.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '4'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is category and action is delete
	if ($module == 'category' && $act == 'delete')
	{
		// insert method into a variable
		$categoryID = $_GET['categoryID'];
		
		// delete categories
		$queryCategory = "DELETE FROM as_categories WHERE categoryID = '$categoryID'";
		$sqlCategory = mysqli_query($connect, $queryCategory);
		
		// redirect to the categories page
		header("Location: categories.php?msg=Data kategori berhasil dihapus");
	} // close bracket
	
	// if module is category and act is search
	elseif ($module == 'category' && $act == 'search')
	{
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		$queryCategory = "SELECT * FROM as_categories WHERE categoryName LIKE '%$q%' ORDER BY categoryName ASC";
		$sqlCategory = mysqli_query($connect, $queryCategory);
		
		// fetch data
		$i = 1;
		while ($dtCategory = mysqli_fetch_array($sqlCategory))
		{
			$dataCategory[] = array('categoryID' => $dtCategory['categoryID'],
									'categoryName' => $dtCategory['categoryName'],
									'status' => $dtCategory['status'],
									'no' => $i);
			$i++;
		}
		
		// assign
		$smarty->assign("dataCategory", $dataCategory);
		$smarty->assign("q", $q);
	}
	
	else
	{
		// create new object pagination
		$p = new PaginationCategory;
		// limit 20 data for page
		$limit  = 20;
		$position = $p->searchPosition($limit);
		
		// showing up the categories data
		$queryCategory = "SELECT * FROM as_categories ORDER BY categoryName ASC LIMIT $position,$limit";
		$sqlCategory = mysqli_query($connect, $queryCategory);
		
		// fetch data
		$i = 1 + $position;
		while ($dtCategory = mysqli_fetch_array($sqlCategory))
		{
			$dataCategory[] = array('categoryID' => $dtCategory['categoryID'],
									'categoryName' => $dtCategory['categoryName'],
									'status' => $dtCategory['status'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataCategory", $dataCategory);
		
		// count data
		$queryCountCategory = "SELECT * FROM as_categories";
		$sqlCountCategory = mysqli_query($connect, $queryCountCategory);
		$amountData = mysqli_num_rows($sqlCountCategory);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
	}
	
	$smarty->assign("msg", $_GET['msg']);
	$smarty->assign("breadcumbTitle", "Manajemen Kategori");
	$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan data master kategori produk.");
	$smarty->assign("breadcumbMenuName", "Master Data");
	$smarty->assign("breadcumbMenuSubName", "Kategori");
}

// include footer
include "footer.php";
?>