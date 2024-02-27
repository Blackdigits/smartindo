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
						
						{if $module == 'assembly' AND $act == 'add'}
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
											<input type="text" id="assemblyDate" name="assemblyDate" value="{$assemblyDate}" class="form-control" placeholder="Tanggal Assembly" style="width: 120px;" required>
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
										<td><input type="text" value="{$note}" id="note1" name="note1" class="form-control" placeholder="Note" style="width: 270px;"></td>
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
											{section name=dataDetilAssembly loop=$dataDetilAssembly}
												<tr>
													<td>{$dataDetilAssembly[dataDetilAssembly].no} <input type="hidden" name="detailID[]" value="{$dataDetilAssembly[dataDetilAssembly].detailID}"></td>
													<td>{$dataDetilAssembly[dataDetilAssembly].productName} <input type="hidden" name="productID[]" value="{$dataDetilAssembly[dataDetilAssembly].productID}"> <input type="hidden" name="productName[]" value="{$dataDetilAssembly[dataDetilAssembly].productName}"></td>
													<td style='text-align: right;'>{$dataDetilAssembly[dataDetilAssembly].price} <input type="hidden" name="price[]" value="{$dataDetilAssembly[dataDetilAssembly].priceori}"></td>
													<td style='text-align: center;'>{$dataDetilAssembly[dataDetilAssembly].qty} <input type="hidden" name="kuantiti[]" value="{$dataDetilAssembly[dataDetilAssembly].qty}"></td>
													<td style='text-align: right;'>{$dataDetilAssembly[dataDetilAssembly].subtotal}</td>
													<td>
														<select name="factory[]" id="factory" class="form-control" style="width: 180px;" required>
															<option value=""></option>
															{section name=stok loop=$dataDetilAssembly[dataDetilAssembly].stok}
																<option value="{$dataDetilAssembly[dataDetilAssembly].stok[stok].factoryID}#{$dataDetilAssembly[dataDetilAssembly].stok[stok].factoryCode} {$dataDetilAssembly[dataDetilAssembly].stok[stok].factoryName}#{$dataDetilAssembly[dataDetilAssembly].stok[stok].stock}">{$dataDetilAssembly[dataDetilAssembly].stok[stok].factoryCode} {$dataDetilAssembly[dataDetilAssembly].stok[stok].factoryName} [ Stok : {$dataDetilAssembly[dataDetilAssembly].stok[stok].stock} ]</option>
															{/section}
														</select>
													</td>
													<td>{$dataDetilAssembly[dataDetilAssembly].note} <input type="hidden" name="note[]" value="{$dataDetilAssembly[dataDetilAssembly].note}"></td>
													<td>
														<a title="Edit" href="edit_assembly.php?module=assembly&act=edit&detailID={$dataDetilAssembly[dataDetilAssembly].detailID}" data-width="550" data-height="230" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="assembly.php?module=assembly&act=deletedetail&detailID={$dataDetilAssembly[dataDetilAssembly].detailID}" onclick="return confirm('Anda Yakin ingin menghapus item produk {$dataDetilAssembly[dataDetilAssembly].productName}?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">SUBTOTAL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="subtotal" name="subtotal" value="{$subtotal}"><input type="text" id="subtotalrp" name="subtotalrp" class="form-control" value="{$subtotalrp}" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>ASSEMBLY COST</td>
										<td>:</td>
										<td><input type="text" id="cost" name="cost" class="form-control" style="width: 270px;" value="0" onkeyup="sum();"></td>
									</tr>
									<tr>
										<td>GRANDTOTAL</td>
										<td>:</td>
										<td><input type="hidden" id="grandtotal" name="grandtotal" value="{$subtotal}">
											<input type="text" id="grandtotalrp" name="grandtotalrp" class="form-control" value="{$subtotalrp}" style="width: 270px;" DISABLED></td>
									</tr>
								</table>
								<br>
								{if $numsDetilAssembly > 0}
									<button type="submit" class="btn btn-primary">Simpan</button>
								{else}
									<button type="button" class="btn btn-primary">Simpan</button>
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
											<form id="assembly" name="assembly" method="POST" action="#">
											<input type="hidden" id="assemblyFaktur" name="assemblyFaktur" value="{$assemblyFaktur}">
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
							
						{elseif $module == 'assembly' AND $act == 'detailassembly'}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Detail Assembly</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_assembly.php?module=assembly&act=print&assemblyID={$assemblyID}&assemblyFaktur={$assemblyFaktur}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="assembly.php?page={$pageNumber}"><button class="btn btn-default pull-right">Back</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">KODE ASS / TGL</td>
										<td width="5">:</td>
										<td>{$assemblyCode} / {$assemblyDate}
										</td>
									</tr>
									<tr>
										<td>KODE ITEM</td>
										<td>:</td>
										<td>{$productCode}</td>
									</tr>
									<tr>
										<td>NAMA ITEM</td>
										<td>:</td>
										<td>{$productName}</td>
									</tr>
									<tr>
										<td>QTY</td>
										<td>:</td>
										<td>{$qty}</td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td>{$note}</td>
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
											{section name=dataDetail loop=$dataDetail}
												<tr>
													<td>{$dataDetail[dataDetail].no}</td>
													<td>{$dataDetail[dataDetail].productName}</td>
													<td style='text-align: right;'>{$dataDetail[dataDetail].price}</td>
													<td style='text-align: center;'>{$dataDetail[dataDetail].qty}</td>
													<td style='text-align: right;'>{$dataDetail[dataDetail].subtotal}</td>
													<td>{$dataDetail[dataDetail].factoryName}</td>
													<td>{$dataDetail[dataDetail].note}</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">SUBTOTAL</td>
										<td width="5">:</td>
										<td>{$subtotal}</td>
									</tr>
									<tr>
										<td>ASSEMBLY COST</td>
										<td>:</td>
										<td>{$cost}</td>
									</tr>
									<tr>
										<td>GRANDTOTAL</td>
										<td>:</td>
										<td>{$grandtotal}</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'assembly' AND $act == 'finish'}
							
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
								<h3 class="box-title">Detail Assembly</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_assembly.php?module=assembly&act=print&assemblyID={$assemblyID}&assemblyFaktur={$assemblyFaktur}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="assembly.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">KODE ASS / TGL</td>
										<td width="5">:</td>
										<td>{$assemblyCode} / {$assemblyDate}
										</td>
									</tr>
									<tr>
										<td>KODE ITEM</td>
										<td>:</td>
										<td>{$productCode}</td>
									</tr>
									<tr>
										<td>NAMA ITEM</td>
										<td>:</td>
										<td>{$productName}</td>
									</tr>
									<tr>
										<td>QTY</td>
										<td>:</td>
										<td>{$qty}</td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td>{$note}</td>
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
											{section name=dataDetail loop=$dataDetail}
												<tr>
													<td>{$dataDetail[dataDetail].no}</td>
													<td>{$dataDetail[dataDetail].productName}</td>
													<td style='text-align: right;'>{$dataDetail[dataDetail].price}</td>
													<td style='text-align: center;'>{$dataDetail[dataDetail].qty}</td>
													<td style='text-align: right;'>{$dataDetail[dataDetail].subtotal}</td>
													<td>{$dataDetail[dataDetail].factoryName}</td>
													<td>{$dataDetail[dataDetail].note}</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">SUBTOTAL</td>
										<td width="5">:</td>
										<td>{$subtotal}</td>
									</tr>
									<tr>
										<td>ASSEMBLY COST</td>
										<td>:</td>
										<td>{$cost}</td>
									</tr>
									<tr>
										<td>GRANDTOTAL</td>
										<td>:</td>
										<td>{$grandtotal}</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'assembly' && $act == 'search'}
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="assembly.php">
											<input type="hidden" name="module" value="assembly">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="{$endDate}" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" id="startDate" name="startDate" value="{$startDate}" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : Nomor Assembly" style="float: right; width: 270px;">
										
											<a href="assembly.php?module=assembly&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_assembly.php?act=print&q={$q}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
											{section name=dataAssembly loop=$dataAssembly}
												<tr>
													<td>{$dataAssembly[dataAssembly].no}</td>
													<td>{$dataAssembly[dataAssembly].assemblyCode}</td>
													<td>{$dataAssembly[dataAssembly].assemblyDate}</td>
													<td>{$dataAssembly[dataAssembly].productName}</td>
													<td>{$dataAssembly[dataAssembly].qty}</td>
													<td>{$dataAssembly[dataAssembly].grandtotal}</td>
													<td>{$dataAssembly[dataAssembly].staffName}</td>
													<td>
														<a title="Detail" href="assembly.php?module=assembly&act=detailassembly&assemblyID={$dataAssembly[dataAssembly].assemblyID}&assemblyFaktur={$dataAssembly[dataAssembly].assemblyFaktur}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="assembly.php?module=assembly&act=delete&assemblyID={$dataAssembly[dataAssembly].assemblyID}&assemblyFaktur={$dataAssembly[dataAssembly].assemblyFaktur}" onclick="return confirm('Anda Yakin ingin menghapus transaksi {$dataAssembly[dataAssembly].assemblyCode}? penghapusan ini berarti membatalkan assembly.');"><img src="img/icons/delete.png" width="18"></a>
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
										<form method="GET" action="assembly.php">
											<input type="hidden" name="module" value="assembly">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="{$endDate}" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" id="startDate" name="startDate" value="{$startDate}" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : Nomor Assembly" style="float: right; width: 270px;">
										
											<a href="assembly.php?module=assembly&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_assembly.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
											{section name=dataAssembly loop=$dataAssembly}
												<tr>
													<td>{$dataAssembly[dataAssembly].no}</td>
													<td>{$dataAssembly[dataAssembly].assemblyCode}</td>
													<td>{$dataAssembly[dataAssembly].assemblyDate}</td>
													<td>{$dataAssembly[dataAssembly].productName}</td>
													<td>{$dataAssembly[dataAssembly].qty}</td>
													<td>{$dataAssembly[dataAssembly].grandtotal}</td>
													<td>{$dataAssembly[dataAssembly].staffName}</td>
													<td>
														<a title="Detail" href="assembly.php?module=assembly&act=detailassembly&assemblyID={$dataAssembly[dataAssembly].assemblyID}&assemblyFaktur={$dataAssembly[dataAssembly].assemblyFaktur}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="assembly.php?module=assembly&act=delete&assemblyID={$dataAssembly[dataAssembly].assemblyID}&assemblyFaktur={$dataAssembly[dataAssembly].assemblyFaktur}" onclick="return confirm('Anda Yakin ingin menghapus transaksi {$dataAssembly[dataAssembly].assemblyCode}? penghapusan ini berarti membatalkan assembly.');"><img src="img/icons/delete.png" width="18"></a>
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
										<!--<li><a href="#">&laquo;</a></li>
										<li><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">&raquo;</a></li>-->
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