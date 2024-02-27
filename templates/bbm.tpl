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
			
			$( "#receiveDate" ).datepicker({
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
			
			$('#receiveDate').change(function () {
				var bbmNo = $("#bbmNo").val();
				var bbmID = $("#bbmID").val();
				var spbNo = $("#spbNo").val();
				var receiveDate = $("#receiveDate").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_bbm_receivedate.php',
					dataType: 'JSON',
					data:{
						bbmNo: bbmNo,
						bbmID: bbmID,
						receiveDate: receiveDate
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "bbm.php?module=bbm&act=add&spbNo=" + spbNo;
					}
				});
			});
			
			$('#note').change(function () {
				var bbmNo = $("#bbmNo").val();
				var bbmID = $("#bbmID").val();
				var spbNo = $("#spbNo").val();
				var note = $("#note").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_bbm_note.php',
					dataType: 'JSON',
					data:{
						bbmNo: bbmNo,
						bbmID: bbmID,
						note: note
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "bbm.php?module=bbm&act=add&spbNo=" + spbNo;
					}
				});
			});
			
			$('#spbNo').change(function () {
				var bbmNo = $("#bbmNo").val();
				var bbmID = $("#bbmID").val();
				var spbNo = $("#spbNo").val(); 
				
				$.ajax({
					type: 'POST',
					url: 'save_bbm_spb.php',
					dataType: 'JSON',
					data:{
						bbmNo: bbmNo,
						bbmID: bbmID,
						spbNo: spbNo
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "bbm.php?module=bbm&act=add&spbNo=" + spbNo;
					}
				});
			});

			$('#supplierName').change(function () {
				var supplierName = $("#supplierName").val();
				var spbNo = $("#spbNo").val(); 
				$.ajax({
					type: 'POST',
					url: 'ajax/save_bbm_spb.php',
					dataType: 'JSON',
					data:{ 
						supplierName: supplierName
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "bbm.php?module=bbm&act=add&spbNo=" + spbNo;
					}
				});
			});
		
			 
			$("#productBarcode").autocomplete("product_bbm_autocomplete.php", {
				width: 310
			}).result(function(event, item, a) {
				var myarr = item[0].split(" # ");
				
				document.getElementById('productBarcode').value = myarr[0];
				document.getElementById('productName1').value = myarr[1];
				document.getElementById('productName').value = myarr[1];
				document.getElementById('productID').value = myarr[2];
				document.getElementById('priced').value = myarr[3];

			});
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#bbm").submit(function() { return false; });
			$("#bbm2").submit(function() { return false; });
			
			$("#send2").on("click", function(){
				var bbmNo = $("#bbmNo").val();
				var productID = $("#productID").val();
				var productName1 = $("#productName1").val();
				var qty = parseInt($("#qtys").val());
				var price = parseInt($("#price").val());
				var desc = $("#desc").val();
				var supplierName = $("#supplierName").val();
				 
					
					$.ajax({
						type: 'POST',
						url: 'save_bbm.php',
						dataType: 'JSON',
						data:{
							qty: qty,
							price: price,
							bbmNo: bbmNo,
							productID: productID,
							productName1: productName1,
							desc: desc
						},
						beforeSend: function (data) {
							$('#send2').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "bbm.php?module=bbm&act=add&supplierName="+supplierName;
						}
					}); 
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
						
						{if $module == 'bbm' AND $act == 'add'}
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
									
									function hapus(detailID){ 
										var spbNo = $("#spbNo").val(); 
										$.ajax({
											type: 'POST',
											url: 'ajax/revoke_bbm_product.php',
											dataType: 'JSON',
											data:{ 
												detailID: detailID
											},
											success: function(data) {
												setTimeout("$.fancybox.close()", 1000);
												window.location.href = "bbm.php?module=bbm&act=add&spbNo=" + spbNo;
											}
										});
									};
								</script>
							{/literal}
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Tambah Penerimaan Barang</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="bbm.php?module=bbm&act=cancel" onclick="return confirm('Anda Yakin ingin membatalkan bukti barang masuk ini?');"><button class="btn btn-default pull-right">Batal Trx</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="bbm.php?module=bbm&act=input">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">ID / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="bbmNo" name="bbmNo" value="{$bbmNo}">
											<input type="hidden" id="bbmID" name="bbmID" value="{$bbmID}">
											<input type="text" id="bbmNo" name="bbmNo" value="{$bbmNo}" class="form-control" placeholder="ID BBM" style="width: 110px; float: left" DISABLED>
											<input type="text" id="receiveDate" name="receiveDate" value="{$receiveDate}" class="form-control" placeholder="Tanggal Penerimaan" style="width: 160px;" required>
										</td>
									</tr>
									<tr valign="top">
										<td>ALOKASI DARI</td>
										<td>:</td>
										<td>
											<input type="text" id="spbNo" name="spbNo" value="{$spbNo}" class="form-control" placeholder="NAMA" style="width: 270px;" required> 
										</td>
									</tr>
									<tr>
										<td>ALOKASI KE</td>
										<td>:</td>
										<td>
											<select id="supplierName" name="supplierName" class="form-control" placeholder="GUDANG"  required> 
												{section name=dataFactory loop=$dataFactory} 
													{if {$dataFactory[dataFactory].factoryID} == $supplierName}
														<option value="{$dataFactory[dataFactory].factoryID}" SELECTED>{$dataFactory[dataFactory].factoryName} [{$dataFactory[dataFactory].factoryCode}]</option>
													{else}
														<option value="{$dataFactory[dataFactory].factoryID}">{$dataFactory[dataFactory].factoryName} [{$dataFactory[dataFactory].factoryCode}]</option>
													{/if} 
												{/section}
											</select> 
										</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td>
												<input type="hidden" id="orderDate" name="orderDate" value="{$orderDate}"><input type="hidden" id="needDate" name="needDate" value="{$needDate}"> 
												<input type="hidden" id="orderDate" name="orderDate" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED>
												<input type="hidden" id="orderDate" name="needDate" class="form-control" placeholder="Tgl Dibutuhkan" style="width: 135px;" DISABLED>
										</td> 
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td>
												<input type="text" value="{$note}" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;">
										</td>
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
												<th>NOTE</th> 
												<th>JUMLAH BARANG</th>  
											</tr>
										</thead>
										<tbody> 
											{section name=dataDetail loop=$dataDetail}
												<tr>
													<td>{$dataDetail[dataDetail].no} <input type="hidden" name="detailID[]" id="detailID" value="{$dataDetail[dataDetail].detailID}"></td>
													<td>{$dataDetail[dataDetail].productName} 
														<input type="hidden" name="productName[]" id="productName" value="{$dataDetail[dataDetail].productName}"> 
														<input type="hidden" name="productID[]" id="productID" value="{$dataDetail[dataDetail].productID}">
													</td>
													<td>{$dataDetail[dataDetail].note} 
														<input type="hidden" name="notedetail[]" id="notedetail" value="{$dataDetail[dataDetail].note}">
													</td>
													<td style='text-align: center;'>
														<input type="hidden" name="qty[]" id="qty" value="{$dataDetail[dataDetail].qty}"> 
														<input type="hidden" name="price[]" id="price" value="{$dataDetail[dataDetail].price}">
														<input type="hidden" value="{$supplierName}" id="factory" name="factory[]" class="form-control"> 
														<input type="number" value="{$dataDetail[dataDetail].qty}" id="receiveQty" name="receiveQty[]" class="form-control" placeholder="Jml" style="width: 100px;" required>
														
													</td>
													<td style="vertical-align: middle;">
														<a href="#" onclick="hapus({$dataDetail[dataDetail].detailID});" style="padding:5px;background-color:red;color:white;font-weight:bold;border-radius:15px;border: white solid 1px;"> hapus </button> 
													</td> 
												</tr>
											{/section} 
										</tbody>
									</table>
								</div>
								<br>
								<br>
								{if $numsSpb > 0}
									{if $numsBbm > 0 AND $spbNo != ''}
									{else}
										<button type="submit" class="btn btn-primary">Simpan</button>
									{/if}
								{/if}
								</form>
							
							</div><!-- /.box-body -->

							<div id="inline">	
								<table width="95%" align="center">
									<tr>
										<td colspan="3"><h3>Tambah Item</h3></td>
									</tr>
									<tr>
										<td>
											<form id="bbm" name="bbm" method="POST" action="#">
											<input type="hidden" id="bbmNo" name="bbmNo" value="{$bbmNo}">
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
													<td><input type="number" id="priced" name="price" class="form-control" placeholder="Harga Satuan" style="width: 270px;" required></td>
												</tr>
												<tr>
													<td>Qty</td>
													<td>:</td>
													<td><input type="number" id="qtys" name="qty" class="form-control" placeholder="Qty Produk" style="width: 270px;" required></td>
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
							
						{elseif $module == 'bbm' AND $act == 'finish'}
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
								<h3 class="box-title">Bukti Penerimaan Barang</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_bbm.php?module=bbm&act=print&bbmID={$bbmID}&bbmNo={$bbmNo}&bbmFaktur={$bbmFaktur}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="bbm.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">ID / TGL PENERIMAAN</td>
										<td width="5">:</td>
										<td><input type="text" id="bbmNo" name="bbmNo" value="{$bbmNo}" class="form-control" placeholder="ID BBM" style="width: 110px; float: left" DISABLED>
											<input type="text" id="receiveDate" name="receiveDate" value="{$receiveDate}" class="form-control" placeholder="Tanggal Penerimaan" style="width: 160px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>ALOKASI DARI</td>
										<td>:</td>
										<td><input type="text" id="spbNo" name="spbNo" value="{$spbNo}" class="form-control" placeholder="NAMA" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>ALOKASI KE</td>
										<td>:</td>
										<td><input type="text" id="supplierName" name="supplierName" value="{$supplierName}" class="form-control" placeholder="GUDANG /ADMIN" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td>
											<input type="hidden" id="orderDate" name="orderDate" value="{$orderDate}" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED>
											<input type="hidden" id="orderDate" name="needDate" value="{$needDate}" class="form-control" placeholder="Tgl Dibutuhkan" style="width: 135px;" DISABLED>
										</td>
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
												<th>JUMLAH BARANG</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataBbmDetail loop=$dataBbmDetail}
												<tr>
													<td>{$dataBbmDetail[dataBbmDetail].no}</td>
													<td>{$dataBbmDetail[dataBbmDetail].productName}</td>
													<td>{$dataBbmDetail[dataBbmDetail].note}</td> 
													<td style='text-align: center;'>{$dataBbmDetail[dataBbmDetail].receiveQty}</td> 
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'bbm' AND $act == 'detailbbm'}
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Bukti Penerimaan Barang</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_bbm.php?module=bbm&act=print&bbmID={$bbmID}&bbmNo={$bbmNo}&bbmFaktur={$bbmFaktur}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										{if $q != ''}
											<a href="bbm.php?module=bbm&act=search&q={$q}&page={$page}"><button class="btn btn-default pull-right">Back</button></a>
										{else}
											<a href="bbm.php?page={$page}"><button class="btn btn-default pull-right">Back</button></a>
										{/if}
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">ID / TGL</td>
										<td width="5">:</td>
										<td><input type="text" id="bbmNo" name="bbmNo" value="{$bbmNo}" class="form-control" placeholder="ID BBM" style="width: 110px; float: left" DISABLED>
											<input type="text" id="receiveDate" name="receiveDate" value="{$receiveDate}" class="form-control" placeholder="Tanggal Penerimaan" style="width: 160px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>ALOKASI DARI</td>
										<td>:</td>
										<td><input type="text" id="spbNo" name="spbNo" value="{$spbNo}" class="form-control" placeholder="NAMA" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>ALOKASI KE</td>
										<td>:</td>
										<td><input type="text" id="supplierName" name="supplierName" value="{$supplierName}" class="form-control" placeholder="GUDANG / ADMIN" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td>
											<input type="hidden" id="orderDate" name="orderDate" value="{$orderDate}" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED>
											<input type="hidden" id="orderDate" name="needDate" value="{$needDate}" class="form-control" placeholder="Tgl Dibutuhkan" style="width: 135px;" DISABLED>
										</td>
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
												<th>JUMLAH BARANG</th> 
											</tr>
										</thead>
										<tbody>
											{section name=dataBbmDetail loop=$dataBbmDetail}
												<tr>
													<td>{$dataBbmDetail[dataBbmDetail].no}</td>
													<td>{$dataBbmDetail[dataBbmDetail].productName}</td>
													<td>{$dataBbmDetail[dataBbmDetail].note}</td> 
													<td style='text-align: center;'>{$dataBbmDetail[dataBbmDetail].receiveQty}</td> 
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
						
						{elseif $module == 'bbm' AND $act == 'search'}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="bbm.php">
											<input type="hidden" name="module" value="bbm">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : Nomor Bukti Barang Masuk" style="float: right; width: 270px;">
										
											<a href="bbm.php?module=bbm&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_bbm.php?act=print&q={$q}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>NO BBM <i class="fa fa-sort"></i></th>
												<th>ALOKASI DARI <i class="fa fa-sort"></i></th>
												<th>ALOKASI KE <i class="fa fa-sort"></i></th>
												<th>TGL PENERIMAAN <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataBbm loop=$dataBbm}
												<tr>
													<td>{$dataBbm[dataBbm].no}</td>
													<td>{$dataBbm[dataBbm].bbmNo}</td>
													<td>{$dataBbm[dataBbm].spbNo}</td>
													<td>{$dataBbm[dataBbm].supplierName}</td>
													<td>{$dataBbm[dataBbm].receiveDate}</td>
													<td>{$dataBbm[dataBbm].staffName}</td>
													<td>
														<a title="Detail" href="bbm.php?module=bbm&act=detailbbm&bbmID={$dataBbm[dataBbm].bbmID}&bbmNo={$dataBbm[dataBbm].bbmNo}&bbmFaktur={$dataBbm[dataBbm].bbmFaktur}&q={$q}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="bbm.php?module=bbm&act=delete&bbmID={$dataBbm[dataBbm].bbmID}&bbmFaktur={$dataBbm[dataBbm].bbmFaktur}&bbmNo={$dataBbm[dataBbm].bbmNo}" onclick="return confirm('Anda Yakin ingin membatalkan transaksi {$dataBbm[dataBbm].bbmNo}?');"><img src="img/icons/delete.png" width="18"></a>
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
										<form method="GET" action="bbm.php">
											<input type="hidden" name="module" value="bbm">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : No Bukti Barang Masuk" style="float: right; width: 270px;">
										
											<a href="bbm.php?module=bbm&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_bbm.php?act=print&q={$q}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>NO BBM <i class="fa fa-sort"></i></th>
												<th>ALOKASI DARI <i class="fa fa-sort"></i></th>
												<th>ALOKASI KE <i class="fa fa-sort"></i></th>
												<th>TGL PENERIMAAN <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataBbm loop=$dataBbm}
												<tr>
													<td>{$dataBbm[dataBbm].no}</td>
													<td>{$dataBbm[dataBbm].bbmNo}</td>
													<td>{$dataBbm[dataBbm].spbNo}</td>
													<td>{$dataBbm[dataBbm].supplierName}</td>
													<td>{$dataBbm[dataBbm].receiveDate}</td>
													<td>{$dataBbm[dataBbm].staffName}</td>
													<td>
														<a title="Detail" href="bbm.php?module=bbm&act=detailbbm&bbmID={$dataBbm[dataBbm].bbmID}&bbmNo={$dataBbm[dataBbm].bbmNo}&bbmFaktur={$dataBbm[dataBbm].bbmFaktur}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="bbm.php?module=bbm&act=delete&bbmID={$dataBbm[dataBbm].bbmID}&bbmFaktur={$dataBbm[dataBbm].bbmFaktur}&bbmNo={$dataBbm[dataBbm].bbmNo}" onclick="return confirm('Anda Yakin ingin membatalkan transaksi {$dataBbm[dataBbm].bbmNo}?');"><img src="img/icons/delete.png" width="18"></a>
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