<?php
// include header
include "header.php";

$createdDate = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];
$staffCode = mysqli_real_escape_string($connect, $_POST['staffCode']);
$staffName = mysqli_real_escape_string($connect, $_POST['staffName']);
$address = mysqli_real_escape_string($connect, $_POST['address']);
$address2 = mysqli_real_escape_string($connect, $_POST['address2']);
$village = mysqli_real_escape_string($connect, $_POST['village']);
$district = mysqli_real_escape_string($connect, $_POST['district']);
$city = mysqli_real_escape_string($connect, $_POST['city']);
$zipCode = $_POST['zipCode'];
$province = mysqli_real_escape_string($connect, $_POST['province']);
$phone = mysqli_real_escape_string($connect, $_POST['phone']);
$position = mysqli_real_escape_string($connect, $_POST['position']);
$part = mysqli_real_escape_string($connect, $_POST['part']);
$statusStaff = $_POST['statusStaff'];
$level = $_POST['level'];
$photo = $_POST['photo'];
//$authorize = $_POST['authorize'];
//$authorizeTotal = COUNT($authorize);
$email = mysqli_real_escape_string($connect, $_POST['email']);
$password = md5($_POST['password']);


for ($i = 0; $i < $authorizeTotal; $i++)
{
	if ($i == 0)
	{
		$auto .= "-".$authorize[$i]."-";
	}
	else
	{
		$auto .= $authorize[$i]."-";
	}
}

if ($staffCode != '' && $staffName != '' && $statusStaff != '' && $level != '' && $email != '' && $password != ''){
	
	// set photo to thumbnail
	if ($photo != '')
	{
		$file = "img/staffs/".$photo;
		$realPic = imagecreatefromjpeg($file);
		$width = imagesx($realPic);
		$height = imagesy($realPic);
		
		$thumbWidth = 70;
		$thumbHeight = 100;
		
		$thumbPic = imagecreatetruecolor($thumbWidth, $thumbHeight);
		imagecopyresampled($thumbPic, $realPic, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
		
		imagejpeg($thumbPic, "img/staffs/thumb/small_".$photo);
		
		imagedestroy($realPic);
		imagedestroy($thumbPic);
	} // close bracket
		
	$queryStaff = "INSERT INTO as_staffs(	staffCode,
											staffName,
											address,
											address2,
											village,
											district,
											city,
											zipCode,
											province,
											phone,
											position,
											part,
											status,
											level,
											photo,
											email,
											password,
											lastLogin,
											createdDate,
											createdUserID,
											modifiedDate,
											modifiedUserID)
									VALUES(	'$staffCode',
											'$staffName',
											'$address',
											'$address2',
											'$village',
											'$district',
											'$city',
											'$zipCode',
											'$province',
											'$phone',
											'$position',
											'$part',
											'$statusStaff',
											'$level',
											'$photo',
											'$email',
											'$password',
											'',
											'$createdDate',
											'$staffID',
											'',
											'')";
											
	$sqlStaff = mysqli_query($connect, $queryStaff);
	
	if ($sqlStaff)
	{
		echo json_encode('OK');
	}
	
}
exit();
?>