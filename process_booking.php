<?php
session_start();
include 'db_connect.php'; // Kết nối database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $house_id = $_POST['house_id'];
    $owner_id = $_POST['owner_id'];
    $viewing_date = $_POST['viewing_date'];

    $sql = "INSERT INTO appointments (user_id, house_id, owner_id, viewing_date, status)
            VALUES ('$user_id', '$house_id', '$owner_id', '$viewing_date', 'pending')";

    if (mysqli_query($conn, $sql)) {
        echo "Đặt lịch thành công!";
        header("Location: index.php?page=schedule_viewing&success=1"); // Quay lại trang đặt lịch
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>
