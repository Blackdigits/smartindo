<?php /* Smarty version Smarty-3.1.11, created on 2023-10-03 15:59:30
         compiled from "./templates/edit_transfers.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1378559555638b038029ab23-09328436%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '25ae0dae7314380e129941e297f90d02602b3926' => 
    array (
      0 => './templates/edit_transfers.tpl',
      1 => 1693930207,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1378559555638b038029ab23-09328436',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_638b03802d0044_61360167',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'detailID' => 0,
    'productCode' => 0,
    'productName' => 0,
    'stock' => 0,
    'qty' => 0,
    'note' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_638b03802d0044_61360167')) {function content_638b03802d0044_61360167($_smarty_tpl) {?><script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<body style='background-color: #FFF; color: #000;'>

	<script>
		$(document).ready(function() {
			
			$("#transfer").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var detailID = $("#detailID").val();
				var qty = parseInt($("#qty").val());
				var stock = parseInt($("#stock1").val());
				var desc = $("#desc").val();
				
				if (detailID != '' && qty != '' && stock != ''){
				
					if (qty > stock) {
						alert("Qty tidak mencukupi jumlah stok.");
						return false;
					}
					else{
						$.ajax({
							type: 'POST',
							url: 'save_edit_transfer.php',
							dataType: 'JSON',
							data:{
								detailID: detailID,
								qty: qty,
								stock: stock,
								desc: desc
							},
							beforeSend: function (data) {
								$('#send').hide();
							},
							success: function(data) {
								parent.jQuery.fancybox.close();
							}
						});
					}
				}
			});
		});
	</script>	

				

<?php if ($_smarty_tpl->tpl_vars['module']->value=='transfer'&&$_smarty_tpl->tpl_vars['act']->value=='edit'){?>
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Item</h3></td>
		</tr>
		<tr>
			<td>
				<form id="transfer" name="transfer" method="POST" action="#">
				<input type="hidden" id="detailID" name="detailID" value="<?php echo $_smarty_tpl->tpl_vars['detailID']->value;?>
">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Kode Produk</td>
						<td width="5">:</td>
						<td><input type="text" id="productBarcode" value="<?php echo $_smarty_tpl->tpl_vars['productCode']->value;?>
" name="productBarcode" class="form-control" style="width: 270px;" DISABLED></td>
					</tr>
					<tr>
						<td colspan="2"></td>
						<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['productName']->value;?>
" id="productName" name="productName" class="form-control" placeholder="Nama Produk" style="width: 270px;" DISABLED></td>
					</tr>
					<tr>
						<td colspan="2"></td>
						<td><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['stock']->value;?>
" id="stock1" name="stock1" class="form-control">
							<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['stock']->value;?>
" id="stock" name="stock" class="form-control" placeholder="Jumlah Stok" style="width: 270px;" DISABLED>
						</td>
					</tr>
					<tr>
						<td>Qty</td>
						<td>:</td>
						<td><input type="number" value="<?php echo $_smarty_tpl->tpl_vars['qty']->value;?>
" id="qty" name="qty" class="form-control" placeholder="Qty Produk" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td>Note</td>
						<td>:</td>
						<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['note']->value;?>
" id="desc" name="desc" class="form-control" placeholder="Note" style="width: 270px;"></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

<?php }?>
</body><?php }} ?>