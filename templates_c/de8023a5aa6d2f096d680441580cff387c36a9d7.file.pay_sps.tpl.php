<?php /* Smarty version Smarty-3.1.11, created on 2016-08-27 03:31:41
         compiled from ".\templates\pay_sps.tpl" */ ?>
<?php /*%%SmartyHeaderCode:878057c0a72d80cf89-59140132%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de8023a5aa6d2f096d680441580cff387c36a9d7' => 
    array (
      0 => '.\\templates\\pay_sps.tpl',
      1 => 1472243404,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '878057c0a72d80cf89-59140132',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'numsTotal' => 0,
    'invoiceNo' => 0,
    'debto' => 0,
    'supplierID' => 0,
    'supplierName' => 0,
    'supplierAddress' => 0,
    'spbNo' => 0,
    'invoiceID' => 0,
    'payInNo' => 0,
    'payInDate' => 0,
    'debt' => 0,
    'paymentNo' => 0,
    'paymentID' => 0,
    'paymentDate' => 0,
    'payType' => 0,
    'bankNo' => 0,
    'bankName' => 0,
    'effectiveDate' => 0,
    'bankAC' => 0,
    'total' => 0,
    'ref' => 0,
    'note' => 0,
    'q' => 0,
    'page' => 0,
    'endDate' => 0,
    'startDate' => 0,
    'dataPay' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57c0a72d9718c7_08768294',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57c0a72d9718c7_08768294')) {function content_57c0a72d9718c7_08768294($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
			
			$( "#effectiveDate" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy",
				yearRange: 'c:c+1'
			});
			
			$('#invoiceNo').change(function () {
				var invoiceNo = $("#invoiceNo").val();
				
				window.location.href = "pay_in.php?module=payin&act=add&invoiceNo=" + invoiceNo;
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
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='paysps'&&$_smarty_tpl->tpl_vars['act']->value=='add'){?>
							
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
								<h3 class="box-title">Pembayaran Transaksi Pembelian Khusus</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="pay_in.php" onclick="return confirm('Anda Yakin ingin membatalkan pembayaran transaksi pembelian ini?');"><button type="button" class="btn btn-default pull-right">Batal Trx</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<?php if ($_smarty_tpl->tpl_vars['numsTotal']->value=='0'&&$_smarty_tpl->tpl_vars['invoiceNo']->value!=''){?>
									<span style="color: #f56954;">Nomor Faktur tidak ditemukan.</span>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['numsTotal']->value>0){?>
									<?php if ($_smarty_tpl->tpl_vars['debto']->value<='0'){?>
										<span style="color: green;">Nomor Faktur ini telah lunas dibayarkan.</span>
									<?php }?>
								<?php }?>
								<form method="POST" action="pay_in.php?module=payin&act=input">
								<input type="hidden" id="supplierID" name="supplierID" value="<?php echo $_smarty_tpl->tpl_vars['supplierID']->value;?>
">
								<input type="hidden" id="supplierName" name="supplierName" value="<?php echo $_smarty_tpl->tpl_vars['supplierName']->value;?>
">
								<input type="hidden" id="supplierAddress" name="supplierAddress" value="<?php echo $_smarty_tpl->tpl_vars['supplierAddress']->value;?>
">
								<input type="hidden" id="spbNo" name="spbNo" value="<?php echo $_smarty_tpl->tpl_vars['spbNo']->value;?>
">
								<input type="hidden" id="invoiceID" name="invoiceID" value="<?php echo $_smarty_tpl->tpl_vars['invoiceID']->value;?>
">
								<table cellpadding="3" cellspacing="3" width="100%">
									<tr>
										<td width="150">NO PAYMENT / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="paymentNo" name="paymentNo" value="<?php echo $_smarty_tpl->tpl_vars['payInNo']->value;?>
">
											<input type="text" id="paymentNo" name="paymentNo" value="<?php echo $_smarty_tpl->tpl_vars['payInNo']->value;?>
" class="form-control" placeholder="NOMOR PAYMENT" style="width: 110px; float: left" DISABLED>
											<input type="text" id="paymentDate" name="paymentDate" value="<?php echo $_smarty_tpl->tpl_vars['payInDate']->value;?>
" class="form-control" placeholder="Tanggal Payment" style="width: 190px;" required>
										</td>
									</tr>
									<tr valign="top">
										<td>NOMOR FAKTUR</td>
										<td>:</td>
										<td><input type="text" id="invoiceNo" name="invoiceNo" value="<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
" class="form-control" placeholder="Nomor Faktur" style="width: 300px;" required></td>
									</tr>
									<tr valign="top">
										<td>TERHUTANG</td>
										<td>:</td>
										<td><input type="text" id="debt" name="debt" value="<?php echo $_smarty_tpl->tpl_vars['debt']->value;?>
" class="form-control" placeholder="Total Terhutang" style="width: 300px;" DISABLED></td>
									</tr>
									<tr>
										<td>DIBAYARKAN KEPADA</td>
										<td>:</td>
										<td>
											<input type="text" id="supplierName" name="supplierName" value="<?php echo $_smarty_tpl->tpl_vars['supplierName']->value;?>
" class="form-control" placeholder="Nama Supplier" style="width: 300px;" DISABLED>
										</td>
									</tr>
									<tr>
										<td>PEMBAYARAN</td>
										<td>:</td>
										<td><select id="payType" name="payType" class="form-control" style="width: 125px; float: left;" required>
												<option value=""></option>
												<option value="1">Tunai</option>
												<option value="2">Transfer</option>
												<option value="3">Cek</option>
												<option value="4">Giro</option>
											</select>
											<input type="text" id="bankNo" name="bankNo" class="form-control" placeholder="Nomor Rek / Cek / Giro" style="width: 175px; float:left;">
										</td>
									</tr>
									<tr>
										<td>NAMA BANK</td>
										<td>:</td>
										<td>
											<input type="text" id="bankName" name="bankName" class="form-control" placeholder="Nama Bank" style="width: 175px; float: left;">
											<input type="text" id="effectiveDate" name="effectiveDate" class="form-control" placeholder="Tanggal Efektif" style="width: 125px;">
										</td>
									</tr>
									<tr>
										<td>NAMA AKUN</td>
										<td>:</td>
										<td>
											<input type="text" id="bankAC" name="bankAC" class="form-control" placeholder="Nama Akun (Pemegang)" style="width:300px; float:left;">
										</td>
									</tr>
									<tr>
										<td>JUMLAH</td>
										<td>:</td>
										<td>
											<input type="text" id="total" name="total" class="form-control" placeholder="Jumlah" style="width: 300px;" required>
										</td>
									</tr>
									<tr>
										<td>REFERENSI</td>
										<td>:</td>
										<td>
											<input type="text" id="ref" name="ref" class="form-control" placeholder="Referensi" style="width: 300px;">
										</td>
									</tr>
									<tr valign="top">
										<td>NOTE</td>
										<td>:</td>
										<td>
											<textarea id="note" name="note" class="form-control" placeholder="Note" style="width: 300px;"></textarea>
										</td>
									</tr>
								</table>
								<?php if ($_smarty_tpl->tpl_vars['numsTotal']->value>0){?>
									<?php if ($_smarty_tpl->tpl_vars['debto']->value>0){?>
										<button type="submit" class="btn btn-primary">Simpan</button>
									<?php }?>
								<?php }?>
								</form>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='payin'&&$_smarty_tpl->tpl_vars['act']->value=='finish'){?>
							
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
								<h3 class="box-title">Pembayaran Transaksi Pembelian Khusus</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_paysps.php?module=payin&act=print&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
&paymentNo=<?php echo $_smarty_tpl->tpl_vars['paymentNo']->value;?>
&paymentID=<?php echo $_smarty_tpl->tpl_vars['paymentID']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="pay_sps.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3" width="100%">
									<tr>
										<td width="150">NO PAYMENT / TGL</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['paymentNo']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['paymentDate']->value;?>
</td>
									</tr>
									<tr valign="top">
										<td>NOMOR FAKTUR</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
</td>
									</tr>
									<tr valign="top">
										<td>TERHUTANG</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['debt']->value;?>
</td>
									</tr>
									<tr>
										<td>DIBAYARKAN KEPADA</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['supplierName']->value;?>
</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td><?php echo $_smarty_tpl->tpl_vars['supplierAddress']->value;?>
</td>
									</tr>
									<tr>
										<td>PEMBAYARAN</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['payType']->value;?>
</td>
									</tr>
									<tr>
										<td>NO REK/CEK/GIRO</td>
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
									<tr valign="top">
										<td>NOTE</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['note']->value;?>
</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='paysps'&&$_smarty_tpl->tpl_vars['act']->value=='detailpaysps'){?>
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Pembayaran Transaksi Pembelian Khusus</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_paysps.php?module=paysps&act=print&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
&paymentNo=<?php echo $_smarty_tpl->tpl_vars['paymentNo']->value;?>
&paymentID=<?php echo $_smarty_tpl->tpl_vars['paymentID']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<?php if ($_smarty_tpl->tpl_vars['q']->value!=''){?>
											<a href="pay_sps.php?module=paysps&act=search&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
"><button class="btn btn-default pull-right">Back</button></a>
										<?php }else{ ?>
											<a href="pay_sps.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><button class="btn btn-default pull-right">Back</button></a>
										<?php }?>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3" width="100%">
									<tr>
										<td width="150">NO PAYMENT / TGL</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['paymentNo']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['paymentDate']->value;?>
</td>
									</tr>
									<tr valign="top">
										<td>NOMOR FAKTUR</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
</td>
									</tr>
									<tr valign="top">
										<td>TERHUTANG</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['debt']->value;?>
</td>
									</tr>
									<tr>
										<td>DIBAYARKAN KEPADA</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['supplierName']->value;?>
</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td><?php echo $_smarty_tpl->tpl_vars['supplierAddress']->value;?>
</td>
									</tr>
									<tr>
										<td>PEMBAYARAN</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['payType']->value;?>
</td>
									</tr>
									<tr>
										<td>NO REK/CEK/GIRO</td>
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
									<tr valign="top">
										<td>NOTE</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['note']->value;?>
</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='paysps'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="pay_sps.php">
											<input type="hidden" name="module" value="paysps">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" id="q" name="q" class="form-control" placeholder="Pencarian : Nomor Bukti Pembayaran" style="float: right; width: 270px;" required>
											<a href="pay_sps.php?module=paysps&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_pay_sps.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
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
												<th>NO PAYMENT <i class="fa fa-sort"></i></th>
												<th>TGL <i class="fa fa-sort"></i></th>
												<th>NO INVOICE <i class="fa fa-sort"></i></th>
												<th>NO PO <i class="fa fa-sort"></i></th>
												<th>VIA <i class="fa fa-sort"></i></th>
												<th>TOTAL <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['name'] = 'dataPay';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataPay']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['paymentNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['paymentDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['invoiceNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['spbNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['payType'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['total'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['staffName'];?>
</td>
													<td>
														<a title="Detail" href="pay_sps.php?module=paysps&act=detailpayin&paymentID=<?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['paymentID'];?>
&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['invoiceNo'];?>
&paymentNo=<?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['paymentNo'];?>
&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="pay_sps.php?module=paysps&act=delete&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['invoiceNo'];?>
&paymentNo=<?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['paymentNo'];?>
&paymentID=<?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['paymentID'];?>
&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" onclick="return confirm('Anda Yakin ingin membatalkan nomor pembayaran <?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['paymentNo'];?>
? penghapusan ini akan membatalkan pembayaran transaksi ini.');"><img src="img/icons/delete.png" width="18"></a>
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
									
										<form method="GET" action="pay_in.php">
											<input type="hidden" name="module" value="payin">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" id="q" name="q" class="form-control" placeholder="Pencarian : Nomor Bukti Pembayaran" style="float: right; width: 270px;">
											<a href="pay_sps.php?module=paysps&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_pay_sps.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
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
												<th>NO PAYMENT <i class="fa fa-sort"></i></th>
												<th>TGL <i class="fa fa-sort"></i></th>
												<th>NO INVOICE <i class="fa fa-sort"></i></th>
												<th>NO PO <i class="fa fa-sort"></i></th>
												<th>VIA <i class="fa fa-sort"></i></th>
												<th>TOTAL <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['name'] = 'dataPay';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataPay']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPay']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['paymentNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['paymentDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['invoiceNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['spbNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['payType'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['total'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['staffName'];?>
</td>
													<td>
														<a title="Detail" href="pay_sps.php?module=paysps&act=detailpayin&paymentID=<?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['paymentID'];?>
&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['invoiceNo'];?>
&paymentNo=<?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['paymentNo'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="pay_sps.php?module=paysps&act=delete&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['invoiceNo'];?>
&paymentNo=<?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['paymentNo'];?>
&paymentID=<?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['paymentID'];?>
" onclick="return confirm('Anda Yakin ingin membatalkan nomor pembayaran <?php echo $_smarty_tpl->tpl_vars['dataPay']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPay']['index']]['paymentNo'];?>
? penghapusan ini akan membatalkan pembayaran transaksi ini.');"><img src="img/icons/delete.png" width="18"></a>
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