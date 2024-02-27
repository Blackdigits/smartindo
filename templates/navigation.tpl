<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
	<!-- Sidebar toggle button-->
	<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</a>
	
	<div class="navbar-right">
		<ul class="nav navbar-nav">
		<!-- User Account: style can be found in dropdown.less -->
		<li class="dropdown user user-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class="glyphicon glyphicon-user"></i>
				<span>{$loginStaffName} <i class="caret"></i></span>
			</a>
			<ul class="dropdown-menu">
				<!-- User image -->
				<li class="user-header bg-light-blue">
					{if $loginPhoto != ''}
						<img src="img/staffs/thumb/small_{$loginPhoto}" class="img-circle" alt="{$loginStaffName}" />
					{/if}
					<p>
						{$loginStaffName}<br>
						{$loginStaffPosition}
						
					</p>
				</li>
				<!-- Menu Footer-->
				<li class="user-footer">
					<div class="pull-left">
						<a href="#" class="btn btn-default btn-flat">Ubah Password</a>
					</div>
					<div class="pull-right">
						<a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
					</div>
				</li>
			</ul>
		</li>
	</ul>
</div>
</nav>