<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
// include 'user_class.php';
$crud = new Action();
if ($action == 'login') {
	$login = $crud->login();
	if ($login)
		echo $login;
}
if ($action == 'login2') {
	$login = $crud->login2();
	if ($login)
		echo $login;
}
if ($action == 'logout') {
	$logout = $crud->logout();
	if ($logout)
		echo $logout;
}
if ($action == 'logout2') {
	$logout = $crud->logout2();
	if ($logout)
		echo $logout;
}
if ($action == 'save_user') {
	$save = $crud->save_user();
	if ($save)
		echo $save;
}
if ($action == 'delete_user') {
	$save = $crud->delete_user();
	if ($save)
		echo $save;
}
if (isset($_GET['action']) && $_GET['action'] == "signup") {
	include 'db_connect.php';

	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = md5($_POST['password']); // Mã hóa mật khẩu

	// Kiểm tra xem tên người dùng đã tồn tại chưa
	$check_user = $conn->query("SELECT * FROM users WHERE username = '$username'");
	if ($check_user->num_rows > 0) {
		echo 2; // Trả về 2 nếu username đã tồn tại
		exit;
	}

	// Chèn dữ liệu vào bảng users
	$query = $conn->query("INSERT INTO users (name, username, password) VALUES ('$name', '$username', '$password')");

	if ($query) {
		echo 1; // Đăng ký thành công
	} else {
		echo 0; // Lỗi đăng ký
	}
}

if ($action == 'update_account') {
	$save = $crud->update_account();
	if ($save)
		echo $save;
}
if ($action == "save_settings") {
	$save = $crud->save_settings();
	if ($save)
		echo $save;
}
if ($action == "save_category") {
	$save = $crud->save_category();
	if ($save)
		echo $save;
}

if ($action == "delete_category") {
	$delete = $crud->delete_category();
	if ($delete)
		echo $delete;
}
if ($action == "save_house") {
	$save = $crud->save_house();
	if ($save)
		echo $save;
}
if ($action == "delete_house") {
	$save = $crud->delete_house();
	if ($save)
		echo $save;
}

if ($action == "save_tenant") {
	$save = $crud->save_tenant();
	if ($save)
		echo $save;
}
if ($action == "delete_tenant") {
	$save = $crud->delete_tenant();
	if ($save)
		echo $save;
}
if ($action == "get_tdetails") {
	$get = $crud->get_tdetails();
	if ($get)
		echo $get;
}

if ($action == "save_payment") {
	$save = $crud->save_payment();
	if ($save)
		echo $save;
}
if ($action == "delete_payment") {
	$save = $crud->delete_payment();
	if ($save)
		echo $save;
}

ob_end_flush();
