{include file="header.tpl"}

<style>
	div.ui-datepicker{
		font-size:14px;
	}
</style>

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
						
						{if $module == 'stockproduct' && $act == 'search'}
							<div class="box-header">
								<i class="ion ion-clipboard">Kategori : {$categoryName}</i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="report_stock_products.php">
											<input type="hidden" name="module" value="stockproduct">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<select id="categoryID" name="categoryID" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
												<option value="">Semua Kategori</option>
												{section name=dataCategory loop=$dataCategory}
													{if $dataCategory[dataCategory].categoryID == $categoryID}
														<option value="{$dataCategory[dataCategory].categoryID}" SELECTED>{$dataCategory[dataCategory].categoryName}</option>
													{else}
														<option value="{$dataCategory[dataCategory].categoryID}">{$dataCategory[dataCategory].categoryName}</option>
													{/if}
												{/section}
											</select>
										
											<a href="print_report_stock_products.php?act=print&categoryID={$categoryID}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>KODE - NAMA PRODUK<i class="fa fa-sort"></i></th> 
												{section name=dataFac loop=$dataFac}
													<th>{$dataFac[dataFac].factoryName} <i class="fa fa-sort"></i></th>
												{/section}
												<th>TOTAL <i class="fa fa-sort"></i></th>
											</tr>
										</thead>
										<tbody>
											{section name=dataStock loop=$dataStock}
												<tr>
													<td>{$dataStock[dataStock].no}</td>
													<td>{$dataStock[dataStock].productName}</td> 
													{section name=dataSP loop=$dataStock[dataStock].factory}
														<td>{$dataStock[dataStock].factory[dataSP].stock}</td>
													{/section}
													<td>{$dataStock[dataStock].total}</td>
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
							<div class="label-success">{$msg}</div>
							<div class="box-header" style="float: left;">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="report_stock_products.php">
											<input type="hidden" name="module" value="stockproduct">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<select id="categoryID" name="categoryID" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
												<option value="">Semua Gudang</option>
												{section name=dataCategory loop=$dataCategory}
													<option value="{$dataCategory[dataCategory].categoryID}">{$dataCategory[dataCategory].categoryName}</option>
												{/section}
											</select>
										
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