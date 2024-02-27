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
						
						{if $module == 'payin' AND $act == 'add'}
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
								<h3 class="box-title">Pembayaran Transaksi Pembelian</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="pay_in.php" onclick="return confirm('Anda Yakin ingin membatalkan pembayaran transaksi pembelian ini?');"><button type="button" class="btn btn-default pull-right">Batal Trx</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								{if $numsTotal == '0' && $invoiceNo != ''}
									<span style="color: #f56954;">Nomor Faktur tidak ditemukan.</span>
								{/if}
								{if $numsTotal > 0}
									{if $debto <= '0'}
										<span style="color: green;">Nomor Faktur ini telah lunas dibayarkan.</span>
									{/if}
								{/if}
								<form method="POST" action="pay_in.php?module=payin&act=input">
								<input type="hidden" id="supplierID" name="supplierID" value="{$supplierID}">
								<input type="hidden" id="supplierName" name="supplierName" value="{$supplierName}">
								<input type="hidden" id="supplierAddress" name="supplierAddress" value="{$supplierAddress}">
								<input type="hidden" id="spbNo" name="spbNo" value="{$spbNo}">
								<input type="hidden" id="invoiceID" name="invoiceID" value="{$invoiceID}">
								<table cellpadding="3" cellspacing="3" width="100%">
									<tr>
										<td width="150">NO PAYMENT / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="paymentNo" name="paymentNo" value="{$payInNo}">
											<input type="text" id="paymentNo" name="paymentNo" value="{$payInNo}" class="form-control" placeholder="NOMOR PAYMENT" style="width: 110px; float: left" DISABLED>
											<input type="text" id="paymentDate" name="paymentDate" value="{$payInDate}" class="form-control" placeholder="Tanggal Payment" style="width: 190px;" required>
										</td>
									</tr>
									<tr valign="top">
										<td>NOMOR FAKTUR</td>
										<td>:</td>
										<td><input type="text" id="invoiceNo" name="invoiceNo" value="{$invoiceNo}" class="form-control" placeholder="Nomor Faktur" style="width: 300px;" required></td>
									</tr>
									<tr valign="top">
										<td>TERHUTANG</td>
										<td>:</td>
										<td><input type="text" id="debt" name="debt" value="{$debt}" class="form-control" placeholder="Total Terhutang" style="width: 300px;" DISABLED></td>
									</tr>
									<tr>
										<td>DIBAYARKAN KEPADA</td>
										<td>:</td>
										<td>
											<input type="text" id="supplierName" name="supplierName" value="{$supplierName}" class="form-control" placeholder="Nama Supplier" style="width: 300px;" DISABLED>
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
								{if $numsTotal > 0}
									{if $debto > 0}
										<button type="submit" class="btn btn-primary">Simpan</button>
									{/if}
								{/if}
								</form>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'payin' AND $act == 'finish'}
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
								<h3 class="box-title">Pembayaran Transaksi Pembelian</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_payin.php?module=payin&act=print&invoiceNo={$invoiceNo}&paymentNo={$paymentNo}&paymentID={$paymentID}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="pay_in.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3" width="100%">
									<tr>
										<td width="150">NO PAYMENT / TGL</td>
										<td width="5">:</td>
										<td>{$paymentNo} / {$paymentDate}</td>
									</tr>
									<tr valign="top">
										<td>NOMOR FAKTUR</td>
										<td>:</td>
										<td>{$invoiceNo}</td>
									</tr>
									<tr valign="top">
										<td>TERHUTANG</td>
										<td>:</td>
										<td>{$debt}</td>
									</tr>
									<tr>
										<td>DIBAYARKAN KEPADA</td>
										<td>:</td>
										<td>{$supplierName}</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td>{$supplierAddress}</td>
									</tr>
									<tr>
										<td>PEMBAYARAN</td>
										<td>:</td>
										<td>{$payType}</td>
									</tr>
									<tr>
										<td>NO REK/CEK/GIRO</td>
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
									<tr valign="top">
										<td>NOTE</td>
										<td>:</td>
										<td>{$note}</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'payin' AND $act == 'detailpayin'}
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Pembayaran Transaksi Pembelian</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_payin.php?module=payin&act=print&invoiceNo={$invoiceNo}&paymentNo={$paymentNo}&paymentID={$paymentID}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										{if $q != ''}
											<a href="pay_in.php?module=payin&act=search&q={$q}"><button class="btn btn-default pull-right">Back</button></a>
										{else}
											<a href="pay_in.php?page={$page}"><button class="btn btn-default pull-right">Back</button></a>
										{/if}
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3" width="100%">
									<tr>
										<td width="150">NO PAYMENT / TGL</td>
										<td width="5">:</td>
										<td>{$paymentNo} / {$paymentDate}</td>
									</tr>
									<tr valign="top">
										<td>NOMOR FAKTUR</td>
										<td>:</td>
										<td>{$invoiceNo}</td>
									</tr>
									<tr valign="top">
										<td>TERHUTANG</td>
										<td>:</td>
										<td>{$debt}</td>
									</tr>
									<tr>
										<td>DIBAYARKAN KEPADA</td>
										<td>:</td>
										<td>{$supplierName}</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td>{$supplierAddress}</td>
									</tr>
									<tr>
										<td>PEMBAYARAN</td>
										<td>:</td>
										<td>{$payType}</td>
									</tr>
									<tr>
										<td>NO REK/CEK/GIRO</td>
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
									<tr valign="top">
										<td>NOTE</td>
										<td>:</td>
										<td>{$note}</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'payin' AND $act == 'search'}
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="pay_in.php">
											<input type="hidden" name="module" value="payin">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" value="{$q}" id="q" name="q" class="form-control" placeholder="Pencarian : Nomor Bukti Pembayaran" style="float: right; width: 270px;" required>
											<a href="pay_in.php?module=payin&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_pay_in.php?act=print&q={$q}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
											{section name=dataPay loop=$dataPay}
												<tr>
													<td>{$dataPay[dataPay].no}</td>
													<td>{$dataPay[dataPay].paymentNo}</td>
													<td>{$dataPay[dataPay].paymentDate}</td>
													<td>{$dataPay[dataPay].invoiceNo}</td>
													<td>{$dataPay[dataPay].spbNo}</td>
													<td>{$dataPay[dataPay].payType}</td>
													<td>{$dataPay[dataPay].total}</td>
													<td>{$dataPay[dataPay].staffName}</td>
													<td>
														<a title="Detail" href="pay_in.php?module=payin&act=detailpayin&paymentID={$dataPay[dataPay].paymentID}&invoiceNo={$dataPay[dataPay].invoiceNo}&paymentNo={$dataPay[dataPay].paymentNo}&q={$q}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="pay_in.php?module=payin&act=delete&invoiceNo={$dataPay[dataPay].invoiceNo}&paymentNo={$dataPay[dataPay].paymentNo}&paymentID={$dataPay[dataPay].paymentID}&q={$q}" onclick="return confirm('Anda Yakin ingin membatalkan nomor pembayaran {$dataPay[dataPay].paymentNo}? penghapusan ini akan membatalkan pembayaran transaksi ini.');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
													
						{else}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="pay_in.php">
											<input type="hidden" name="module" value="payin">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" value="{$q}" id="q" name="q" class="form-control" placeholder="Pencarian : Nomor Bukti Pembayaran" style="float: right; width: 270px;">
											<a href="pay_in.php?module=payin&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_pay_in.php?act=print&q={$q}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
											{section name=dataPay loop=$dataPay}
												<tr>
													<td>{$dataPay[dataPay].no}</td>
													<td>{$dataPay[dataPay].paymentNo}</td>
													<td>{$dataPay[dataPay].paymentDate}</td>
													<td>{$dataPay[dataPay].invoiceNo}</td>
													<td>{$dataPay[dataPay].spbNo}</td>
													<td>{$dataPay[dataPay].payType}</td>
													<td>{$dataPay[dataPay].total}</td>
													<td>{$dataPay[dataPay].staffName}</td>
													<td>
														<a title="Detail" href="pay_in.php?module=payin&act=detailpayin&paymentID={$dataPay[dataPay].paymentID}&invoiceNo={$dataPay[dataPay].invoiceNo}&paymentNo={$dataPay[dataPay].paymentNo}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="pay_in.php?module=payin&act=delete&invoiceNo={$dataPay[dataPay].invoiceNo}&paymentNo={$dataPay[dataPay].paymentNo}&paymentID={$dataPay[dataPay].paymentID}" onclick="return confirm('Anda Yakin ingin membatalkan nomor pembayaran {$dataPay[dataPay].paymentNo}? penghapusan ini akan membatalkan pembayaran transaksi ini.');"><img src="img/icons/delete.png" width="18"></a>
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