<?php

$action = $_GET['action'];
include 'admin_class.php';
include 'db_connect.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == 'update_account'){
	$save = $crud->update_account();
	if($save)
		echo $save;
}
if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_category"){
	$save = $crud->save_category();
	if($save)
		echo $save;
}

if($action == "delete_category"){
	$delete = $crud->delete_category();
	if($delete)
		echo $delete;
}
if($action == "save_house"){
	$save = $crud->save_house();
	if($save)
		echo $save;
}
if($action == "delete_house"){
	$save = $crud->delete_house();
	if($save)
		echo $save;
}

if($action == "save_tenant"){
	$save = $crud->save_tenant();
	if($save)
		echo $save;
}
if($action == "delete_tenant"){
	$save = $crud->delete_tenant();
	if($save)
		echo $save;
}
if($action == "get_tdetails"){
	$get = $crud->get_tdetails();
	if($get)
		echo $get;
}

if($action == "save_payment"){
	$save = $crud->save_payment();
	if($save)
		echo $save;
}
if($action == "delete_payment"){
	$save = $crud->delete_payment();
	if($save)
		echo $save;
}

if($action == "confirm_schedule"){
    $id = $_POST['id'];
    $update = $conn->query("UPDATE schedules SET status = 1 WHERE id = $id");
    if($update){
        echo 1;
		exit;
    }
}

if($action == "cancel_schedule"){
    $id = $_POST['id'];
    $delete = $conn->query("DELETE FROM schedules WHERE id = $id");
    if($delete){
        echo 1;
		exit;
    }
}

// 👁️ XEM CHI TIẾT LỊCH HẸN
if ($action == 'view_schedule') {
	$res = $conn->query("SELECT * FROM schedules WHERE id = $id");
	if ($res && $res->num_rows > 0) {
		$row = $res->fetch_assoc();

		$datetime = strtotime($row['schedule_time']);
		$date = date("d-m-Y", $datetime);
		$time = date("H:i", $datetime);

		?>
		<p><strong>ID lịch hẹn:</strong> <?php echo $row['id']; ?></p>
		<p><strong>Người thuê (tenant_id):</strong> <?php echo $row['tenant_id']; ?></p>
		<p><strong>Nhà cần xem (house_id):</strong> <?php echo $row['house_id']; ?></p>
		<p><strong>Ngày xem nhà:</strong> <?php echo $date; ?></p>
		<p><strong>Giờ xem nhà:</strong> <?php echo $time; ?></p>
		<p><strong>Địa điểm:</strong> <?php echo $row['location']; ?></p>
		<p><strong>Khoảng giá:</strong> <?php echo $row['price_range']; ?></p>
		<p><strong>Loại nhà:</strong> <?php echo $row['house_type'] ?: 'Chưa chọn'; ?></p>
		<p><strong>Số điện thoại:</strong> <?php echo $row['phone'] ?: 'Chưa nhập'; ?></p>
		<p><strong>Ghi chú:</strong> <?php echo $row['note'] ?: 'Không có'; ?></p>
		<p><strong>Trạng thái:</strong> <?php echo ucfirst($row['status']); ?></p>
		<p><strong>Ngày tạo:</strong> <?php echo $row['created_at']; ?></p>
		<?php
	} else {
		echo "Không tìm thấy lịch hẹn.";
	}
	exit;
}

ob_end_flush();
?>
