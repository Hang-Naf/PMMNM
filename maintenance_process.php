<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenant_name = $_POST['tenant_name'];
    $room_number = $_POST['room_number'];
    $issue = $_POST['issue'];
    $request_date = $_POST['request_date'];

    $sql = "INSERT INTO maintenance_requests (tenant_name, room_number, issue, request_date) 
            VALUES ('$tenant_name', '$room_number', '$issue', '$request_date')";

    if (mysqli_query($conn, $sql)) {
        echo "Yêu cầu bảo trì đã được gửi thành công.";
        header("Location: maintenance_admin.php"); // Điều hướng về trang quản trị
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>