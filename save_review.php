<?php
// Bắt đầu session
session_start();
include('db_connect.php'); // Kết nối cơ sở dữ liệu

// Kiểm tra nếu người dùng đã nhập dữ liệu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $review_text = mysqli_real_escape_string($conn, $_POST['review_text']);
    $created_at = date('Y-m-d H:i:s'); // Thời gian hiện tại

    // Thêm đánh giá vào bảng reviews
    $query = "INSERT INTO reviews (user_name, review_text, created_at) 
              VALUES ('$user_name', '$review_text', '$created_at')";
    
    if ($conn->query($query) === TRUE) {
        // Chuyển hướng về trang reviews sau khi thêm đánh giá thành công
        header("Location: reviews.php");
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
