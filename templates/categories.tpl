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
			
			$("#category").submit(function() { return false; });
			$("#category2").submit(function() { return false; });
					
			$("#send").on("click", function(){
				var categoryName = $("#categoryName").val();
				var categoryStatus = $("#categoryStatus").val();
				var categoryprivat = $("#categoryprivat").val();
				
				if (categoryName != '' && categoryStatus != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_category.php',
						dataType: 'JSON',
						data:{
							categoryName: categoryName,
							categoryStatus: categoryStatus
						},
						beforeSend: function (data) {
							$('#send').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "categories.php?msg=Data berhasil disimpan";
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
							<h3 class="box-title">Data Kategori</h3>
							<div class="box-tools pull-right">
								<div class="box-footer clearfix no-border">
									
									<form method="GET" action="categories.php">
										<input type="hidden" name="module" value="category">
										<input type="hidden" name="act" value="search">
										<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
										<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : Nama Kategori" style="float: right; width: 270px;" required>
									
										<a href="#inline" class="modalbox" style="float: left;"><button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
										<a href="print_categories.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
										&nbsp;&nbsp;&nbsp;
									</form>
								</div>
							</div>
						</div><!-- /.box-header -->
						
						{if $module == 'category' AND $act == 'search'}
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>NAMA KATEGORI <i class="fa fa-sort"></i></th>
												<th>STATUS <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataCategory loop=$dataCategory}
												<tr>
													<td>{$dataCategory[dataCategory].no}</td>
													<td>{$dataCategory[dataCategory].categoryName}</td>
													<td>{$dataCategory[dataCategory].status}</td>
													<td>
														<a title="Edit" href="edit_categories.php?module=category&act=edit&categoryID={$dataCategory[dataCategory].categoryID}" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="categories.php?module=category&act=delete&categoryID={$dataCategory[dataCategory].categoryID}" onclick="return confirm('Anda Yakin ingin menghapus kategori {$dataCategory[dataCategory].categoryName}?');"><img src="img/icons/delete.png" width="18"></a>
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
												<th>NAMA KATEGORI <i class="fa fa-sort"></i></th>
												<th>STATUS <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataCategory loop=$dataCategory}
												<tr>
													<td>{$dataCategory[dataCategory].no}</td>
													<td>{$dataCategory[dataCategory].categoryName}</td>
													<td>{$dataCategory[dataCategory].status}</td>
													<td>
														<a title="Edit" href="edit_categories.php?module=category&act=edit&categoryID={$dataCategory[dataCategory].categoryID}" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="categories.php?module=category&act=delete&categoryID={$dataCategory[dataCategory].categoryID}" onclick="return confirm('Anda Yakin ingin menghapus kategori {$dataCategory[dataCategory].categoryName}?');"><img src="img/icons/delete.png" width="18"></a>
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
							
							
							<div id="inline">	
								<table width="95%" align="center">
									<tr>
										<td colspan="3"><h3>Tambah Kategori</h3></td>
									</tr>
									<tr>
										<td>
											<form id="category" name="category" method="POST" action="#">
											<table cellpadding="7" cellspacing="7">
												<tr>
													<td width="140">Nama Kategori</td>
													<td width="5">:</td>
													<td><input type="text" id="categoryName" name="categoryName" class="form-control" placeholder="Nama kategori" style="width: 270px;" required></td>
												</tr>
												<tr>
													<td>Status</td>
													<td>:</td>
													<td><select name="categoryStatus" id="categoryStatus" class="form-control" required>
														<option value="">- Pilih Status -</option>
														<option value="Y">Y (Aktif)</option>
														<option value="N">N (Tidak Aktif)</option>
													</select></td>
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