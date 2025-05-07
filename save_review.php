<?php
session_start();
include('db_connect.php'); // Kết nối cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kiểm tra nếu người dùng đã đăng nhập
    if (!isset($_SESSION['login_id'])) {
        die("Bạn chưa đăng nhập!");
    }

    $user_id = $_SESSION['login_id'];
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $review_text = mysqli_real_escape_string($conn, $_POST['review_text']);
    $created_at = date('Y-m-d H:i:s');
    $rating = 5; // Nếu bạn chưa có form để nhập, có thể để mặc định

    // Lấy tenant_id và house_id từ bảng tenants
    $sql = "SELECT id AS tenant_id, house_id FROM tenants WHERE user_id = $user_id LIMIT 1";
    $res = $conn->query($sql);

    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $tenant_id = $row['tenant_id'];
        $house_id = $row['house_id'];

        // Chèn vào bảng reviews
        $query = "INSERT INTO reviews (house_id, tenant_id, user_name, user_id, review_text, rating, created_at) 
                  VALUES ($house_id, $tenant_id, '$user_name', $user_id, '$review_text', $rating, '$created_at')";

        if ($conn->query($query) === TRUE) {
            header("Location: reviews.php");
            exit();
        } else {
            echo "Lỗi khi thêm đánh giá: " . $conn->error;
        }

    } else {
        echo "Không tìm thấy người thuê (tenant) tương ứng!";
    }
}
?>


