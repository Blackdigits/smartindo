<?php /* Smarty version Smarty-3.1.11, created on 2023-10-04 09:51:31
         compiled from "./templates/side_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2124870462637ec8868c8782-99098962%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '157f88d4cf5a1dfce37b52fa250ca5d52e457381' => 
    array (
      0 => './templates/side_menu.tpl',
      1 => 1696387888,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2124870462637ec8868c8782-99098962',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_637ec8868f3ea3_57666803',
  'variables' => 
  array (
    'dataAuthorize' => 0,
    'loginStaffLevel' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_637ec8868f3ea3_57666803')) {function content_637ec8868f3ea3_57666803($_smarty_tpl) {?><!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
	<li class="active">
		<a href="home.php">
			<i class="fa fa-home"></i> <span>Dashboard</span>
		</a>
	</li>
	<li class="treeview">
		<a href="#">
			<i class="fa fa-th"></i>
			<span>Master Data</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['name'] = 'dataAuthorize';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAuthorize']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total']);
?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==1&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="staffs.php"><i class="fa fa-angle-double-right"></i> Admin</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==4&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="categories.php"><i class="fa fa-angle-double-right"></i> Kategori</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==5&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="products.php"><i class="fa fa-angle-double-right"></i> Produk</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==12&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="factories.php"><i class="fa fa-angle-double-right"></i> Gudang</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==6&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="suppliers.php"><i class="fa fa-angle-double-right"></i> SFA</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==2&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="customers.php"><i class="fa fa-angle-double-right"></i> Toko</a></li>
				<?php }?> 
			<?php endfor; endif; ?>
		</ul>
	</li> 
	<li class="treeview">
		<a href="#">
			<i class="fa fa-laptop"></i>
			<span>Transaksi</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['name'] = 'dataAuthorize';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAuthorize']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total']);
?> 
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==7&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="transfers.php"><i class="fa fa-angle-double-right"></i> <span>Transfer Stok</span></a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==14&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="spb.php"><i class="fa fa-angle-double-right"></i> Stok Sales</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==28&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="so.php"><i class="fa fa-angle-double-right"></i> Penjualan</a></li>
				<?php }?> 
			<?php endfor; endif; ?>
		</ul>
	</li>
	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['name'] = 'dataAuthorize';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAuthorize']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total']);
?>
		<li class="treeview">
			<a href="#">
				<i class="fa fa-folder"></i> <span>TOP Toko & SFA</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['name'] = 'dataAuthorize';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAuthorize']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total']);
?>
					<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==23&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
						<li><a href="debts.php"><i class="fa fa-angle-double-right"></i> TOP SFA</a></li>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==24&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
						<li><a href="receivables.php"><i class="fa fa-angle-double-right"></i> TOP Toko</a></li>
					<?php }?>
				<?php endfor; endif; ?>
			</ul>
		</li>
	<?php endfor; endif; ?>  
	<li class="treeview">
		<a href="#">
			<i class="fa fa-edit"></i> <span>Retur & Alokasi Barang</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['name'] = 'dataAuthorize';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAuthorize']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total']);
?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==11&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="retur_staffs.php"><i class="fa fa-angle-double-left"></i> Retur Toko</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==10&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="retur_suppliers.php"><i class="fa fa-angle-double-left"></i> Retur SFA</a></li>
				<?php }?> 
                <?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==13&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="bbm.php"><i class="fa fa-angle-double-left"></i> Alokasi Barang Masuk</a></li>
				<?php }?>
			<?php endfor; endif; ?>
		</ul>
	</li>
	<li class="treeview">
		<a href="#">
			<i class="fa fa-bar-chart-o"></i> <span>Laporan</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['name'] = 'dataAuthorize';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAuthorize']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total']);
?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==17&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="report_stock_products.php"><i class="fa fa-angle-double-right"></i> Laporan Stok Gudang</a></li>
				<?php }?>
                <?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==17&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="report_stock_sales.php"><i class="fa fa-angle-double-right"></i> Laporan Stok Sales</a></li>
				<?php }?> 
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==20&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="report_out.php"><i class="fa fa-angle-double-right"></i> Laporan Penjualan</a></li>
				<?php }?> 
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==22&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="report_receives.php"><i class="fa fa-angle-double-right"></i> Laporan TOP TOKO</a></li>
				<?php }?>
			<?php endfor; endif; ?>
		</ul>
	</li>  
	<li class="active">
		<a href="exceler/index.php?cron=false">
			<i class="fa fa-download"></i> <span>Laporan Harian</span>
		</a>
	</li>
</ul><?php }} ?>