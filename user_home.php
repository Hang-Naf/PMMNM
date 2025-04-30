<html lang="en">
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

// Truy vấn lấy thông báo chung từ admin
$notification_result = $conn->query("SELECT * FROM notifications ORDER BY created_at DESC");

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
// Truy vấn danh sách nhà
$sql = "SELECT h.id, h.house_no, h.description, h.price, h.address, h.image, h.created_at, c.name as category 
         FROM houses h 
         JOIN categories c ON h.category_id = c.id 
         ORDER BY h.id DESC";
$result = $conn->query($sql);
?>

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Real Estate Page
    </title>
    <link rel="stylesheet" href="user.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />

    <style>
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
    <div class="navbar">
        <a href="user_home.php">
            <img src="logo.png" alt="" width="50px" style="border-radius: 50%;">
        </a>
        <div class="dropdown">
            <button class="dropdown-toggle">
                Trang chủ
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
        <!-- <div class="section">
            <div class="card">
                <img alt="Mua bán icon" height="50" src="https://storage.googleapis.com/a1aa/image/2Zl3uGbEg4HzYGuM4VMTdUm5kgyxonC_TqOgZloNGq8.jpg" width="50" />
                <h3>
                    Mua bán
                </h3>
                <p>
                    133.293 tin đăng mua bán
                </p>
            </div>
            <div class="card">
                <img alt="Cho thuê icon" height="50" src="https://storage.googleapis.com/a1aa/image/TVcA4dQc7m9i_4cnjGsEiKpyxD4Cw47dPnSxQZVNUNg.jpg" width="50" />
                <h3>
                    Cho thuê
                </h3>
                <p>
                    112.954 tin đăng cho thuê
                </p>
            </div>
            <div class="card">
                <img alt="Dự án icon" height="50" src="https://storage.googleapis.com/a1aa/image/9c7s0t01O1WK4bnTLwveWsqVm_0Tcljo3RmB4kGbFPM.jpg" width="50" />
                <h3>
                    Dự án
                </h3>
                <p>
                    4.167 dự án
                </p>
            </div>
            <div class="card">
                <img alt="Môi giới icon" height="50" src="https://storage.googleapis.com/a1aa/image/lJoRimLDPUST30N4nOAMiMICYlePFozres7kJChzE5Y.jpg" width="50" />
                <h3>
                    Môi giới
                </h3>
                <p>
                    143 chuyên trang
                </p>
            </div>
        </div>
        <div class="services">
            <div class="service-card">
                <img alt="Gói Pro" height="100" src="https://storage.googleapis.com/a1aa/image/YSKMlMrBIy29mS8N2aB9AXJ0_YsC4gpqnPa8IDR2YkI.jpg" width="300" />
                <h4>
                    AAAAAAAAAAAAAAAA
                </h4>
            </div>
            <div class="service-card">
                <img alt="Tài khoản doanh nghiệp" height="100" src="https://storage.googleapis.com/a1aa/image/B9tYSUqMuHpEhroCapqmoylcik8vSLVYnA9y9dZ7O2A.jpg" width="300" />
                <h4>
                    BBBBBBBBBBBBBBBBB
                </h4>
            </div>
            <div class="service-card">
                <img alt="Chuyên trang môi giới" height="100" src="https://storage.googleapis.com/a1aa/image/hsNS5EDQZC3U2Qp7NgWK-b6WSJpkZb5_RhDnSrKGVdI.jpg" width="300" />
                <h4>
                    CCCCCCCCCCCCCCCC
                    <span class="new-badge">
                        Mới
                    </span>
                </h4>
            </div>
        </div>
        <div class="view-all">
            <a href="#">
                Xem tất cả
            </a>
        </div> -->
    </div>
    <div class="content">
        <div class="main">
            <h2>Cho thuê Bất động sản</h2>
            <div class="listing">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="item" data-id="<?php echo $row['id']; ?>">
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Hình ảnh nhà" onerror="this.src='default.jpg';">
                        <div class="details">
                            <h3><?php echo htmlspecialchars($row['house_no']); ?></h3>
                            <div class="price">Giá: <?php echo number_format($row['price']); ?> VNĐ/tháng</div>
                            <div class="location">Loại: <?php echo htmlspecialchars($row['category']); ?></div>
                            <div class="description">Mô tả: <?php echo htmlspecialchars($row['description']); ?></div>
                            <div class="address">
                                Địa chỉ: <?php echo isset($row['address']) ? htmlspecialchars($row['address']) : "Chưa cập nhật"; ?>
                            </div>
                            <div class="created_at">Đăng lúc: <?php echo htmlspecialchars($row['created_at']); ?> </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".item").forEach(function(element) {
                element.addEventListener("click", function() {
                    const id = this.getAttribute("data-id");
                    if (id) {
                        window.location.href = "user_houses.php?id=" + id;
                    }
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
