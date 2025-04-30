<html>
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
    $phone = $_POST["phone"];
    $address_user = $_POST["address_user"];
    $email = $_POST["email"];
    $cccd = $_POST["cccd"];
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];

    // Cập nhật mật khẩu nếu có
    if (!empty($_POST["new_password"])) {
        $new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
        $stmt->bind_param("si", $new_password, $user_id);
        $stmt->execute();
    }

    // Cập nhật thông tin cá nhân
    $stmt = $conn->prepare("UPDATE users SET name=?, email=?, phone=?, address_user=?, cccd=?, gender=?, dob=? WHERE id=?");
    $stmt->bind_param("sssssssi", $name, $email, $phone, $address_user, $cccd, $gender, $dob, $user_id);
    $stmt->execute();

    // Sau khi cập nhật xong
    echo "<script>alert('Cập nhật thành công!');</script>";


    // Cập nhật lại dữ liệu mới
    $result = $conn->query("SELECT * FROM users WHERE id=$user_id");
    $user = $result->fetch_assoc();
}
// Truy vấn lấy thông báo chung từ admin
$notification_result = $conn->query("SELECT * FROM notifications ORDER BY created_at DESC");

?>

<head>
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container1 {
            padding: 50 0px 0 50px;
        }

        .container {
            display: flex;
            justify-content: center;
            padding: 0 20 20 20;
        }

        .content1 {
            background-color: #fff;
            padding: 20px;
            margin: 20 20 50 50;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 200px;
            max-height: 200px;
        }

        .ttcn {
            font-weight: 700;
            cursor: default;
            color: #222 !important;
        }

        .content2 {
            background-color: #fff;
            padding: 20px;
            margin: 20 20 50 50;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }

        .sidebar {
            width: 200px;
            margin-right: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
        }

        .main-content {
            flex: 1;
            top: 0px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-group .input-group {
            display: flex;
        }

        .form-group .input-group input {
            flex: 1;
        }

        .form-group .input-group button {
            padding: 10px;
            border: 1px solid #ccc;
            border-left: none;
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .form-group .input-group button:hover {
            background-color: #e0e0e0;
        }

        .form-group .input-group i {
            margin-right: 5px;
        }

        .form-group .note {
            font-size: 12px;
            color: #666;
        }

        .form-group .link {
            color: #007bff;
            text-decoration: none;
        }

        .form-group .link:hover {
            text-decoration: underline;
        }

        .form-group .change-link {
            color: #007bff;
            cursor: pointer;
        }

        .form-group .change-link:hover {
            text-decoration: underline;
        }

        .form-group .select-group {
            display: flex;
            gap: 10px;
        }

        .form-group .select-group select {
            flex: 1;
        }

        .btn-save {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-save:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="user_home.php">
            <img src="logo.png" alt="" width="50px" style="border-radius: 50%;">
        </a>
        <div class="dropdown">
            <button class="dropdown-toggle">
                <h3>Trang thông tin tài khoản</h3>
                <!-- <i class="fas fa-chevron-down">
                </i> -->
            </button>
            <!-- <div class="dropdown-menu">
                <a href="#">Biệt thự</a>
                <a href="#">
                    Chung cư
                </a>
                <a href="#">
                    Căn hộ
                </a>
                <a href="#">
                    Duplex (căn hộ thông tầng)
                </a>
                <a href="#">
                    Nhà đơn/ Nhà riêng
                </a>
                <a href="#">Nhà 2 tầng</a>
                <a href="#">Nhà cấp 4</a>
            </div> -->
        </div>
        <!-- <div class="dropdown">
            <button class="dropdown-toggle">
                Bất động sản
                <i class="fas fa-chevron-down">
                </i>
            </button>
            <div class="dropdown-menu">
                <a href="#">
                    Option 1
                </a>
                <a href="#">
                    Option 2
                </a>
                <a href="#">
                    Option 3
                </a>
            </div>
        </div> -->
        <div class="search-bar">
            <!-- <input placeholder="Search..." type="text" />
            <button>
                <i class="fas fa-search">
                </i>
            </button> -->
        </div>
        <div class="icons">
            <!-- <div class="icon-wrapper">
                <i class="fas fa-bell" id="bell-icon"></i>
                <div class="dropdown-menu" id="bell-menu">
                    <p>Thông báo của bạn</p>
                    <a href="#">Xem tất cả</a>
                </div>
            </div> -->

            <div class="icon-wrapper">
                <i class="fas fa-bell" id="bell-icon"></i>
                <div class="dropdown-menu" id="bell-menu">
                    <?php if ($notification_result->num_rows > 0): ?>
                        <?php while ($notif = $notification_result->fetch_assoc()): ?>
                            <div class="notification-item">
                                <?php if ($notif['type'] == 'maintenance_done'): ?>
                                    <strong style="color: #007bff;">🔧 [Bảo trì]</strong><br>
                                <?php elseif ($notif['type'] == 'general'): ?>
                                    <strong style="color: #555;">📢 [Thông báo]</strong><br>
                                <?php endif; ?>

                                <?php echo htmlspecialchars($notif['message']); ?><br>
                                <small><?php echo date("d/m/Y H:i", strtotime($notif['created_at'])); ?></small>
                            </div>
                        <?php endwhile; ?>

                    <?php else: ?>
                        <div class="notification-item">Không có thông báo nào</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="icon-wrapper">
                <i class="fas fa-comments" id="chat-icon"></i>
                <div class="dropdown-menu" id="chat-menu">
                    <p>Đánh giá</p>
                    <a href="reviews.php">Xem tất cả</a>
                </div>
            </div>

            <!-- <div class="icon-wrapper">
                <i class="fas fa-tools" id="maintenance-icon" onclick="window.location.href='maintenance_user.php'"></i>
            </div> -->

            <div class="icon-wrapper">
                <i class="fas fa-user" id="user-icon"></i>
                <div class="dropdown-menu" id="user-menu">
                    <a href="user_profile.php">Thông tin tài khoản</a>
                    <a href="ajax.php?action=logout">Đăng xuất</a>
                </div>
            </div>

            <div class="icon-wrapper">
                <i class="fas fa-tools" id="maintenance-icon"></i>
                <div class="dropdown-menu" id="maintenance-menu">
                    <a href="maintenance_user.php">Yêu cầu bảo trì</a>
                </div>
            </div>


        </div>


        <button class="post-button" onclick="window.location.href='user_addhouse.php'">
            ĐĂNG TIN
        </button>
    </div>

    <div class="container1">
        <h1> </h1>
    </div>

    <div class="container">
        <div class="content1">
            <div class="sidebar">
                <ul>
                    <li><a class="ttcn" href="#">Thông tin cá nhân</a></li>
                    <!-- <li><a href="#">Liên kết mạng xã hội</a></li> -->
                    <li><a href="account_settings.php">Đổi mật khẩu</a></li> <!-- đặt lại mật khẩu, quên mật khẩu -->
                    <!-- <li><a href="#">Quản lý lịch sử đăng nhập</a></li> -->
                </ul>
            </div>
        </div>
        <div class="content2">
            <div class="main-content">
                <form method="POST">
                    <div class="section-title">Hồ sơ cá nhân</div>
                    <div class="form-group">
                        <label for="name">Họ và tên (tên tài khoản)* </label>
                        <div class="input-group">
                            <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại*</label>
                        <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label> <!-- address_user -->
                        <input type="text" name="address_user" value="<?= htmlspecialchars($user['address_user']) ?>">
                    </div>
                    <div class="section-title">Thông tin bảo mật</div>
                    <div class="form-group">
                        <label for="email">Email*</label>
                        <div class="input-group">
                            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id">CCCD / CMND / Hộ chiếu</label>
                        <input type="text" name="cccd" value="<?= htmlspecialchars($user['cccd']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="gender">Giới tính</label>
                        <select name="gender">
                            <option value="male" <?= $user['gender'] == 'male' ? 'selected' : '' ?>>Nam</option>
                            <option value="female" <?= $user['gender'] == 'female' ? 'selected' : '' ?>>Nữ</option>
                            <option value="other" <?= $user['gender'] == 'other' ? 'selected' : '' ?>>Khác</option>
                        </select>
                        <div>
                            <label for="dob">Ngày, tháng, năm sinh</label>
                            <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($user['dob']) ?>">
                        </div>
                    </div>
                    <button class="btn-save" type="submit">LƯU THAY ĐỔI</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".item").forEach(function(element) {
                element.addEventListener("click", function() {
                    window.location.href = "user_houses.php";
                });
            });
        });
        document.addEventListener("DOMContentLoaded", function() {


            const icons = [{
                    icon: "bell-icon",
                    menu: "bell-menu"
                },
                {
                    icon: "chat-icon",
                    menu: "chat-menu"
                },
                {
                    icon: "maintenance-icon",
                    menu: "maintenance-menu"
                },
                {
                    icon: "user-icon",
                    menu: "user-menu"
                }
            ];


            icons.forEach(({
                icon,
                menu
            }) => {
                const iconElement = document.getElementById(icon);
                const menuElement = document.getElementById(menu);

                iconElement.addEventListener("click", function(event) {
                    event.stopPropagation();
                    closeAllMenus(); // Đóng tất cả menu trước khi mở cái mới
                    menuElement.classList.toggle("dropdown-active");
                    iconElement.classList.toggle("icon-active"); // Đổi màu icon
                });
            });

            // Đóng menu khi click ra ngoài
            document.addEventListener("click", function(event) {
                if (!event.target.closest(".icon-wrapper")) {
                    closeAllMenus();
                }
            });

            function closeAllMenus() {
                document.querySelectorAll(".dropdown-menu").forEach(menu => {
                    menu.classList.remove("dropdown-active");
                });
                document.querySelectorAll(".icons i").forEach(icon => {
                    icon.classList.remove("icon-active"); // Reset màu icon
                });
            }
        });
        // $('#manage_my_account').click(function() {
        //     uni_modal("Manage Account", "user_profile.php?id=<?php echo $_SESSION['login_id'] ?>&mtype=own")
        // })
    </script>
