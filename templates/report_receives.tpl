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
						
						{if $module == 'receive' && $act == 'search'}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="report_receives.php">
											<input type="hidden" name="module" value="receive">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="{$endDate}" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px; margin-right: 5px;">
											<input type="text" id="startDate" name="startDate" value="{$startDate}" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px; margin-right: 5px;">
											<select id="customerID" name="customerID" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
												<option value=""></option>
												{section name=dataCustomer loop=$dataCustomer}
													{if $dataCustomer[dataCustomer].customerID == $customerID}
														<option value="{$dataCustomer[dataCustomer].customerID}" SELECTED>{$dataCustomer[dataCustomer].customerName} [ Kode : {$dataCustomer[dataCustomer].customerCode} ]</option>
													{else}
														<option value="{$dataCustomer[dataCustomer].customerID}">{$dataCustomer[dataCustomer].customerName} [ Kode : {$dataCustomer[dataCustomer].customerCode} ]</option>
													{/if}
												{/section}
											</select>
										
											<a href="print_report_receives.php?act=print&customerID={$customerID}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
											&nbsp;
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
												<th>NOMOR <i class="fa fa-sort"></i></th>
												<th>NO FAKTUR <i class="fa fa-sort"></i></th>
												<th>CUSTOMER <i class="fa fa-sort"></i></th>
												<th>TOTAL <i class="fa fa-sort"></i></th>
												<th>INCOMING <i class="fa fa-sort"></i></th>
												<th>REDUCTION <i class="fa fa-sort"></i></th>
												<th>SISA <i class="fa fa-sort"></i></th>
											</tr>
										</thead>
										<tbody> 
											{section name=dataReceive loop=$dataReceive}
												<tr>
													<td>{$dataReceive[dataReceive].no}</td>
													<td>{$dataReceive[dataReceive].receiveNo}</td>
													<td>{$dataReceive[dataReceive].invoiceNo}</td>
													<td>{$dataReceive[dataReceive].customerName}</td>
													<td>{$dataReceive[dataReceive].receiveTotal}</td>
													<td>{$dataReceive[dataReceive].incomingTotal}</td>
													<td>{$dataReceive[dataReceive].reductionTotal}</td>
													<td>{$dataReceive[dataReceive].sisa}</td>
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
										<form method="GET" action="report_receives.php">
											<input type="hidden" name="module" value="receive">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="{$endDate}" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px; margin-right: 5px;">
											<input type="text" id="startDate" name="startDate" value="{$startDate}" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px; margin-right: 5px;">
											<select id="customerID" name="customerID" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
												<option value=""></option>
												{section name=dataCustomer loop=$dataCustomer}
													<option value="{$dataCustomer[dataCustomer].customerID}">{$dataCustomer[dataCustomer].customerName} [ Kode : {$dataCustomer[dataCustomer].customerCode} ]</option>
												{/section}
											</select>
											<a href="print_report_receives.php?act=print&customerID={$customerID}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
											&nbsp;
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