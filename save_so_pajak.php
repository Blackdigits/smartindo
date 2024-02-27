<?php
// include header
include "header.php";

$createdDate = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];
$soFaktur = $_SESSION['soFaktur'];
$pajak = $_POST['pajak'];

if ($pajak != '' && $soFaktur != ''){

        $querySo = "UPDATE as_sales_order SET pajak = '$pajak' WHERE soFaktur = '$soFaktur'";
        $sqlSo = mysqli_query($connect, $querySo);
		

        if ($sqlSo)
        {
            $_SESSION['pajak'] = $pajak;
            echo json_encode('OK'); 
        }
}
exit();
?>