</body>
<footer style="background-color: #f44336; color: white; text-align: center; padding: 20px 0;">
    <div style="display: flex; flex-direction: column; align-items: center;">
        <!-- Logo và tiêu đề -->
        <div style="display: flex; align-items: center; gap: 10px;">
            <img src="logo.png" alt="Logo" style="width: 60px; height: 60px; border-radius: 50%;">
            <h2 style="color: #ccff00; margin: 0;">HỆ THỐNG CHO THUÊ NHÀ TRỰC TUYẾN</h2>
        </div>

        <!-- Thông tin liên hệ -->
        <div style="margin-top: 15px; display: flex; gap: 30px; align-items: center;">
            <div><i class="fas fa-map-marker-alt"></i> Dịch Vọng Hậu, Cầu Giấy, Hà Nội</div>
            <div><i class="fas fa-envelope"></i> admin@gmail.com</div>
            <div><i class="fas fa-phone"></i> 0945678321</div>
        </div>

        <!-- Đường kẻ ngang -->
        <hr style="width: 80%; margin: 20px auto; border-top: 1px solid #ccc;" />

        <!-- Khẩu hiệu -->
        <div style="color: #ffeb3b; font-weight: bold;">ĐỘC LẬP - TỰ DO - HẠNH PHÚC</div>
    </div>
</footer>

</html>
