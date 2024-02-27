<?php /* Smarty version Smarty-3.1.11, created on 2016-07-18 06:25:07
         compiled from ".\templates\detail_payment_debts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26477578c13d3c4c1a2-56933853%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '37230e8971b0b981e16676a88df1cc6140a9aec2' => 
    array (
      0 => '.\\templates\\detail_payment_debts.tpl',
      1 => 1419372562,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26477578c13d3c4c1a2-56933853',
  'function' => 
  array (
  ),
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
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_578c13d3d54450_59276914',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_578c13d3d54450_59276914')) {function content_578c13d3d54450_59276914($_smarty_tpl) {?><script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
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