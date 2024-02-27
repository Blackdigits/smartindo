<?php /* Smarty version Smarty-3.1.11, created on 2023-09-05 23:18:31
         compiled from "./templates/user_panel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:798025015637ec8868c4db3-38793519%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1593a5f160ce5ebd865534a4f17d7eb84d3c8cee' => 
    array (
      0 => './templates/user_panel.tpl',
      1 => 1693930207,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '798025015637ec8868c4db3-38793519',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_637ec8868c6c82_60142884',
  'variables' => 
  array (
    'loginPhoto' => 0,
    'loginStaffNickName' => 0,
    'loginStaffPosition' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_637ec8868c6c82_60142884')) {function content_637ec8868c6c82_60142884($_smarty_tpl) {?><!-- Sidebar user panel -->
<div class="user-panel">
	<div class="pull-left image">
		<?php if ($_smarty_tpl->tpl_vars['loginPhoto']->value!=''){?>
			<img src="img/staffs/thumb/small_<?php echo $_smarty_tpl->tpl_vars['loginPhoto']->value;?>
" class="img-circle" alt="User Image" />
		<?php }?>
	</div>
	<div class="pull-left info">
		<p>Hello, <?php echo $_smarty_tpl->tpl_vars['loginStaffNickName']->value;?>
</p>
		<?php echo $_smarty_tpl->tpl_vars['loginStaffPosition']->value;?>

	</div>
</div>
<?php }} ?>