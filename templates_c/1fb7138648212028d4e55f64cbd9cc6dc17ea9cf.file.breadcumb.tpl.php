<?php /* Smarty version Smarty-3.1.11, created on 2023-09-05 23:18:31
         compiled from "./templates/breadcumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:411339078637ec8868fc2c6-72364660%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1fb7138648212028d4e55f64cbd9cc6dc17ea9cf' => 
    array (
      0 => './templates/breadcumb.tpl',
      1 => 1693930207,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '411339078637ec8868fc2c6-72364660',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_637ec8868fdbf2_02050610',
  'variables' => 
  array (
    'breadcumbTitle' => 0,
    'breadcumbTitleSmall' => 0,
    'breadcumbMenuName' => 0,
    'breadcumbMenuSubName' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_637ec8868fdbf2_02050610')) {function content_637ec8868fdbf2_02050610($_smarty_tpl) {?><!-- Content Header (Page header) -->
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