<?php
include 'db_connect.php';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tenant_name = $_POST['tenant_name'] ?? '';
    $room_number = $_POST['room_number'] ?? '';
    $issue = $_POST['issue'] ?? '';
    $request_date = $_POST['request_date'] ?? '';

    // Kiểm tra đơn giản
    if ($tenant_name && $room_number && $issue && $request_date) {
        $stmt = $conn->prepare("INSERT INTO maintenance_requests (tenant_name, room_number, issue, request_date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $tenant_name, $room_number, $issue, $request_date);

        if ($stmt->execute()) {
            $success = true;
        } else {
            $error = "Lỗi khi gửi yêu cầu: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = "Vui lòng điền đầy đủ thông tin.";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi Yêu Cầu Bảo Trì</title>
    <link rel="stylesheet" href="user.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f8f9fa;
            padding: 50px;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
            text-align: left;
        }
        label {
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            margin-top: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #2980b9;
        }
        .success-message {
            color: green;
            font-weight: bold;
            text-align: center;
        }
        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
        }

        .navbar {
            display: flex;
            align-items: center;
            padding: 10px;
            background: white;
            border-bottom: 1px solid #ddd;
        }

        .menu-icon {
            font-size: 24px;
            margin-right: 15px;
        }

        .dropdown {
            position: relative;
            margin-right: 15px;
        }

        .dropdown-toggle {
            background: none;
            border: none;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            border: 1px solid #ccc;
            z-index: 1000;
        }

        .dropdown-menu a {
            display: block;
            padding: 5px 10px;
            text-decoration: none;
            color: black;
        }

        .dropdown-menu a:hover {
            background: #f0f0f0;
        }

        .dropdown-active {
            display: block !important;
        }

        .search-bar {
            flex: 1;
            display: flex;
            align-items: center;
        }

        .search-bar input {
            width: 100%;
            padding: 5px 10px;
        }

        .search-bar button {
            background: orange;
            color: white;
            border: none;
            padding: 6px 10px;
        }

        .icons {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: 15px;
        }

        .icon-wrapper {
            position: relative;
        }

        .dropdown-menu {
            white-space: nowrap;
            width: max-content;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
        }

        .post-button {
            margin-left: 15px;
            background: orange;
            color: white;
            padding: 8px 16px;
            border: none;
            font-weight: bold;
            border-radius: 4px;
        }

        .home-button {
            display: inline-block;
            background-color: #2ecc71;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .home-button:hover {
            background-color: #27ae60;
        }


    </style>
</head>
<body>
    
    <div class="container">
        <h2>🔧 Gửi Yêu Cầu Bảo Trì</h2>

        <!-- <?php if ($success): ?>
            <p class="success-message">✅ Yêu cầu đã được gửi thành công!</p>
        <?php elseif ($error): ?>
            <p class="error-message">❌ <?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?> -->

        <?php if ($success): ?>
            <p class="success-message">✅ Yêu cầu đã được gửi thành công!</p>
            <div style="text-align: center; margin-top: 15px;">
                <a href="user_home.php" class="home-button">🔙 Về Trang Chủ</a>
            </div>
        <?php elseif ($error): ?>
            <p class="error-message">❌ <?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>


        <form method="POST">
            <label for="tenant_name">Tên người thuê:</label>
            <input type="text" name="tenant_name" id="tenant_name" required>

            <label for="room_number">Số phòng:</label>
            <input type="text" name="room_number" id="room_number" required>

            <label for="issue">Mô tả vấn đề:</label>
            <textarea name="issue" id="issue" rows="5" required></textarea>

            <label for="request_date">Ngày mong muốn sửa chữa:</label>
            <input type="date" name="request_date" id="request_date" required>

            <button type="submit">Gửi Yêu Cầu</button>
        </form>
    </div>
</body>
</html>
