{include file="header.tpl"}

<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

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
			
			$("#supplier").submit(function() { return false; });
			$("#supplier2").submit(function() { return false; });
					
			$("#send").on("click", function(){
				var supplierCode = $("#supplierCode").val();
				var supplierName = $("#supplierName").val();
				var contactPerson = $("#contactPerson").val();
				var address = $("#address").val();
				var city = $("#city").val();
				var phone = $("#phone").val();
				var fax = $("#fax").val();
				var email = $("#email").val();
				var privat = $("#privat").val();
				
				if (supplierCode != '' && supplierName != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_supplier.php',
						dataType: 'JSON',
						data:{
							supplierCode: supplierCode,
							supplierName: supplierName,
							contactPerson: contactPerson,
							address: address,
							city: city,
							phone: phone,
							fax: fax,
							email: email
						},
						beforeSend: function (data) {
							$('#send').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "suppliers.php?msg=Data berhasil disimpan";
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
							<h3 class="box-title">Data Sales</h3>
							<div class="box-tools pull-right">
								<div class="box-footer clearfix no-border">
									<form method="GET" action="suppliers.php">
										<input type="hidden" name="module" value="supplier">
										<input type="hidden" name="act" value="search">
										<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Cari</button>
										<input type="text" value="{$q}" id="q" name="q" class="form-control" placeholder="Pencarian : Kode atau Nama Supplier" style="float: right; width: 270px;" required>
									
										<a href="#inline" class="modalbox" style="float: left;"><button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
										<a href="print_suppliers.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
										&nbsp;&nbsp;&nbsp;
									</form>
								</div>
							</div>
						</div><!-- /.box-header -->
						
						{if $module == 'supplier' AND $act == 'search'}
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>KODE <i class="fa fa-sort"></i></th>
												<th>NAMA SPF<i class="fa fa-sort"></i></th>
												<th>USERNAME LOGIN <i class="fa fa-sort"></i></th>
												<th>ALAMAT <i class="fa fa-sort"></i></th>
												<th>TELPON <i class="fa fa-sort"></i></th> 
												<th width="60">AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataSupplier loop=$dataSupplier}
												<tr>
													<td>{$dataSupplier[dataSupplier].no}</td>
													<td>{$dataSupplier[dataSupplier].supplierCode}</td>
													<td>{$dataSupplier[dataSupplier].supplierName}</td>
													<td>{$dataSupplier[dataSupplier].contactPerson}</td>
													<td>{$dataSupplier[dataSupplier].address}</td>
													<td>{$dataSupplier[dataSupplier].phone}</td> 
													<td>
														<a title="Edit" href="edit_suppliers.php?module=supplier&act=edit&supplierID={$dataSupplier[dataSupplier].supplierID}" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="suppliers.php?module=supplier&act=delete&supplierID={$dataSupplier[dataSupplier].supplierID}" onclick="return confirm('Anda Yakin ingin menghapus supplier {$dataSupplier[dataSupplier].supplierName}?');"><img src="img/icons/delete.png" width="18"></a>
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
												<th>KODE <i class="fa fa-sort"></i></th>
												<th>NAMA SALES <i class="fa fa-sort"></i></th>
												<th>USERNAME LOGIN <i class="fa fa-sort"></i></th>
												<th>ALAMAT <i class="fa fa-sort"></i></th>
												<th>TELPON <i class="fa fa-sort"></i></th> 
												<th width="60">AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataSupplier loop=$dataSupplier}
												<tr>
													<td>{$dataSupplier[dataSupplier].no}</td>
													<td>{$dataSupplier[dataSupplier].supplierCode}</td>
													<td>{$dataSupplier[dataSupplier].supplierName}</td>
													<td>{$dataSupplier[dataSupplier].contactPerson}</td>
													<td>{$dataSupplier[dataSupplier].address}</td>
													<td>{$dataSupplier[dataSupplier].phone}</td> 
													<td>
														<a title="Edit" href="edit_suppliers.php?module=supplier&act=edit&supplierID={$dataSupplier[dataSupplier].supplierID}" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="suppliers.php?module=supplier&act=delete&supplierID={$dataSupplier[dataSupplier].supplierID}" onclick="return confirm('Anda Yakin ingin menghapus supplier {$dataSupplier[dataSupplier].supplierName}?');"><img src="img/icons/delete.png" width="18"></a>
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
										<td colspan="3"><h3>Tambah Data</h3></td>
									</tr>
									<tr>
										<td>
											<form id="supplier" name="supplier" method="POST" action="#">
											<table cellpadding="7" cellspacing="7">
												<tr>
													<td width="140">Kode</td>
													<td width="5">:</td>
													<td>
														<input type="hidden" value="{$supplierCode}" id="supplierCode" name="supplierCode">
														<input type="text" value="{$supplierCode}" id="supplierCode" name="supplierCode" class="form-control" placeholder="Kode Supplier" style="width: 270px;">
													</td>
												</tr>
												<tr>
													<td>Nama Sales</td>
													<td>:</td>
													<td><input type="text" id="supplierName" name="supplierName" class="form-control" placeholder="Nama Sales" style="width: 270px;" required></td>
												</tr>
												<tr>
													<td>Username Login</td>
													<td>:</td>
													<td><input type="text" id="contactPerson" name="contactPerson" class="form-control" placeholder="Username" style="width: 270px;"></td>
												</tr>
												<tr>
													<td>Alamat</td>
													<td>:</td>
													<td><input type="text" id="address" name="address" class="form-control" placeholder="Alamat" style="width: 270px;"></td>
												</tr>
												<tr>
													<td>Kota</td>
													<td>:</td>
													<td><input type="text" id="city" name="city" class="form-control" placeholder="Kota" style="width: 270px;"></td>
												</tr>
												<tr>
													<td>Telepon</td>
													<td>:</td>
													<td><input type="text" id="phone" name="phone" class="form-control" placeholder="Telepon" style="width: 270px;"></td>
												</tr>
												<tr>
													<td>Password</td>
													<td>:</td>
													<td><input type="password" id="fax" name="fax" class="form-control" placeholder="Password" style="width: 270px;"></td>
												</tr>
												<tr>
													<td>Email</td>
													<td>:</td>
													<td><input type="email" id="email" name="email" class="form-control" placeholder="Email" style="width: 270px;"></td>
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