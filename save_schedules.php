<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "house_rental_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Kết nối CSDL thất bại']);
    exit;
}

$fields = ['house_id', 'name', 'phone', 'date_in', 'time_in', 'location', 'house_type', 'price_range', 'note'];
foreach ($fields as $field) {
    if (!isset($_POST[$field])) {
        echo json_encode(['status' => 'error', 'message' => 'Thiếu thông tin: ' . $field]);
        exit;
    }
}

$stmt = $conn->prepare("INSERT INTO schedules (house_id, name, phone, date_in, time_in, location, house_type, price_range, note) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Lỗi prepare: ' . $conn->error]);
    exit;
}

$stmt->bind_param("issssssss", 
    $_POST['house_id'], 
    $_POST['name'], 
    $_POST['phone'], 
    $_POST['date_in'], 
    $_POST['time_in'], 
    $_POST['location'], 
    $_POST['house_type'], 
    $_POST['price_range'], 
    $_POST['note']
);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Đặt lịch thành công!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Lỗi khi lưu lịch: ' . $stmt->error]);
}
