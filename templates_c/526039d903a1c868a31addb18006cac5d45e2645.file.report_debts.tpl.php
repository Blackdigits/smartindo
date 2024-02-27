<?php /* Smarty version Smarty-3.1.11, created on 2022-10-28 20:09:54
         compiled from ".\templates\report_debts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1804318557635bd4a23cfff0-41803021%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '526039d903a1c868a31addb18006cac5d45e2645' => 
    array (
      0 => '.\\templates\\report_debts.tpl',
      1 => 1452509082,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1804318557635bd4a23cfff0-41803021',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'endDate' => 0,
    'startDate' => 0,
    'dataSupplier' => 0,
    'supplierID' => 0,
    'dataDebt' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_635bd4a245c6d8_23627379',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_635bd4a245c6d8_23627379')) {function content_635bd4a245c6d8_23627379($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='debt'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="report_debts.php">
											<input type="hidden" name="module" value="debt">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px; margin-right: 5px;">
											<input type="text" id="startDate" name="startDate" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px; margin-right: 5px;">
											<select id="supplierID" name="supplierID" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
												<option value=""></option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['name'] = 'dataSupplier';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataSupplier']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total']);
?>
													<?php if ($_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierID']==$_smarty_tpl->tpl_vars['supplierID']->value){?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierID'];?>
" SELECTED><?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierName'];?>
 [ Kode : <?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierCode'];?>
 ]</option>
													<?php }else{ ?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierName'];?>
 [ Kode : <?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierCode'];?>
 ]</option>
													<?php }?>
												<?php endfor; endif; ?>
											</select>
											<a href="print_report_debts.php?act=print&supplierID=<?php echo $_smarty_tpl->tpl_vars['supplierID']->value;?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>SUPPLIER <i class="fa fa-sort"></i></th>
												<th>TOTAL <i class="fa fa-sort"></i></th>
												<th>INCOMING <i class="fa fa-sort"></i></th>
												<th>REDUCTION <i class="fa fa-sort"></i></th>
												<th>SISA <i class="fa fa-sort"></i></th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['name'] = 'dataDebt';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDebt']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['debtNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['invoiceNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['supplierName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['debtTotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['incomingTotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['reductionTotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['sisa'];?>
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
										<form method="GET" action="report_debts.php">
											<input type="hidden" name="module" value="debt">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px; margin-right: 5px;">
											<input type="text" id="startDate" name="startDate" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px; margin-right: 5px;">
											<select id="supplierID" name="supplierID" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
												<option value=""></option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['name'] = 'dataSupplier';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataSupplier']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total']);
?>
													<option value="<?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierName'];?>
 [ Kode : <?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierCode'];?>
 ]</option>
												<?php endfor; endif; ?>
											</select>
											
											<a href="print_report_debts.php?act=print&supplierID=<?php echo $_smarty_tpl->tpl_vars['supplierID']->value;?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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