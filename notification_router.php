<?php
session_start();
include 'db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = $_GET['id'];
$conn->query("UPDATE notifications SET is_read = 1 WHERE id = $id");

$notif_id = intval($_GET['id']);

// Đánh dấu là đã đọc
$conn->query("UPDATE notifications SET is_read = 1 WHERE id = $notif_id");

// Truy vấn để lấy nội dung message và type
$result = $conn->query("SELECT * FROM notifications WHERE id = $notif_id LIMIT 1");

if ($result && $result->num_rows > 0) {
    $notif = $result->fetch_assoc();
    $msg = $notif['message'];
    $type = $notif['type'];

    // Điều hướng
    if (strpos($msg, 'bảo trì') !== false) {
        header("Location: index.php?page=maintenance");
        exit;
    } elseif (strpos($msg, 'lịch hẹn') !== false) {
        header("Location: index.php?page=manage_appointments");
        exit;
    }
}

// fallback nếu không match
header("Location: index.php");
exit;
