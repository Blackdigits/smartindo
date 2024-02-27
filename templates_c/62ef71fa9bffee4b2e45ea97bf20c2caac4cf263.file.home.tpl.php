<?php /* Smarty version Smarty-3.1.11, created on 2023-09-05 23:18:30
         compiled from "./templates/home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:977419264637ec8868ac631-28878626%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '62ef71fa9bffee4b2e45ea97bf20c2caac4cf263' => 
    array (
      0 => './templates/home.tpl',
      1 => 1693930207,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '977419264637ec8868ac631-28878626',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_637ec8868b5c03_20516556',
  'variables' => 
  array (
    'chartData' => 0,
    'BarchartData' => 0,
    'sqlProduct' => 0,
    'no' => 0,
    'dtProduct' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_637ec8868b5c03_20516556')) {function content_637ec8868b5c03_20516556($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include '/home/u606309387/domains/smartindo.online/public_html/libs/plugins/function.math.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	
<header class="header">
	
	<?php echo $_smarty_tpl->getSubTemplate ("logo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
	<?php echo $_smarty_tpl->getSubTemplate ("navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
</header>
<style type="text/css">
.chart {
  width: 49%;
  height: auto;
  display: inline-block;
}
h2 {
    font-size: 1.5rem;
}
.container {
    padding-left: 0;
    padding-right: 0; 
}
.card {
    position: relative;
    background-color: #fff;
    margin-bottom: 1.25rem;
    border: 1px solid #edf2f9;
    border-radius: .25rem;
    transition: all 0.3s ease-in-out;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    -ms-transition: all 0.3s ease-in-out;
}
.card-body {
    padding: 1.5rem;
    position: relative;
}
.card-body .h2 {
    font-size: 24px;
}
.badge-cyan {
    color: #00c9a7;
    background: rgba(0,201,167,0.1);
    border-color: transparent;
    font-weight: 500;
}
.badge {
    line-height: 1.7;
    padding: 0.25em 0.7em;
}
.badge.badge-dot {
    width: 7px;
    height: 7px;
    border-radius: 50px;
    padding: 0px;
}
.font-size-13 {
    font-size: 13px !important;
}
.progress-bar:last-child {
    border-top-right-radius: 50px;
    border-bottom-right-radius: 50px;
}
.progress.progress-sm {
    height: 4px;
}

.progress {
    height: 8px;
    background-color: #ececec;
    border-radius: 50px;
    margin-bottom: 20px;
    min-width: 50px;
}
.badge.badge-dot:empty {
    display: inline-block;
}

.badge.badge-dot {
    width: 7px;
    height: 7px;
    border-radius: 50px;
    padding: 0px;
}
.badge-red {
    color: #de4436;
    background: rgba(222,68,54,0.05);
    border-color: transparent;
    font-weight: 500;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" >
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<div class="wrapper row-offcanvas row-offcanvas-left">
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="left-side sidebar-offcanvas">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<?php echo $_smarty_tpl->getSubTemplate ("user_panel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        	
			<?php echo $_smarty_tpl->getSubTemplate ("side_menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		</section>
		<!-- /.sidebar -->
	</aside>
	
	<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		
		<?php echo $_smarty_tpl->getSubTemplate ("breadcumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
		<!-- Main content -->
		<section class="content">
		
			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<section class="col-lg-12 connectedSortable">
					<iframe src="https://smartindo.online/templates/stats.php" frameborder="0" style="width:100%;min-height: 222px;"></iframe>
					 <div id="chartdiv" class='chart'></div>
					 <div id="barchartdiv" class='chart'></div>
					<script>  
						// Themes begin
						am4core.useTheme(am4themes_animated);
						// Themes end

						// Create chart instance
						var chart = am4core.create("chartdiv", am4charts.PieChart);
						chart.data = <?php echo $_smarty_tpl->tpl_vars['chartData']->value;?>
;

						// Add and configure Series
						var pieSeries = chart.series.push(new am4charts.PieSeries());
						pieSeries.dataFields.value = "stock";
						pieSeries.dataFields.category = "supplierName"; 
						pieSeries.slices.template.stroke = am4core.color("#fff");
						pieSeries.slices.template.strokeWidth = 2;
						pieSeries.slices.template.strokeOpacity = 0;
						pieSeries.labels.template.fontSize = 9;

						// This creates initial animation
						pieSeries.hiddenState.properties.opacity = 1;
						pieSeries.hiddenState.properties.endAngle = -90;
						pieSeries.hiddenState.properties.startAngle = -90;
						
						// Create chart
						var barchart = am4core.create("barchartdiv", am4charts.XYChart);  

						// Add Data
						barchart.data = <?php echo $_smarty_tpl->tpl_vars['BarchartData']->value;?>
;

						// Add category axis
						var categoryAxis = barchart.xAxes.push(new am4charts.CategoryAxis());
						categoryAxis.dataFields.category = "supplierName";

						// Add value axis
						var valueAxis = barchart.yAxes.push(new am4charts.ValueAxis());

						// Add series
						var series = barchart.series.push(new am4charts.ColumnSeries());
						series.name = "Transaksi Mingguan SFA";
						series.dataFields.categoryX = "supplierName";
						series.dataFields.valueY = "transaksi";

					</script> 

					<table class="table table-striped">
						<thead>
							<tr>
								<th>Nama Produk</th>
								<th>Harga</th>
								<th>Sisa Stok</th>
								<th>Valuasi</th>
							</tr>
						</thead>
						<tbody>
							<?php $_smarty_tpl->tpl_vars["no"] = new Smarty_variable(0, null, 0);?>
							<?php  $_smarty_tpl->tpl_vars['dtProduct'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dtProduct']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sqlProduct']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dtProduct']->key => $_smarty_tpl->tpl_vars['dtProduct']->value){
$_smarty_tpl->tpl_vars['dtProduct']->_loop = true;
?>
								<?php echo smarty_function_math(array('equation'=>"no = no + 1",'no'=>$_smarty_tpl->tpl_vars['no']->value,'assign'=>"no"),$_smarty_tpl);?>

								<tr>
									<td><?php echo $_smarty_tpl->tpl_vars['dtProduct']->value['productName'];?>
</td>
									<td><?php echo number_format($_smarty_tpl->tpl_vars['dtProduct']->value['hpp'],0,',','.');?>
</td>
									<td><?php echo $_smarty_tpl->tpl_vars['dtProduct']->value['stock'];?>
</td>
									<td>Rp <?php echo number_format($_smarty_tpl->tpl_vars['dtProduct']->value['total'],2,',','.');?>
</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>

				
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>