<?php /* Smarty version Smarty-3.1.11, created on 2023-09-14 15:18:55
         compiled from "./templates/receivables.tpl" */ ?>
<?php /*%%SmartyHeaderCode:832504826638e246460d319-83131315%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a59b92218edfd7bf16dea4c71dcf1f6e1e446c68' => 
    array (
      0 => './templates/receivables.tpl',
      1 => 1694679528,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '832504826638e246460d319-83131315',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_638e246467c6f0_20530512',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'soDate' => 0,
    'dataFactory' => 0,
    'factoryID' => 0,
    'receiveID' => 0,
    'receiveNo' => 0,
    'salesId' => 0,
    'salesName' => 0,
    'soNo' => 0,
    'paymentNo' => 0,
    'paymentDate' => 0,
    'invoiceID' => 0,
    'invoiceNo' => 0,
    'customerID' => 0,
    'customerName' => 0,
    'customerAddress' => 0,
    'receiveTotalRp' => 0,
    'incomingTotalRp' => 0,
    'reductionTotalRp' => 0,
    'pajak' => 0,
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
    'endDate' => 0,
    'startDate' => 0,
    'dataCustomer' => 0,
    'dataReceive' => 0,
    'page' => 0,
    'dataStockOpname' => 0,
    'msg' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_638e246467c6f0_20530512')) {function content_638e246467c6f0_20530512($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
			
			$("#receive").submit(function() { return false; });
			$("#receive2").submit(function() { return false; });
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
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='receivable'&&$_smarty_tpl->tpl_vars['act']->value=='add'){?>
							
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
								<h3 class="box-title">Tambah Piutang</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="receivables.php?module=receivable&act=cancel" onclick="return confirm('Anda Yakin ingin membatalkan piutang ini?');"><button class="btn btn-default pull-right">Batal</button></a>
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
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='receivable'&&$_smarty_tpl->tpl_vars['act']->value=='history'){?>
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Tambah Pembayaran Piutang</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_global_payment_receivables.php?module=payment&act=print&receiveID=<?php echo $_smarty_tpl->tpl_vars['receiveID']->value;?>
&receiveNo=<?php echo $_smarty_tpl->tpl_vars['receiveNo']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="receivables.php"><button class="btn btn-default pull-right">Back</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body" style="float: left; background-color: #FFF;">
								<form method="POST" action="receivables.php?module=receivable&act=input">
								<input type="hidden" name="receiveID" id="receiveID" value="<?php echo $_smarty_tpl->tpl_vars['receiveID']->value;?>
">
								<input type="hidden" name="receiveNo" id="receiveNo" value="<?php echo $_smarty_tpl->tpl_vars['receiveNo']->value;?>
">
                                <input type="hidden" name="sfaid" id="receiveID" value="<?php echo $_smarty_tpl->tpl_vars['salesId']->value;?>
">
								<input type="hidden" name="sfaname" id="receiveNo" value="<?php echo $_smarty_tpl->tpl_vars['salesName']->value;?>
">
								<input type="hidden" name="soNo" id="soNo" value="<?php echo $_smarty_tpl->tpl_vars['soNo']->value;?>
">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td colspan="3"><h4>Form Pembayaran Piutang</h4></td>
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
" id="invoiceNo" name="invoiceNo" class="form-control" placeholder="Nomor Faktur Penjualan" style="width: 270px;" DISABLED>
										</td>
									</tr>
									<tr>
										<td>CUSTOMER</td>
										<td>:</td>
										<td><input type="hidden" id="customerID" name="customerID" value="<?php echo $_smarty_tpl->tpl_vars['customerID']->value;?>
"><input type="hidden" id="customerName" name="customerName" value="<?php echo $_smarty_tpl->tpl_vars['customerName']->value;?>
"><input type="hidden" id="customerAddress" name="customerAddress" value="<?php echo $_smarty_tpl->tpl_vars['customerAddress']->value;?>
">
											<input type="text" id="productName" name="productName" class="form-control" placeholder="Nama Customer" value="<?php echo $_smarty_tpl->tpl_vars['customerName']->value;?>
" style="width: 270px;" DISABLED>
										</td>
									</tr>
                                    <tr>
										<td>SALES</td>
										<td>:</td>
										<td>
                                            <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['salesId']->value;?>
" name="salesId" id="salesId"  class="form-control" style="width: 270px;" DISABLED>
                                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['salesName']->value;?>
" name="salesName" id="salesName" class="form-control" placeholder="Nama Sales" style="width: 270px;" DISABLED>
										</td>
									</tr>
									<tr>
										<td>TOTAL PIUTANG</td>
										<td>:</td>
										<td><input type="text" id="receiveTotal" name="receiveTotal" class="form-control" placeholder="Total Piutang" value="<?php echo $_smarty_tpl->tpl_vars['receiveTotalRp']->value;?>
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
										<td><input type="text" id="reductionTotal" name="reductionTotal" class="form-control" placeholder="Pengurangan Piutang" value="<?php echo $_smarty_tpl->tpl_vars['reductionTotalRp']->value;?>
" style="width: 270px;" DISABLED></td>
									</tr>
                                    <tr>
										<td>PAJAK</td>
										<td>:</td>
										<td><input type="text" id="pajak" name="pajak" class="form-control" placeholder="Penambahan Pajak" value="<?php echo $_smarty_tpl->tpl_vars['pajak']->value;?>
" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>SISA PIUTANG</td>
										<td>:</td>
										<td><input type="text" id="sisa" name="sisa" class="form-control" placeholder="Sisa Piutang" value="<?php echo $_smarty_tpl->tpl_vars['sisa']->value;?>
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
										<td colspan="3"><h4>Rincian Pembayaran Piutang</h4></td>
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
														<a title="Detail" href="detail_payment_receivables.php?module=payment&act=detail&paymentID=<?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['paymentID'];?>
&paymentNo=<?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['paymentNo'];?>
" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="receivables.php?module=receive&act=deletepayment&receiveID=<?php echo $_smarty_tpl->tpl_vars['receiveID']->value;?>
&receiveNo=<?php echo $_smarty_tpl->tpl_vars['receiveNo']->value;?>
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
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='receivable'&&$_smarty_tpl->tpl_vars['act']->value=='finish'){?>
							
							
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
								<h3 class="box-title">Tambah Pembayaran Piutang</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="receivables.php"><button class="btn btn-default pull-right">Close</button></a>
										<a href="print_unit_payment_receivables.php?module=payment&act=print&paymentID=<?php echo $_smarty_tpl->tpl_vars['paymentID']->value;?>
&paymentNo=<?php echo $_smarty_tpl->tpl_vars['paymentNo']->value;?>
&receiveID=<?php echo $_smarty_tpl->tpl_vars['receiveID']->value;?>
&receiveNo=<?php echo $_smarty_tpl->tpl_vars['receiveNo']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td colspan="3"><h4>Detail Pembayaran Piutang</h4></td>
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
										<td>CUSTOMER</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['customerName']->value;?>
</td>
									</tr>
									<tr>
										<td>TOTAL PIUTANG</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['receiveTotalRp']->value;?>
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
										<td>SISA PIUTANG</td>
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
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='receivable'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="receivables.php">
											<input type="hidden" name="module" value="receivable">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px; margin-right: 5px;">
											<input type="text" id="startDate" name="startDate" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px; margin-right: 5px;">
											<select id="customerID" name="customerID" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
												<option value=""></option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['name'] = 'dataCustomer';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataCustomer']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total']);
?>
													<?php if ($_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerID']==$_smarty_tpl->tpl_vars['customerID']->value){?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerID'];?>
" SELECTED><?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerName'];?>
 [ Kode : <?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerCode'];?>
 ]</option>
													<?php }else{ ?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerName'];?>
 [ Kode : <?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerCode'];?>
 ]</option>
													<?php }?>
												<?php endfor; endif; ?>
											</select>
											<input type="text" id="invoiceNo" value="<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
" name="invoiceNo" class="form-control" placeholder="No Faktur Penjualan" style="float: right; width: 200px; margin-right: 5px;">
										
											<!--<a href="debts.php?module=debt&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>-->
											<a href="print_receivables.php?act=print&customerID=<?php echo $_smarty_tpl->tpl_vars['customerID']->value;?>
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
												<th>CUSTOMER <i class="fa fa-sort"></i></th>
												<th>TOTAL <i class="fa fa-sort"></i></th>
												<th>INCOMING <i class="fa fa-sort"></i></th>
												<th>REDUCTION <i class="fa fa-sort"></i></th>
												<th>SISA <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['name'] = 'dataReceive';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataReceive']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['receiveNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['invoiceNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['customerName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['debtTotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['incomingTotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['reductionTotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['sisa'];?>
</td>
													<td>
														<a title="Detail" href="receivables.php?module=receivable&act=history&receiveID=<?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['receiveID'];?>
&receiveNo=<?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['receiveNo'];?>
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
										<form method="GET" action="receivables.php">
											<input type="hidden" name="module" value="receivable">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px; margin-right: 5px;">
											<input type="text" id="startDate" name="startDate" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px; margin-right: 5px;">
											<select id="customerID" name="customerID" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
												<option value=""></option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['name'] = 'dataCustomer';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataCustomer']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total']);
?>
													<option value="<?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerName'];?>
 [ Kode : <?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerCode'];?>
 ]</option>
												<?php endfor; endif; ?>
											</select>
											<input type="text" id="invoiceNo" name="invoiceNo" class="form-control" placeholder="No Faktur Pembelian" style="float: right; width: 200px; margin-right: 5px;">
										
											<!--<a href="debts.php?module=debt&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>-->
											<a href="print_receivables.php?act=print&customerID=<?php echo $_smarty_tpl->tpl_vars['customerID']->value;?>
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
												<th>CUSTOMER <i class="fa fa-sort"></i></th>
												<th>TOTAL <i class="fa fa-sort"></i></th>
												<th>INCOMING <i class="fa fa-sort"></i></th>
												<th>REDUCTION <i class="fa fa-sort"></i></th>
												<th>SISA <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['name'] = 'dataReceive';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataReceive']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceive']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['receiveNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['invoiceNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['customerName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['receiveTotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['incomingTotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['reductionTotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['sisa'];?>
</td>
													<td>
														<a title="Detail" href="receivables.php?module=receivable&act=history&receiveID=<?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['receiveID'];?>
&receiveNo=<?php echo $_smarty_tpl->tpl_vars['dataReceive']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceive']['index']]['receiveNo'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<!--<a title="Delete" href="stock_opname.php?module=stockopname&act=delete&soID=<?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['soID'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" onclick="return confirm('Anda Yakin ingin menghapus piutang #<?php echo $_smarty_tpl->tpl_vars['dataStockOpname']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStockOpname']['index']]['soID'];?>
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