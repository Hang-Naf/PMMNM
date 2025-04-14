<?php
header('Content-Type: application/json');
include 'db_connect.php';

$response = ["status" => "error", "message" => "Lỗi không xác định!"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Lấy dữ liệu từ form
    $tenant_id = 0; // nếu chưa login, có thể để 0 hoặc NULL
    $house_id = 0;  // nếu chưa chọn nhà cụ thể, có thể để 0
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $location = $_POST['location'] ?? '';
    $price_range = $_POST['price_range'] ?? '';
    $status = 0;

    // Gộp ngày + giờ thành schedule_time
    $schedule_time = date('Y-m-d H:i:s', strtotime($date . ' ' . $time));

    if (empty($date) || empty($time) || empty($location)) {
        echo json_encode(["status" => "error", "message" => "Vui lòng nhập đầy đủ ngày, giờ và địa điểm."]);
        exit;
    }

    // Lưu dữ liệu vào bảng schedules
    $stmt = $conn->prepare("INSERT INTO schedules 
        (tenant_id, house_id, schedule_time, location, price_range, status)
        VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("iisssi", 
            $tenant_id, $house_id, $schedule_time, $location, $price_range, $status
        );

        if ($stmt->execute()) {
            $response = ["status" => "success", "message" => "🎉 Lịch hẹn đã được đặt thành công!"];
        } else {
            $response["message"] = "Lỗi khi lưu lịch hẹn: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $response["message"] = "Lỗi CSDL: " . $conn->error;
    }

    if (isset($_POST['delete_appointment'])) {
        $appointmentId = $_POST['appointment_id'];
    
        // Kết nối CSDL nếu chưa có
        include 'db_connection.php'; // nếu có file riêng cho kết nối
    
        $sql = "DELETE FROM appointments WHERE id = $appointmentId";
        if (mysqli_query($conn, $sql)) {
            // Có thể redirect lại trang quản lý lịch hẹn
            header("Location: manage_appointments.php?status=deleted");
            exit;
        } else {
            echo "Lỗi khi xóa: " . mysqli_error($conn);
        }
    }
    
}

echo json_encode($response);
?>
