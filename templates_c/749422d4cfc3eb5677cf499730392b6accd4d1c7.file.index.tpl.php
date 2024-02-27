<?php /* Smarty version Smarty-3.1.11, created on 2022-11-15 13:53:55
         compiled from ".\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6455576dc8d69a5446-79152008%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '749422d4cfc3eb5677cf499730392b6accd4d1c7' => 
    array (
      0 => '.\\templates\\index.tpl',
      1 => 1668495221,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6455576dc8d69a5446-79152008',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576dc8d69f9c88_19596174',
  'variables' => 
  array (
    'msg' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576dc8d69f9c88_19596174')) {function content_576dc8d69f9c88_19596174($_smarty_tpl) {?><!doctype html>
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
	
	<div class="alert-danger-login"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</div>
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
</html><?php }} ?>