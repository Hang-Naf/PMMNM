<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

include 'db_connect.php';
$admin_notifications = $conn->query("
  SELECT * FROM notifications 
  WHERE (type = 'user_to_admin') 
  ORDER BY created_at DESC
");

$unread_count = $conn->query("
  SELECT COUNT(*) AS unread_total 
  FROM notifications 
  WHERE (type = 'user_to_admin') AND is_read = 0
")->fetch_assoc()['unread_total'];

?>

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
.dropdown-menu.dropdown-menu-right {
    width: 320px;
    max-height: 350px;
    overflow-y: auto;
    overflow-x: hidden;  /* THÊM DÒNG NÀY */
    white-space: normal; /* THÊM DÒNG NÀY để xuống dòng nếu dài */
}
.dropdown-menu .dropdown-item {
    white-space: normal !important;
    word-wrap: break-word;
    max-width: 100%;
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

        <div class="dropdown mr-3">
  <a href="#" class="nav-link dropdown-toggle notification-icon text-white" id="notifDropdown" role="button"
     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-bell"></i>
    <!-- <span id="notification-count" class="badge badge-danger" style="<?php echo ($admin_notifications->num_rows > 0) ? 'display:inline;' : 'display:none;'; ?>">
      <?php echo $admin_notifications->num_rows; ?>
    </span> -->
    <span id="notification-count" class="badge badge-danger" style="<?= $unread_count > 0 ? 'display:inline;' : 'display:none;' ?>">
      <?= $unread_count ?>
    </span>

  </a>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifDropdown" style="width: 320px; max-height: 350px; overflow-y: auto;">
    <div class="px-3 py-2 border-bottom">
      <a href="index.php?page=notifications" class="btn btn-sm btn-primary btn-block"><i class="fas fa-plus-circle"></i> Tạo thông báo</a>
      <a href="#" id="markAllRead" class="btn btn-sm btn-light btn-block mt-2">≡ Đánh dấu đã đọc tất cả</a>
    </div>
    <?php if ($admin_notifications->num_rows > 0): ?>
      <?php while ($noti = $admin_notifications->fetch_assoc()): ?>
        <div class="dropdown-item small">
          <a href="notification_router.php?id=<?php echo $noti['id'] ?>" 
            class="<?php echo $noti['is_read'] == 0 ? 'font-weight-bold text-primary' : '' ?>">
            <i class="fas fa-tools text-primary"></i> 
            <?php echo htmlspecialchars($noti['message']); ?><br>
            <small class="text-muted"><?php echo date("d/m/Y H:i", strtotime($noti['created_at'])); ?></small>
          </a>
        </div>

      <?php endwhile; ?>
    <?php else: ?>
      <div class="dropdown-item text-center text-muted">Không có thông báo</div>
    <?php endif; ?>
  </div>
</div>

        <div class=" dropdown mr-4 mt-2">
          <a href="#" class="text-white dropdown-toggle" id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_name'] ?> </a>
          <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
            <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
            <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
          </div>
        </div>
      </div>
    </div>

</nav>

<script>
  $('#manage_my_account').click(function() {
    uni_modal("Manage Account", "manage_user.php?id=<?php echo $_SESSION['login_id'] ?>&mtype=own")
  })
</script>
<script>
  document.getElementById('markAllRead').addEventListener('click', function(e) {
    e.preventDefault();
    fetch('ajax.php?action=mark_all_read')
  .then(() => {
    document.getElementById('notification-count').style.display = 'none';
  });
});

</script>


