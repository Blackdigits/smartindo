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
			
			$( "#deliveredDate" ).datepicker({
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
			
			$('#deliveredDate').change(function () {
				var doNo = $("#doNo").val();
				var doID = $("#doID").val();
				var soNo = $("#soNo").val();
				var deliveredDate = $("#deliveredDate").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_do_delivereddate.php',
					dataType: 'JSON',
					data:{
						doNo: doNo,
						doID: doID,
						deliveredDate: deliveredDate
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "do.php?module=do&act=add&soNo=" + soNo;
					}
				});
			});
			
			$('#note').change(function () {
				var doNo = $("#doNo").val();
				var doID = $("#doID").val();
				var soNo = $("#soNo").val();
				var note = $("#note").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_do_note.php',
					dataType: 'JSON',
					data:{
						doNo: doNo,
						doID: doID,
						soNo: soNo,
						note: note
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "do.php?module=do&act=add&soNo=" + soNo;
					}
				});
			});
			
			$('#soNo').change(function () {
				var soNo = $("#soNo").val();
				
				window.location.href = "do.php?module=do&act=add&soNo=" + soNo;
			});
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#do").submit(function() { return false; });
			$("#do2").submit(function() { return false; });
			
			$("#send2").on("click", function(){
				var doNo = $("#doNo").val();
				var productID = $("#productID").val();
				var productName1 = $("#productName1").val();
				var qty = parseInt($("#qty").val());
				var price = parseInt($("#price").val());
				var desc = $("#desc").val();
				
				if (qty != '' && soNo != '' && productID != '' && price != ''){
					
					$.ajax({
						type: 'POST',
						url: 'save_so.php',
						dataType: 'JSON',
						data:{
							qty: qty,
							price: price,
							soNo: soNo,
							productID: productID,
							productName1: productName1,
							desc: desc
						},
						beforeSend: function (data) {
							$('#send2').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "so.php?module=so&act=add&msg=Data berhasil disimpan";
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
						
						{if $module == 'do' AND $act == 'add'}
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
								<h3 class="box-title">Tambah Surat Jalan</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="do.php?module=do&act=cancel" onclick="return confirm('Anda Yakin ingin membatalkan surat jalan ini?');"><button class="btn btn-default pull-right">Batal Trx</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="do.php?module=do&act=input">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO DO / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="doNo" name="doNo" value="{$doNo}">
											<input type="hidden" id="doID" name="doID" value="{$doID}">
											<input type="text" id="doNo" name="doNo" value="{$doNo}" class="form-control" placeholder="NO DO" style="width: 110px; float: left" DISABLED>
											<input type="text" id="deliveredDate" name="deliveredDate" value="{$deliveredDate}" class="form-control" placeholder="Tanggal DO" style="width: 160px;" required>
										</td>
									</tr>
									<tr valign="top">
										<td>NO SO</td>
										<td>:</td>
										<td><input type="text" id="soNo" name="soNo" value="{$soNo}" class="form-control" placeholder="Nomor SO" style="width: 270px;" required>
											
											{if $numsSo == '0' AND $soNo != ''}
												<font color="#f56954">Nomor SO tidak ditemukan.</font>
											{/if}
											{if $numsDo > 0 AND $soNo != ''}
												<font color="#f56954">Nomor SO sudah digunakan.</font>
											{/if}
										</td>
									</tr>
									<tr>
										<td>TOKO</td>
										<td>:</td>
										<td>{if $numsDo == '0' AND $soNo != ''}
											<input type="hidden" id="customerID" name="customerID" value="{$customerID}">
											<input type="hidden" id="customerName" name="customerName" value="{$customerName}">
											<input type="hidden" id="customerAddress" name="customerAddress" value="{$customerAddress}">
											<input type="text" id="customerName" name="customerName" value="{$customerName}" class="form-control" placeholder="Customer" style="width: 270px;" DISABLED>
											{else}
											<input type="text" id="customerName" name="customerName" class="form-control" placeholder="Customer" style="width: 270px;" DISABLED>
											{/if}
										</td>
									</tr>
									<tr>
										<td>TGL SO/DIBUTUHKAN</td>
										<td>:</td>
										<td><input type="hidden" id="orderDate" name="orderDate" value="{$orderDate}"><input type="hidden" id="needDate" name="needDate" value="{$needDate}">
											{if $numsDo == '0' AND $soNo != ''}
												<input type="text" id="orderDate" name="orderDate" value="{$orderDate}" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED><input type="text" id="orderDate" name="needDate" value="{$needDate}" class="form-control" placeholder="Tgl Dibutuhkan" style="width: 135px;" DISABLED></td>
											{else}
												<input type="text" id="orderDate" name="orderDate" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED><input type="text" id="orderDate" name="needDate" class="form-control" placeholder="Tgl Dibutuhkan" style="width: 135px;" DISABLED></td>
											{/if}
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td>{if $numsDo == '0' AND $soNo != ''}
												<input type="text" value="{$note}" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;">
											{else}
												<input type="text" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;">
											{/if}</td>
									</tr>
									<tr>
										<td colspan="3">
											<br>
										</td>
									</tr>
								</table>

								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA PRODUK</th>
												<th>NOTE</th>
												<th>JML ORDER</th>
												<th>JML DIKIRIM</th>
												<th>KIRIM</th>
												<th>DARI GUDANG</th>
											</tr>
										</thead>
										<tbody>
											{if $numsDo == '0' AND $soNo != ''}
											{section name=dataDetail loop=$dataDetail}
												<tr>
													<td>{$dataDetail[dataDetail].no} <input type="hidden" name="detailID[]" id="detailID" value="{$dataDetail[dataDetail].detailID}"></td>
													<td>{$dataDetail[dataDetail].productName} <input type="hidden" name="productName[]" id="productName" value="{$dataDetail[dataDetail].productName}"> <input type="hidden" name="productID[]" id="productID" value="{$dataDetail[dataDetail].productID}"></td>
													<td>{$dataDetail[dataDetail].note} <input type="hidden" name="notedetail[]" id="notedetail" value="{$dataDetail[dataDetail].note}"></td>
													<td style='text-align: center;'>{$dataDetail[dataDetail].qty} <input type="hidden" name="qty[]" id="qty" value="{$dataDetail[dataDetail].qty}"> <input type="hidden" name="price[]" id="price" value="{$dataDetail[dataDetail].price}"></td>
													<td><input type="number" value="0" id="deliveredQty" name="deliveredQty[]" class="form-control" placeholder="Jml" style="width: 100px;" required></td>
													<td>
														<select id="status" name="status[]" class="form-control" style="width: 100px;" required>
															<option value=""></option>
															<option value="Y">YA</option>
															<option value="N">TIDAK</option>
														</select>
													</td>
													<td>
														<select id="factory" name="factory[]" class="form-control" style="width: 180px;" required>
															<option value=""></option>
															{section name=dataFactory loop=$dataDetail[dataDetail].dataFactory}
																<option value="{$dataDetail[dataDetail].dataFactory[dataFactory].factoryID}#{$dataDetail[dataDetail].dataFactory[dataFactory].factoryCode}#{$dataDetail[dataDetail].dataFactory[dataFactory].factoryName}">{$dataDetail[dataDetail].dataFactory[dataFactory].factoryCode} {$dataDetail[dataDetail].dataFactory[dataFactory].factoryName} [Stok : {$dataDetail[dataDetail].dataFactory[dataFactory].stock}]</option>
															{/section}
														</select>
													</td>
												</tr>
											{/section}
											{/if}
										</tbody>
									</table>
								</div>
								<br>
								<br>
								{if $numsSo > 0}
									{if $numsDo > 0 AND $soNo != ''}
									{else}
										<button type="submit" class="btn btn-primary">Simpan</button>
									{/if}
								{/if}
								</form>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'do' AND $act == 'finish'}
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
								<h3 class="box-title">Delivery Order</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_do.php?module=do&act=print&doID={$doID}&doNo={$doNo}&doFaktur={$doFaktur}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="do.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO DO / TGL</td>
										<td width="5">:</td>
										<td><input type="text" id="doNo" name="doNo" value="{$doNo}" class="form-control" placeholder="ID BBM" style="width: 110px; float: left" DISABLED>
											<input type="text" id="deliveredDate" name="deliveredDate" value="{$deliveredDate}" class="form-control" placeholder="Tanggal DO" style="width: 160px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>NO SO</td>
										<td>:</td>
										<td><input type="text" id="soNo" name="soNo" value="{$soNo}" class="form-control" placeholder="Nomor SO" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>TOKO</td>
										<td>:</td>
										<td><input type="text" id="customerName" name="customerName" value="{$customerName}" class="form-control" placeholder="Customer" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>TGL SO/DIBUTUHKAN</td>
										<td>:</td>
										<td><input type="text" id="orderDate" name="orderDate" value="{$orderDate}" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED><input type="text" id="orderDate" name="needDate" value="{$needDate}" class="form-control" placeholder="Tgl Dibutuhkan" style="width: 135px;" DISABLED></td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><input type="text" value="{$note}" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td colspan="3">
											<br>
										</td>
									</tr>
								</table>

								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA PRODUK</th>
												<th>NOTE</th>
												<th>JML ORDER</th>
												<th>JML DIKIRIM</th>
												<th>KIRIM</th>
												<th>DARI GUDANG</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataDoDetail loop=$dataDoDetail}
												<tr>
													<td>{$dataDoDetail[dataDoDetail].no}</td>
													<td>{$dataDoDetail[dataDoDetail].productName}</td>
													<td>{$dataDoDetail[dataDoDetail].note}</td>
													<td style='text-align: center;'>{$dataDoDetail[dataDoDetail].qty}</td>
													<td style='text-align: center;'>{$dataDoDetail[dataDoDetail].deliveredQty}</td>
													<td style='text-align: center;'>{$dataDoDetail[dataDoDetail].status}</td>
													<td>{$dataDoDetail[dataDoDetail].factoryName}</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'do' AND $act == 'detaildo'}
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Surat Jalan</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_do.php?module=do&act=print&doID={$doID}&doNo={$doNo}&doFaktur={$doFaktur}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										{if $q != ''}
											<a href="do.php?module=do&act=search&q={$q}&page={$page}"><button class="btn btn-default pull-right">Back</button></a>
										{else}
											<a href="do.php?page={$page}"><button class="btn btn-default pull-right">Back</button></a>
										{/if}
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO DO / TGL</td>
										<td width="5">:</td>
										<td><input type="text" id="doNo" name="doNo" value="{$doNo}" class="form-control" placeholder="NO DO" style="width: 110px; float: left" DISABLED>
											<input type="text" id="deliveredDate" name="deliveredDate" value="{$deliveredDate}" class="form-control" placeholder="Tanggal DO" style="width: 160px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>NO SO</td>
										<td>:</td>
										<td><input type="text" id="soNo" name="soNo" value="{$soNo}" class="form-control" placeholder="Nomor SO" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>CUSTOMER</td>
										<td>:</td>
										<td><input type="text" id="customerName" name="customerName" value="{$customerName}" class="form-control" placeholder="Customer" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>TGL SO/DIBUTUHKAN</td>
										<td>:</td>
										<td><input type="text" id="orderDate" name="orderDate" value="{$orderDate}" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED><input type="text" id="orderDate" name="needDate" value="{$needDate}" class="form-control" placeholder="Tgl Dibutuhkan" style="width: 135px;" DISABLED></td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><input type="text" value="{$note}" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td colspan="3">
											<br>
										</td>
									</tr>
								</table>

								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA PRODUK</th>
												<th>NOTE</th>
												<th>JML ORDER</th>
												<th>JML DIKIRIM</th>
												<th>TERIMA</th>
												<th>GUDANG</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataDoDetail loop=$dataBbmDetail}
												<tr>
													<td>{$dataDoDetail[dataDoDetail].no}</td>
													<td>{$dataDoDetail[dataDoDetail].productName}</td>
													<td>{$dataDoDetail[dataDoetail].note}</td>
													<td style='text-align: center;'>{$dataDoDetail[dataDoDetail].qty}</td>
													<td style='text-align: center;'>{$dataDoDetail[dataDoDetail].receiveQty}</td>
													<td style='text-align: center;'>{$dataDoDetail[dataDoDetail].status}</td>
													<td>{$dataDoDetail[dataDoDetail].factoryName}</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
						
						{elseif $module == 'do' AND $act == 'search'}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="do.php">
											<input type="hidden" name="module" value="do">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : Nomor DO" style="float: right; width: 270px;">
										
											<a href="do.php?module=do&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_do.php?act=print&q={$q}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>NO DO <i class="fa fa-sort"></i></th>
												<th>NO SO <i class="fa fa-sort"></i></th>
												<th>CUSTOMER <i class="fa fa-sort"></i></th>
												<th>TGL PENGIRIMAN <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataDo loop=$dataDo}
												<tr>
													<td>{$dataDo[dataDo].no}</td>
													<td>{$dataDo[dataDo].doNo}</td>
													<td>{$dataDo[dataDo].soNo}</td>
													<td>{$dataDo[dataDo].customerName}</td>
													<td>{$dataDo[dataDo].deliveredDate}</td>
													<td>{$dataDo[dataDo].staffName}</td>
													<td>
														<a title="Detail" href="do.php?module=do&act=detaildo&doID={$dataDo[dataDo].doID}&doNo={$dataDo[dataDo].doNo}&doFaktur={$dataDo[dataDo].doFaktur}&q={$q}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="do.php?module=do&act=delete&doID={$dataDo[dataDo].doID}&doFaktur={$dataDo[dataDo].doFaktur}&doNo={$dataDo[dataDo].doNo}" onclick="return confirm('Anda Yakin ingin membatalkan transaksi {$dataDo[dataDo].doNo}?');"><img src="img/icons/delete.png" width="18"></a>
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
										<form method="GET" action="do.php">
											<input type="hidden" name="module" value="do">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : Nomor DO" style="float: right; width: 270px;" required>
										
											<a href="do.php?module=do&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_do.php?act=print&q={$q}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>NO DO <i class="fa fa-sort"></i></th>
												<th>NO SO <i class="fa fa-sort"></i></th>
												<th>CUSTOMER <i class="fa fa-sort"></i></th>
												<th>TGL PENGIRIMAN <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataDo loop=$dataDo}
												<tr>
													<td>{$dataDo[dataDo].no}</td>
													<td>{$dataDo[dataDo].doNo}</td>
													<td>{$dataDo[dataDo].soNo}</td>
													<td>{$dataDo[dataDo].customerName}</td>
													<td>{$dataDo[dataDo].deliveredDate}</td>
													<td>{$dataDo[dataDo].staffName}</td>
													<td>
														<a title="Detail" href="do.php?module=do&act=detaildo&bbmID={$dataDo[dataDo].doID}&doNo={$dataDo[dataDo].doNo}&doFaktur={$dataDo[dataDo].doFaktur}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="do.php?module=do&act=delete&doID={$dataDo[dataDo].doID}&doFaktur={$dataDo[dataDo].doFaktur}&doNo={$dataDo[dataDo].doNo}" onclick="return confirm('Anda Yakin ingin membatalkan transaksi {$dataDo[dataDo].doNo}?');"><img src="img/icons/delete.png" width="18"></a>
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