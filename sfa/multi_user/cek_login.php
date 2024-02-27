<?php    
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"SELECT * FROM as_suppliers WHERE (contactPerson='$username' OR email='$username') and fax='$password';");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

	$data = mysqli_fetch_assoc($login);
 
	setcookie('balance', $data['balance'], strtotime('+7 days'), '/'); 
	setcookie('supplierID', $data['supplierID'], strtotime('+7 days'), '/'); 
	setcookie('supplierName', $data['supplierName'], strtotime('+7 days'), '/'); 
	setcookie('supplierCode', $data['supplierCode'], strtotime('+7 days'), '/'); 
    
	header("location:../");
	
}else{
	header("location:index.php?pesan=gagal");
}



?>