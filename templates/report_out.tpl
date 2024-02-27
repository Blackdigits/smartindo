{include file="header.tpl"}

<style>
	div.ui-datepicker{
		font-size:14px;
	}
</style>

{literal}
	<script>
		$(document).ready(function() {
			
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
						
						{if $module == 'out' AND $act == 'search'}
						
							<div class="box-header">
								<i class="ion ion-clipboard">Periode : {$startDate} s/d {$endDate}</i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="report_out.php">
											<input type="hidden" name="module" value="out">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 150px; margin-right: 5px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 150px; margin-right: 5px;">
											<a href="cluster1/exceler/index.php?act=print&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print Excel</button></a>
											<a href="print_report_out.php?act=print&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>FAKTUR <i class="fa fa-sort"></i></th>
												<th>TGL <i class="fa fa-sort"></i></th>
												<th>TOKO <i class="fa fa-sort"></i></th>
												<th>TOTAL <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
											</tr>
										</thead>
										<tbody>
											{section name=dataSales loop=$dataSales}
												<tr>
													<td>{$dataSales[dataSales].no}</td>
													<td>{$dataSales[dataSales].invoiceNo}</td>
													<td>{$dataSales[dataSales].invoiceDate}</td>
													<td>{$dataSales[dataSales].soNo}</td>
													<td>{$dataSales[dataSales].grandtotal}</td>
													<td>{$dataSales[dataSales].staffName}</td>
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
													
						{else}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="report_out.php">
											<input type="hidden" name="module" value="out">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 150px; margin-right: 5px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 150px; margin-right: 5px;">
											&nbsp;&nbsp;&nbsp;
										</form>
									</div>
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