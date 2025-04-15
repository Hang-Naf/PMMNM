<?php
include 'db_connect.php';

$response = ["status" => "error", "message" => "Lỗi không xác định!"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $house_type = $_POST['house_type'];
    $price_range = $_POST['price_range'];
    $note = $_POST['note'];

    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare("INSERT INTO schedules (tenant_name, phone, date_in, time_in, location, house_type, price_range, note, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)");
    $stmt->bind_param("ssssssss", $name, $phone, $date, $time, $location, $house_type, $price_range, $note);

    if ($stmt->execute()) {
        $response = ["status" => "success", "message" => "Lịch hẹn đã được đặt thành công!"];
    } else {
        $response = ["status" => "error", "message" => "Lỗi khi lưu lịch hẹn!"];
    }

    $stmt->close();
}

echo json_encode($response);
?>
