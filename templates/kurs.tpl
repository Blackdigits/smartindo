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
			
			$("#currency").submit(function() { return false; });
			$("#currency2").submit(function() { return false; });
					
			$("#send").on("click", function(){
				var valas = $("#valas").val();
				var kurs = $("#kurs").val();
				var status = $("#status").val();
				
				if (valas != '' && status != '' && kurs != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_kurs.php',
						dataType: 'JSON',
						data:{
							valas: valas,
							kurs: kurs,
							status: status
						},
						beforeSend: function (data) {
							$('#send').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "kurs.php?msg=Data berhasil disimpan";
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
							<h3 class="box-title">Data Kurs / Valas</h3>
							<div class="box-tools pull-right">
								<div class="box-footer clearfix no-border">
									<a href="print_kurs.php?act=print" target="_blank"><button class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
									<a href="#inline" class="modalbox"><button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
								</div>
							</div>
						</div><!-- /.box-header -->
						
						<div class="box-body">
							
							<div class="table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>NO <i class="fa fa-sort"></i></th>
											<th>VALAS <i class="fa fa-sort"></i></th>
											<th>KURS <i class="fa fa-sort"></i></th>
											<th>STATUS <i class="fa fa-sort"></i></th>
											<th>AKSI</th>
										</tr>
									</thead>
									<tbody>
										{section name=dataCurrency loop=$dataCurrency}
											<tr>
												<td>{$dataCurrency[dataCurrency].no}</td>
												<td>{$dataCurrency[dataCurrency].valas}</td>
												<td>{$dataCurrency[dataCurrency].kurs}</td>
												<td>{$dataCurrency[dataCurrency].status}</td>
												<td>
													<a title="Edit" href="edit_kurs.php?module=kurs&act=edit&currencyID={$dataCurrency[dataCurrency].kursID}" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
													<a title="Delete" href="kurs.php?module=kurs&act=delete&currencyID={$dataCurrency[dataCurrency].kursID}" onclick="return confirm('Anda Yakin ingin menghapus kurs / valas {$dataCurrency[dataCurrency].valas}?');"><img src="img/icons/delete.png" width="18"></a>
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
									<td colspan="3"><h3>Tambah Kurs / Valas</h3></td>
								</tr>
								<tr>
									<td>
										<form id="currency" name="currency" method="POST" action="#">
										<table cellpadding="3" cellspacing="3">
											<tr>
												<td width="100">Valas</td>
												<td width="5">:</td>
												<td><input type="text" id="valas" name="valas" class="form-control" placeholder="Nama Valuta Asing" style="width: 270px;" required></td>
											</tr>
											<tr>
												<td>Kurs</td>
												<td>:</td>
												<td><input type="number" id="kurs" name="kurs" class="form-control" placeholder="Kurs IDR" style="width: 270px;" required></td>
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
										</table>
										<button id="send" class="btn btn-primary">Simpan</button>
										</form>
									</td>
								</tr>
							</table>
						</div>
					</div><!-- /.box -->
					
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

{include file="footer.tpl"}