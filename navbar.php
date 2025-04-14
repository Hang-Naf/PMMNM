
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600&display=swap" rel="stylesheet">
</head>

<style>
	.collapse a{
		text-indent:10px;
	}
	nav#sidebar{
		/*background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>) !important*/
	}

	#sidebar {
    transition: all 0.3s ease-in-out;
    width: 250px;
    position: fixed;
    left: 0;
    top: 0;
    height: 100vh;
    background: #343a40;
	font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

}
#sidebar.collapsed {
    margin-left: -250px;
}
#toggle-sidebar {
    position: fixed;
    left: 0px;
    top: 5px;
    background:  #007bff;
    color: black;
    border: none;
    padding: 8px 10px;
    /* cursor: pointer; */
    z-index: 1050;  /* Hiển thị trên tất cả */
}
#toggle-sidebar:hover {
    background: #0056b3;
}
@media print {
    #sidebar, #toggle-sidebar {
        display: none !important;
    }
}


</style>


<!-- Nút Toggle -->
<button id="toggle-sidebar" class="btn btn-primary m-2">
    <i class="fa fa-bars"></i>
</button>


<nav id="sidebar" class='mx-lt-5 bg-dark' >
		
		<div class="sidebar-list">
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-tachometer-alt "></i></span> Dashboard</a>
				<a href="index.php?page=categories" class="nav-item nav-categories"><span class='icon-field'><i class="fa fa-th-list "></i></span> House Type</a>
				<a href="index.php?page=houses" class="nav-item nav-houses"><span class='icon-field'><i class="fa fa-home "></i></span> Houses</a>
				<a href="index.php?page=tenants" class="nav-item nav-tenants"><span class='icon-field'><i class="fa fa-user-friends "></i></span> Tenants</a>
				<a href="index.php?page=invoices" class="nav-item nav-invoices"><span class='icon-field'><i class="fa fa-file-invoice "></i></span> Payments</a>
				<a href="index.php?page=reports" class="nav-item nav-reports"><span class='icon-field'><i class="fa fa-list-alt "></i></span> Reports</a>
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users "></i></span> Users</a>
				<!-- <a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs text-danger"></i></span> System Settings</a> -->
			<?php endif; ?>

			<a href="index.php?page=reviews" class="nav-item nav-reviews">
            	<span class='icon-field'><i class="fa fa-comments "></i></span> Reviews & Comments
        	</a>

			<a href="index.php?page=contracts" class="nav-item nav-contracts"><span class='icon-field'><i class="fa fa-file-alt"></i></span> Contracts</a>
			
			 <!-- Hẹn lịch xem nhà -->
			<a href="index.php?page=schedule_viewing" class="nav-item nav-schedule">
            	<span class='icon-field'><i class="fa fa-calendar-check"></i></span> Schedule Viewing
        	</a>
			
			<!-- Quản lý lịch hẹn -->
			<a href="index.php?page=manage_appointments" class="nav-item nav-manage_appointments">
    			<span class='icon-field'><i class="fa fa-calendar"></i></span> Manage Appointments
			</a>

		</div>

</nav>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')

	$(document).ready(function(){
        // Làm nổi bật menu tương ứng với trang hiện tại
        $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active');
    });

	$(document).ready(function(){
    	$('#toggle-sidebar').click(function(){
        	$('#sidebar').toggleClass('collapsed');
    	});
	});

</script>

