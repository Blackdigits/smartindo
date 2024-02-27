<?php /* Smarty version Smarty-3.1.11, created on 2016-09-07 01:42:29
         compiled from ".\templates\stock_opname.tpl" */ ?>
<?php /*%%SmartyHeaderCode:258485787bef0a22959-04651298%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b583ac2a1ad72e55ead093f6705676d9e5455fb8' => 
    array (
      0 => '.\\templates\\stock_opname.tpl',
      1 => 1419321978,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '258485787bef0a22959-04651298',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5787bef0f259e7_70081526',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'soDate' => 0,
    'dataFactory' => 0,
    'factoryID' => 0,
    'soID' => 0,
    'factoryName' => 0,
    'productName' => 0,
    'productStock' => 0,
    'realStock' => 0,
    'note' => 0,
    'msg' => 0,
    'endDate' => 0,
    'startDate' => 0,
    'q' => 0,
    'dataStockOpname' => 0,
    'page' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5787bef0f259e7_70081526')) {function content_5787bef0f259e7_70081526($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
			
			$( "#soDate" ).datepicker({
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
			
			$('#factoryID').change(function () {
				var factoryID = $("#factoryID").val();
				
				window.location.href = "stock_opname.php?module=stockopname&act=add&factoryID=" + factoryID;
			});
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#stockopname").submit(function() { return false; });
			$("#stockopname2").submit(function() { return false; });
			
			$("#productCode").autocomplete("product_auto.php", {
				width: 310
			}).result(function(event, item, a) {
				var myarr = item[0].split("#");
				
				document.getElementById('productCode').value = myarr[0];
				document.getElementById('productCode1').value = myarr[0];
				document.getElementById('productName').value = myarr[1];
				document.getElementById('productName1').value = myarr[1];
				document.getElementById('productID').value = myarr[2];
				document.getElementById('productStock').value = myarr[3];
				document.getElementById('productStock1').value = myarr[3];
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
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='stockopname'&&$_smarty_tpl->tpl_vars['act']->value=='add'){?>
							
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
								<h3 class="box-title">Tambah Stock Opname</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="stock_opname.php?module=stockopname&act=cancel" onclick="return confirm('Anda Yakin ingin membatalkan stock opname ini?');"><button class="btn btn-default pull-right">Batal</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="stock_opname.php?module=stockopname&act=input">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">TANGGAL</td>
										<td width="5">:</td>
										<td><input type="text" id="soDate" name="soDate" value="<?php echo $_smarty_tpl->tpl_vars['soDate']->value;?>
" class="form-control" placeholder="Tanggal Stock Opname" style="width: 270px;" required></td>
									</tr>
									<tr>
										<td>GUDANG</td>
										<td>:</td>
										<td><select name="factoryID" id="factoryID" class="form-control" style="width: 270px;" required>
												<option value=""></option>
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
													<?php if ($_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryID']==$_smarty_tpl->tpl_vars['factoryID']->value){?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryID'];?>
" SELECTED><?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryCode'];?>
 <?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryName'];?>
</option>
													<?php }else{ ?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryCode'];?>
 <?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryName'];?>
</option>
													<?php }?>
												<?php endfor; endif; ?>
											</select>
										</td>
									</tr>
									<tr>
										<td>KODE PRODUK</td>
										<td>:</td>
										<td><input type="hidden" id="productCode1" name="productCode1">
											<input type="text" id="productCode" name="productCode" class="form-control" placeholder="Kode Produk" style="width: 270px;" required>
										</td>
									</tr>
									<tr>
										<td>NAMA PRODUK</td>
										<td>:</td>
										<td>
											<input type="hidden" id="productName" name="productName">
											<input type="text" id="productName1" name="productName1" class="form-control" placeholder="Nama Produk" style="width: 270px;" DISABLED>
										</td>
									</tr>
									<tr>
										<td>STOK SAAT INI</td>
										<td>:</td>
										<td>
											<input type="hidden" id="productStock" name="productStock"><input type="hidden" id="productID" name="productID">
											<input type="text" id="productStock1" name="productStock1" class="form-control" placeholder="Stok Produk" style="width: 270px;" DISABLED>
										</td>
									</tr>
									<tr>
										<td>STOK NYATA</td>
										<td>:</td>
										<td><input type="number" id="realStock" name="realStock" class="form-control" placeholder="Stok Nyata" style="width: 270px;" required></td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><input type="text" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;"></td>
									</tr>
								</table>

								<br>
								<button type="submit" class="btn btn-primary">Simpan</button>
								</form>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='stockopname'&&$_smarty_tpl->tpl_vars['act']->value=='detailstockopname'){?>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Detail Stock Opname</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_stock_opname.php?module=stockopname&act=print&soID=<?php echo $_smarty_tpl->tpl_vars['soID']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="javascript:history.go(-1)"><button class="btn btn-default pull-right">Back</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">TANGGAL</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['soDate']->value;?>
</td>
									</tr>
									<tr>
										<td>GUDANG</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['factoryName']->value;?>
</td>
									</tr>
									<tr>
										<td>NAMA PRODUK</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['productName']->value;?>
</td>
									</tr>
									<tr>
										<td>STOK SAAT INI</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['productStock']->value;?>
</td>
									</tr>
									<tr>
										<td>STOK NYATA</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['realStock']->value;?>
</td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['note']->value;?>
</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='stockopname'&&$_smarty_tpl->tpl_vars['act']->value=='finish'){?>
							
							
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
								<h3 class="box-title">Detail Stock Opname</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_stock_opname.php?module=stockopname&act=print&soID=<?php echo $_smarty_tpl->tpl_vars['soID']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="stock_opname.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">TANGGAL</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['soDate']->value;?>
</td>
									</tr>
									<tr>
										<td>GUDANG</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['factoryName']->value;?>
</td>
									</tr>
									<tr>
										<td>NAMA PRODUK</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['productName']->value;?>
</td>
									</tr>
									<tr>
										<td>STOK SAAT INI</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['productStock']->value;?>
</td>
									</tr>
									<tr>
										<td>STOK NYATA</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['realStock']->value;?>
</td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['note']->value;?>
</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='stockopname'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="stock_opname.php">
											<input type="hidden" name="module" value="stockopname">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" id="startDate" name="startDate" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" class="form-control" placeholder="Pencarian : Kode or Nama Produk" style="float: right; width: 270px;">
										
											<a href="stock_opname.php?module=stockopname&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_stock_opname.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
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
												<th>TGL <i class="fa fa-sort"></i></th>
												<th>NAMA PRODUK <i class="fa fa-sort"></i></th>
												<th>GUDANG <i class="fa fa-sort"></i></th>
												<th>STOK AWAL <i class="fa fa-sort"></i></th>
												<th>STOK NYATA <i class="fa fa-sort"></i></th>
												<th>OPERATOR <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['name'] = 'dataStockOpname';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataStockOpname']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['soDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['productName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['factoryName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['productStock'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['realStock'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['staffName'];?>
</td>
													<td>
														<a title="Detail" href="stock_opname.php?module=stockopname&act=detailstockopname&soID=<?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['soID'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="stock_opname.php?module=stockopname&act=delete&soID=<?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['soID'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" onclick="return confirm('Anda Yakin ingin menghapus stock opname #<?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['soID'];?>
? penghapusan ini berarti membatalkan stock opname dan akan mengembalikan stok ke awal.');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
						
						<?php }else{ ?>
							<div class="label-success"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</div>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="stock_opname.php">
											<input type="hidden" name="module" value="stockopname">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" id="startDate" name="startDate" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" class="form-control" placeholder="Pencarian : Kode or Nama Produk" style="float: right; width: 270px;">
										
											<a href="stock_opname.php?module=stockopname&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_stock_opname.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
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
												<th>TGL <i class="fa fa-sort"></i></th>
												<th>NAMA PRODUK <i class="fa fa-sort"></i></th>
												<th>GUDANG <i class="fa fa-sort"></i></th>
												<th>STOK AWAL <i class="fa fa-sort"></i></th>
												<th>STOK NYATA <i class="fa fa-sort"></i></th>
												<th>OPERATOR <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['name'] = 'dataStockOpname';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataStockOpname']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStockOpname']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['soDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['productName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['factoryName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['productStock'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['realStock'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['staffName'];?>
</td>
													<td>
														<a title="Detail" href="stock_opname.php?module=stockopname&act=detailstockopname&soID=<?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['soID'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="stock_opname.php?module=stockopname&act=delete&soID=<?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['soID'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" onclick="return confirm('Anda Yakin ingin menghapus stock opname #<?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['soID'];?>
? penghapusan ini berarti membatalkan stock opname dan akan mengembalikan stok ke awal.');"><img src="img/icons/delete.png" width="18"></a>
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