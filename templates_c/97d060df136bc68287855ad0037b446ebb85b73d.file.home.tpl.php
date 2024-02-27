<?php /* Smarty version Smarty-3.1.11, created on 2022-11-19 22:44:26
         compiled from ".\templates\home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28038576dc8ea126975-12728683%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97d060df136bc68287855ad0037b446ebb85b73d' => 
    array (
      0 => '.\\templates\\home.tpl',
      1 => 1668872661,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28038576dc8ea126975-12728683',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576dc8ea1ab8b7_89944525',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576dc8ea1ab8b7_89944525')) {function content_576dc8ea1ab8b7_89944525($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	
<header class="header">
	
	<?php echo $_smarty_tpl->getSubTemplate ("logo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
	<?php echo $_smarty_tpl->getSubTemplate ("navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
</header>
<script src="https://cdn.tailwindcss.com"></script>
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
<div class="container mx-auto px-20">
<div class="flex flex-col w-full" style="cursor: auto;">
  <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 my-2 w-full">
    <div class="metric-card bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72 w-full" style="cursor: auto;">
      <a aria-label="Unsplash Downloads" target="_blank" rel="noopener noreferrer" href="https://stackdiary.com/">
        <div class="flex items-center text-gray-900 dark:text-gray-100" style="cursor: auto;">Twitter Followers
          <svg class="h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="cursor: auto;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
          </svg>
        </div>
      </a>
      <p class="mt-2 text-3xl font-bold spacing-sm text-black dark:text-white" style="cursor: auto;">5,412</p>
    </div>
    <div class="metric-card bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72 w-full" style="cursor: auto;">
      <a aria-label="Unsplash Views" target="_blank" rel="noopener noreferrer" href="https://stackdiary.com/">
        <div class="flex items-center text-gray-900 dark:text-gray-100" style="cursor: auto;">Email Subscribers
          <svg class="h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
          </svg>
        </div>
      </a>
      <p class="mt-2 text-3xl font-bold spacing-sm text-black dark:text-white" style="cursor: auto;">3,641</p>
    </div>
  </div>
  <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 my-2 w-full">
    <div class="metric-card bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72 w-full" style="cursor: auto;">
      <a aria-label="YouTube Subscribers" target="_blank" rel="noopener noreferrer" href="https://stackdiary.com/">
        <div class="flex items-center text-gray-900 dark:text-gray-100" style="cursor: auto;">Blog Articles
          <svg class="h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
          </svg>
        </div>
      </a>
      <p class="mt-2 text-3xl font-bold spacing-sm text-black dark:text-white" style="cursor: auto;">56</p>
    </div>
    <div class="metric-card bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72 w-full" style="cursor: auto;">
      <a aria-label="YouTube Views" target="_blank" rel="noopener noreferrer" href="https://stackdiary.com/">
        <div class="flex items-center text-gray-900 dark:text-gray-100">GitHub Projects
          <svg class="h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="cursor: auto;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
          </svg>
        </div>
      </a>
      <p class="mt-2 text-3xl font-bold spacing-sm text-black dark:text-white" style="cursor: auto;">5</p>
    </div>
  </div>
</div>
</div>
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>