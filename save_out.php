<?php// include headerinclude "header.php";$createdDate = date('Y-m-d H:i:s');$staffID = $_SESSION['staffID'];$price = mysqli_real_escape_string($connect, $_POST['price']);$doNo = $_POST['doNo'];$detailID = $_POST['detailID'];$kurs = $_POST['kurs'];$valas = $_POST['valas'];$kursID = $_POST['kursID'];if ($price != '' && $doNo != '' && $detailID != ''){		$queryDo = "UPDATE as_detail_do SET price = '$price' WHERE doNo = '$doNo' AND doID = '$detailID'";												$sqlDo = mysqli_query($connect, $queryDo);		if ($sqlDo)	{		$queryDetail = "SELECT SUM(price * deliveredQty) as total, doFaktur FROM as_detail_do WHERE doNo = '$doNo'";		$sqlDetail = mysqli_query($connect, $queryDetail);		$dataDetail = mysqli_fetch_array($sqlDetail);				$queryUpdate = "UPDATE as_delivery_order SET total = '$dataDetail[total]' WHERE doNo = '$doNo' AND doFaktur = '$dataDetail[doFaktur]'";		$sqlUpdate = mysqli_query($connect, $queryUpdate);				if ($sqlUpdate)		{			echo json_encode(OK);		}	}	}exit();?>