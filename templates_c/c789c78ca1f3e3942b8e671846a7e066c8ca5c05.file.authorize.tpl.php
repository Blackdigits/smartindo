<?php /* Smarty version Smarty-3.1.11, created on 2016-07-14 21:58:19
         compiled from ".\templates\authorize.tpl" */ ?>
<?php /*%%SmartyHeaderCode:52735787a88b703769-06211353%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c789c78ca1f3e3942b8e671846a7e066c8ca5c05' => 
    array (
      0 => '.\\templates\\authorize.tpl',
      1 => 1417000802,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '52735787a88b703769-06211353',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'dataModule' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5787a88b913233_28620604',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5787a88b913233_28620604')) {function content_5787a88b913233_28620604($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>


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
										<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['name'] = 'dataModule';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataModule']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['total']);
?>
											<tr>
												<td><?php echo $_smarty_tpl->tpl_vars['dataModule']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataModule']['index']]['no'];?>
</td>
												<td><?php echo $_smarty_tpl->tpl_vars['dataModule']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataModule']['index']]['modulName'];?>
</td>
												<td><?php echo $_smarty_tpl->tpl_vars['dataModule']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataModule']['index']]['status'];?>
</td>
												<td><?php echo $_smarty_tpl->tpl_vars['dataModule']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataModule']['index']]['authorize'];?>
</td>
												<td>
													<a title="Edit" href="edit_authorize.php?module=authorize&act=edit&modulID=<?php echo $_smarty_tpl->tpl_vars['dataModule']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataModule']['index']]['modulID'];?>
" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
												</td>
											</tr>
										<?php endfor; endif; ?>
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

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>