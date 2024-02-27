<?php 
$koneksi = mysqli_connect("localhost","u606309387_smartindo","Smartindo0!","u606309387_cluster0");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>