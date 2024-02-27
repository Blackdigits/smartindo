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
			
			$("#authorize").submit(function() { return false; });
			$("#authorize2").submit(function() { return false; });
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
							<h3 class="box-title">Data Otorisasi Level</h3>
							<div class="box-tools pull-right">
								<div class="box-footer clearfix no-border">
									<a href="print_authorize.php?act=print" target="_blank"><button class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
								</div>
							</div>
						</div><!-- /.box-header -->
						
						<div class="box-body">
							
							<div class="table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>NO <i class="fa fa-sort"></i></th>
											<th>NAMA MODUL <i class="fa fa-sort"></i></th>
											<th>STATUS <i class="fa fa-sort"></i></th>
											<th>OTORISASI <i class="fa fa-sort"></i></th>
											<th>AKSI</th>
										</tr>
									</thead>
									<tbody>
										{section name=dataModule loop=$dataModule}
											<tr>
												<td>{$dataModule[dataModule].no}</td>
												<td>{$dataModule[dataModule].modulName}</td>
												<td>{$dataModule[dataModule].status}</td>
												<td>{$dataModule[dataModule].authorize}</td>
												<td>
													<a title="Edit" href="edit_authorize.php?module=authorize&act=edit&modulID={$dataModule[dataModule].modulID}" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
												</td>
											</tr>
										{/section}
									</tbody>
								</table>
							</div>
						
						</div><!-- /.box-body -->
						
					</div><!-- /.box -->
					
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

{include file="footer.tpl"}