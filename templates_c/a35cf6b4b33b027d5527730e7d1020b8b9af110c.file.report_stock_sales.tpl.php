<?php /* Smarty version Smarty-3.1.11, created on 2023-09-08 15:28:40
         compiled from "./templates/report_stock_sales.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17183680486391851820f8a0-66665973%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a35cf6b4b33b027d5527730e7d1020b8b9af110c' => 
    array (
      0 => './templates/report_stock_sales.tpl',
      1 => 1694161715,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17183680486391851820f8a0-66665973',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_6391851822ca14_63118975',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'categoryName' => 0,
    'dataCategory' => 0,
    'categoryID' => 0,
    'dataFac' => 0,
    'dataStock' => 0,
    'pageLink' => 0,
    'msg' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6391851822ca14_63118975')) {function content_6391851822ca14_63118975($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<style>
	div.ui-datepicker{
		font-size:14px;
	}
</style>

<header class="header">
	
	<?php echo $_smarty_tpl->getSubTemplate ("logo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
	<?php echo $_smarty_tpl->getSubTemplate ("navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
</header>

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
				
					<!-- TO DO List -->
					<div class="box box-primary">
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='stocksales'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
							<div class="box-header">
								<i class="ion ion-clipboard">Kategori : <?php echo $_smarty_tpl->tpl_vars['categoryName']->value;?>
</i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="report_stock_sales.php">
											<input type="hidden" name="module" value="stocksales">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<select id="categoryID" name="categoryID" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
												<option value="">Semua Kategori</option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['name'] = 'dataCategory';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataCategory']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total']);
?>
													<?php if ($_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryID']==$_smarty_tpl->tpl_vars['categoryID']->value){?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryID'];?>
" SELECTED><?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryName'];?>
</option>
													<?php }else{ ?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryName'];?>
</option>
													<?php }?>
												<?php endfor; endif; ?>
											</select>
                                            
                                            <?php if ($_smarty_tpl->tpl_vars['categoryID']->value!=''){?>
											<a href="exceler/export_stock_sfa.php?sfa=<?php echo $_smarty_tpl->tpl_vars['categoryName']->value;?>
&sfaID=<?php echo $_smarty_tpl->tpl_vars['categoryID']->value;?>
" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Ekspor Excel</button></a>
											&nbsp;&nbsp;&nbsp;
											<?php }else{ ?>
											<a href="https://smartindo.online/exceler/stoksfa/" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Lihat Histori</button></a>
											&nbsp;&nbsp;&nbsp;
                                            <?php }?>
										</form>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr> 
												<th>KODE - NAMA PRODUK<i class="fa fa-sort"></i></th>
												<?php if ($_smarty_tpl->tpl_vars['categoryID']->value!=''){?>
													<th>NILAI <i class="fa fa-sort"></i></th>
												<?php }?>
												
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['name'] = 'dataFac';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataFac']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFac']['total']);
?>
													<th><?php echo $_smarty_tpl->tpl_vars['dataFac']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFac']['index']]['factoryName'];?>
 <i class="fa fa-sort"></i></th>
												<?php endfor; endif; ?>
												<?php if ($_smarty_tpl->tpl_vars['categoryID']->value!=''){?>
													<th>TOTAL <i class="fa fa-sort"></i></th>
												<?php }?>
												
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['name'] = 'dataStock';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataStock']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStock']['total']);
?>
												<tr> 
													<td><?php echo $_smarty_tpl->tpl_vars['dataStock']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStock']['index']]['productName'];?>
</td>
													<?php if ($_smarty_tpl->tpl_vars['categoryID']->value!=''){?>
														<td><?php echo $_smarty_tpl->tpl_vars['dataStock']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStock']['index']]['unit'];?>
</td>
													<?php }?> 
													<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['name'] = 'dataSP';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataStock']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStock']['index']]['factory']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSP']['total']);
?>
														<td><?php echo $_smarty_tpl->tpl_vars['dataStock']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStock']['index']]['factory'][$_smarty_tpl->getVariable('smarty')->value['section']['dataSP']['index']]['stock'];?>
</td>
													<?php endfor; endif; ?>
													<?php if ($_smarty_tpl->tpl_vars['categoryID']->value!=''){?>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStock']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStock']['index']]['total'];?>
</td>
													<?php }?>
													
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-left">
									<ul class="pagination pagination-sm inline">
										<?php echo $_smarty_tpl->tpl_vars['pageLink']->value;?>

									</ul>
								</div>
							</div><!-- /.box-header -->
						
						<?php }else{ ?>
							<div class="label-success"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</div>
							<div class="box-header" style="float: left;">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="report_stock_sales.php">
											<input type="hidden" name="module" value="stocksales">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<select id="categoryID" name="categoryID" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
												<option value="">Semua Kategori</option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['name'] = 'dataCategory';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataCategory']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total']);
?>
													<option value="<?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryName'];?>
</option>
												<?php endfor; endif; ?>
											</select>
										
											&nbsp;&nbsp;&nbsp;
										</form>
									</div>
								</div>
							</div><!-- /.box-header -->
						<?php }?>
						
					</div><!-- /.box -->
					
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>