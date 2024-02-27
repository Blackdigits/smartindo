<?php /* Smarty version Smarty-3.1.11, created on 2023-09-12 22:41:12
         compiled from "./templates/edit_stock.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1352065106639041413dc065-94081528%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '11c9a99a1e85b252e54893e208b0965b54a979e9' => 
    array (
      0 => './templates/edit_stock.tpl',
      1 => 1693930207,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1352065106639041413dc065-94081528',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_639041413e6297_03952592',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'productID' => 0,
    'productName' => 0,
    'categoryName' => 0,
    'unit' => 0,
    'unitPrice1' => 0,
    'unitPrice2' => 0,
    'unitPrice3' => 0,
    'hpp' => 0,
    'numsFactory' => 0,
    'dataFactory' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_639041413e6297_03952592')) {function content_639041413e6297_03952592($_smarty_tpl) {?><script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<body style='background-color: #FFF; color: #000;'>

	<script>
		$(document).ready(function() {
			
			$("#stock").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var productID = $("#productID").val();
				var numsFactory = $("#numsFactory").val();
				
				var i;
				var gudang = [];
				var stock = [];
				for (i = 1; i <= numsFactory; i++) {
					gudang[i] = $("#gudang"+i).val();
					stock[i] = $("#stock"+i).val();
				} 
				
				if (productID != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_stock.php',
						dataType: 'JSON',
						data:{
							productID: productID,
							numsFactory: numsFactory,
							gudang: gudang,
							stock: stock
						},
						beforeSend: function (data) {
							$('#send').hide();
						},
						success: function(data) {
							parent.jQuery.fancybox.close();
						}
					});
				}
			});
		});
	</script>	

				

<?php if ($_smarty_tpl->tpl_vars['module']->value=='product'&&$_smarty_tpl->tpl_vars['act']->value=='stock'){?>
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Stok Gudang</h3></td>
		</tr>
		<tr>
			<td>
				<form id="stock" name="stock" method="POST" action="#">
				<input type="hidden" id="productID" name="productID" value="<?php echo $_smarty_tpl->tpl_vars['productID']->value;?>
">
				<table>
					<tr valign="top">
						<td>
							<table cellpadding="3" cellspacing="3">
								<tr>
									<td width="130">Nama Produk</td>
									<td width="5">:</td>
									<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['productName']->value;?>
" id="#" name="#" class="form-control" style="width: 270px;" DISABLED></td>
								</tr>
								<tr>
									<td>Kategori</td>
									<td>:</td>
									<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['categoryName']->value;?>
" id="#" name="#" class="form-control" style="width: 270px;" DISABLED></td>
								</tr>
								<tr>
									<td>Satuan</td>
									<td>:</td>
									<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['unit']->value;?>
" id="#" name="#" class="form-control" style="width: 270px;" DISABLED></td>
								</tr>
								<tr>
									<td>Harga 1</td>
									<td>:</td>
									<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['unitPrice1']->value;?>
" id="#" name="#" class="form-control" style="width: 270px;" DISABLED></td>
								</tr>
								<tr>
									<td>Harga 2</td>
									<td>:</td>
									<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['unitPrice2']->value;?>
" id="#" name="#" class="form-control" style="width: 270px;" DISABLED></td>
								</tr>
								<tr>
									<td>Harga 3</td>
									<td>:</td>
									<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['unitPrice3']->value;?>
" id="#" name="#" class="form-control" style="width: 270px;" DISABLED></td>
								</tr>
								<tr>
									<td>HPP</td>
									<td>:</td>
									<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['hpp']->value;?>
" id="#" name="#" class="form-control" style="width: 270px;" DISABLED></td>
								</tr>
							</table>
						</td>
						<td>
							<table cellpadding="3" cellspacing="3">
								<input type="hidden" name="numsFactory" id="numsFactory" value="<?php echo $_smarty_tpl->tpl_vars['numsFactory']->value;?>
">
								<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['name'] = 'dataFactory';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataFactory']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['total']);
?>
								<tr>
									<td width="130"><?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryName'];?>
</td>
									<td width="5">:</td>
									<td>
										<input type="hidden" id="gudang<?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['no'];?>
" name="gudang<?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['no'];?>
" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryID'];?>
" style="width: 270px;">
										<input type="number" id="stock<?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['no'];?>
" name="stock<?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['no'];?>
" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['stock'];?>
" placeholder="Stok Gudang gudang <?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['no'];?>
" style="width: 270px;"></td>
								</tr>
								<?php endfor; endif; ?>
							</table>
						</td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

<?php }?>
</body><?php }} ?>