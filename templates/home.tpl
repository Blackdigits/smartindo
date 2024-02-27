{include file="header.tpl"}
	
<header class="header">
	
	{include file="logo.tpl"}
		
	{include file="navigation.tpl"}
		
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
					<iframe src="https://smartindo.online/templates/stats.php" frameborder="0" style="width:100%;min-height: 222px;"></iframe>
					 <div id="chartdiv" class='chart'></div>
					 <div id="barchartdiv" class='chart'></div>
					<script>  
						// Themes begin
						am4core.useTheme(am4themes_animated);
						// Themes end

						// Create chart instance
						var chart = am4core.create("chartdiv", am4charts.PieChart);
						chart.data = {$chartData};

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
						barchart.data = {$BarchartData};

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
							{assign var="no" value=0}
							{foreach $sqlProduct as $dtProduct}
								{math equation="no = no + 1" no=$no assign="no"}
								<tr>
									<td>{$dtProduct.productName}</td>
									<td>{$dtProduct.hpp|number_format:0:',':'.'}</td>
									<td>{$dtProduct.stock}</td>
									<td>Rp {$dtProduct.total|number_format:2:',':'.'}</td>
								</tr>
							{/foreach}
						</tbody>
					</table>

				
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

{include file="footer.tpl"}