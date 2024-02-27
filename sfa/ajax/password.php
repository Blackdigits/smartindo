<?php  
include '../config.php';
$result = mysqli_query($connect, "UPDATE as_suppliers SET fax = '$_POST[password]' WHERE supplierID = $_COOKIE[supplierID]"); 
header('Content-Type: application/json');
echo json_encode('Ganti Password Sukses');