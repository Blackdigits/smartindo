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
			
			$("#factory").submit(function() { return false; });
			$("#factory").submit(function() { return false; });
					
			$("#send").on("click", function(){
				var factoryCode = $("#factoryCode").val();
				var factoryName = $("#factoryName").val();
				var factoryType = $("#factoryType").val();
				var status = $("#status").val();
				var note = $("#note").val();
				
				if (factoryCode != '' && factoryName != '' && factoryType != '' && status != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_factory.php',
						dataType: 'JSON',
						data:{
							factoryCode: factoryCode,
							factoryName: factoryName,
							factoryType: factoryType,
							status: status,
							note: note
						},
						beforeSend: function (data) {
							$('#send').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "factories.php?msg=Data berhasil disimpan";
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
							<h3 class="box-title">Data Gudang</h3>
							<div class="box-tools pull-right">
								<div class="box-footer clearfix no-border">
									<form method="GET" action="factories.php">
										<input type="hidden" name="module" value="factory">
										<input type="hidden" name="act" value="search">
										<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
										<input type="text" value="{$q}" id="q" name="q" class="form-control" placeholder="Pencarian : Kode atau Nama Gudang" style="float: right; width: 270px;" required>
									
										<a href="#inline" class="modalbox" style="float: left;"><button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
										<a href="print_factories.php?act=print&q={$q}" style="float: left;" target="_blank"><button class="btn btn-default pull-right" type="button"><i class="fa fa-print"></i> Print PDF</button></a>
										&nbsp;&nbsp;&nbsp;
									</form>
								</div>
							</div>
						</div><!-- /.box-header -->
						
						{if $module == 'factory' AND $act == 'search'}
						
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>KODE GUDANG <i class="fa fa-sort"></i></th>
												<th>NAMA GUDANG <i class="fa fa-sort"></i></th>
												<th>TIPE <i class="fa fa-sort"></i></th>
												<th>STATUS <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataFactory loop=$dataFactory}
												<tr>
													<td>{$dataFactory[dataFactory].no}</td>
													<td>{$dataFactory[dataFactory].factoryCode}</td>
													<td>{$dataFactory[dataFactory].factoryName}</td>
													<td>{$dataFactory[dataFactory].factoryType}</td>
													<td>{$dataFactory[dataFactory].status}</td>
													<td>
														<a title="Edit" href="edit_factories.php?module=factory&act=edit&factoryID={$dataFactory[dataFactory].factoryID}" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="factories.php?module=factory&act=delete&factoryID={$dataFactory[dataFactory].factoryID}" onclick="return confirm('Anda Yakin ingin menghapus gudang {$dataFactory[dataFactory].factoryName}?');"><img src="img/icons/delete.png" width="18"></a>
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
												<th>KODE GUDANG <i class="fa fa-sort"></i></th>
												<th>NAMA GUDANG <i class="fa fa-sort"></i></th>
												<th>TIPE <i class="fa fa-sort"></i></th>
												<th>STATUS <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataFactory loop=$dataFactory}
												<tr>
													<td>{$dataFactory[dataFactory].no}</td>
													<td>{$dataFactory[dataFactory].factoryCode}</td>
													<td>{$dataFactory[dataFactory].factoryName}</td>
													<td>{$dataFactory[dataFactory].factoryType}</td>
													<td>{$dataFactory[dataFactory].status}</td>
													<td>
														<a title="Edit" href="edit_factories.php?module=factory&act=edit&factoryID={$dataFactory[dataFactory].factoryID}" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="factories.php?module=factory&act=delete&factoryID={$dataFactory[dataFactory].factoryID}" onclick="return confirm('Anda Yakin ingin menghapus gudang {$dataFactory[dataFactory].factoryName}?');"><img src="img/icons/delete.png" width="18"></a>
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
										<td colspan="3"><h3>Tambah Gudang / Pabrik</h3></td>
									</tr>
									<tr>
										<td>
											<form id="factory" name="factory" method="POST" action="#">
											<table cellpadding="7" cellspacing="7">
												<tr>
													<td width="140">Kode Gudang</td>
													<td width="5">:</td>
													<td><input type="hidden" value="{$factoryCode}" id="factoryCode" name="factoryCode">
														<input type="text" value="{$factoryCode}" id="factoryCode" name="factoryCode" class="form-control" placeholder="Kode Gudang" style="width: 270px;" DISABLED></td>
												</tr>
												<tr>
													<td>Nama Gudang</td>
													<td>:</td>
													<td><input type="text" id="factoryName" name="factoryName" class="form-control" placeholder="Nama Gudang" style="width: 270px;" required></td>
												</tr>
												<tr>
													<td>Tipe</td>
													<td>:</td>
													<td><select name="factoryType" id="factoryType" class="form-control" required>
														<option value="">- Pilih Status -</option>
														<option value="1">Tetap</option>
														<option value="2">Sementara (Sewa)</option>
													</select></td>
												</tr>
												<tr>
													<td>Status</td>
													<td>:</td>
													<td><select name="status" id="status" class="form-control" required>
														<option value="">- Pilih Status -</option>
														<option value="Y">Y (Aktif)</option>
														<option value="N">N (Tidak Aktif)</option>
													</select></td>
												</tr>
												<tr valign="top">
													<td>Note</td>
													<td>:</td>
													<td><textarea class="textarea" name="note" id="note" placeholder="Note" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea></td>
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