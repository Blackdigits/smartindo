{include file="header.tpl"}

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
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#transfer").submit(function() { return false; });
			$("#transfer2").submit(function() { return false; });
			
			$("#productBarcode").autocomplete("product_autocomplete.php", {
				width: 310
			}).result(function(event, item) {
				
				var myarr = item[0].split(" # ");
				
				document.getElementById('productBarcode').value = myarr[0];
				document.getElementById('productName1').value = myarr[1];
				document.getElementById('productName').value = myarr[1];
				document.getElementById('productID').value = myarr[2];
				document.getElementById('stock1').value = myarr[3];
				document.getElementById('stock').value = myarr[3];
			});
			
			$("#transferFrom").change(function(e){
				var transferFrom = $("#transferFrom").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_transfer_from.php',
					dataType: 'JSON',
					data:{
						transferFrom: transferFrom
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "transfers.php?module=transfer&act=add";
					}
				});
			});
			
			$("#transferTo").change(function(e){
				var transferTo = $("#transferTo").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_transfer_to.php',
					dataType: 'JSON',
					data:{
						transferTo: transferTo
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "transfers.php?module=transfer&act=add";
					}
				});
			});
					
			$("#send2").on("click", function(){
				var transferCode = $("#transferCode").val();
				var productID = $("#productID").val();
				var productName1 = $("#productName1").val();
				var qty = parseInt($("#qty").val());
				var desc = $("#desc").val();
				var stock1 = parseInt($("#stock1").val());
				
				if (qty != 0 && transferCode != '' && productID != ''){
					if (qty > stock1) {
						alert("Qty tidak mencukupi jumlah stok.");
						return false;
					} else if (qty <= 0) {
						alert("Qty tidak boleh minus !");
						return false;
					} else if (isNaN(qty)) {
						alert("Jangan lupa masukkan Jumlah Qty !");
						return false;
					}
					else{
					
						$.ajax({
							type: 'POST',
							url: 'save_transfer.php',
							dataType: 'JSON',
							data:{
								qty: qty,
								transferCode: transferCode,
								productID: productID,
								productName1: productName1,
								stock1: stock1,
								desc: desc
							},
							beforeSend: function (data) {
								$('#send2').hide();
							},
							success: function(data) {
								setTimeout("$.fancybox.close()", 1000);
								window.location.href = "transfers.php?module=transfer&act=add&msg=Data berhasil disimpan";
							}
						});
					}
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
						
						{if $module == 'transfer' AND $act == 'add'}
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
								<h3 class="box-title">Tambah Transaksi Transfer Stok</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="transfers.php?module=transfer&act=cancel" onclick="return confirm('Anda Yakin ingin membatalkan transaksi ini?');"><button class="btn btn-default pull-right">Batal Trx</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="transfers.php?module=transfer&act=input">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="120">ID TRX / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="trxDate" value="{$trxDate}" name="trxDate">
											<input type="hidden" id="transferCode" name="transferCode" value="{$transferCode}">
											<input type="text" id="transferCode" name="transferCode" value="{$transferCode} / {$trxIndo}" class="form-control" placeholder="ID Transaksi" style="width: 270px;" DISABLED>
										</td>
									</tr>
									<tr>
										<td>DARI</td>
										<td>:</td>
										<td>
											<select id="transferFrom" name="transferFrom" class="form-control" style="width: 270px;" required>
												<option value=""></option>
												{section name=dataFactory loop=$dataFactory}
													{if $dataFactory[dataFactory].factoryID == $transferFrom}
														<option value="{$dataFactory[dataFactory].factoryID}" SELECTED>{$dataFactory[dataFactory].factoryName}</option>
													{else}
														<option value="{$dataFactory[dataFactory].factoryID}">{$dataFactory[dataFactory].factoryName}</option>
													{/if}
												{/section}
											</select>
										</td>
									</tr>
									<tr>
										<td>UNTUK</td>
										<td>:</td>
										<td>
											<select id="transferTo" name="transferTo" class="form-control" style="width: 270px;" required>
												<option value=""></option>
												{section name=dataStaff loop=$dataStaff}
													{if $dataStaff[dataStaff].staffID == $transferTo}
														<option value="{$dataStaff[dataStaff].staffID}" SELECTED>{$dataStaff[dataStaff].staffName}</option>
													{else}
														<option value="{$dataStaff[dataStaff].staffID}">{$dataStaff[dataStaff].staffName}</option>
													{/if}
												{/section}
											</select>
										</td>
									</tr>
									<tr>
										<td width="120">NO REF</td>
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
											{if $transferFrom != 0 AND $transferTo != 0}
												<a href="#inline" class="modalbox"><button class="btn btn-default pull-left"><i class="fa fa-plus"></i> Tambah Produk</button></a> 
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
											<form id="transfer" name="transfer" method="POST" action="#">
											<input type="hidden" id="transferCode" name="transferCode" value="{$transferCode}">
											<table cellpadding="7" cellspacing="7">
												<tr>
													<td width="140">Kode Produk</td>
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
													<td colspan="2"></td>
													<td><input type="hidden" id="stock1" name="stock1" class="form-control">
														<input type="text" id="stock" name="stock" class="form-control" placeholder="Jumlah Stok" style="width: 270px;" DISABLED>
													</td>
												</tr>
												<tr>
													<td>Qty</td>
													<td>:</td>
													<td><input type="number" min="0" id="qty" name="qty" class="form-control" placeholder="Qty Produk" style="width: 270px;" required></td>
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
										<td>DARI</td>
										<td>:</td>
										<td>{$transferFrom}</td>
									</tr>
									<tr>
										<td>UNTUK</td>
										<td>:</td>
										<td>{$transferTo}</td>
									</tr>
									<tr>
										<td width="120">NO REF</td>
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
								<h3 class="box-title">Data Transaksi Transfer Stok</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_transfers.php?act=print" target="_blank"><button class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
										<a href="transfers.php?module=transfer&act=add"><button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>ID TRX <i class="fa fa-sort"></i></th>
												<th>TANGGAL <i class="fa fa-sort"></i></th>
												<th>REF <i class="fa fa-sort"></i></th>
												<th>DARI <i class="fa fa-sort"></i></th>
												<th>UNTUK <i class="fa fa-sort"></i></th> 
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataTransfer loop=$dataTransfer}
												<tr>
													<td>{$dataTransfer[dataTransfer].no}</td>
													<td>{$dataTransfer[dataTransfer].transferCode}</td>
													<td>{$dataTransfer[dataTransfer].trxDate}</td>
													<td>{$dataTransfer[dataTransfer].ref}</td>
													<td>{$dataTransfer[dataTransfer].from}</td>
													<td>{$dataTransfer[dataTransfer].to}</td> 
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