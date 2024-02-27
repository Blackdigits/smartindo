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
			
			$( "#orderDate" ).datepicker({
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
			
			$('#needDate').focusout(function () {
				var spbNo = $("#spbNo").val();
				var needDate = $("#needDate").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_spb_needdate.php',
					dataType: 'JSON',
					data:{
						spbNo: spbNo,
						needDate: needDate
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "spb.php?module=spb&act=add";
					}
				});
			});
			
			$('#orderDate').change(function () {
				var spbNo = $("#spbNo").val();
				var orderDate = $("#orderDate").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_spb_orderdate.php',
					dataType: 'JSON',
					data:{
						spbNo: spbNo,
						orderDate: orderDate
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "spb.php?module=spb&act=add";
					}
				});
			});
			
			$('#note').change(function () {
				var spbNo = $("#spbNo").val();
				var note = $("#note").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_spb_note.php',
					dataType: 'JSON',
					data:{
						spbNo: spbNo,
						note: note
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "spb.php?module=spb&act=add";
					}
				});
			});
			 
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#spb").submit(function() { return false; });
			$("#spb2").submit(function() { return false; });
			
			var sisastock = {};
			$("#productBarcode").autocomplete("product_spb_autocomplete.php", {
				width: 310
			}).result(function(event, item, a) {
				var myarr = item[0].split(" # ");
				
				document.getElementById('productBarcode').value = myarr[0];
				document.getElementById('productName1').value = myarr[1];
				document.getElementById('productName').value = myarr[1];
				document.getElementById('productID').value = myarr[2];
				document.getElementById('price').value = myarr[3]; 
				document.getElementById('qty').value = myarr[4];
				sisastock = myarr[4];
				$("#qty").attr({
				"max" : sisastock, 
				"min" : 0  
				});
				
			});
  
			$("#supplierID").change(function(e){
				var supplierID = $("#supplierID").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_spb_supplier.php',
					dataType: 'JSON',
					data:{
						supplierID: supplierID
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "spb.php?module=spb&act=add";
					}
				});
			});

            $("#factoryID").change(function(e){
				var factoryID = $("#factoryID").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_spb_factory.php',
					dataType: 'JSON',
					data:{
						factoryID: factoryID
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "spb.php?module=spb&act=add";
					}
				});
			});

					
			$("#send2").on("click", function(){
				var spbNo = $("#spbNo").val();
				var productID = $("#productID").val();
				var productName1 = $("#productName1").val();
				var qty = parseInt($("#qty").val());
				var price = parseInt($("#price").val());
				var desc = $("#desc").val();
				
				if (qty <= sisastock && qty > 0 && spbNo != '' && productID != '' && price > 0){
					
					$.ajax({
						type: 'POST',
						url: 'save_spb.php',
						dataType: 'JSON',
						data:{
							qty: qty,
							price: price,
							spbNo: spbNo,
							productID: productID,
							productName1: productName1,
							desc: desc
						},
						beforeSend: function (data) {
							$('#send2').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "spb.php?module=spb&act=add&msg=Data berhasil disimpan";
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
						
						{if $module == 'spb' AND $act == 'add'}
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
								<h3 class="box-title">Tambah Stok Sales</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="spb.php?module=spb&act=cancel"><button class="btn btn-default pull-right">Batal Trx</button></a>
									</div>
								</div>
							</div><!-- on <a> : onclick="return confirm('Anda Yakin ingin membatalkan PO ini?');" -->
							
							<div class="box-body">
								<form method="POST" action="spb.php?module=spb&act=input">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">No TRX / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="spbNo" name="spbNo" value="{$spbNo}">
											<input type="text" id="spbNo" name="spbNo" value="{$spbNo}" class="form-control" placeholder="NO PO" style="width: 110px; float: left" DISABLED>
											<input type="text" id="orderDate" name="orderDate" value="{$orderDateIndo}" class="form-control" placeholder="Tanggal PO" style="width: 160px;" required>
										</td>
									</tr>
									<tr>
										<td>JAM TRANSAKSI</td>
										<td>:</td>
										<td><input type="time" id="needDate" name="needDate" value="{$needDateIndo}" class="form-control" placeholder="Jam Transaksi" style="width: 270px;" required></td>
									</tr>
									<tr>
										<td>SALES</td>
										<td>:</td>
										<td>
											<select id="supplierID" name="supplierID" class="form-control" style="width: 270px;" required>
												<option value=""></option>
												{section name=dataSupplier loop=$dataSupplier}
													{if $dataSupplier[dataSupplier].supplierID == $supplierID}
														<option value="{$dataSupplier[dataSupplier].supplierID}" SELECTED>{$dataSupplier[dataSupplier].supplierName} [{$dataSupplier[dataSupplier].supplierCode}]</option>
													{else}
														<option value="{$dataSupplier[dataSupplier].supplierID}">{$dataSupplier[dataSupplier].supplierName} [{$dataSupplier[dataSupplier].supplierCode}]</option>
													{/if}
												{/section}
											</select>
										</td>
									</tr>
                                    <tr>
										<td>GUDANG</td>
										<td>:</td>
										<td>
											<select id="factoryID" name="factoryID" class="form-control" style="width: 270px;" required>
												<option value=""></option>
												{section name=dataFactory loop=$dataFactory}
													{if $dataFactory[dataFactory].supplierID == $factoryID}
														<option value="{$dataFactory[dataFactory].supplierID}" SELECTED>{$dataFactory[dataFactory].supplierName} [{$dataFactory[dataFactory].supplierCode}]</option>
													{else}
														<option value="{$dataFactory[dataFactory].supplierID}">{$dataFactory[dataFactory].supplierName} [{$dataFactory[dataFactory].supplierCode}]</option>
													{/if}
												{/section}
											</select>
										</td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><input type="text" value="{$note}" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;"></td>
									</tr>
									<tr>
										<td colspan="3">
											<br>
											{if $numsDetilSpb < 100}
											<a href="#inline" class="modalbox"><button class="btn btn-default pull-left"><i class="fa fa-plus"></i> tambah</button></a>
											{/if}
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
												<th>NOTE</th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataDetilSpb loop=$dataDetilSpb}
												<tr>
													<td>{$dataDetilSpb[dataDetilSpb].no}</td>
													<td>{$dataDetilSpb[dataDetilSpb].productName}</td>
													<td style='text-align: right;'>{$dataDetilSpb[dataDetilSpb].price}</td>
													<td style='text-align: center;'>{$dataDetilSpb[dataDetilSpb].qty}</td>
													<td style='text-align: right;'>{$dataDetilSpb[dataDetilSpb].subtotal}</td>
													<td>{$dataDetilSpb[dataDetilSpb].note}</td>
													<td>
														<a title="Edit" href="edit_spb.php?module=spb&act=edit&detailID={$dataDetilSpb[dataDetilSpb].detailID}" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="spb.php?module=spb&act=deletedetail&detailID={$dataDetilSpb[dataDetilSpb].detailID}" onclick="return confirm('Anda Yakin ingin menghapus item produk {$dataDetilSpb[dataDetilSpb].productName}?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br>
								<br>
								{if $numsDetilSpb > 0}
									<button type="submit" class="btn btn-primary">Simpan</button>
								{else}
									<button type="button" class="btn btn-primary">Simpan</button>
								{/if}
								</form>
							
							</div><!-- /.box-body -->
							
							<div id="inline">	
								<table width="95%" align="center">
									<td colspan="3"><h3>Tambah Item</h3></td>
										<tr>
									</tr>
									<tr>
										<td>
											<form id="spb" name="spb" method="POST" action="#">
											<input type="hidden" id="spbNo" name="spbNo" value="{$spbNo}">
											<table cellpadding="3" cellspacing="3">
												<tr>
													<td width="130">Kode Produk</td>
													<td width="5">:</td>
													<td><input type="text" id="productBarcode" name="productBarcode" class="form-control" placeholder="Kode atau Nama Produk" style="width: 270px;" required></td>
												</tr>
												<tr>
													<td colspan="2"></td>
													<td><input type="hidden" id="productID" name="productID">
														<input type="hidden" id="productName1" name="productName1">
														<input type="text" id="productName" name="productName" class="form-control" placeholder="Nama Produk" style="width: 270px;" DISABLED>
													</td>
												</tr>
												<tr>
													<td>Harga Satuan</td>
													<td>:</td>
													<td><input type="number" id="price" name="price" class="form-control" placeholder="Harga Satuan" style="width: 270px;" required></td>
												</tr>
												<tr>
													<td>Qty</td>
													<td>:</td>
													<td><input type="number" id="qty" name="qty" class="form-control" placeholder="Qty Produk" style="width: 270px;" required></td>
												</tr>
												<tr>
													<td>Note</td>
													<td>:</td>
													<td><input type="text" id="desc" name="desc" class="form-control" placeholder="Note" style="width: 270px;"></td>
												</tr>
											</table>
											<button id="send2" class="btn btn-primary">Simpan</button>
											</form>
										</td>
									</tr>
								</table>
							</div>
							
						{elseif $module == 'spb' AND $act == 'detailtrf'}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Detail Mutasi Stok Sales</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										{if $status == 'Invalid'}
										<a href="spb.php?module=spb&act=add&faktur={$spbFaktur}"><button class="btn btn-default pull-right" style="background-color:#f56954;color:white;font-weight:bold;">EDIT</button></a>
										{else}
										<a href="print_unit_spb.php?module=spb&act=print&spbID={$spbID}&spbFaktur={$spbFaktur}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										{/if}
										{if $q != ''}
											<a href="spb.php?module=spb&act=search&q={$q}&page={$pageNumber}"><button class="btn btn-default pull-right">Kembali</button></a>
										{else}
											<a href="spb.php?page={$pageNumber}"><button class="btn btn-default pull-right">Kembali</button></a>
										{/if}
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">ID TRX / TGL</td>
										<td width="5">:</td>
										<td>{$spbNo} / {$orderDate}</td>
									</tr>
									<tr>
										<td>JAM TRANSAKSI</td>
										<td>:</td>
										<td>{$needDate}</td>
									</tr>
									<tr>
										<td>NAMA SALES</td>
										<td>:</td>
										<td>{$supplierName}</td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td>{$note}</td>
									</tr>
									<tr>
										<td colspan="3"><br></td>
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
												<th>NOTE</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataDetail loop=$dataDetail}
												<tr>
													<td>{$dataDetail[dataDetail].no}</td>
													<td>{$dataDetail[dataDetail].productName}</td>
													<td style="text-align: right;">{$dataDetail[dataDetail].price}</td>
													<td style="text-align: center;">{$dataDetail[dataDetail].qty}</td>
													<td style="text-align: right;">{$dataDetail[dataDetail].subtotal}</td>
													<td>{$dataDetail[dataDetail].note}</td>
												</tr>
											{/section}
												<tr>
													<td colspan="4"></td>
													<td style="text-align: right;">{$grandtotal}</td>
													<td></td>
												</tr>
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'spb' AND $act == 'finish'}
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
								<h3 class="box-title">Detail Mutasi Stok Sales</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_spb.php?module=spb&act=print&spbID={$spbID}&spbFaktur={$spbFaktur}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="spb.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">ID TRX / TGL</td>
										<td width="5">:</td>
										<td>{$spbNo} / {$orderDate}</td>
									</tr>
									<tr>
										<td>JAM TRANSAKSI</td>
										<td>:</td>
										<td>{$needDate}</td>
									</tr>
									<tr>
										<td>NAMA SALES</td>
										<td>:</td>
										<td>{$supplierName}</td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td>{$note}</td>
									</tr>
									<tr>
										<td colspan="3"><br></td>
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
												<th>NOTE</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataDetail loop=$dataDetail}
												<tr>
													<td>{$dataDetail[dataDetail].no}</td>
													<td>{$dataDetail[dataDetail].productName}</td>
													<td style="text-align: right;">{$dataDetail[dataDetail].price}</td>
													<td style="text-align: center;">{$dataDetail[dataDetail].qty}</td>
													<td style="text-align: right;">{$dataDetail[dataDetail].subtotal}</td>
													<td>{$dataDetail[dataDetail].note}</td>
												</tr>
											{/section}
												<tr>
													<td colspan="4"></td>
													<td style="text-align: right;">{$grandtotal}</td>
													<td></td>
												</tr>
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'spb' && $act == 'search'}
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="spb.php">
											<input type="hidden" name="module" value="spb">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="{$endDate}" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" id="startDate" name="startDate" value="{$startDate}" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : Nomor PO" style="float: right; width: 270px;" required>
										
											<a href="spb.php?module=spb&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Tambah</button></a>
											<a href="print_spb.php?act=print&q={$q}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>NO TRX <i class="fa fa-sort"></i></th>
												<th>TGL TRX <i class="fa fa-sort"></i></th>
												<th>JAM TRANSAKSI <i class="fa fa-sort"></i></th>
												<th>NAMA SALES <i class="fa fa-sort"></i></th>
												<th>STATUS <i class="fa fa-sort"></i></th>
												<th>DISERAHKAN OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataSpb loop=$dataSpb}
												<tr>
													<td>{$dataSpb[dataSpb].no}</td>
													<td>{$dataSpb[dataSpb].spbNo}</td>
													<td>{$dataSpb[dataSpb].orderDate}</td>
													<td>{$dataSpb[dataSpb].needDate}</td>
													<td>{$dataSpb[dataSpb].supplierName}</td>
													<td>{$dataSpb[dataSpb].status}</td>
													<td>{$dataSpb[dataSpb].staffName}</td>
													<td>
														<a title="Detail" href="spb.php?module=spb&act=detailtrf&spbID={$dataSpb[dataSpb].spbID}&spbFaktur={$dataSpb[dataSpb].spbFaktur}&q={$q}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="spb.php?module=spb&act=delete&spbID={$dataSpb[dataSpb].spbID}&spbFaktur={$dataSpb[dataSpb].spbFaktur}&spbNo={$dataSpb[dataSpb].spbNo}" onclick="return confirm('Anda Yakin ingin menghapus transaksi {$dataSpb[dataSpb].spbNo}?');"><img src="img/icons/delete.png" width="18"></a>
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
										<form method="GET" action="spb.php">
											<input type="hidden" name="module" value="spb">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="{$endDate}" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" id="startDate" name="startDate" value="{$startDate}" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : Nomor PO" style="float: right; width: 270px;">
										
											<a href="spb.php?module=spb&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Tambah</button></a>
											<a href="print_spb.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>NO TRX <i class="fa fa-sort"></i></th>
												<th>TGL TRX <i class="fa fa-sort"></i></th>
												<th>JAM TRANSAKSI <i class="fa fa-sort"></i></th>
												<th>NAMA SALES <i class="fa fa-sort"></i></th>
												<th>STATUS <i class="fa fa-sort"></i></th>
												<th>DISERAHKAN OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataSpb loop=$dataSpb}
												<tr>
													<td>{$dataSpb[dataSpb].no}</td>
													<td>{$dataSpb[dataSpb].spbNo}</td>
													<td>{$dataSpb[dataSpb].orderDate}</td>
													<td>{$dataSpb[dataSpb].needDate}</td>
													<td>{$dataSpb[dataSpb].supplierName}</td>
													<td>{$dataSpb[dataSpb].status}</td>
													<td>{$dataSpb[dataSpb].staffName}</td>
													<td>
														<a title="Detail" href="spb.php?module=spb&act=detailtrf&spbID={$dataSpb[dataSpb].spbID}&spbFaktur={$dataSpb[dataSpb].spbFaktur}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="spb.php?module=spb&act=delete&spbID={$dataSpb[dataSpb].spbID}&spbFaktur={$dataSpb[dataSpb].spbFaktur}&spbNo={$dataSpb[dataSpb].spbNo}" onclick="return confirm('Anda Yakin ingin menghapus transaksi {$dataSpb[dataSpb].spbNo}?');"><img src="img/icons/delete.png" width="18"></a>
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