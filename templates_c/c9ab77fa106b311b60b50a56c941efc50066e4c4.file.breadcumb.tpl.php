<?php /* Smarty version Smarty-3.1.11, created on 2016-09-06 22:42:40
         compiled from ".\templates\breadcumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11744576dc8ea5adfd4-22739323%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c9ab77fa106b311b60b50a56c941efc50066e4c4' => 
    array (
      0 => '.\\templates\\breadcumb.tpl',
      1 => 1415245388,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11744576dc8ea5adfd4-22739323',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576dc8ea5bee08_43026027',
  'variables' => 
  array (
    'breadcumbTitle' => 0,
    'breadcumbTitleSmall' => 0,
    'breadcumbMenuName' => 0,
    'breadcumbMenuSubName' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576dc8ea5bee08_43026027')) {function content_576dc8ea5bee08_43026027($_smarty_tpl) {?><!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?php echo $_smarty_tpl->tpl_vars['breadcumbTitle']->value;?>

		<small><?php echo $_smarty_tpl->tpl_vars['breadcumbTitleSmall']->value;?>
</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $_smarty_tpl->tpl_vars['breadcumbMenuName']->value;?>
</a></li>
		<li class="active"><?php echo $_smarty_tpl->tpl_vars['breadcumbMenuSubName']->value;?>
</li>
	</ol>
</section><?php }} ?>