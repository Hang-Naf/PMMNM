<html>

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

    <div class="container1">
        <h1>Thông tin cá nhân</h1>
    </div>

    <div class="container">
        <div class="content1">
            <div class="sidebar">
                <ul>
                    <li><a class="ttcn" href="#">Thông tin cá nhân</a></li>
                    <li><a href="#">Liên kết mạng xã hội</a></li>
                    <li><a href="#">Cài đặt tài khoản</a></li>
                    <li><a href="#">Quản lý lịch sử đăng nhập</a></li>
                </ul>
            </div>
        </div>
        <div class="content2">
            <div class="main-content">
                <div class="section-title">Hồ sơ cá nhân</div>
                <div class="form-group">
                    <label for="name">Họ và tên* </label>
                    <div class="input-group">
                        <input type="text" id="name" value="" required>
                        <!-- <button><i class="fas fa-phone"></i> Thêm số điện thoại</button> -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Số điện thoại*</label>
                    <input type="text" name="" id="">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" id="address">
                </div>
                <div class="form-group">
                    <label for="bio">Giới thiệu</label>
                    <textarea id="bio" rows="3" placeholder="Viết vài dòng giới thiệu về ngôi nhà của bạn..."></textarea>
                </div>
                <div class="form-group">
                    <label for="website">Tài khoản</label>
                    <input type="text" id="website" value="">
                    <div class="note">Tài khoản của bạn sẽ được hiển thị công khai trên trang cá nhân của bạn.</div>
                </div>
                <div class="form-group">
                    <label for="nickname">Tên gợi nhớ</label>
                    <input type="text" id="nickname">
                </div>
                <div class="section-title">Thông tin bảo mật</div>
                <div class="form-group">
                    <label for="email">Email*</label>
                    <div class="input-group">
                        <input type="email" id="email" value="" readonly>
                        <button class="change-link">Thay đổi</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="id">CCCD / CMND / Hộ chiếu</label>
                    <input type="text" id="id">
                </div>
                <div class="form-group">
                    <label for="tax">Thông tin xuất hóa đơn</label>
                    <input type="text" id="tax">
                </div>
                <div class="form-group">
                    <label for="tax-code">Mã số thuế</label>
                    <input type="text" id="tax-code">
                </div>
                <div class="form-group">
                    <label for="favorite-category">Danh mục yêu thích</label>
                    <input type="text" id="favorite-category">
                </div>
                <div class="form-group select-group">
                    <div>
                        <label for="gender">Giới tính</label>
                        <select id="gender">
                            <option value="male">Nam</option>
                            <option value="female">Nữ</option>
                            <option value="other">Khác</option>
                        </select>
                    </div>
                    <div>
                        <label for="dob">Ngày, tháng, năm sinh</label>
                        <input type="date" id="dob">
                    </div>
                </div>
                <button class="btn-save">LƯU THAY ĐỔI</button>
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