<html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "house_rental_db";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID nhà từ URL
$house_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Nếu không có ID hợp lệ thì chuyển hướng
if ($house_id <= 0) {
    die("Không tìm thấy thông tin nhà.");
}

// Truy vấn chi tiết nhà
$sql = "SELECT h.*, c.name as category 
        FROM houses h 
        JOIN categories c ON h.category_id = c.id 
        WHERE h.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $house_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Không tìm thấy nhà với ID này.");
}
// Truy vấn lấy thông báo chung từ admin
$notification_result = $conn->query("SELECT * FROM notifications ORDER BY created_at DESC");

$house = $result->fetch_assoc();
?>

<head>
    <title>
        Real Estate Listing
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
        }

        .navbar {
            display: flex;
            position: fixed;
            top: 0px;
            left: 0px;
            width: 97%;
            z-index: 100;
            align-items: center;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar .menu-icon {
            font-size: 24px;
            margin-right: 20px;
        }

        .navbar .dropdown {
            position: relative;
        }

        .navbar .dropdown-toggle {
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .navbar .dropdown-toggle i {
            margin-left: 5px;
        }

        .navbar .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: none;
            flex-direction: column;
            width: 200px;
            z-index: 1000;
        }

        .navbar .dropdown-menu a {
            padding: 10px 20px;
            text-decoration: none;
            color: #333;
            display: block;
        }

        .navbar .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }

        .navbar .dropdown:hover .dropdown-menu {
            display: flex;
        }

        .navbar .search-bar {
            flex-grow: 1;
            display: flex;
            align-items: center;
            margin-left: 20px;
        }

        .navbar .search-bar input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .navbar .search-bar button {
            background-color: #ff6600;
            border: none;
            padding: 8px 12px;
            color: #fff;
            border-radius: 4px;
            margin-left: 10px;
            cursor: pointer;
        }

        .navbar .icons {
            display: flex;
            align-items: center;
            margin-left: 20px;
        }

        .navbar .icons i {
            font-size: 20px;
            margin-left: 20px;
            cursor: pointer;
        }

        .navbar .icons i:hover {
            color: #007bff;
        }

        .navbar .icon-active {
            color: white !important;
            background-color: #007bff;
            border-radius: 50%;
            padding: 4px;
        }

        .navbar .post-button {
            background-color: #ff6600;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            margin-left: 20px;
            cursor: pointer;
        }

        .main-content {
            display: flex;
            position: relative;
            top: 60px;
            margin-top: 20px;
        }

        .main-content .left {
            flex: 2;
            margin-right: 20px;
        }

        .main-content .right {
            flex: 1;
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .main-content .left .image-gallery {
            display: flex;
            flex-direction: column;
        }

        .main-content .left .image-gallery img {
            width: 100%;
            margin-bottom: 10px;
        }

        .main-content .left .details {
            margin-top: 20px;
        }

        .main-content .left .details h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .main-content .left .details .price {
            font-size: 20px;
            color: #ff6600;
            margin-bottom: 10px;
        }

        .main-content .left .details .info {
            display: flex;
            flex-wrap: wrap;
        }

        .main-content .left .details .info div {
            width: 50%;
            margin-bottom: 10px;
        }

        .main-content .left .details .info div i {
            margin-right: 5px;
        }

        .main-content .left .details .description {
            margin-top: 20px;
        }

        .main-content .right .contact {
            margin-bottom: 20px;
        }

        .main-content .right .contact h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .main-content .right .contact .contact-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .main-content .right .contact .contact-info i {
            margin-right: 10px;
        }

        .main-content .right .contact .contact-info span {
            font-size: 16px;
        }

        .main-content .right .contact .contact-form {
            display: flex;
            flex-direction: column;
        }

        .main-content .right .contact .contact-form input,
        .main-content .right .contact .contact-form textarea {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        .main-content .right .contact .contact-form button {
            padding: 10px;
            background-color: #ff6600;
            border: none;
            color: #fff;
            cursor: pointer;
        }

        .thumbnails {
            display: flex;
        }

        #maintenance-menu {
            white-space: nowrap !important;
            width: max-content !important;
            padding: 10px 15px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            z-index: 999;
        }

        #maintenance-menu a {
            display: block;
            font-size: 14px;
            white-space: nowrap;
        }

        .dropdown-active {
            display: block !important;
        }

        .icon-wrapper {
            position: relative;
        }

        .dropdown-menu a {
            display: block;
            color: black;
            padding: 5px 10px;
            text-decoration: none;
        }

        .dropdown-menu a:hover {
            background-color: #f0f0f0;
        }

        #maintenance-menu a {
            display: block;
            font-size: 14px;
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="navbar">
            <a href="user_home.php">
                <img src="logo.png" alt="" width="50px" style="border-radius: 50%;">
            </a>
            <div class="dropdown">
                <button class="dropdown-toggle">
                    Trang chủ
                    <i class="fas fa-chevron-down">
                    </i>
                </button>
                <div class="dropdown-menu">
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
                </div>
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
                <input placeholder="Search..." type="text" />
                <button>
                    <i class="fas fa-search">
                    </i>
                </button>
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
        <div class="main-content">
            <div class="left">
                <div class="image-gallery">
                    <img alt="Main image of the property" height="400" src="<?php echo htmlspecialchars($house['image']); ?>" width="600" />
                    <!-- <div class="thumbnails">
                        <img alt="Thumbnail 1" height="100" src="https://storage.googleapis.com/a1aa/image/-yCQQNJ7JQV-cHxr6jM7Jmp5Ns4AYB1pa_JCzommPm0.jpg" width="100" />
                        <img alt="Thumbnail 2" height="100" src="https://storage.googleapis.com/a1aa/image/oh77uIFMcLFHp1mDc5c30_d5M8r5TPIZY9P4BAS2zVg.jpg" width="100" />
                        <img alt="Thumbnail 3" height="100" src="https://storage.googleapis.com/a1aa/image/q1xYTo8p0VrkbPSVhQtrRJs5bf11Jjv5x6risn9kbAk.jpg" width="100" />
                        <img alt="Thumbnail 4" height="100" src="https://storage.googleapis.com/a1aa/image/pUa2ML-en1kcQMW9fWKRp4Bpwd5_G7rhFG9C9MkwO3w.jpg" width="100" />
                        <img alt="Thumbnail 5" height="100" src="https://storage.googleapis.com/a1aa/image/twrpq9hbQeeSxUHeEcvBHrKHb6cMFl1ttqP_VwpGdc4.jpg" width="100" />
                    </div> -->
                </div>
                <div class="details">
                    <h1><?php echo htmlspecialchars($house['house_no']); ?></h1>
                    <div class="price">
                        <?php echo number_format($house['price']); ?> VNĐ/tháng
                    </div>
                    <div class="info">
                        <div>
                            <i class="fas fa-home">
                            </i>
                            Loại hình nhà: <?php echo htmlspecialchars($house['category']); ?>
                        </div>
                        <div>
                            <i class="fas fa-expand">
                            </i>
                            Diện tích: 40 m²
                        </div>
                        <div>
                            <i class="fas fa-file-alt">
                            </i>
                            Giấy tờ pháp lý: Đã có sổ
                        </div>
                        <div>
                            <i class="fas fa-bed">
                            </i>
                            Số phòng ngủ: 3 phòng
                        </div>
                        <div>
                            <i class="fas fa-bath">
                            </i>
                            Số phòng vệ sinh: 3 phòng
                        </div>
                        <div>
                            <i class="fas fa-calendar-alt">
                            </i>
                            Tình trạng nội thất: Nội thất cao cấp
                        </div>
                    </div>
                    <div class="description">
                        <h2>
                            Mô tả chi tiết:
                        </h2>
                        <p>
                            <?php echo nl2br(htmlspecialchars($house['description'])); ?>
                        </p>
                        <p>
                            Cho thuê nguyên căn, diện tích 5 x 8m, 1 trệt 2 lầu, 1 phòng khách, 1 bếp, 3 phòng ngủ, 3 phòng vệ sinh.
                        </p>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="contact">
                    <h2>
                        Liên hệ
                    </h2>
                    <div class="contact-info">
                        <i class="fas fa-user">
                        </i>
                        <span>
                            Bình Minh
                        </span>
                    </div>
                    <div class="contact-info">
                        <i class="fas fa-phone">
                        </i>
                        <span>
                            091822 ***
                        </span>
                    </div>
                    <div class="contact-form">
                        <!-- <input placeholder="Họ và tên" type="text" />
                        <input placeholder="Số điện thoại" type="text" />
                        <textarea placeholder="Thêm lời nhắn (100 kí tự)"></textarea> -->
                        <button type="button" class="btn btn-warning w-100 mt-2" data-bs-toggle="modal" data-bs-target="#bookingModal">
                            Đặt lịch hẹn xem nhà
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Bootstrap -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="booking-form">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="bookingModalLabel">Đặt lịch hẹn xem nhà</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ngày xem nhà</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giờ xem nhà</label>
                            <input type="time" name="time" class="form-control" required>
                        </div>
                        <!-- Chọn địa điểm & loại nhà -->
                        <div class="mb-3">
                            <label class="form-label">Địa điểm</label>
                            <select class="form-select" name="location">
                                <option value="Ba Đình">Ba Đình</option>
                                <option value="Hoàn Kiếm">Hoàn Kiếm</option>
                                <option value="Tây Hồ">Tây Hồ</option>
                                <option value="Cầu Giấy">Cầu Giấy</option>
                                <option value="Đống Đa">Đống Đa</option>
                                <option value="Hai Bà Trưng">Hai Bà Trưng</option>
                                <option value="Thanh Xuân">Thanh Xuân</option>
                                <option value="Hoàng Mai">Hoàng Mai</optio>
                                <option value="Long Biên">Long Biên</option>
                                <option value="Nam Từ Liêm">Nam Từ Liêm</option>
                                <option value="Bắc Từ Liêm">Bắc Từ Liêm</option>
                                <option value="Hà Đông">Hà Đông</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Loại nhà</label>
                            <select name="house_type" class="form-select" required>
                                <option>Chung cư</option>
                                <option>Nhà nguyên căn</option>
                                <option>Biệt thự</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Khoảng giá</label>
                            <select name="price_range" class="form-select" required>
                                <option>Dưới 1 tỷ</option>
                                <option>1 - 2 tỷ</option>
                                <option>5 - 10 tỷ</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ghi chú</label>
                            <textarea name="note" class="form-control" placeholder="Yêu cầu đặc biệt (nếu có)"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success w-100">Xác nhận đặt lịch</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('#booking-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'save_schedules.php',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.status === 'success') {
                        alert(res.message);
                        $('#booking-form')[0].reset();
                        $('#bookingModal').modal('hide');
                    } else {
                        alert("❌ " + res.message);
                    }
                },
                error: function() {
                    alert("❌ Gửi dữ liệu thất bại!");
                }
            });
        });
    });
</script>

</html>
