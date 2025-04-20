<?php
header('Content-Type: application/json');
$response = [];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Phương thức không hợp lệ!');
    }

    $conn = new mysqli("127.0.0.1", "root", "", "house_rental_db", 3307);
    if ($conn->connect_error) {
        throw new Exception('Lỗi kết nối CSDL: ' . $conn->connect_error);
    }

    $name        = $_POST['name'] ?? '';
    $phone       = $_POST['phone'] ?? '';
    $date        = $_POST['date'] ?? '';
    $time        = $_POST['time'] ?? '';
    $location    = $_POST['location'] ?? '';
    $house_type  = $_POST['house_type'] ?? '';
    $price_range = $_POST['price_range'] ?? '';
    $note        = $_POST['note'] ?? '';

    if (!$name || !$phone || !$date || !$time) {
        throw new Exception('Vui lòng nhập đầy đủ thông tin!');
    }

    $stmt = $conn->prepare("INSERT INTO schedules (tenant_name, phone, date_in, time_in, location, house_type, price_range, note, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'chưa xác nhận')");
    if (!$stmt) {
        throw new Exception('Lỗi prepare: ' . $conn->error);
    }

    $stmt->bind_param("ssssssss", $name, $phone, $date, $time, $location, $house_type, $price_range, $note);

    if (!$stmt->execute()) {
        throw new Exception('Lỗi khi lưu dữ liệu: ' . $stmt->error);
    }

    $response['status'] = 'success';
    $response['message'] = '🎉 Đặt lịch thành công!';
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
