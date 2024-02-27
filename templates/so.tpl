{include file="header.tpl"}

<style>
	div.ui-datepicker{
		font-size:14px;
	}
	

    .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        transition: opacity 500ms;
        visibility: hidden;
        opacity: 0;
      }
      .overlay:target {
        visibility: visible;
        opacity: 1;
      }
      
      .popup {
        margin: 70px auto;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        width: 30%;
        position: relative;
        transition: all 5s ease-in-out;
      }
      
      .popup h2 {
        margin-top: 0;
        color: #333;
        font-family: Tahoma, Arial, sans-serif;
      }
      .popup .close {
        position: absolute;
        top: 20px;
        right: 30px;
        transition: all 200ms;
        font-size: 30px;
        font-weight: bold;
        text-decoration: none;
        color: #333;
      }
      .popup .close:hover {
        color: #06D85F;
      }
      .popup .content {
        max-height: 30%;
        overflow: auto;
      }
      
      @media screen and (max-width: 700px){
        .box{
          width: 70%;
        }
        .popup{
          width: 70%;
        }
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
			
			$('#needDate').change(function () {
				var soNo = $("#soNo").val();
				var needDate = $("#needDate").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_so_needdate.php',
					dataType: 'JSON',
					data:{
						soNo: soNo,
						needDate: needDate
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "so.php?module=so&act=add";
					}
				});
			});
			
			$('#orderDate').change(function () {
				var soNo = $("#soNo").val();
				var orderDate = $("#orderDate").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_so_orderdate.php',
					dataType: 'JSON',
					data:{
						soNo: soNo,
						orderDate: orderDate
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "so.php?module=so&act=add";
					}
				});
			});
			
			$('#note').change(function () {
				var soNo = $("#soNo").val();
				var note = $("#note").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_so_note.php',
					dataType: 'JSON',
					data:{
						soNo: soNo,
						note: note
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "so.php?module=so&act=add";
					}
				});
			}); 

			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#so").submit(function() { return false; });
			$("#so2").submit(function() { return false; });

			var sisastock = {};
			$("#productBarcode").autocomplete("product_so_autocomplete.php", {
				width: 310
			}).result(function(event, item, a) {
				var myarr = item[0].split(" # ");
				
				document.getElementById('productBarcode').value = myarr[0];
				document.getElementById('productName1').value = myarr[1];
				document.getElementById('productName').value = myarr[1];
				document.getElementById('productID').value = myarr[2];
				document.getElementById('unitPrice1').value = myarr[3];
				document.getElementById('unitPrice2').value = myarr[4];
				document.getElementById('unitPrice3').value = myarr[5];
				document.getElementById('price').value = myarr[6];
				document.getElementById('qty').value = myarr[7];
				sisastock = myarr[7];
				$("#qty").attr({
				"max" : sisastock, 
				"min" : 0  
				});
			}); 

			$("#customerID").change(function(e){
				var customerID = $("#customerID").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_so_customer.php',
					dataType: 'JSON',
					data:{
						customerID: customerID
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "so.php?module=so&act=add";
					}
				});
			});

			$("#pajak").change(function(e){
				var pajak = $("#pajak").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_so_pajak.php',
					dataType: 'JSON',
					data:{
						pajak: pajak
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "so.php?module=so&act=add";
					}
				});
			});

			$("#factory").change(function(e){
				var factory = $("#factory").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_so_factory.php',
					dataType: 'JSON',
					data:{
						factory: factory
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "so.php?module=so&act=add";
					}
				});
			});

			$("#send2").on("click", function(){
				var soNo = $("#soNo").val();
				var productID = $("#productID").val();
				var productName1 = $("#productName1").val();
				var qty = parseInt($("#qty").val());
				var price = parseInt($("#price").val());
				var desc = $("#desc").val();
				
				if (qty <= sisastock && qty > 0 && soNo != '' && productID != '' && price > 0){
					
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
		 function pricing(price) { 
			temp =  price.replace(/[^a-zA-Z 0-9]+/g,''); 
			str = temp.substring(0, temp.length - 2);
            $("#price").val(str);
         }
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
						
						{if $module == 'so' AND $act == 'add'}
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
								<h3 class="box-title">Tambah Sales Order</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="so.php?module=so&act=cancel" onclick="return confirm('Anda Yakin ingin membatalkan SO ini?');"><button class="btn btn-default pull-right">Batal Trx</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="so.php?module=so&act=input">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">NO FAKTUR / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="soNo" name="soNo" value="{$soNo}">
											<input type="text" id="soNo" name="soNo" value="{$soFaktur}" class="form-control" placeholder="NO SO" style="width: 110px; float: left" requireds disabled>
											<input type="text" id="orderDate" name="orderDate" value="{$orderDateIndo}" class="form-control" placeholder="Tanggal PO" style="width: 160px;" required>
										</td>
									</tr>
									<tr>
										<td>TOKO</td>
										<td>:</td>
										<td>
											<select id="customerID" name="customerID" class="form-control" style="width: 270px;" required>
												<option value=""></option>
												{section name=dataCustomer loop=$dataCustomer}
													{if $dataCustomer[dataCustomer].customerID == $customerID}
														<option value="{$dataCustomer[dataCustomer].customerID}" SELECTED>{$dataCustomer[dataCustomer].customerName} [{$dataCustomer[dataCustomer].customerCode}]</option>
													{else}
														<option value="{$dataCustomer[dataCustomer].customerID}">{$dataCustomer[dataCustomer].customerName} [{$dataCustomer[dataCustomer].customerCode}]</option>
													{/if}
												{/section}
											</select>
										</td>
									</tr>
									<tr>
										<td>SALES</td>
										<td>:</td>
										<td>
											<select id="needDate" name="needDate" class="form-control" style="width: 270px;" required>
												<option value=""></option>
												{section name=dataSupplier loop=$dataSupplier}
													{if $dataSupplier[dataSupplier].supplierID == $needDateIndo}
														<option value="{$dataSupplier[dataSupplier].supplierID}" SELECTED>{$dataSupplier[dataSupplier].supplierName} [{$dataSupplier[dataSupplier].supplierCode}]</option>
													{else}
														<option value="{$dataSupplier[dataSupplier].supplierID}">{$dataSupplier[dataSupplier].supplierName} [{$dataSupplier[dataSupplier].supplierCode}]</option>
													{/if}
												{/section}
											</select>
										</td>
										<td>GUDANG</td>
										<td>:</td>
										<td>
											<select id="factory" name="factory" class="form-control" style="width: 160px;" required>
												<option value="sfa">Stok Sales</option>
												{section name=dataFactory loop=$dataFactory}
													{if $dataFactory[dataFactory].factoryID == $factory}
														<option value="{$dataFactory[dataFactory].factoryID}" SELECTED>{$dataFactory[dataFactory].factoryName} [{$dataFactory[dataFactory].factoryCode}]</option>
													{else}
														<option value="{$dataFactory[dataFactory].factoryID}">{$dataFactory[dataFactory].factoryName} [{$dataFactory[dataFactory].factoryCode}]</option>
													{/if}
												{/section}
											</select>
										</td>
									</tr> 
									<tr>
										<td>PEMBAYARAN</td>
										<td>:</td>
										<td>
											<select id="note" name="note" class="form-control" required>
												<option value="{$note}">{$note}</option>
												<option value="Tunai">Tunai</option>
												<option value="Hutang">Hutang</option>
												<option value="Transfer">Transfer</option>
											</select>
										</td>
                                        <td>PAJAK</td>
										<td>:</td>
										<td>
                                             <input type="number" name="pajak" id="pajak" value="{$pajak}" class="form-control" style="width: 160px;">
										</td>
									</tr>
                                    
									<tr>
										<td colspan="3">
											<br> 
											{if $customerID != '' AND $supplierID != ''}
											<a href="#inline" class="modalbox"><button class="btn btn-default pull-left"><i class="fa fa-plus"></i> Add</button></a>
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
											{section name=dataDetilSo loop=$dataDetilSo}
												<tr>
													<td>{$dataDetilSo[dataDetilSo].no}</td>
													<td>{$dataDetilSo[dataDetilSo].productName}</td>
													<td style='text-align: right;'>{$dataDetilSo[dataDetilSo].price}</td>
													<td style='text-align: center;'>{$dataDetilSo[dataDetilSo].qty}</td>
													<td style='text-align: right;'>{$dataDetilSo[dataDetilSo].subtotal}</td>
													<td>{$dataDetilSo[dataDetilSo].note}</td>
													<td>
														<a title="Edit" href="edit_so.php?module=so&act=edit&detailID={$dataDetilSo[dataDetilSo].detailID}" data-width="550" data-height="230" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="so.php?module=so&act=deletedetail&detailID={$dataDetilSo[dataDetilSo].detailID}" onclick="return confirm('Anda Yakin ingin menghapus item produk {$dataDetilSo[dataDetilSo].productName}?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br>
								<br>
								{if $numsDetilSo > 0}
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
											<form id="so" name="so" method="POST" action="#">
											<input type="hidden" id="soNo" name="soNo" value="{$soNo}">
											<table cellpadding="3" cellspacing="3">
												<tr>
													<td width="140">Kode Produk</td>
													<td width="5">:</td>
													<td><input type="text" id="productBarcode" name="productBarcode" class="form-control" placeholder="Kode atau Nama Produk" style="width: 360px;" required></td>
												</tr>
												<tr>
													<td colspan="2"></td>
													<td><input type="hidden" id="productID" name="productID">
														<input type="hidden" id="productName1" name="productName1">
														<input type="text" id="productName" name="productName" class="form-control" placeholder="Nama Produk" style="width: 360px;" DISABLED>
													</td>
												</tr>
												<tr>
													<td>Harga Satuan</td>
													<td>:</td>
													<td><input id="unitPrice1" name="unitPrice1" class="form-control" placeholder="Harga 1" style="width: 120px; float: left;" value="" onclick="pricing(this.value);" readonly>
														<input id="unitPrice2" name="unitPrice2" class="form-control" placeholder="Harga 2" style="width: 120px; float: left;" value="" onclick="pricing(this.value);" readonly>
														<input id="unitPrice3" name="unitPrice3" class="form-control" placeholder="Harga 3" style="width: 120px;;" value="" onclick="pricing(this.value);" readonly>
													</td>
												</tr>
												<tr>
													<td>Masukan Harga</td>
													<td>:</td>
													<td><input type="number" id="price" name="price" class="form-control" placeholder="Harga Satuan" style="width: 360px;" value="" required></td>
												</tr>
												<tr>
													<td>Qty</td>
													<td>:</td>
													<td><input type="number" id="qty" name="qty" class="form-control" placeholder="Qty Produk" style="width: 360px;" required></td>
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
							
						{elseif $module == 'so' AND $act == 'detailso'}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Detail Sales Order</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_so.php?module=so&act=print&soID={$soID}&soFaktur={$soFaktur}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										{if $q != ''}
											<a href="so.php?module=so&act=search&q={$q}&page={$pageNumber}"><button class="btn btn-default pull-right">Back</button></a>
										{else}
											<a href="so.php?page={$pageNumber}"><button class="btn btn-default pull-right">Back</button></a>
										{/if}
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">NO SO / TGL</td>
										<td width="5">:</td>
										<td>{$soNo} / {$orderDate}</td>
									</tr>
									<tr>
										<td>SALES</td>
										<td>:</td>
										<td>{$needDate} <small>({$factory})</small></td>
									</tr>
									<tr>
										<td>TOKO</td>
										<td>:</td>
										<td>{$customerName}</td>
									</tr>
									<tr>
										<td>PEMBAYARAN</td>
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
							
						{elseif $module == 'so' AND $act == 'finish'}
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
								<h3 class="box-title">Detail Sales Order</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_so.php?module=so&act=print&soID={$soID}&soFaktur={$soFaktur}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="so.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">NO SO / TGL</td>
										<td width="5">:</td>
										<td>{$soNo} / {$orderDate}</td>
									</tr>
									<tr>
										<td>SALES</td>
										<td>:</td>
										<td>{$needDate} <small>({$factory})</small></td>
									</tr>
									<tr>
										<td>CUSTOMER</td>
										<td>:</td>
										<td>{$customerName}</td>
									</tr>
									<tr>
										<td>PEMBAYARAN</td>
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
												<th>PEMBAYARAN</th>
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
							
						{elseif $module == 'so' && $act == 'search'}
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="so.php">
											<input type="hidden" name="module" value="so">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="{$endDate}" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" id="startDate" name="startDate" value="{$startDate}" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : Nomor SO" style="float: right; width: 270px;">
										
											<a href="#add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Tambah Penjualan</button></a>
											<a href="print_so.php?act=print&q={$q}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>TANGGAL <i class="fa fa-sort"></i></th>
												<th>NO FAKTUR <i class="fa fa-sort"></i></th>
												<th>TOKO <i class="fa fa-sort"></i></th> 
												<th>SALES <i class="fa fa-sort"></i></th>
												<th>STATUS <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataSo loop=$dataSo}
												<tr>
													<td>{$dataSo[dataSo].orderDate}</td>
													<td>{$dataSo[dataSo].soFaktur}</td>  
													<td>{$dataSo[dataSo].customerName}</td>
                                                    <td>{$dataSo[dataSo].needDate}</td>
													<td>{$dataSo[dataSo].status}</td>
													<td>{$dataSo[dataSo].staffName}</td>
													<td>
														<a title="Detail" href="so.php?module=so&act=detailso&soID={$dataSo[dataSo].soID}&soFaktur={$dataSo[dataSo].soFaktur}&q={$q}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="so.php?module=so&act=delete&soID={$dataSo[dataSo].soID}&soFaktur={$dataSo[dataSo].soFaktur}&soNo={$dataSo[dataSo].soNo}" onclick="return confirm('Anda Yakin ingin menghapus transaksi {$dataSo[dataSo].soNo}?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
                                <div id="add" class="overlay">
                                    <div class="popup">
                                        <h3>Nomor Faktur</h3>
                                        <a class="close" href="#">&times;</a>
                                        <div class="content">
                                            <form method="post" action="so.php?module=so&act=add">
                                                <input type="number" name="faktur" placeholder="Masukkan nomor faktur. . ." required>
                                                <button type="submit">Lanjut</button> 
                                            </form>
                                        </div>
                                    </div>
                                </div>
							</div><!-- /.box-body -->
						
						{else}
						<div id="add" class="overlay">
							<div class="popup">
								<h3>Nomor Faktur</h3>
								<a class="close" href="#">&times;</a>
								<div class="content">
									<form method="post" action="so.php?module=so&act=add">
										<input type="number" name="faktur" placeholder="Masukkan nomor faktur. . ." required>
										<button type="submit">Lanjut</button> 
									</form>
								</div>
							</div>
						</div>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="so.php">
											<input type="hidden" name="module" value="so">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="{$endDate}" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" id="startDate" name="startDate" value="{$startDate}" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : Nomor SO" style="float: right; width: 270px;">
										
											<a href="#add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Tambah Penjualan</button></a>
											<a href="print_so.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
                                                <th>TANGGAL <i class="fa fa-sort"></i></th> 
												<th>NO FAKTUR<i class="fa fa-sort"></i></th>  
												<th>TOKO <i class="fa fa-sort"></i></th>
                                                <th>SALES <i class="fa fa-sort"></i></th>
												<th>STATUS <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataSo loop=$dataSo}
												<tr>
                                                    <td>{$dataSo[dataSo].orderDate}</td>
													<td>{$dataSo[dataSo].soFaktur}</td>  
													<td>{$dataSo[dataSo].customerName}</td>
                                                    <td>{$dataSo[dataSo].needDate}</td>
													<td>{$dataSo[dataSo].status}</td>
													<td>{$dataSo[dataSo].staffName}</td>
													<td>
														<a title="Detail" href="so.php?module=so&act=detailso&soID={$dataSo[dataSo].soID}&soFaktur={$dataSo[dataSo].soFaktur}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="so.php?module=so&act=delete&soID={$dataSo[dataSo].soID}&soFaktur={$dataSo[dataSo].soFaktur}&soNo={$dataSo[dataSo].soNo}" onclick="return confirm('Anda Yakin ingin menghapus transaksi {$dataSo[dataSo].soNo}?');"><img src="img/icons/delete.png" width="18"></a>
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