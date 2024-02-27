{include file="header.tpl"}

<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<script type="text/javascript" src="design/js/ajaxupload.3.5.js" ></script>
<link rel="stylesheet" type="text/css" href="design/css/Ajaxfile-upload.css" />

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
			
			$(".various3").fancybox({
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
			
			// Image 
			var btnUpload=$('#me');
			var mestatus=$('#mestatus');
			var files=$('#files');
			new AjaxUpload(btnUpload, {
				action: 'upload_product.php',
				name: 'uploadfile',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|jpeg)$/.test(ext))){ 
	                    // extension is not allowed 
						mestatus.text('Hanya ekstensi .JPG/JPEG yang diijinkan.');
						return false;
					}
					//mestatus.html('<img src="images/ajax-loader.gif" height="16" width="16">');
					mestatus.html('');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus.text('');
					//On completion clear the status
					files.html('');
					//Add uploaded file to list
					if(response!=="error"){
						$('<li></li>').appendTo('#files').html('<img src="img/products/'+response+'" alt="" height="70"/><br />').addClass('success');
						$('<li></li>').appendTo('#photoproduct').html('<input type="hidden" id="image" name="image" value="'+response+'">').addClass('nameupload');
						
					} else{
						$('<li></li>').appendTo('#files').text(file).addClass('error');
					}
				}
			});
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#product").submit(function() { return false; });
			$("#product2").submit(function() { return false; });
			
			$("#send").on("click", function(){
				var productCode = $("#productCode").val();
				var productName = $("#productName").val();
				var categoryID = $("#categoryID").val();
				var unit = $("#unit").val();
				var unitPrice1 = $("#unitPrice1").val();
				var unitPrice2 = $("#unitPrice2").val();
				var unitPrice3 = $("#unitPrice3").val();
				var hpp = $("#hpp").val();
				var purchasePrice = $("#purchasePrice").val();
				var note = $("#note").val();
				var image = $("#image").val();
				var minimumStock = $("#minimumStock").val();
				
				if (productCode != '' && productName != '' && categoryID != '' && unit != '' && unitPrice1 != '' && unitPrice2 != '' && unitPrice3 != '' && hpp != '' && purchasePrice != '' && minimumStock != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_product.php',
						dataType: 'JSON',
						data:{
							productCode: productCode,
							productName: productName,
							categoryID: categoryID,
							unit: unit,
							unitPrice1: unitPrice1,
							unitPrice2: unitPrice2,
							unitPrice3: unitPrice3,
							hpp: hpp,
							purchasePrice: purchasePrice,
							note: note,
							image: image,
							minimumStock: minimumStock
						},
						beforeSend: function (data) {
							$('#send').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "products.php?msg=Data berhasil disimpan";
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
						
						<div class="box-header">
							<i class="ion ion-clipboard"></i>
							<h3 class="box-title">Data Produk</h3>
							<div class="box-tools pull-right">
								<div class="box-footer clearfix no-border">
								
									<form method="GET" action="products.php">
										<input type="hidden" name="module" value="product">
										<input type="hidden" name="act" value="search">
										<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
										<input type="text" value="{$q}" id="q" name="q" class="form-control" placeholder="Pencarian : Kode atau Nama Produk" style="float: right; width: 270px;" required>
									
										<a href="#inline" class="modalbox" style="float: left;"><button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
                                        <a href="print_products_excel.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print Excel</button></a>
										<a href="print_products.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
										&nbsp;&nbsp;&nbsp;
									</form>
								</div>
							</div>
						</div><!-- /.box-header -->
						
						{if $module == 'product' AND $act == 'search'}
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>NAMA PRODUK <i class="fa fa-sort"></i></th>
												<th>SATUAN <i class="fa fa-sort"></i></th>
												<th>HARGA 1 <i class="fa fa-sort"></i></th>
												<th>HARGA 2 <i class="fa fa-sort"></i></th>
												<th>HARGA 3 <i class="fa fa-sort"></i></th>
												<th>HPP <i class="fa fa-sort"></i></th>
												<th>STOCK <i class="fa fa-sort"></i></th>
												<th width="80">AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataProduct loop=$dataProduct}
												<tr>
													<td>{$dataProduct[dataProduct].no}</td>
													<td>{$dataProduct[dataProduct].productName}</td>
													<td align="center">{$dataProduct[dataProduct].unit}</td>
													<td align="right">{$dataProduct[dataProduct].unitPrice1}</td>
													<td align="right">{$dataProduct[dataProduct].unitPrice2}</td>
													<td align="right">{$dataProduct[dataProduct].unitPrice3}</td>
													<td align="right">{$dataProduct[dataProduct].hpp}</td>
													<td align="center">{$dataProduct[dataProduct].stockAmount}</td>
													<td>
                                                    {if $level == 1}
														<a title="Stok Gudang" href="edit_stock.php?module=product&act=stock&productID={$dataProduct[dataProduct].productID}" data-width="900" data-height="420" class="various3 fancybox.iframe"><img src="img/icons/gudang.png" width="18"></a>
													{/if}
                                                        <a title="Edit" href="edit_products.php?module=product&act=edit&productID={$dataProduct[dataProduct].productID}" data-width="900" data-height="420" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="products.php?module=product&act=delete&productID={$dataProduct[dataProduct].productID}&pic={$dataProduct[dataProduct].image}" onclick="return confirm('Anda Yakin ingin menghapus produk {$dataProduct[dataProduct].productName}?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
						
						{else}
						
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>NAMA PRODUK <i class="fa fa-sort"></i></th>
												<th>SATUAN <i class="fa fa-sort"></i></th>
												<th>HARGA 1 <i class="fa fa-sort"></i></th>
												<th>HARGA 2 <i class="fa fa-sort"></i></th>
												<th>HARGA 3 <i class="fa fa-sort"></i></th>
												<th>HPP <i class="fa fa-sort"></i></th>
												<th>STOCK <i class="fa fa-sort"></i></th>
												<th width="80">AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataProduct loop=$dataProduct}
												<tr>
													<td>{$dataProduct[dataProduct].no}</td>
													<td>{$dataProduct[dataProduct].productName}</td>
													<td align="center">{$dataProduct[dataProduct].unit}</td>
													<td align="right">{$dataProduct[dataProduct].unitPrice1}</td>
													<td align="right">{$dataProduct[dataProduct].unitPrice2}</td>
													<td align="right">{$dataProduct[dataProduct].unitPrice3}</td>
													<td align="right">{$dataProduct[dataProduct].hpp}</td>
													<td align="center">{$dataProduct[dataProduct].stockAmount}</td>
													<td>
                                                    {if $level == 1}
														<a title="Stok Gudang" href="edit_stock.php?module=product&act=stock&productID={$dataProduct[dataProduct].productID}" data-width="900" data-height="420" class="various3 fancybox.iframe"><img src="img/icons/gudang.png" width="18"></a>
													{/if}
                                                        <a title="Edit" href="edit_products.php?module=product&act=edit&productID={$dataProduct[dataProduct].productID}" data-width="900" data-height="420" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="products.php?module=product&act=delete&productID={$dataProduct[dataProduct].productID}&pic={$dataProduct[dataProduct].image}" onclick="return confirm('Anda Yakin ingin menghapus produk {$dataProduct[dataProduct].productName}?');"><img src="img/icons/delete.png" width="18"></a>
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
							
							
							<div id="inline">	
								<table width="95%" align="center">
									<tr>
										<td colspan="3"><h3>Tambah Produk</h3></td>
									</tr>
									<tr>
										<td>
											<form id="product" name="product" method="POST" action="#">
											<table cellpadding="7" cellspacing="7">
												<tr valign="top">
													<td width="130">Kode Produk</td>
													<td width="5">:</td>
													<td>
														<input type="hidden" value="{$productCode}" id="productCode" name="productCode">
														<input type="text" value="{$productCode}" id="productCode" name="productCode" class="form-control" placeholder="Kode Produk" style="width: 270px;" DISABLED>
													</td>
													<td width="120">Harga Beli</td>
													<td width="5">:</td>
													<td><input type="number" id="purchasePrice" name="purchasePrice" class="form-control" placeholder="Harga Beli" style="width: 270px;" required></td>
												</tr>
												<tr>
													<td>Nama Produk</td>
													<td>:</td>
													<td><input type="text" id="productName" name="productName" class="form-control" placeholder="Nama Produk" style="width: 270px;" required></td>
													<td></td>
													<td></td>
													<td><input type="hidden" id="minimumStock" name="minimumStock" class="form-control" value="0" style="width: 270px;" required></td>
												</tr>
												<tr valign="top">
													<td>Kategori</td>
													<td>:</td>
													<td>
														<select id="categoryID" name="categoryID" class="form-control" style="width: 270px;" required>
															<option value=""></option>
															{section name=dataCategory loop=$dataCategory}
																<option value="{$dataCategory[dataCategory].categoryID}">{$dataCategory[dataCategory].categoryName}</option>
															{/section}
														</select>
													</td>
													<td>Note</td>
													<td>:</td>
													<td><input type="text" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;"></td>
												</tr>
												<tr valign="top">
													<td>Satuan</td>
													<td>:</td>
													<td>
														<select id="unit" name="unit" class="form-control" style="width: 270px;" required>
															<option value=""></option>
															<option value="1">SET</option>
															<option value="2">PCS</option>
														</select>
													</td>
													<td>Gambar</td>
													<td>:</td>
													<td rowspan="8">
														<div id="me" class="styleall" style="cursor:pointer;">
															<label>
																<button class="btn btn-warning">Browse</button>
															</label>
														</div>
														<span id="mestatus"></span>
														<div id="photoproduct">
															<li class="nameupload"></li>
														</div>
														<div id="files">
															<li class="success"></li>
														</div>
													</td>
												</tr>
												<tr>
													<td>Harga Unit 1</td>
													<td>:</td>
													<td><input type="number" id="unitPrice1" name="unitPrice1" class="form-control" placeholder="Harga Satuan 1" style="width: 270px;" required></td>
												</tr>
												<tr>
													<td>Harga Unit 2</td>
													<td>:</td>
													<td><input type="number" id="unitPrice2" name="unitPrice2" class="form-control" placeholder="Harga Satuan 2" style="width: 270px;" required></td>
												</tr>
												<tr>
													<td>Harga Unit 3</td>
													<td>:</td>
													<td><input type="number" id="unitPrice3" name="unitPrice3" class="form-control" placeholder="Harga Satuan 3" style="width: 270px;" required></td>
												</tr>
												<tr>
													<td>HPP</td>
													<td>:</td>
													<td><input type="number" id="hpp" name="hpp" class="form-control" placeholder="HPP" style="width: 270px;" required></td>
												</tr>
											</table>
											<button id="send" class="btn btn-primary">Simpan</button>
											</form>
										</td>
									</tr>
								</table>
							</div>
						{/if}
					</div><!-- /.box -->
					
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

{include file="footer.tpl"}