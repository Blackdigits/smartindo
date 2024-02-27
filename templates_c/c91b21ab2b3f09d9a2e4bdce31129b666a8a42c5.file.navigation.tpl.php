<?php /* Smarty version Smarty-3.1.11, created on 2016-09-06 22:42:40
         compiled from ".\templates\navigation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32669576dc8ea1d8402-22861831%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c91b21ab2b3f09d9a2e4bdce31129b666a8a42c5' => 
    array (
      0 => '.\\templates\\navigation.tpl',
      1 => 1451415538,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32669576dc8ea1d8402-22861831',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576dc8ea1f8933_17205357',
  'variables' => 
  array (
    'loginStaffName' => 0,
    'loginPhoto' => 0,
    'loginStaffPosition' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576dc8ea1f8933_17205357')) {function content_576dc8ea1f8933_17205357($_smarty_tpl) {?><!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
	<!-- Sidebar toggle button-->
	<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</a>
	
	<div class="navbar-right">
		<ul class="nav navbar-nav">
		<!-- User Account: style can be found in dropdown.less -->
		<li class="dropdown user user-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class="glyphicon glyphicon-user"></i>
				<span><?php echo $_smarty_tpl->tpl_vars['loginStaffName']->value;?>
 <i class="caret"></i></span>
			</a>
			<ul class="dropdown-menu">
				<!-- User image -->
				<li class="user-header bg-light-blue">
					<?php if ($_smarty_tpl->tpl_vars['loginPhoto']->value!=''){?>
						<img src="img/staffs/thumb/small_<?php echo $_smarty_tpl->tpl_vars['loginPhoto']->value;?>
" class="img-circle" alt="<?php echo $_smarty_tpl->tpl_vars['loginStaffName']->value;?>
" />
					<?php }?>
					<p>
						<?php echo $_smarty_tpl->tpl_vars['loginStaffName']->value;?>
<br>
						<?php echo $_smarty_tpl->tpl_vars['loginStaffPosition']->value;?>

						
					</p>
				</li>
				<!-- Menu Footer-->
				<li class="user-footer">
					<div class="pull-left">
						<a href="#" class="btn btn-default btn-flat">Ubah Password</a>
					</div>
					<div class="pull-right">
						<a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
					</div>
				</li>
			</ul>
		</li>
	</ul>
</div>
</nav><?php }} ?>