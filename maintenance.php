<?php
include 'db_connect.php';

// Cập nhật trạng thái nếu admin thay đổi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $id = $_POST['request_id'];
    $new_status = $_POST['status'];
// Lấy trạng thái cũ và tên người thuê
$old_res = $conn->query("SELECT status, tenant_name FROM maintenance_requests WHERE id = $id");
    
if ($old_res && $old_res->num_rows > 0) {
    $old_data = $old_res->fetch_assoc();
    $old_status = $old_data['status'];
    $tenant_name = $old_data['tenant_name'];

    // Cập nhật trạng thái mới
    $conn->query("UPDATE maintenance_requests SET status = '$new_status' WHERE id = $id");

    // Nếu trạng thái chuyển thành "Đã sửa xong", gửi thông báo
    if ($old_status != 'Đã sửa xong' && $new_status == 'Đã sửa xong') {
        $user_q = $conn->query("SELECT id FROM users WHERE name = '$tenant_name' LIMIT 1");
        if ($user_q && $user_q->num_rows > 0) {
            $user_row = $user_q->fetch_assoc();
            $user_id = $user_row['id'];
            $message = "Yêu cầu bảo trì của bạn ($tenant_name) đã được hoàn thành";
            $conn->query("INSERT INTO notifications (user_id, message, type) 
                          VALUES ($user_id, '$message', 'maintenance_done')");
        }
    }
    
}
}

// Lấy danh sách yêu cầu bảo trì
$result = mysqli_query($conn, "SELECT * FROM maintenance_requests");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Yêu Cầu Bảo Trì</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa }
        .container { width: 80%; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #007bff; color: white; }
        .status-form { display: flex; justify-content: center; gap: 10px; }
        button { background-color: #28a745; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>
    <div class="container">
        <h2>📋 Danh sách Yêu Cầu Bảo Trì</h2>
        <table>
            <tr>
                <th>Tên người thuê</th>
                <th>Số phòng</th>
                <th>Mô tả</th>
                <th>Ngày sửa chữa</th>
                <th>Trạng thái</th>
                <th>Cập nhật</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['tenant_name']); ?></td>
                <td><?php echo htmlspecialchars($row['room_number']); ?></td>
                <td><?php echo htmlspecialchars($row['issue']); ?></td>
                <td><?php echo htmlspecialchars($row['request_date']); ?></td>
                <td>
                    <form method="POST" class="status-form">
                        <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                        <input type="radio" name="status" value="Đang sửa" <?php if ($row['status'] == 'Đang sửa') echo 'checked'; ?>> Đang sửa
                        <input type="radio" name="status" value="Đã sửa xong" <?php if ($row['status'] == 'Đã sửa xong') echo 'checked'; ?>> Đã sửa xong
                        <td>
                            <button type="submit" name="update_status">✔ Cập nhật</button>
                        </td>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>