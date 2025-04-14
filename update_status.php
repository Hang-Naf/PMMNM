<?php
include 'db_connect.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    $sql = "UPDATE appointments SET status='$status' WHERE id='$id'";
    
    if (mysqli_query($conn, $sql)) {
        echo "Cập nhật trạng thái thành công!";
        header("Location: index.php?page=manage_appointments"); // Quay lại danh sách lịch hẹn
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>
