<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
	<li class="active">
		<a href="home.php">
			<i class="fa fa-home"></i> <span>Dashboard</span>
		</a>
	</li>
	<li class="treeview">
		<a href="#">
			<i class="fa fa-th"></i>
			<span>Master Data</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			{section name=dataAuthorize loop=$dataAuthorize}
				{if $dataAuthorize[dataAuthorize].modulID == 1 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
					<li><a href="staffs.php"><i class="fa fa-angle-double-right"></i> Admin</a></li>
				{/if}
				{if $dataAuthorize[dataAuthorize].modulID == 4 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
					<li><a href="categories.php"><i class="fa fa-angle-double-right"></i> Kategori</a></li>
				{/if}
				{if $dataAuthorize[dataAuthorize].modulID == 5 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
					<li><a href="products.php"><i class="fa fa-angle-double-right"></i> Produk</a></li>
				{/if}
				{if $dataAuthorize[dataAuthorize].modulID == 12 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
					<li><a href="factories.php"><i class="fa fa-angle-double-right"></i> Gudang</a></li>
				{/if}
				{if $dataAuthorize[dataAuthorize].modulID == 6 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
					<li><a href="suppliers.php"><i class="fa fa-angle-double-right"></i> SFA</a></li>
				{/if}
				{if $dataAuthorize[dataAuthorize].modulID == 2 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
					<li><a href="customers.php"><i class="fa fa-angle-double-right"></i> Toko</a></li>
				{/if} 
			{/section}
		</ul>
	</li> 
	<li class="treeview">
		<a href="#">
			<i class="fa fa-laptop"></i>
			<span>Transaksi</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			{section name=dataAuthorize loop=$dataAuthorize} 
				{if $dataAuthorize[dataAuthorize].modulID == 7 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
					<li><a href="transfers.php"><i class="fa fa-angle-double-right"></i> <span>Transfer Stok</span></a></li>
				{/if}
				{if $dataAuthorize[dataAuthorize].modulID == 14 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
					<li><a href="spb.php"><i class="fa fa-angle-double-right"></i> Stok Sales</a></li>
				{/if}
				{if $dataAuthorize[dataAuthorize].modulID == 28 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
					<li><a href="so.php"><i class="fa fa-angle-double-right"></i> Penjualan</a></li>
				{/if} 
			{/section}
		</ul>
	</li>
	{section name=dataAuthorize loop=$dataAuthorize}
		<li class="treeview">
			<a href="#">
				<i class="fa fa-folder"></i> <span>TOP Toko & SFA</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				{section name=dataAuthorize loop=$dataAuthorize}
					{if $dataAuthorize[dataAuthorize].modulID == 23 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
						<li><a href="debts.php"><i class="fa fa-angle-double-right"></i> TOP SFA</a></li>
					{/if}
					{if $dataAuthorize[dataAuthorize].modulID == 24 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
						<li><a href="receivables.php"><i class="fa fa-angle-double-right"></i> TOP Toko</a></li>
					{/if}
				{/section}
			</ul>
		</li>
	{/section}  
	<li class="treeview">
		<a href="#">
			<i class="fa fa-edit"></i> <span>Retur & Alokasi Barang</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			{section name=dataAuthorize loop=$dataAuthorize}
				{if $dataAuthorize[dataAuthorize].modulID == 11 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
					<li><a href="retur_staffs.php"><i class="fa fa-angle-double-left"></i> Retur Toko</a></li>
				{/if}
				{if $dataAuthorize[dataAuthorize].modulID == 10 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
					<li><a href="retur_suppliers.php"><i class="fa fa-angle-double-left"></i> Retur SFA</a></li>
				{/if} 
                {if $dataAuthorize[dataAuthorize].modulID == 13 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
					<li><a href="bbm.php"><i class="fa fa-angle-double-left"></i> Alokasi Barang Masuk</a></li>
				{/if}
			{/section}
		</ul>
	</li>
	<li class="treeview">
		<a href="#">
			<i class="fa fa-bar-chart-o"></i> <span>Laporan</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			{section name=dataAuthorize loop=$dataAuthorize}
				{if $dataAuthorize[dataAuthorize].modulID == 17 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
					<li><a href="report_stock_products.php"><i class="fa fa-angle-double-right"></i> Laporan Stok Gudang</a></li>
				{/if}
                {if $dataAuthorize[dataAuthorize].modulID == 17 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
					<li><a href="report_stock_sales.php"><i class="fa fa-angle-double-right"></i> Laporan Stok Sales</a></li>
				{/if} 
				{if $dataAuthorize[dataAuthorize].modulID == 20 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
					<li><a href="report_out.php"><i class="fa fa-angle-double-right"></i> Laporan Penjualan</a></li>
				{/if} 
				{if $dataAuthorize[dataAuthorize].modulID == 22 AND strpos("{$dataAuthorize[dataAuthorize].authorize}", "{$loginStaffLevel}") !== false}
					<li><a href="report_receives.php"><i class="fa fa-angle-double-right"></i> Laporan TOP TOKO</a></li>
				{/if}
			{/section}
		</ul>
	</li>  
	<li class="active">
		<a href="exceler/index.php?cron=false">
			<i class="fa fa-download"></i> <span>Laporan Harian</span>
		</a>
	</li>
</ul>