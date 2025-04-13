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
    <!-- <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .navbar {
            display: flex;
            position: fixed;
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
            padding: 20px;
            position: relative;
            top: 60px;
        }

        .main-content .section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .main-content .section .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            flex: 1;
            margin-right: 20px;
            text-align: center;
        }

        .main-content .section .card:last-child {
            margin-right: 0;
        }

        .main-content .section .card img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .main-content .section .card h3 {
            font-size: 18px;
            margin: 10px 0;
        }

        .main-content .section .card p {
            font-size: 14px;
            color: #666;
        }

        .main-content .services {
            display: flex;
            justify-content: space-between;
        }

        .main-content .services .service-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            flex: 1;
            margin-right: 20px;
            text-align: center;
        }

        .main-content .services .service-card:last-child {
            margin-right: 0;
        }

        .main-content .services .service-card img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .main-content .services .service-card h4 {
            font-size: 16px;
            margin: 10px 0;
        }

        .main-content .services .service-card .new-badge {
            background-color: #ff6600;
            color: #fff;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 12px;
            margin-left: 5px;
        }

        .main-content .services .view-all {
            text-align: right;
            margin-top: 10px;
        }

        .main-content .services .view-all a {
            text-decoration: none;
            color: #ff6600;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .navbar .search-bar {
                display: none;
            }

            .main-content .section,
            .main-content .services {
                flex-direction: column;
            }

            .main-content .section .card,
            .main-content .services .service-card {
                margin-right: 0;
                margin-bottom: 20px;
            }

            .main-content .section .card:last-child,
            .main-content .services .service-card:last-child {
                margin-bottom: 0;
            }
        }

        .content {
            display: flex;
            padding: 20px;
            justify-content: center;
        }

        /* .content .sidebar {
            width: 20%;
            background-color: #e0f7fa;
            padding: 20px;
            border-radius: 8px;
        } */
        .content .main {
            width: 80%;
            padding: 20px;
            /* display: flex; */
        }

        .content .main h2 {
            margin-top: 0;
        }

        .listing {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .listing .item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            width: calc(20% - 20px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .listing .item img {
            width: 100%;
            height: auto;
        }

        .listing .item .details {
            padding: 10px;
        }

        .listing .item .details h3 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }

        .listing .item .details .price {
            color: #ff0000;
            font-weight: bold;
            margin: 5px 0;
        }

        .listing .item .details .location {
            color: #666;
            font-size: 14px;
        }

        .listing .item .details .time {
            color: #999;
            font-size: 12px;
        }

        .listing .item .details .favorite {
            text-align: right;
        }

        .listing .item .details .favorite i {
            color: #ccc;
            cursor: pointer;
        }

        .load-more {
            text-align: center;
            margin-top: 20px;
        }

        .load-more button {
            background-color: #ff6600;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .content {
                flex-direction: column;
            }

            .content .sidebar,
            .content .main {
                width: 100%;
            }

            .listing .item {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .listing .item {
                width: 100%;
            }
        }
    </style> -->
</head>

<body>
    <div class="navbar">
        <i class="fas fa-bars menu-icon">
        </i>
        <div class="dropdown">
            <button class="dropdown-toggle">
                Mua bán
                <i class="fas fa-chevron-down">
                </i>
            </button>
            <div class="dropdown-menu">
                <a href="#">
                    Căn hộ/Chung cư
                </a>
                <a href="#">
                    Nhà ở
                </a>
                <a href="#">
                    Đất
                </a>
                <a href="#">
                    Văn phòng, Mặt bằng kinh doanh
                </a>
            </div>
        </div>
        <div class="dropdown">
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
        </div>
        <div class="search-bar">
            <input placeholder="Search..." type="text" />
            <button>
                <i class="fas fa-search">
                </i>
            </button>
        </div>
        <div class="icons">
            <div class="icon-wrapper">
                <i class="fas fa-bell" id="bell-icon"></i>
                <div class="dropdown-menu" id="bell-menu">
                    <p>Thông báo của bạn</p>
                    <a href="#">Xem tất cả</a>
                </div>
            </div>
            <div class="icon-wrapper">
                <i class="fas fa-comments" id="chat-icon"></i>
                <div class="dropdown-menu" id="chat-menu">
                    <p>Tin nhắn của bạn</p>
                    <a href="#">Xem tất cả</a>
                </div>
            </div>
            <div class="icon-wrapper">
                <i class="fas fa-user" id="user-icon"></i>
                <div class="dropdown-menu" id="user-menu">
                    <a href="user_profile.php">Thông tin tài khoản</a>
                    <a href="ajax.php?action=logout">Đăng xuất</a>
                </div>
            </div>
        </div>
        <button class="post-button" onclick="window.location.href='user_addhouse.php'">
            ĐĂNG TIN
        </button>
    </div>
    <div class="main-content">
        <div class="section">
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
        </div>
    </div>
    <div class="content">
        <div class="main">
            <h2>Cho thuê Bất động sản</h2>
            <div class="listing">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="item">
                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Hình ảnh nhà" onerror="this.src='default.jpg';">
                        <div class="details">
                            <h3><?php echo htmlspecialchars($row['house_no']); ?></h3>
                            <div class="price">Giá: <?php echo number_format($row['price']); ?> triệu/tháng</div>
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

</html>