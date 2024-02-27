<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SmartFren Ambassador</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css"> 

	</style>
</head>
<body> 
	<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
		}
	}
	?>
 
	<div class="kotak_login">
		<div style="text-align: center;"><img src="smartindo.png" width="50%"></div>
		<p class="tulisan_login">Login SmartFren Ambassador</p>
 
		<form action="cek_login.php" method="POST">
			<label>Username</label>
			<input type="text" name="username" class="form_login" placeholder="Username..." required="required">
 
			<label>Password</label>
			<input type="password" name="password" class="form_login" placeholder="Password..." required="required">
 
			<input type="submit" class="tombol_login" value="LOGIN">
 
			<br/>
			<br/>
			<center>
				<a class="link" href="reset.php">Lupa Password?</a>
			</center>
		</form>
		
	</div>
 
 
</body>
</html>