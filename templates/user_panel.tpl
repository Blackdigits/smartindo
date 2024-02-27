<!-- Sidebar user panel -->
<div class="user-panel">
	<div class="pull-left image">
		{if $loginPhoto != ''}
			<img src="img/staffs/thumb/small_{$loginPhoto}" class="img-circle" alt="User Image" />
		{/if}
	</div>
	<div class="pull-left info">
		<p>Hello, {$loginStaffNickName}</p>
		{$loginStaffPosition}
	</div>
</div>
