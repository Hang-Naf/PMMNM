<style>
	.logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 7px 11px;
    border-radius: 50% 50%;
    color: #000000b3;
}

.notification-icon {
    position: relative;
    font-size: 20px;
    margin-right: 20px;
}

.notification-icon .badge {
    position: absolute;
    top: -10px;
    right: -10px;
    background: red;
    color: white;
    border-radius: 50%;
    padding: 4px 7px;
    font-size: 12px;
    display: none;
}
.notification-icon {
    position: relative;
    font-size: 20px;
    margin-right: 20px;
    display: flex;
    align-items: center;
    transform: translateY(5px); /* Điều chỉnh độ cao */
}



</style>

<nav class="navbar navbar-light fixed-top bg-primary" style="padding:0;min-height: 3.5rem">
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
  		<div class="col-md-1 float-left" style="display: flex;">
  		<img src="house.png" alt="..." width="80%">
  		</div>
      <div class="col-md-4 float-left text-white mt-2">
        <large><b><?php echo isset($_SESSION['system']['name']) ? $_SESSION['system']['name'] : '' ?></b></large>
      </div>
	  	<div class="float-right" style="display: flex; align-items: center;">
        
        <!-- Biểu tượng thông báo -->
        <div class="dropdown mr-3">
          <a href="index.php?page=notifications" class="nav-item nav-notifications"  class="notification-icon text-white">
            <i class="fas fa-bell"></i>
              <span id="notification-count" class="badge badge-danger" style="display:none;">0</span>
          </a>


            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifications">
                <div id="notification-list" style="max-height: 300px; overflow-y: auto;">
                    <a class="dropdown-item text-center text-muted">Không có thông báo mới</a>
                </div>
            </div>
        </div>

        <!-- Tài khoản người dùng -->
        <div class="dropdown mr-4 mt-2">
            <a href="#" class="text-white dropdown-toggle" id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['login_name'] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
                <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
            </div>
        </div>
      </div> 
    </div>
  </div>
</nav>

<script>
  $('#manage_my_account').click(function(){
    uni_modal("Manage Account","manage_user.php?id=<?php echo $_SESSION['login_id'] ?>&mtype=own")
  })
</script>
