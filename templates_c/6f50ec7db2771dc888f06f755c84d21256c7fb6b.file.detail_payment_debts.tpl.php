<?php /* Smarty version Smarty-3.1.11, created on 2023-10-03 09:51:52
         compiled from "./templates/detail_payment_debts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:260068641641d126731d4e7-69003904%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f50ec7db2771dc888f06f755c84d21256c7fb6b' => 
    array (
      0 => './templates/detail_payment_debts.tpl',
      1 => 1693930207,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '260068641641d126731d4e7-69003904',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_641d126735bde2_77293537',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'paymentNo' => 0,
    'paymentDate' => 0,
    'payType' => 0,
    'bankName' => 0,
    'bankNo' => 0,
    'bankAC' => 0,
    'effectiveDate' => 0,
    'total' => 0,
    'ref' => 0,
    'note' => 0,
    'staffName' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_641d126735bde2_77293537')) {function content_641d126735bde2_77293537($_smarty_tpl) {?><script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>

<body>				

<?php if ($_smarty_tpl->tpl_vars['module']->value=='payment'&&$_smarty_tpl->tpl_vars['act']->value=='detail'){?>
	<table align="center">
		<tr>
			<td align="center"><h3><b>RINCIAN PEMBAYARAN</b></h3></td>
		</tr>
	</table>
	<table cellpadding="3" cellspacing="3">
		<tr>
			<td width="130" style="font-size: 14px;">NOMOR</td>
			<td width="5" style="font-size: 14px;">:</td>
			<td style="font-size: 14px;"><?php echo $_smarty_tpl->tpl_vars['paymentNo']->value;?>
</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">TANGGAL</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;"><?php echo $_smarty_tpl->tpl_vars['paymentDate']->value;?>
</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">CARA BAYAR</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;"><?php echo $_smarty_tpl->tpl_vars['payType']->value;?>
</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">BANK</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;"><?php echo $_smarty_tpl->tpl_vars['bankName']->value;?>
</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">NOMOR AKUN</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;"><?php echo $_smarty_tpl->tpl_vars['bankNo']->value;?>
</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">NAMA AKUN</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;"><?php echo $_smarty_tpl->tpl_vars['bankAC']->value;?>
</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">TANGGAL EFEKTIF</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;"><?php echo $_smarty_tpl->tpl_vars['effectiveDate']->value;?>
</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">TOTAL</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;"><?php echo $_smarty_tpl->tpl_vars['total']->value;?>
</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">REF</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;"><?php echo $_smarty_tpl->tpl_vars['ref']->value;?>
</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">NOTE</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;"><?php echo $_smarty_tpl->tpl_vars['note']->value;?>
</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">OPERATOR</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;"><?php echo $_smarty_tpl->tpl_vars['staffName']->value;?>
</td>
		</tr>
	</table>
<?php }?>
</body><?php }} ?>