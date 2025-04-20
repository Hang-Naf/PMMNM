<!-- <?php 
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý yêu cầu bảo trì</title>
    <style>
		.row {
			display: flex;
			flex-wrap: wrap;
		}

		.card {
			display: flex;
			flex-direction: column;
			height: 100%;
		}

		.card-body {
			flex-grow: 1; /* Để phần nội dung mở rộng tối đa */
		}
	</style>
</head>
<body>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="col-md-12">
					<div class="row">
						<div class="col-sm-4">
							<div class="card border-primary">
								<div class="card-body bg-light">
									<h4><b>Maintenance required</b></h4>
								</div>
								<div class="card-footer">
									<div class="col-md-12">
										<a href="index.php?page=maintenance_user" class="d-flex justify-content-between"> <span>View Report</span> <span class="fa fa-chevron-circle-right"></span></a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="card border-primary">
								<div class="card-body bg-light">
									<h4><b>Receive maintenance requests</b></h4>
								</div>
								<div class="card-footer">
									<div class="col-md-12">
										<a href="index.php?page=maintenance_admin" class="d-flex justify-content-between"> <span>View Report</span> <span class="fa fa-chevron-circle-right"></span></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html> -->
<?php
include 'db_connect.php';

// Cập nhật trạng thái nếu admin thay đổi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $id = $_POST['request_id'];
    $new_status = $_POST['status'];
    
    $sql = "UPDATE maintenance_requests SET status = '$new_status' WHERE id = $id";
    mysqli_query($conn, $sql);
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
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; text-align: center; }
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