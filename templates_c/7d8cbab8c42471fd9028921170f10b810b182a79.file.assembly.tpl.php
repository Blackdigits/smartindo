<?php /* Smarty version Smarty-3.1.11, created on 2023-10-14 20:39:44
         compiled from "./templates/assembly.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1325014721652a9a20201561-81909126%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d8cbab8c42471fd9028921170f10b810b182a79' => 
    array (
      0 => './templates/assembly.tpl',
      1 => 1693930207,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1325014721652a9a20201561-81909126',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'assemblyDate' => 0,
    'note' => 0,
    'dataDetilAssembly' => 0,
    'subtotal' => 0,
    'subtotalrp' => 0,
    'numsDetilAssembly' => 0,
    'assemblyFaktur' => 0,
    'assemblyID' => 0,
    'pageNumber' => 0,
    'assemblyCode' => 0,
    'productCode' => 0,
    'productName' => 0,
    'qty' => 0,
    'dataDetail' => 0,
    'cost' => 0,
    'grandtotal' => 0,
    'msg' => 0,
    'endDate' => 0,
    'startDate' => 0,
    'q' => 0,
    'dataAssembly' => 0,
    'page' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_652a9a202517b6_56097482',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_652a9a202517b6_56097482')) {function content_652a9a202517b6_56097482($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<style>
	div.ui-datepicker{
		font-size:14px;
	}
</style>

<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
<script type='text/javascript' src="design/js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="design/css/jquery.autocomplete.css" />


	<script>
		function toRp(amount, decimalSeparator, thousandsSeparator, nDecimalDigits){
			var num = parseFloat( amount ); //convert to float
			//default values
			decimalSeparator = decimalSeparator || ',';
			thousandsSeparator = thousandsSeparator || ',';
			nDecimalDigits = nDecimalDigits == null? 2 : nDecimalDigits;
			
			var fixed = num.toFixed(nDecimalDigits); //limit or add decimal digits
			//separate begin [$1], middle [$2] and decimal digits [$4]
			var parts = new RegExp('^(-?\\d{1,3})((?:\\d{3})+)(\\.(\\d{' + nDecimalDigits + '}))?$').exec(fixed);
			
			if(parts){ //num >= 1000 || num < = -1000
				return parts[1] + parts[2].replace(/\d{3}/g, thousandsSeparator + '$&') + (parts[4] ? decimalSeparator + parts[4] : '');
			}else{
				return fixed.replace('.', decimalSeparator);
			}
		}
		
		function sum() {
			var subtotal = eval($("#subtotal").val());
			var cost = eval($("#cost").val());
			var grand = eval(subtotal + cost);
			 
			document.getElementById('grandtotal').value = grand.toFixed(2);
			document.getElementById('grandtotalrp').value = toRp(grand);
		}
		
		$(document).ready(function() {
			
			$(".various2").fancybox({
				fitToView: false,
				scrolling: 'no',
				afterLoad: function(){
					this.width = $(this.element).data("width");
					this.height = $(this.element).data("height");
				},
				'afterClose':function () {
					window.location.reload();
				}
			});
			
			$( "#assemblyDate" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy",
				yearRange: 'c-1:c-0'
			});
			
			$( "#startDate" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy",
				yearRange: '2014:c-0'
			});
			
			$( "#endDate" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy",
				yearRange: '2014:c-0'
			});
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#assembly").submit(function() { return false; });
			$("#assembly2").submit(function() { return false; });
			
			$("#productBarcode").autocomplete("product_auto.php", {
				width: 310
			}).result(function(event, item, a) {
				var myarr = item[0].split("#");
				
				document.getElementById('productBarcode').value = myarr[0];
				document.getElementById('productBarcodeInline').value = myarr[0];
				document.getElementById('productName1').value = myarr[1];
				document.getElementById('productNameInline').value = myarr[1];
				document.getElementById('productIDInline').value = myarr[2];
				document.getElementById('unitPrice1').value = myarr[3];
				document.getElementById('unitPrice2').value = myarr[4];
				document.getElementById('unitPrice3').value = myarr[5];
			});
			
			$("#send2").on("click", function(){
				var productID = $("#productIDInline").val();
				var productCode = $("#productBarcodeInline").val();
				var productName1 = $("#productName1").val();
				var qty = parseInt($("#quantity").val());
				var price = parseInt($("#price").val());
				var desc = $("#desc").val();
				
				if (qty != '' && productID != '' && price != ''){
					
					$.ajax({
						type: 'POST',
						url: 'save_assembly.php',
						dataType: 'JSON',
						data:{
							qty: qty,
							price: price,
							productID: productID,
							productCode: productCode,
							productName1: productName1,
							desc: desc
						},
						beforeSend: function (data) {
							$('#send2').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "assembly.php?module=assembly&act=add&msg=Data berhasil disimpan";
						}
					});
				}
			});
		});
	</script>


<header class="header">
	
	<?php echo $_smarty_tpl->getSubTemplate ("logo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
	<?php echo $_smarty_tpl->getSubTemplate ("navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
</header>

<div class="wrapper row-offcanvas row-offcanvas-left">
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="left-side sidebar-offcanvas">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<?php echo $_smarty_tpl->getSubTemplate ("user_panel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        	
			<?php echo $_smarty_tpl->getSubTemplate ("side_menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		</section>
		<!-- /.sidebar -->
	</aside>
	
	<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		
		<?php echo $_smarty_tpl->getSubTemplate ("breadcumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
		<!-- Main content -->
		<section class="content">
		
			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<section class="col-lg-12 connectedSortable">
				
					<!-- TO DO List -->
					<div class="box box-primary">
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='assembly'&&$_smarty_tpl->tpl_vars['act']->value=='add'){?>
							
								<script>
									window.location.hash="no-back-button";
									window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
									window.onhashchange=function(){window.location.hash="no-back-button";}
									
									document.onkeydown = function (e) {
										if (e.keyCode === 116) {
											return false;
										}
									};
								</script>
							
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Tambah Assembly</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="assembly.php?module=assembly&act=cancel" onclick="return confirm('Anda Yakin ingin membatalkan Assembly ini?');"><button class="btn btn-default pull-right">Batal</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="assembly.php?module=assembly&act=input">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">KODE ASS / TGL</td>
										<td width="5">:</td>
										<td><input type="text" id="assemblyCode" name="assemblyCode" class="form-control" placeholder="Kode Assembly" style="width: 150px; float: left" required>
											<input type="text" id="assemblyDate" name="assemblyDate" value="<?php echo $_smarty_tpl->tpl_vars['assemblyDate']->value;?>
" class="form-control" placeholder="Tanggal Assembly" style="width: 120px;" required>
										</td>
									</tr>
									<tr>
										<td>KODE ITEM</td>
										<td>:</td>
										<td><input type="hidden" id="productID" name="productID"><input type="text" id="productCode" name="productCode" class="form-control" placeholder="Kode Produk" style="width: 270px;" required></td>
									</tr>
									<tr>
										<td>NAMA ITEM</td>
										<td>:</td>
										<td><input type="text" id="productName1" name="productName1" class="form-control" placeholder="Nama Produk" style="width: 270px;" required></td>
									</tr>
									<tr>
										<td>QTY</td>
										<td>:</td>
										<td><input type="text" id="qty" name="qty" class="form-control" placeholder="Qty" style="width: 270px;" required></td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['note']->value;?>
" id="note1" name="note1" class="form-control" placeholder="Note" style="width: 270px;"></td>
									</tr>
									<tr>
										<td colspan="3">
											<br>
											<a href="#inline" class="modalbox"><button class="btn btn-default pull-left"><i class="fa fa-plus"></i> Add</button></a>
										</td>
									</tr>
								</table>

								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA PRODUK</th>
												<th>HARGA SATUAN</th>
												<th>QTY</th>
												<th>SUBTOTAL</th>
												<th>GUDANG</th>
												<th>NOTE</th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['name'] = 'dataDetilAssembly';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDetilAssembly']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilAssembly']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['no'];?>
 <input type="hidden" name="detailID[]" value="<?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['detailID'];?>
"></td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['productName'];?>
 <input type="hidden" name="productID[]" value="<?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['productID'];?>
"> <input type="hidden" name="productName[]" value="<?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['productName'];?>
"></td>
													<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['price'];?>
 <input type="hidden" name="price[]" value="<?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['priceori'];?>
"></td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['qty'];?>
 <input type="hidden" name="kuantiti[]" value="<?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['qty'];?>
"></td>
													<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['subtotal'];?>
</td>
													<td>
														<select name="factory[]" id="factory" class="form-control" style="width: 180px;" required>
															<option value=""></option>
															<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['stok'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['stok']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['name'] = 'stok';
$_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['stok']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['stok']['total']);
?>
																<option value="<?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['stok'][$_smarty_tpl->getVariable('smarty')->value['section']['stok']['index']]['factoryID'];?>
#<?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['stok'][$_smarty_tpl->getVariable('smarty')->value['section']['stok']['index']]['factoryCode'];?>
 <?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['stok'][$_smarty_tpl->getVariable('smarty')->value['section']['stok']['index']]['factoryName'];?>
#<?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['stok'][$_smarty_tpl->getVariable('smarty')->value['section']['stok']['index']]['stock'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['stok'][$_smarty_tpl->getVariable('smarty')->value['section']['stok']['index']]['factoryCode'];?>
 <?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['stok'][$_smarty_tpl->getVariable('smarty')->value['section']['stok']['index']]['factoryName'];?>
 [ Stok : <?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['stok'][$_smarty_tpl->getVariable('smarty')->value['section']['stok']['index']]['stock'];?>
 ]</option>
															<?php endfor; endif; ?>
														</select>
													</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['note'];?>
 <input type="hidden" name="note[]" value="<?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['note'];?>
"></td>
													<td>
														<a title="Edit" href="edit_assembly.php?module=assembly&act=edit&detailID=<?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['detailID'];?>
" data-width="550" data-height="230" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="assembly.php?module=assembly&act=deletedetail&detailID=<?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['detailID'];?>
" onclick="return confirm('Anda Yakin ingin menghapus item produk <?php echo $_smarty_tpl->tpl_vars['dataDetilAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilAssembly']['index']]['productName'];?>
?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">SUBTOTAL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="subtotal" name="subtotal" value="<?php echo $_smarty_tpl->tpl_vars['subtotal']->value;?>
"><input type="text" id="subtotalrp" name="subtotalrp" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['subtotalrp']->value;?>
" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>ASSEMBLY COST</td>
										<td>:</td>
										<td><input type="text" id="cost" name="cost" class="form-control" style="width: 270px;" value="0" onkeyup="sum();"></td>
									</tr>
									<tr>
										<td>GRANDTOTAL</td>
										<td>:</td>
										<td><input type="hidden" id="grandtotal" name="grandtotal" value="<?php echo $_smarty_tpl->tpl_vars['subtotal']->value;?>
">
											<input type="text" id="grandtotalrp" name="grandtotalrp" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['subtotalrp']->value;?>
" style="width: 270px;" DISABLED></td>
									</tr>
								</table>
								<br>
								<?php if ($_smarty_tpl->tpl_vars['numsDetilAssembly']->value>0){?>
									<button type="submit" class="btn btn-primary">Simpan</button>
								<?php }else{ ?>
									<button type="button" class="btn btn-primary">Simpan</button>
								<?php }?>
								</form>
							
							</div><!-- /.box-body -->
							
							<div id="inline">	
								<table width="95%" align="center">
									<tr>
										<td colspan="3"><h3>Tambah Item</h3></td>
									</tr>
									<tr>
										<td>
											<form id="assembly" name="assembly" method="POST" action="#">
											<input type="hidden" id="assemblyFaktur" name="assemblyFaktur" value="<?php echo $_smarty_tpl->tpl_vars['assemblyFaktur']->value;?>
">
											<table cellpadding="3" cellspacing="3">
												<tr>
													<td width="140">Kode Produk</td>
													<td width="5">:</td>
													<td><input type="text" id="productBarcode" name="productBarcode" class="form-control" placeholder="Kode atau Nama Produk" style="width: 360px;" required></td>
												</tr>
												<tr>
													<td colspan="2"></td>
													<td><input type="hidden" id="productBarcodeInline" name="productBarcodeInline">
														<input type="hidden" id="productIDInline" name="productIDInline">
														<input type="hidden" id="productName1" name="productName1">
														<input type="text" id="productNameInline" name="productNameInline" class="form-control" placeholder="Nama Produk" style="width: 360px;" DISABLED>
													</td>
												</tr>
												<tr>
													<td>Harga Satuan</td>
													<td>:</td>
													<td><input id="unitPrice1" name="unitPrice1" class="form-control" placeholder="Harga 1" style="width: 120px; float: left;" DISABLED>
														<input id="unitPrice2" name="unitPrice2" class="form-control" placeholder="Harga 2" style="width: 120px; float: left;" DISABLED>
														<input id="unitPrice3" name="unitPrice3" class="form-control" placeholder="Harga 3" style="width: 120px;;" DISABLED>
													</td>
												</tr>
												<tr>
													<td>Masukan Harga</td>
													<td>:</td>
													<td><input type="text" id="price" name="price" class="form-control" placeholder="Harga Satuan" style="width: 360px;" required></td>
												</tr>
												<tr>
													<td>Qty</td>
													<td>:</td>
													<td><input type="number" id="quantity" name="quantity" class="form-control" placeholder="Qty Produk" style="width: 360px;" required></td>
												</tr>
												<tr>
													<td>Note</td>
													<td>:</td>
													<td><input type="text" id="desc" name="desc" class="form-control" placeholder="Note" style="width: 360px;"></td>
												</tr>
											</table>
											<button id="send2" class="btn btn-primary">Simpan</button>
											</form>
										</td>
									</tr>
								</table>
							</div>
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='assembly'&&$_smarty_tpl->tpl_vars['act']->value=='detailassembly'){?>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Detail Assembly</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_assembly.php?module=assembly&act=print&assemblyID=<?php echo $_smarty_tpl->tpl_vars['assemblyID']->value;?>
&assemblyFaktur=<?php echo $_smarty_tpl->tpl_vars['assemblyFaktur']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="assembly.php?page=<?php echo $_smarty_tpl->tpl_vars['pageNumber']->value;?>
"><button class="btn btn-default pull-right">Back</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">KODE ASS / TGL</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['assemblyCode']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['assemblyDate']->value;?>

										</td>
									</tr>
									<tr>
										<td>KODE ITEM</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['productCode']->value;?>
</td>
									</tr>
									<tr>
										<td>NAMA ITEM</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['productName']->value;?>
</td>
									</tr>
									<tr>
										<td>QTY</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['qty']->value;?>
</td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['note']->value;?>
</td>
									</tr>
								</table>
								<br>
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA PRODUK</th>
												<th>HARGA SATUAN</th>
												<th>QTY</th>
												<th>SUBTOTAL</th>
												<th>GUDANG</th>
												<th>NOTE</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['name'] = 'dataDetail';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDetail']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productName'];?>
</td>
													<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['price'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['qty'];?>
</td>
													<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['subtotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['factoryName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['note'];?>
</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">SUBTOTAL</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['subtotal']->value;?>
</td>
									</tr>
									<tr>
										<td>ASSEMBLY COST</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['cost']->value;?>
</td>
									</tr>
									<tr>
										<td>GRANDTOTAL</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['grandtotal']->value;?>
</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='assembly'&&$_smarty_tpl->tpl_vars['act']->value=='finish'){?>
							
							
								<script>
									window.location.hash="no-back-button";
									window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
									window.onhashchange=function(){window.location.hash="no-back-button";}
									
									document.onkeydown = function (e) {
										if (e.keyCode === 116) {
											return false;
										}
									};
								</script>
							
							
							<div class="label-success"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</div>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Detail Assembly</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_assembly.php?module=assembly&act=print&assemblyID=<?php echo $_smarty_tpl->tpl_vars['assemblyID']->value;?>
&assemblyFaktur=<?php echo $_smarty_tpl->tpl_vars['assemblyFaktur']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="assembly.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">KODE ASS / TGL</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['assemblyCode']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['assemblyDate']->value;?>

										</td>
									</tr>
									<tr>
										<td>KODE ITEM</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['productCode']->value;?>
</td>
									</tr>
									<tr>
										<td>NAMA ITEM</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['productName']->value;?>
</td>
									</tr>
									<tr>
										<td>QTY</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['qty']->value;?>
</td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['note']->value;?>
</td>
									</tr>
								</table>
								<br>
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA PRODUK</th>
												<th>HARGA SATUAN</th>
												<th>QTY</th>
												<th>SUBTOTAL</th>
												<th>GUDANG</th>
												<th>NOTE</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['name'] = 'dataDetail';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDetail']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productName'];?>
</td>
													<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['price'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['qty'];?>
</td>
													<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['subtotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['factoryName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['note'];?>
</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">SUBTOTAL</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['subtotal']->value;?>
</td>
									</tr>
									<tr>
										<td>ASSEMBLY COST</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['cost']->value;?>
</td>
									</tr>
									<tr>
										<td>GRANDTOTAL</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['grandtotal']->value;?>
</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='assembly'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="assembly.php">
											<input type="hidden" name="module" value="assembly">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" id="startDate" name="startDate" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" class="form-control" placeholder="Pencarian : Nomor Assembly" style="float: right; width: 270px;">
										
											<a href="assembly.php?module=assembly&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_assembly.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
											&nbsp;&nbsp;&nbsp;
										</form>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>KODE <i class="fa fa-sort"></i></th>
												<th>TGL <i class="fa fa-sort"></i></th>
												<th>NAMA PRODUK ASSEMBLY <i class="fa fa-sort"></i></th>
												<th>QTY <i class="fa fa-sort"></i></th>
												<th>GRANDTOTAL <i class="fa fa-sort"></i></th>
												<th>OPERATOR <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['name'] = 'dataAssembly';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAssembly']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['assemblyCode'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['assemblyDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['productName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['qty'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['grandtotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['staffName'];?>
</td>
													<td>
														<a title="Detail" href="assembly.php?module=assembly&act=detailassembly&assemblyID=<?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['assemblyID'];?>
&assemblyFaktur=<?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['assemblyFaktur'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="assembly.php?module=assembly&act=delete&assemblyID=<?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['assemblyID'];?>
&assemblyFaktur=<?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['assemblyFaktur'];?>
" onclick="return confirm('Anda Yakin ingin menghapus transaksi <?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['assemblyCode'];?>
? penghapusan ini berarti membatalkan assembly.');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
						
						<?php }else{ ?>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="assembly.php">
											<input type="hidden" name="module" value="assembly">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" id="startDate" name="startDate" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" class="form-control" placeholder="Pencarian : Nomor Assembly" style="float: right; width: 270px;">
										
											<a href="assembly.php?module=assembly&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_assembly.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
											&nbsp;&nbsp;&nbsp;
										</form>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>KODE <i class="fa fa-sort"></i></th>
												<th>TGL <i class="fa fa-sort"></i></th>
												<th>NAMA PRODUK ASSEMBLY <i class="fa fa-sort"></i></th>
												<th>QTY <i class="fa fa-sort"></i></th>
												<th>GRANDTOTAL <i class="fa fa-sort"></i></th>
												<th>OPERATOR <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['name'] = 'dataAssembly';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAssembly']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAssembly']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['assemblyCode'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['assemblyDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['productName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['qty'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['grandtotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['staffName'];?>
</td>
													<td>
														<a title="Detail" href="assembly.php?module=assembly&act=detailassembly&assemblyID=<?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['assemblyID'];?>
&assemblyFaktur=<?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['assemblyFaktur'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="assembly.php?module=assembly&act=delete&assemblyID=<?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['assemblyID'];?>
&assemblyFaktur=<?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['assemblyFaktur'];?>
" onclick="return confirm('Anda Yakin ingin menghapus transaksi <?php echo $_smarty_tpl->tpl_vars['dataAssembly']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAssembly']['index']]['assemblyCode'];?>
? penghapusan ini berarti membatalkan assembly.');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-left">
									<ul class="pagination pagination-sm inline">
										<?php echo $_smarty_tpl->tpl_vars['pageLink']->value;?>

										<!--<li><a href="#">&laquo;</a></li>
										<li><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">&raquo;</a></li>-->
									</ul>
								</div>
							</div><!-- /.box-header -->
						<?php }?>
						
					</div><!-- /.box -->
					
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>