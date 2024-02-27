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
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#spb").submit(function() { return false; });
			$("#spb2").submit(function() { return false; });
			
			$("#productBarcode").autocomplete("product_spb_autocomplete.php", {
				width: 310
			}).result(function(event, item, a) {
				var myarr = item[0].split(" # ");
				
				document.getElementById('productBarcode').value = myarr[0];
				document.getElementById('productName1').value = myarr[1];
				document.getElementById('productName').value = myarr[1];
				document.getElementById('productID').value = myarr[2];
				
				var optBody = 
					"<option value="+myarr[3]+">Harga 1 : Rp. "+myarr[3]+"</option>"
					+"<option value="+myarr[4]+">Harga 2 : Rp. "+myarr[4]+"</option>"
					+"<option value="+myarr[5]+">Harga 3 : Rp. "+myarr[5]+"</option>"
				
				$("#unitPrice").append(optBody);
				
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
					
			$("#send2").on("click", function(){
				var spbNo = $("#spbNo").val();
				var productID = $("#productID").val();
				var productName1 = $("#productName1").val();
				var unitPrice = parseInt($("#unitPrice").val());
				var qty = parseInt($("#qty").val());
				var desc = $("#desc").val();
				
				if (qty != '' && spbNo != '' && productID != '' && unitPrice != ''){
					
					$.ajax({
						type: 'POST',
						url: 'save_spb.php',
						dataType: 'JSON',
						data:{
							qty: qty,
							spbNo: spbNo,
							productID: productID,
							productName1: productName1,
							unitPrice: unitPrice,
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
								<h3 class="box-title">Tambah Purchase Order</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="spb.php?module=spb&act=cancel" onclick="return confirm('Anda Yakin ingin membatalkan PO ini?');"><button class="btn btn-default pull-right">Batal Trx</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="spb.php?module=spb&act=input">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="120">ID TRX / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="spbNo" name="spbNo" value="{$spbNo}">
											<input type="text" id="spbNo" name="spbNo" value="{$spbNo}" class="form-control" placeholder="ID PO" style="width: 110px; float: left" DISABLED>
											<input type="text" id="orderDate" name="orderDate" value="{$orderDateIndo}" class="form-control" placeholder="Tanggal PO" style="width: 160px;" required>
										</td>
									</tr>
									<tr>
										<td>SUPPLIER</td>
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
										<td width="120">REF</td>
										<td width="5">:</td>
										<td><input type="text" id="ref" name="ref" class="form-control" placeholder="Nomor Referensi" style="width: 270px;"></td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><input type="text" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;"></td>
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
												<th>QTY</th>
												<th>NOTE</th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataDetilTransfer loop=$dataDetilTransfer}
												<tr>
													<td>{$dataDetilTransfer[dataDetilTransfer].no}</td>
													<td>{$dataDetilTransfer[dataDetilTransfer].productName}</td>
													<td>{$dataDetilTransfer[dataDetilTransfer].qty}</td>
													<td>{$dataDetilTransfer[dataDetilTransfer].note}</td>
													<td>
														<a title="Edit" href="edit_transfers.php?module=transfer&act=edit&detailID={$dataDetilTransfer[dataDetilTransfer].detailID}" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="transfers.php?module=transfer&act=deletedetail&detailID={$dataDetilTransfer[dataDetilTransfer].detailID}" onclick="return confirm('Anda Yakin ingin menghapus item produk {$dataDetilTransfer[dataDetilTransfer].productName}?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br>
								<br>
								{if $numsDetilTransfer > 0}
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
													<td>Harga</td>
													<td>:</td>
													<td>
														<select id="unitPrice" name="unitPrice" class="form-control" style="width: 270px;" required>
														</select>
													</td>
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
							
						{elseif $module == 'transfer' AND $act == 'detailtrf'}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Detail Transaksi Transfer Gudang</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_transfers.php?module=transfer&act=print&transferID={$transferID}&transferfaktur={$transferFaktur}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="transfers.php?page={$pageNumber}"><button class="btn btn-default pull-right">Back</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="120">ID TRX / TGL</td>
										<td width="5">:</td>
										<td>{$transferCode} / {$trxIndo}</td>
									</tr>
									<tr>
										<td>FROM</td>
										<td>:</td>
										<td>{$transferFrom}</td>
									</tr>
									<tr>
										<td>TO</td>
										<td>:</td>
										<td>{$transferTo}</td>
									</tr>
									<tr>
										<td width="120">REF</td>
										<td width="5">:</td>
										<td>{$ref}</td>
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
												<th>QTY</th>
												<th>NOTE</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataDetail loop=$dataDetail}
												<tr>
													<td>{$dataDetail[dataDetail].no}</td>
													<td>{$dataDetail[dataDetail].productName}</td>
													<td>{$dataDetail[dataDetail].qty}</td>
													<td>{$dataDetail[dataDetail].note}</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
						{else}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Data Purchase Order</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_spb.php?act=print" target="_blank"><button class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
										<a href="spb.php?module=spb&act=add"><button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>ID PO <i class="fa fa-sort"></i></th>
												<th>TGL PO <i class="fa fa-sort"></i></th>
												<th>TGL DIBUTUHKAN <i class="fa fa-sort"></i></th>
												<th>SUPPLIER <i class="fa fa-sort"></i></th>												
												<th>TOTAL <i class="fa fa-sort"></i></th>
												<th>STATUS <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
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
													<td>{$dataSpb[dataSpb].total}</td>
													<td>{$dataSpb[dataSpb].status}</td>
													<td>{$dataSpb[dataSpb].staffName}</td>
													<td>
														<a title="Detail" href="transfers.php?module=transfer&act=detailtrf&transferID={$dataTransfer[dataTransfer].transferID}&transferFaktur={$dataTransfer[dataTransfer].transferFaktur}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="transfers.php?module=transfer&act=delete&transferID={$dataTransfer[dataTransfer].transferID}&transferFaktur={$dataTransfer[dataTransfer].transferFaktur}" onclick="return confirm('Anda Yakin ingin menghapus kode transaksi {$dataTransfer[dataTransfer].transferCode}?');"><img src="img/icons/delete.png" width="18"></a>
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