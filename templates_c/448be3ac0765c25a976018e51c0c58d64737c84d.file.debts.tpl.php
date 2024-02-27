<?php /* Smarty version Smarty-3.1.11, created on 2016-09-07 01:41:37
         compiled from ".\templates\debts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:246545788c8356b7b57-03173561%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '448be3ac0765c25a976018e51c0c58d64737c84d' => 
    array (
      0 => '.\\templates\\debts.tpl',
      1 => 1452560868,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '246545788c8356b7b57-03173561',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5788c835cf5330_35173579',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'soDate' => 0,
    'dataFactory' => 0,
    'factoryID' => 0,
    'debtID' => 0,
    'debtNo' => 0,
    'spbNo' => 0,
    'paymentNo' => 0,
    'paymentDate' => 0,
    'invoiceID' => 0,
    'invoiceNo' => 0,
    'supplierID' => 0,
    'supplierName' => 0,
    'supplierAddress' => 0,
    'debtTotalRp' => 0,
    'incomingTotalRp' => 0,
    'reductionTotalRp' => 0,
    'sisa' => 0,
    'dataPayment' => 0,
    'paymentID' => 0,
    'payType' => 0,
    'bankNo' => 0,
    'bankName' => 0,
    'effectiveDate' => 0,
    'bankAC' => 0,
    'total' => 0,
    'ref' => 0,
    'note' => 0,
    'soID' => 0,
    'factoryName' => 0,
    'productName' => 0,
    'productStock' => 0,
    'realStock' => 0,
    'msg' => 0,
    'endDate' => 0,
    'startDate' => 0,
    'dataSupplier' => 0,
    'dataDebt' => 0,
    'page' => 0,
    'dataStockOpname' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5788c835cf5330_35173579')) {function content_5788c835cf5330_35173579($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
			
			$( "#paymentDate" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy",
				yearRange: 'c-1:c-0'
			});
			
			$( "#effectiveDate" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy",
				yearRange: 'c-0:c+1'
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
			
			$("#debt").submit(function() { return false; });
			$("#debt2").submit(function() { return false; });
			
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
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='debt'&&$_smarty_tpl->tpl_vars['act']->value=='history'){?>
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Tambah Pembayaran Hutang</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_global_payment_debts.php?module=payment&act=print&debtID=<?php echo $_smarty_tpl->tpl_vars['debtID']->value;?>
&debtNo=<?php echo $_smarty_tpl->tpl_vars['debtNo']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="debts.php"><button class="btn btn-default pull-right">Back</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body" style="float: left; background-color: #FFF;">
								<form method="POST" action="debts.php?module=debt&act=input">
								<input type="hidden" name="debtID" id="debtID" value="<?php echo $_smarty_tpl->tpl_vars['debtID']->value;?>
">
								<input type="hidden" name="debtNo" id="debtNo" value="<?php echo $_smarty_tpl->tpl_vars['debtNo']->value;?>
">
								<input type="hidden" name="spbNo" id="spbNo" value="<?php echo $_smarty_tpl->tpl_vars['spbNo']->value;?>
">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td colspan="3"><h4>Form Pembayaran Hutang</h4></td>
									</tr>
									<tr>
										<td width="130">NOMOR / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="paymentNo" value="<?php echo $_smarty_tpl->tpl_vars['paymentNo']->value;?>
" name="paymentNo">
											<input type="text" id="paymentNo" name="paymentNo" value="<?php echo $_smarty_tpl->tpl_vars['paymentNo']->value;?>
" class="form-control" placeholder="Nomor Pembayaran" style="width: 165px; float: left; margin-right: 5px;" DISABLED><input type="text" id="paymentDate" name="paymentDate" value="<?php echo $_smarty_tpl->tpl_vars['paymentDate']->value;?>
" class="form-control" placeholder="Tanggal Pembayaran" style="width: 100px;" required></td>
									</tr>
									<tr>
										<td>NOMOR FAKTUR</td>
										<td>:</td>
										<td>
											<input type="hidden" id="invoiceID" name="invoiceID" value="<?php echo $_smarty_tpl->tpl_vars['invoiceID']->value;?>
"><input type="hidden" id="invoiceNo" name="invoiceNo" value="<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
" id="invoiceNo" name="invoiceNo" class="form-control" placeholder="Nomor Faktur Pembelian" style="width: 270px;" DISABLED>
										</td>
									</tr>
									<tr>
										<td>SUPPLIER</td>
										<td>:</td>
										<td><input type="hidden" id="supplierID" name="supplierID" value="<?php echo $_smarty_tpl->tpl_vars['supplierID']->value;?>
"><input type="hidden" id="supplierName" name="supplierName" value="<?php echo $_smarty_tpl->tpl_vars['supplierName']->value;?>
"><input type="hidden" id="supplierAddress" name="supplierAddress" value="<?php echo $_smarty_tpl->tpl_vars['supplierAddress']->value;?>
">
											<input type="text" id="productName" name="productName" class="form-control" placeholder="Nama Supplier" value="<?php echo $_smarty_tpl->tpl_vars['supplierName']->value;?>
" style="width: 270px;" DISABLED>
										</td>
									</tr>
									<tr>
										<td>TOTAL HUTANG</td>
										<td>:</td>
										<td><input type="text" id="debtTotal" name="debtTotal" class="form-control" placeholder="Total Hutang" value="<?php echo $_smarty_tpl->tpl_vars['debtTotalRp']->value;?>
" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>SUDAH DIBAYAR</td>
										<td>:</td>
										<td><input type="text" id="incomingTotal" name="incomingTotal" class="form-control" placeholder="Sudah Dibayar" value="<?php echo $_smarty_tpl->tpl_vars['incomingTotalRp']->value;?>
" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>PENGURANGAN</td>
										<td>:</td>
										<td><input type="text" id="reductionTotal" name="reductionTotal" class="form-control" placeholder="Pengurangan Hutang" value="<?php echo $_smarty_tpl->tpl_vars['reductionTotalRp']->value;?>
" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>SISA HUTANG</td>
										<td>:</td>
										<td><input type="text" id="sisa" name="sisa" class="form-control" placeholder="Sisa Hutang" value="<?php echo $_smarty_tpl->tpl_vars['sisa']->value;?>
" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>PEMBAYARAN</td>
										<td>:</td>
										<td>
											<select id="payType" name="payType" class="form-control" style="width: 120px; float: left; margin-right: 5px;">
												<option value=""></option>
												<option value="1">TUNAI</option>
												<option value="2">TRANSFER</option>
												<option value="3">CEK</option>
												<option value="4">GIRO</option>
											</select>
											<input type="text" id="bankNo" name="bankNo" class="form-control" placeholder="No Rek/Cek/Giro" style="width: 145px;">
										</td>
									</tr>
									<tr>
										<td>NAMA BANK</td>
										<td>:</td>
										<td><input type="text" id="bankName" name="bankName" class="form-control" placeholder="Nama Bank" style="width: 165px; float: left; margin-right: 5px;">
											<input type="text" id="effectiveDate" name="effectiveDate" class="form-control" placeholder="Tgl Efektif" style="width: 100px;">
										</td>
									</tr>
									<tr>
										<td>NAMA AKUN</td>
										<td>:</td>
										<td><input type="text" id="bankAC" name="bankAC" class="form-control" placeholder="Nama Pemegang Akun" style="width: 270px;"></td>
									</tr>
									<tr>
										<td>JUMLAH</td>
										<td>:</td>
										<td><input type="text" id="total" name="total" class="form-control" placeholder="Jumlah" style="width: 270px;"></td>
									</tr>
									<tr>
										<td>REFERENSI</td>
										<td>:</td>
										<td><input type="text" id="ref" name="ref" class="form-control" placeholder="Referensi" style="width: 270px;"></td>
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
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td colspan="3"><h4>Rincian Pembayaran Hutang</h4></td>
									</tr>
								</table>
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped" style="width: 620px;">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>NOMOR <i class="fa fa-sort"></i></th>
												<th>TANGGAL <i class="fa fa-sort"></i></th>
												<th>CARA BAYAR <i class="fa fa-sort"></i></th>
												<th>TOTAL <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['name'] = 'dataPayment';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataPayment']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['paymentNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['paymentDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['payType'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['total'];?>
</td>
													<td>
														<a title="Detail" href="detail_payment_debts.php?module=payment&act=detail&paymentID=<?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['paymentID'];?>
&paymentNo=<?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['paymentNo'];?>
" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="debts.php?module=debt&act=deletepayment&debtID=<?php echo $_smarty_tpl->tpl_vars['debtID']->value;?>
&debtNo=<?php echo $_smarty_tpl->tpl_vars['debtNo']->value;?>
&paymentID=<?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['paymentID'];?>
&paymentNo=<?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['paymentNo'];?>
" onclick="return confirm('Anda Yakin ingin menghapus nomor pembayaran #<?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['paymentNo'];?>
? penghapusan ini berarti membatalkan pembayaran.');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
							</div>
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='debt'&&$_smarty_tpl->tpl_vars['act']->value=='finish'){?>
							
							
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
								<h3 class="box-title">Tambah Pembayaran Hutang</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="debts.php"><button class="btn btn-default pull-right">Close</button></a>
										<a href="print_unit_payment_debts.php?module=payment&act=print&paymentID=<?php echo $_smarty_tpl->tpl_vars['paymentID']->value;?>
&paymentNo=<?php echo $_smarty_tpl->tpl_vars['paymentNo']->value;?>
&debtID=<?php echo $_smarty_tpl->tpl_vars['debtID']->value;?>
&debtNo=<?php echo $_smarty_tpl->tpl_vars['debtNo']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td colspan="3"><h4>Detail Pembayaran Hutang</h4></td>
									</tr>
									<tr>
										<td width="130">NOMOR / TGL</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['paymentNo']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['paymentDate']->value;?>
</td>
									</tr>
									<tr>
										<td>NOMOR FAKTUR</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
</td>
									</tr>
									<tr>
										<td>SUPPLIER</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['supplierName']->value;?>
</td>
									</tr>
									<tr>
										<td>TOTAL HUTANG</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['debtTotalRp']->value;?>
</td>
									</tr>
									<tr>
										<td>SUDAH DIBAYAR</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['incomingTotalRp']->value;?>
</td>
									</tr>
									<tr>
										<td>PENGURANGAN</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['reductionTotalRp']->value;?>
</td>
									</tr>
									<tr>
										<td>SISA HUTANG</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['sisa']->value;?>
</td>
									</tr>
									<tr>
										<td>PEMBAYARAN</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['payType']->value;?>
</td>
									</tr>
									<tr>
										<td>NOMOR AKUN</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['bankNo']->value;?>
</td>
									</tr>
									<tr>
										<td>NAMA BANK</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['bankName']->value;?>
</td>
									</tr>
									<tr>
										<td>TGL EFEKTIF</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['effectiveDate']->value;?>
</td>
									</tr>
									<tr>
										<td>NAMA AKUN</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['bankAC']->value;?>
</td>
									</tr>
									<tr>
										<td>JUMLAH</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['total']->value;?>
</td>
									</tr>
									<tr>
										<td>REFERENSI</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['ref']->value;?>
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
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='debt'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="debts.php">
											<input type="hidden" name="module" value="debt">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px; margin-right: 5px;">
											<input type="text" id="startDate" name="startDate" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px; margin-right: 5px;">
											<select id="supplierID" name="supplierID" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
												<option value=""></option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['name'] = 'dataSupplier';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataSupplier']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total']);
?>
													<?php if ($_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierID']==$_smarty_tpl->tpl_vars['supplierID']->value){?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierID'];?>
" SELECTED><?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierName'];?>
 [ Kode : <?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierCode'];?>
 ]</option>
													<?php }else{ ?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierName'];?>
 [ Kode : <?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierCode'];?>
 ]</option>
													<?php }?>
												<?php endfor; endif; ?>
											</select>
											<input type="text" id="invoiceNo" value="<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
" name="invoiceNo" class="form-control" placeholder="No Faktur Pembelian" style="float: right; width: 200px; margin-right: 5px;">
										
											<!--<a href="debts.php?module=debt&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>-->
											<a href="print_debts.php?act=print&supplierID=<?php echo $_smarty_tpl->tpl_vars['supplierID']->value;?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
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
												<th>NOMOR <i class="fa fa-sort"></i></th>
												<th>NO FAKTUR <i class="fa fa-sort"></i></th>
												<th>SUPPLIER <i class="fa fa-sort"></i></th>
												<th>TOTAL <i class="fa fa-sort"></i></th>
												<th>INCOMING <i class="fa fa-sort"></i></th>
												<th>REDUCTION <i class="fa fa-sort"></i></th>
												<th>SISA <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['name'] = 'dataDebt';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDebt']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['debtNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['invoiceNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['supplierName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['debtTotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['incomingTotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['reductionTotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['sisa'];?>
</td>
													<td>
														<a title="Detail" href="debts.php?module=debt&act=history&debtID=<?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['debtID'];?>
&debtNo=<?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['debtNo'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<!--<a title="Delete" href="stock_opname.php?module=stockopname&act=delete&soID=<?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['soID'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" onclick="return confirm('Anda Yakin ingin menghapus stock opname #<?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['soID'];?>
? penghapusan ini berarti membatalkan stock opname dan akan mengembalikan stok ke awal.');"><img src="img/icons/delete.png" width="18"></a>-->
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
										<form method="GET" action="debts.php">
											<input type="hidden" name="module" value="debt">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px; margin-right: 5px;">
											<input type="text" id="startDate" name="startDate" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px; margin-right: 5px;">
											<select id="supplierID" name="supplierID" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
												<option value=""></option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['name'] = 'dataSupplier';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataSupplier']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total']);
?>
													<option value="<?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierName'];?>
 [ Kode : <?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierCode'];?>
 ]</option>
												<?php endfor; endif; ?>
											</select>
											<input type="text" id="invoiceNo" name="invoiceNo" class="form-control" placeholder="No Faktur Pembelian" style="float: right; width: 200px; margin-right: 5px;">
										
											<!--<a href="debts.php?module=debt&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>-->
											<a href="print_debts.php?act=print&supplierID=<?php echo $_smarty_tpl->tpl_vars['supplierID']->value;?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
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
												<th>NOMOR <i class="fa fa-sort"></i></th>
												<th>NO FAKTUR <i class="fa fa-sort"></i></th>
												<th>SUPPLIER <i class="fa fa-sort"></i></th>
												<th>TOTAL <i class="fa fa-sort"></i></th>
												<th>INCOMING <i class="fa fa-sort"></i></th>
												<th>REDUCTION <i class="fa fa-sort"></i></th>
												<th>SISA <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['name'] = 'dataDebt';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDebt']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['debtNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['invoiceNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['supplierName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['debtTotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['incomingTotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['reductionTotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['sisa'];?>
</td>
													<td>
														<a title="Detail" href="debts.php?module=debt&act=history&debtID=<?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['debtID'];?>
&debtNo=<?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['debtNo'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<!--<a title="Delete" href="stock_opname.php?module=stockopname&act=delete&soID=<?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['soID'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" onclick="return confirm('Anda Yakin ingin menghapus stock opname #<?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['soID'];?>
? penghapusan ini berarti membatalkan stock opname dan akan mengembalikan stok ke awal.');"><img src="img/icons/delete.png" width="18"></a>-->
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