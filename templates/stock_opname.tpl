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
			
			$( "#soDate" ).datepicker({
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
			
			$('#factoryID').change(function () {
				var factoryID = $("#factoryID").val();
				
				window.location.href = "stock_opname.php?module=stockopname&act=add&factoryID=" + factoryID;
			});
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#stockopname").submit(function() { return false; });
			$("#stockopname2").submit(function() { return false; });
			
			$("#productCode").autocomplete("product_auto.php", {
				width: 310
			}).result(function(event, item, a) {
				var myarr = item[0].split("#");
				
				document.getElementById('productCode').value = myarr[0];
				document.getElementById('productCode1').value = myarr[0];
				document.getElementById('productName').value = myarr[1];
				document.getElementById('productName1').value = myarr[1];
				document.getElementById('productID').value = myarr[2];
				document.getElementById('productStock').value = myarr[3];
				document.getElementById('productStock1').value = myarr[3];
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
							
						{elseif $module == 'stockopname' && $act == 'search'}
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="stock_opname.php">
											<input type="hidden" name="module" value="stockopname">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="{$endDate}" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" id="startDate" name="startDate" value="{$startDate}" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : Kode or Nama Produk" style="float: right; width: 270px;">
										
											<a href="stock_opname.php?module=stockopname&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_stock_opname.php?act=print&q={$q}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>TGL <i class="fa fa-sort"></i></th>
												<th>NAMA PRODUK <i class="fa fa-sort"></i></th>
												<th>GUDANG <i class="fa fa-sort"></i></th>
												<th>STOK AWAL <i class="fa fa-sort"></i></th>
												<th>STOK NYATA <i class="fa fa-sort"></i></th>
												<th>OPERATOR <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataStockOpname loop=$dataStockOpname}
												<tr>
													<td>{$dataStockOpname[dataStockOpname].no}</td>
													<td>{$dataStockOpname[dataStockOpname].soDate}</td>
													<td>{$dataStockOpname[dataStockOpname].productName}</td>
													<td>{$dataStockOpname[dataStockOpname].factoryName}</td>
													<td>{$dataStockOpname[dataStockOpname].productStock}</td>
													<td>{$dataStockOpname[dataStockOpname].realStock}</td>
													<td>{$dataStockOpname[dataStockOpname].staffName}</td>
													<td>
														<a title="Detail" href="stock_opname.php?module=stockopname&act=detailstockopname&soID={$dataStockOpname[dataStockOpname].soID}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="stock_opname.php?module=stockopname&act=delete&soID={$dataStockOpname[dataStockOpname].soID}&page={$page}" onclick="return confirm('Anda Yakin ingin menghapus stock opname #{$dataStockOpname[dataStockOpname].soID}? penghapusan ini berarti membatalkan stock opname dan akan mengembalikan stok ke awal.');"><img src="img/icons/delete.png" width="18"></a>
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
										<form method="GET" action="stock_opname.php">
											<input type="hidden" name="module" value="stockopname">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="{$endDate}" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" id="startDate" name="startDate" value="{$startDate}" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : Kode or Nama Produk" style="float: right; width: 270px;">
										
											<a href="stock_opname.php?module=stockopname&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_stock_opname.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>TGL <i class="fa fa-sort"></i></th>
												<th>NAMA PRODUK <i class="fa fa-sort"></i></th>
												<th>GUDANG <i class="fa fa-sort"></i></th>
												<th>STOK AWAL <i class="fa fa-sort"></i></th>
												<th>STOK NYATA <i class="fa fa-sort"></i></th>
												<th>OPERATOR <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataStockOpname loop=$dataStockOpname}
												<tr>
													<td>{$dataStockOpname[dataStockOpname].no}</td>
													<td>{$dataStockOpname[dataStockOpname].soDate}</td>
													<td>{$dataStockOpname[dataStockOpname].productName}</td>
													<td>{$dataStockOpname[dataStockOpname].factoryName}</td>
													<td>{$dataStockOpname[dataStockOpname].productStock}</td>
													<td>{$dataStockOpname[dataStockOpname].realStock}</td>
													<td>{$dataStockOpname[dataStockOpname].staffName}</td>
													<td>
														<a title="Detail" href="stock_opname.php?module=stockopname&act=detailstockopname&soID={$dataStockOpname[dataStockOpname].soID}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="stock_opname.php?module=stockopname&act=delete&soID={$dataStockOpname[dataStockOpname].soID}&page={$page}" onclick="return confirm('Anda Yakin ingin menghapus stock opname #{$dataStockOpname[dataStockOpname].soID}? penghapusan ini berarti membatalkan stock opname dan akan mengembalikan stok ke awal.');"><img src="img/icons/delete.png" width="18"></a>
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