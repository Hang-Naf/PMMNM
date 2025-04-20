<style>
	.collapse a {
		text-indent: 10px;
	}

	nav#sidebar {
		/*background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>) !important*/
	}
</style>

<nav id="sidebar" class='mx-lt-5 bg-dark'>

	<div class="sidebar-list">
		<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-tachometer-alt "></i></span> Trang chủ</a>
		<a href="index.php?page=categories" class="nav-item nav-categories"><span class='icon-field'><i class="fa fa-th-list "></i></span> Loại nhà</a>
		<a href="index.php?page=houses" class="nav-item nav-houses"><span class='icon-field'><i class="fa fa-home "></i></span> Danh sách nhà</a>
		<a href="index.php?page=tenants" class="nav-item nav-tenants"><span class='icon-field'><i class="fa fa-user-friends "></i></span> Người thuê nhà</a>
		<a href="index.php?page=invoices" class="nav-item nav-invoices"><span class='icon-field'><i class="fa fa-file-invoice "></i></span> Thanh toán</a>
		<a href="index.php?page=reports" class="nav-item nav-reports"><span class='icon-field'><i class="fa fa-list-alt "></i></span> Báo cáo</a>
		<?php if ($_SESSION['login_type'] == 1): ?>
			<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users "></i></span> Người dùng</a>
			<!-- <a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs text-danger"></i></span> System Settings</a> -->
		<?php endif; ?>
		
		<a href="index.php?page=maintenance" class="nav-item nav-maintenance"><span class='icon-field'><i class="fa fa-tools "></i></span> Bảo trì</a>
		<!-- Quản lý lịch hẹn -->
		<a href="index.php?page=manage_appointments" class="nav-item nav-manage_appointments">
    		<span class='icon-field'><i class="fa fa-calendar"></i></span> Quản lý lịch hẹn
		</a>
	</div>

</nav>
<script>
	$('.nav_collapse').click(function() {
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>