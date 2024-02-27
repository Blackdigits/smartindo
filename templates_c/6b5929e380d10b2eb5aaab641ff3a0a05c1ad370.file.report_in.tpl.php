<?php /* Smarty version Smarty-3.1.11, created on 2016-07-14 23:39:33
         compiled from ".\templates\report_in.tpl" */ ?>
<?php /*%%SmartyHeaderCode:123425787c0450fdf45-35983625%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b5929e380d10b2eb5aaab641ff3a0a05c1ad370' => 
    array (
      0 => '.\\templates\\report_in.tpl',
      1 => 1452507744,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123425787c0450fdf45-35983625',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'startDate' => 0,
    'endDate' => 0,
    'dataBuy' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5787c045361da7_10745151',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5787c045361da7_10745151')) {function content_5787c045361da7_10745151($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<style>
	div.ui-datepicker{
		font-size:14px;
	}
</style>


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
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='in'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
						
							<div class="box-header">
								<i class="ion ion-clipboard">Periode : <?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
 s/d <?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
</i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="report_in.php">
											<input type="hidden" name="module" value="in">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 150px; margin-right: 5px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 150px; margin-right: 5px;">
											<a href="print_report_in.php?act=print&startDate=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>NO INVOICE <i class="fa fa-sort"></i></th>
												<th>TGL <i class="fa fa-sort"></i></th>
												<th>NO BBM <i class="fa fa-sort"></i></th>
												<th>GRANDTOTAL <i class="fa fa-sort"></i></th>
												<th>OPERATOR <i class="fa fa-sort"></i></th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['name'] = 'dataBuy';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataBuy']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBuy']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBuy']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBuy']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBuy']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBuy']['index']]['invoiceNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBuy']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBuy']['index']]['invoiceDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBuy']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBuy']['index']]['bbmNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBuy']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBuy']['index']]['grandtotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBuy']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBuy']['index']]['staffName'];?>
</td>
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
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="report_in.php">
											<input type="hidden" name="module" value="in">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 150px; margin-right: 5px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 150px; margin-right: 5px;">
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