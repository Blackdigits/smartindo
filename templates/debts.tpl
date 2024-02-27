{include file="header.tpl"}

<style>
	div.ui-datepicker{
		font-size:14px;
	}
</style>

<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
<script type='text/javascript' src="design/js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="design/css/jquery.autocomplete.css" />

{literal}
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
{/literal}

<header class="header">
	
	{include file="logo.tpl"}
		
	{include file="navigation.tpl"}
		
</header>

<div class="wrapper row-offcanvas row-offcanvas-left">
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="left-side sidebar-offcanvas">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			{include file="user_panel.tpl"}
        	
			{include file="side_menu.tpl"}

		</section>
		<!-- /.sidebar -->
	</aside>
	
	<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		
		{include file="breadcumb.tpl"}
		
		<!-- Main content -->
		<section class="content">
		
			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<section class="col-lg-12 connectedSortable">
				
					<!-- TO DO List -->
					<div class="box box-primary">
						
						{if $module == 'stockopname' AND $act == 'add'}
							{literal}
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
							{/literal}
						
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
										<td><input type="text" id="soDate" name="soDate" value="{$soDate}" class="form-control" placeholder="Tanggal Stock Opname" style="width: 270px;" required></td>
									</tr>
									<tr>
										<td>GUDANG</td>
										<td>:</td>
										<td><select name="factoryID" id="factoryID" class="form-control" style="width: 270px;" required>
												<option value=""></option>
												{section name=dataFactory loop=$dataFactory}
													{if $dataFactory[dataFactory].factoryID == $factoryID}
														<option value="{$dataFactory[dataFactory].factoryID}" SELECTED>{$dataFactory[dataFactory].factoryCode} {$dataFactory[dataFactory].factoryName}</option>
													{else}
														<option value="{$dataFactory[dataFactory].factoryID}">{$dataFactory[dataFactory].factoryCode} {$dataFactory[dataFactory].factoryName}</option>
													{/if}
												{/section}
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
							
						{elseif $module == 'debt' AND $act == 'history'}
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Tambah Pembayaran Hutang</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_global_payment_debts.php?module=payment&act=print&debtID={$debtID}&debtNo={$debtNo}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="debts.php"><button class="btn btn-default pull-right">Back</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body" style="float: left; background-color: #FFF;">
								<form method="POST" action="debts.php?module=debt&act=input">
								<input type="hidden" name="debtID" id="debtID" value="{$debtID}">
								<input type="hidden" name="debtNo" id="debtNo" value="{$debtNo}">
								<input type="hidden" name="spbNo" id="spbNo" value="{$spbNo}">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td colspan="3"><h4>Form Pembayaran Hutang</h4></td>
									</tr>
									<tr>
										<td width="130">NOMOR / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="paymentNo" value="{$paymentNo}" name="paymentNo">
											<input type="text" id="paymentNo" name="paymentNo" value="{$paymentNo}" class="form-control" placeholder="Nomor Pembayaran" style="width: 165px; float: left; margin-right: 5px;" DISABLED><input type="text" id="paymentDate" name="paymentDate" value="{$paymentDate}" class="form-control" placeholder="Tanggal Pembayaran" style="width: 100px;" required></td>
									</tr>
									<tr>
										<td>NOMOR FAKTUR</td>
										<td>:</td>
										<td>
											<input type="hidden" id="invoiceID" name="invoiceID" value="{$invoiceID}"><input type="hidden" id="invoiceNo" name="invoiceNo" value="{$invoiceNo}">
											<input type="text" value="{$invoiceNo}" id="invoiceNo" name="invoiceNo" class="form-control" placeholder="Nomor Faktur Pembelian" style="width: 270px;" DISABLED>
										</td>
									</tr>
									<tr>
										<td>SALES</td>
										<td>:</td>
										<td><input type="hidden" id="supplierID" name="supplierID" value="{$supplierID}"><input type="hidden" id="supplierName" name="supplierName" value="{$supplierName}"><input type="hidden" id="supplierAddress" name="supplierAddress" value="{$supplierAddress}">
											<input type="text" id="productName" name="productName" class="form-control" placeholder="Nama Supplier" value="{$supplierName}" style="width: 270px;" DISABLED>
										</td>
									</tr>
									<tr>
										<td>TOTAL HUTANG</td>
										<td>:</td>
										<td><input type="text" id="debtTotal" name="debtTotal" class="form-control" placeholder="Total Hutang" value="{$debtTotalRp}" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>SUDAH DIBAYAR</td>
										<td>:</td>
										<td><input type="text" id="incomingTotal" name="incomingTotal" class="form-control" placeholder="Sudah Dibayar" value="{$incomingTotalRp}" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>PENGURANGAN</td>
										<td>:</td>
										<td><input type="text" id="reductionTotal" name="reductionTotal" class="form-control" placeholder="Pengurangan Hutang" value="{$reductionTotalRp}" style="width: 270px;" DISABLED></td>
									</tr>
                                    <tr>
										<td>PAJAK</td>
										<td>:</td>
										<td><input type="text" id="pajak" name="pajak" class="form-control" placeholder="Pajak penjualan" value="{$pajak}" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>SISA HUTANG</td>
										<td>:</td>
										<td><input type="text" id="sisa" name="sisa" class="form-control" placeholder="Sisa Hutang" value="{$sisa}" style="width: 270px;" DISABLED></td>
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
											{section name=dataPayment loop=$dataPayment}
												<tr>
													<td>{$dataPayment[dataPayment].no}</td>
													<td>{$dataPayment[dataPayment].paymentNo}</td>
													<td>{$dataPayment[dataPayment].paymentDate}</td>
													<td>{$dataPayment[dataPayment].payType}</td>
													<td>{$dataPayment[dataPayment].total}</td>
													<td>
														<a title="Detail" href="detail_payment_debts.php?module=payment&act=detail&paymentID={$dataPayment[dataPayment].paymentID}&paymentNo={$dataPayment[dataPayment].paymentNo}" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="debts.php?module=debt&act=deletepayment&debtID={$debtID}&debtNo={$debtNo}&paymentID={$dataPayment[dataPayment].paymentID}&paymentNo={$dataPayment[dataPayment].paymentNo}" onclick="return confirm('Anda Yakin ingin menghapus nomor pembayaran #{$dataPayment[dataPayment].paymentNo}? penghapusan ini berarti membatalkan pembayaran.');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							</div>
							
						{elseif $module == 'debt' AND $act == 'finish'}
							
							{literal}
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
							{/literal}
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Tambah Pembayaran Hutang</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="debts.php"><button class="btn btn-default pull-right">Close</button></a>
										<a href="print_unit_payment_debts.php?module=payment&act=print&paymentID={$paymentID}&paymentNo={$paymentNo}&debtID={$debtID}&debtNo={$debtNo}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
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
										<td>{$paymentNo} / {$paymentDate}</td>
									</tr>
									<tr>
										<td>NOMOR FAKTUR</td>
										<td>:</td>
										<td>{$invoiceNo}</td>
									</tr>
									<tr>
										<td>SUPPLIER</td>
										<td>:</td>
										<td>{$supplierName}</td>
									</tr>
									<tr>
										<td>TOTAL HUTANG</td>
										<td>:</td>
										<td>{$debtTotalRp}</td>
									</tr>
									<tr>
										<td>SUDAH DIBAYAR</td>
										<td>:</td>
										<td>{$incomingTotalRp}</td>
									</tr>
									<tr>
										<td>PENGURANGAN</td>
										<td>:</td>
										<td>{$reductionTotalRp}</td>
									</tr>
                                    <tr>
										<td>PAJAK</td>
										<td>:</td>
										<td>{$pajak}</td>
									</tr>
									<tr>
										<td>SISA HUTANG</td>
										<td>:</td>
										<td>{$sisa}</td>
									</tr>
									<tr>
										<td>PEMBAYARAN</td>
										<td>:</td>
										<td>{$payType}</td>
									</tr>
									<tr>
										<td>NOMOR AKUN</td>
										<td>:</td>
										<td>{$bankNo}</td>
									</tr>
									<tr>
										<td>NAMA BANK</td>
										<td>:</td>
										<td>{$bankName}</td>
									</tr>
									<tr>
										<td>TGL EFEKTIF</td>
										<td>:</td>
										<td>{$effectiveDate}</td>
									</tr>
									<tr>
										<td>NAMA AKUN</td>
										<td>:</td>
										<td>{$bankAC}</td>
									</tr>
									<tr>
										<td>JUMLAH</td>
										<td>:</td>
										<td>{$total}</td>
									</tr>
									<tr>
										<td>REFERENSI</td>
										<td>:</td>
										<td>{$ref}</td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td>{$note}</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'stockopname' AND $act == 'detailstockopname'}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Detail Stock Opname</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_stock_opname.php?module=stockopname&act=print&soID={$soID}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="javascript:history.go(-1)"><button class="btn btn-default pull-right">Back</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">TANGGAL</td>
										<td width="5">:</td>
										<td>{$soDate}</td>
									</tr>
									<tr>
										<td>GUDANG</td>
										<td>:</td>
										<td>{$factoryName}</td>
									</tr>
									<tr>
										<td>NAMA PRODUK</td>
										<td>:</td>
										<td>{$productName}</td>
									</tr>
									<tr>
										<td>STOK SAAT INI</td>
										<td>:</td>
										<td>{$productStock}</td>
									</tr>
									<tr>
										<td>STOK NYATA</td>
										<td>:</td>
										<td>{$realStock}</td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td>{$note}</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'stockopname' AND $act == 'finish'}
							
							{literal}
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
							{/literal}
						
							<div class="label-success">{$msg}</div>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Detail Stock Opname</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_stock_opname.php?module=stockopname&act=print&soID={$soID}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="stock_opname.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">TANGGAL</td>
										<td width="5">:</td>
										<td>{$soDate}</td>
									</tr>
									<tr>
										<td>GUDANG</td>
										<td>:</td>
										<td>{$factoryName}</td>
									</tr>
									<tr>
										<td>NAMA PRODUK</td>
										<td>:</td>
										<td>{$productName}</td>
									</tr>
									<tr>
										<td>STOK SAAT INI</td>
										<td>:</td>
										<td>{$productStock}</td>
									</tr>
									<tr>
										<td>STOK NYATA</td>
										<td>:</td>
										<td>{$realStock}</td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td>{$note}</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'debt' && $act == 'search'}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="debts.php">
											<input type="hidden" name="module" value="debt">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="{$endDate}" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px; margin-right: 5px;">
											<input type="text" id="startDate" name="startDate" value="{$startDate}" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px; margin-right: 5px;">
											<select id="supplierID" name="supplierID" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
												<option value=""></option>
												{section name=dataSupplier loop=$dataSupplier}
													{if $dataSupplier[dataSupplier].supplierID == $supplierID}
														<option value="{$dataSupplier[dataSupplier].supplierID}" SELECTED>{$dataSupplier[dataSupplier].supplierName} [ Kode : {$dataSupplier[dataSupplier].supplierCode} ]</option>
													{else}
														<option value="{$dataSupplier[dataSupplier].supplierID}">{$dataSupplier[dataSupplier].supplierName} [ Kode : {$dataSupplier[dataSupplier].supplierCode} ]</option>
													{/if}
												{/section}
											</select>
											<input type="text" id="invoiceNo" value="{$invoiceNo}" name="invoiceNo" class="form-control" placeholder="No Faktur Pembelian" style="float: right; width: 200px; margin-right: 5px;">
										
											<!--<a href="debts.php?module=debt&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>-->
											<a href="print_debts.php?act=print&supplierID={$supplierID}&startDate={$startDate}&endDate={$endDate}&invoiceNo={$invoiceNo}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
											{section name=dataDebt loop=$dataDebt}
												<tr>
													<td>{$dataDebt[dataDebt].no}</td>
													<td>{$dataDebt[dataDebt].debtNo}</td>
													<td>{$dataDebt[dataDebt].invoiceNo}</td>
													<td>{$dataDebt[dataDebt].supplierName}</td>
													<td>{$dataDebt[dataDebt].debtTotal}</td>
													<td>{$dataDebt[dataDebt].incomingTotal}</td>
													<td>{$dataDebt[dataDebt].reductionTotal}</td>
													<td>{$dataDebt[dataDebt].sisa}</td>
													<td>
														<a title="Detail" href="debts.php?module=debt&act=history&debtID={$dataDebt[dataDebt].debtID}&debtNo={$dataDebt[dataDebt].debtNo}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<!--<a title="Delete" href="stock_opname.php?module=stockopname&act=delete&soID={$dataStockOpname[dataStockOpname].soID}&page={$page}" onclick="return confirm('Anda Yakin ingin menghapus stock opname #{$dataStockOpname[dataStockOpname].soID}? penghapusan ini berarti membatalkan stock opname dan akan mengembalikan stok ke awal.');"><img src="img/icons/delete.png" width="18"></a>-->
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
						
						{else}
							<div class="label-success">{$msg}</div>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="debts.php">
											<input type="hidden" name="module" value="debt">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="{$endDate}" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px; margin-right: 5px;">
											<input type="text" id="startDate" name="startDate" value="{$startDate}" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px; margin-right: 5px;">
											<select id="supplierID" name="supplierID" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
												<option value=""></option>
												{section name=dataSupplier loop=$dataSupplier}
													<option value="{$dataSupplier[dataSupplier].supplierID}">{$dataSupplier[dataSupplier].supplierName} [ Kode : {$dataSupplier[dataSupplier].supplierCode} ]</option>
												{/section}
											</select>
											<input type="text" id="invoiceNo" name="invoiceNo" class="form-control" placeholder="No Faktur Pembelian" style="float: right; width: 200px; margin-right: 5px;">
										
											<!--<a href="debts.php?module=debt&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>-->
											<a href="print_debts.php?act=print&supplierID={$supplierID}&startDate={$startDate}&endDate={$endDate}&invoiceNo={$invoiceNo}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
											{section name=dataDebt loop=$dataDebt}
												<tr>
													<td>{$dataDebt[dataDebt].no}</td>
													<td>{$dataDebt[dataDebt].debtNo}</td>
													<td>{$dataDebt[dataDebt].invoiceNo}</td>
													<td>{$dataDebt[dataDebt].supplierName}</td>
													<td>{$dataDebt[dataDebt].debtTotal}</td>
													<td>{$dataDebt[dataDebt].incomingTotal}</td>
													<td>{$dataDebt[dataDebt].reductionTotal}</td>
													<td>{$dataDebt[dataDebt].sisa}</td>
													<td>
														<a title="Detail" href="debts.php?module=debt&act=history&debtID={$dataDebt[dataDebt].debtID}&debtNo={$dataDebt[dataDebt].debtNo}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<!--<a title="Delete" href="stock_opname.php?module=stockopname&act=delete&soID={$dataStockOpname[dataStockOpname].soID}&page={$page}" onclick="return confirm('Anda Yakin ingin menghapus stock opname #{$dataStockOpname[dataStockOpname].soID}? penghapusan ini berarti membatalkan stock opname dan akan mengembalikan stok ke awal.');"><img src="img/icons/delete.png" width="18"></a>-->
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-left">
									<ul class="pagination pagination-sm inline">
										{$pageLink}
									</ul>
								</div>
							</div><!-- /.box-header -->
						{/if}
						
					</div><!-- /.box -->
					
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

{include file="footer.tpl"}