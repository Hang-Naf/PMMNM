<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi Yêu Cầu Bảo Trì</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h2>🔧 Gửi Yêu Cầu Bảo Trì</h2>
        <form method="POST" action="maintenance_process.php">
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