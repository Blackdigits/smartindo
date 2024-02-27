<?php
date_default_timezone_set('ASIA/JAKARTA');
error_reporting(0);
session_start();
// include all files are required
include "includes/connection.php";
include "includes/debug.php";
include "includes/page_function.php";
include "includes/fungsi_rupiah.php";
include "includes/fungsi_indotgl.php";

require('libs/Smarty.class.php');

// create new object
$smarty = new Smarty;

$year = date('Y');

// staff detail
$queryUser = "SELECT lastLogin, photo FROM as_staffs WHERE staffID = '$_SESSION[staffID]'";
$sqlUser = mysqli_query($connect, $queryUser);

// fetch data
$dtUser = mysqli_fetch_array($sqlUser);

$queryAuthorize = "SELECT * FROM as_modules WHERE status = 'Y'";
$sqlAuthorize = mysqli_query($connect, $queryAuthorize); 

while ($dtAuthorize = mysqli_fetch_array($sqlAuthorize))
{
	$dataAuthorize[] = array(	'modulID' => $dtAuthorize['modulID'],
								'authorize' => $dtAuthorize['authorize']);
}
$smarty->assign("dataAuthorize", $dataAuthorize);

// session login info
$smarty->assign("loginStaffName", $_SESSION['staffName']);
$smarty->assign("loginStaffNickName", $_SESSION['staffNickName']);
$smarty->assign("loginStaffPosition", $_SESSION['position']);
$smarty->assign("loginLastLogin", $dtUser['lastLogin']);
$smarty->assign("loginPhoto", $dtUser['photo']);
$smarty->assign("loginStaffLevel", $_SESSION['level']);
?>