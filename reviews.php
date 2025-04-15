<?php
// Bắt đầu session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('db_connect.php'); // Kết nối cơ sở dữ liệu

// Lấy danh sách đánh giá từ bảng reviews
$query = "SELECT * FROM reviews ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đánh Giá</title>
    <!-- Thêm các liên kết CSS (Bootstrap, FontAwesome, v.v...) -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Đánh Giá Nhà Thuê</h2>

        <!-- Form thêm đánh giá mới -->
        <div class="card mb-4">
            <div class="card-header">
                <strong>Thêm Đánh Giá Mới</strong>
            </div>
            <div class="card-body">
                <form action="save_review.php" method="POST">
                    <div class="mb-3">
                        <label for="user_name" class="form-label">Tên của bạn</label>
                        <input type="text" class="form-control" id="user_name" name="user_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="review_text" class="form-label">Nội dung đánh giá</label>
                        <textarea class="form-control" id="review_text" name="review_text" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi Đánh Giá</button>
                </form>
            </div>
        </div>

        <!-- Danh sách các đánh giá -->
        <div class="card">
            <div class="card-header">
                <strong>Các Đánh Giá</strong>
            </div>
            <div class="card-body">
                <?php if ($result->num_rows > 0): ?>
                    <ul class="list-group">
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <li class="list-group-item mb-3">
                                <div class="d-flex justify-content-between">
                                    <strong><?php echo htmlspecialchars($row['user_name']); ?></strong>
                                    <small class="text-muted"><?php echo $row['created_at']; ?></small>
                                </div>
                                <p><?php echo nl2br(htmlspecialchars($row['review_text'])); ?></p>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>Chưa có đánh giá nào.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Thêm thư viện JS (Bootstrap và jQuery nếu cần) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
