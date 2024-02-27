<!doctype html>
<head>

	<!-- General Metas -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	<!-- Force Latest IE rendering engine -->
	<title>Login Admin SMARTINDO</title>
	<meta name="description" content="This is sales application system ">
	<meta name="author" content="PT. Cloud Rise Technology - cloudrise.tech">
	
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="design/css/base.css">
	<link rel="stylesheet" href="design/css/skeleton.css">
	<link rel="stylesheet" href="design/css/layout.css">
	
</head>
<body>

	<!-- Primary Page Layout -->
	
	<div class="alert-danger-login">{$msg}</div>
	<div class="container">
		
		<div class="form-bg">
			<form method="POST" action="index.php?module=login&act=submit">
				<h2>LOGIN ADMIN SMARTINDO</h2>
				<p><input type="text" name="username" required></p>
				<p><input type="password" name="password" required></p>
				<button type="submit"></button>
			<form>
		</div>

	
		<p class="forgot">
			2022 Copyright &copy; CloudRise Technology, Ltd <br>
			Contact Person (Webmaster) : +628116886638
		</p>


	</div><!-- container -->
	
<!-- End Document -->
</body>
</html>