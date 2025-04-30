<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "house_rental_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID người dùng từ session
if (isset($_SESSION['login_id'])) {
    $user_id = $_SESSION['login_id'];

    // Truy vấn thông tin người dùng
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();  // ✅ Gán vào biến $user
    } else {
        echo "Không tìm thấy người dùng.";
        exit;
    }
} else {
    echo "Bạn chưa đăng nhập.";
    exit;
}
// Cập nhật thông tin
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Cập nhật mật khẩu nếu có nhập
    if (!empty($_POST["new_password"])) {
        $new_password = md5($_POST["new_password"]);
        $conn->query("UPDATE users SET password='$new_password' WHERE id=$user_id");
    }

    // Cập nhật thông tin cá nhân
    $stmt = $conn->prepare("UPDATE users SET name=?, email=?, phone=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $email, $phone, $user_id);
    $stmt->execute();

    echo "<p style='color:green'>Cập nhật thành công!</p>";
}

// Lấy dữ liệu người dùng
$result = $conn->query("SELECT * FROM users WHERE id=$user_id");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cập nhật mật khẩu</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        label { display: block; margin-top: 10px; }
        input { padding: 5px; width: 300px; }
        button { margin-top: 15px; padding: 10px 20px; }
    </style>
</head>
<body>
    <h2>Cài đặt mật khẩu mới</h2>
    <form method="POST">
        <label>Họ tên:
            <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" readonly>
        </label>
        <label>Email:
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" readonly>
        </label>
        <label>Số điện thoại:
            <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" readonly>
        </label>
        <label>Mật khẩu mới (bỏ trống nếu không đổi):
            <input type="password" name="new_password">
        </label>
        <button type="submit">Lưu thay đổi</button>
    </form>
</body>
</html>
