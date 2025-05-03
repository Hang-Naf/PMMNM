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

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_house'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    // xử lý lưu nhà
    $category_id = $_POST['category_id'];
    $house_no = $_POST['house_no'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $address = $_POST['address'];
    $updated_at = date('Y-m-d H:i:s');
// xử lý ảnh
    $image = "";

    // Tạo thư mục uploads nếu chưa có
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Nếu có ảnh mới
    if (!empty($_FILES['image']['name'])) {
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png'];

        if (in_array($imageFileType, $allowed_types)) {
            $image = $target_dir . time() . "_" . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
        } else {
            die("Chỉ chấp nhận các tệp JPG, JPEG, PNG.");
        }
    } else if ($id) {
        // Nếu không upload ảnh mới, lấy ảnh cũ
        $query = $conn->query("SELECT image FROM houses WHERE id = '$id'");
        $row = $query->fetch_assoc();
        $image = $row['image'];
    }
    $stmt = $conn->prepare("INSERT INTO houses (user_id, house_no, category_id, description, price, address, image, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isisdsss", $user_id, $house_no, $category_id, $description, $price, $address, $image, $updated_at);

    if ($stmt->execute()) {
        echo "<script>alert('Đăng tin thành công!'); window.location.href='user_home.php';</script>";
        exit;
    } else {
        echo "Lỗi khi lưu nhà: " . $conn->error;
    }
}


// Truy vấn lấy thông báo chung từ admin
$notification_result = $conn->query("SELECT * FROM notifications ORDER BY created_at DESC");
$user_id = $_SESSION['login_id'];
$notification_result = $conn->query("
    SELECT * FROM notifications 
    WHERE (user_id IS NULL OR user_id = $user_id) 
    AND (type IS NULL OR type NOT IN ('user_to_admin'))
    ORDER BY created_at DESC
");

?>

<head>
    <title>
        Đăng Tin
    </title>
    <link rel="stylesheet" href="user.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .header {
            background-color: #ffba00;
            padding: 10px 20px;
            display: flex;
            position: fixed;
            width: 97%;
            z-index: 99;
            align-items: center;
            justify-content: space-between;
        }

        .header .menu-icon {
            font-size: 24px;
            cursor: pointer;
        }

        .header .search-bar {
            display: flex;
            align-items: center;
            flex-grow: 1;
            margin: 0 20px;
        }

        .header .search-bar input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
        }

        .header .search-bar button {
            background-color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
            margin-left: -40px;
        }

        .header .icons {
            display: flex;
            align-items: center;
        }

        .header .icons i {
            font-size: 20px;
            margin: 0 10px;
            cursor: pointer;
        }

        .header .post-button {
            background-color: #ff6f00;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .content {
            padding: 50px 20px 100px 20px;
            height: 350px;
            position: relative;
            display: flex;
            flex-wrap: wrap;
            top: 60px;
        }

        form {
            display: flex;
            position: relative;
            margin: 20px;
        }

        .content .section {
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
            margin: 20px 50px 20px 20px;
        }

        .content .section h2 {
            margin-top: 0;
        }

        .content .section a {
            color: #007bff;
            text-decoration: none;
        }

        .content .section a:hover {
            text-decoration: underline;
        }

        .content .upload-box {
            border: 2px dashed #ffba00;
            border-radius: 4px;
            padding: 70px;
            text-align: center;
            color: #ccc;
        }

        .content .upload-box img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .content .upload-box p {
            margin: 0;
        }

        .content .category-select {
            margin: 20px 50px 20px 20px;
            width: 500px;
        }

        .content .category-select select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .content .illustration {
            text-align: center;
            margin-top: 20px;
            background-image: url('https://storage.googleapis.com/a1aa/image/cu4VGXG1ay6B1cV4sFqw7ORszcXXUMXNGLEyPH2BVyk.jpg');
            background-size: cover;
            background-position: center;
            height: 400px;
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .header .search-bar {
                margin: 0 10px;
            }

            .header .search-bar button {
                margin-left: -30px;
            }
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
    <div class="content">
        <form method="POST" enctype="multipart/form-data">
            <div class="section">
                <h2>
                    Hình ảnh BĐS
                </h2>
                <div class="upload-box" id="uploadBox" name="image"
                    onclick="document.getElementById('fileUpload').click();"
                    style="background-image: url('https://storage.googleapis.com/a1aa/image/K43a3fMNLs2MeB5vz7hWaUORHTt5qdFhrOL8g3MwTVs.jpg');
                    background-size: cover; 
                    background-position: center; 
                    background-repeat: no-repeat;
                    width: 250px; height: 80px; cursor: pointer; position: relative;">

                    <input id="fileUpload" type="file" name="image" accept=".jpg,.jpeg,.png" required style="display: none;">

                    <p style="position: absolute; bottom: 10px; left: 10px; color: white; background: rgba(0,0,0,0.5); padding: 4px 8px; border-radius: 4px;">
                        Hình có định dạng jpg, jpeg, png
                    </p>
                </div>
                <script>
                    document.getElementById('fileUpload').addEventListener('change', function(event) {
                        const file = event.target.files[0];
                        if (file && file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const uploadBox = document.getElementById('uploadBox');
                                uploadBox.style.backgroundImage = `url(${e.target.result})`;
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                </script>

            </div>
            <div class="category-select">

                <label for="category_id">Chọn danh mục:</label>
                <select name="category_id" required>
                    <option value="">-- Chọn danh mục --</option>
                    <option value="5">Biệt thự</option>
                    <option value="7">Chung cư</option>
                    <option value="3">Khu căn hộ</option>
                    <option value="1">Duplex (căn hộ thông tầng)</option>
                    <option value="2">Nhà đơn/ Nhà riêng</option>
                    <option value="4">Nhà 2 tầng</option>
                    <option value="6">Nhà cấp 4</option>
                </select><br><br>

                <label for="house_no">Tên BĐS:</label>
                <input type="text" name="house_no" required><br><br>

                <label for="address">Địa chỉ BĐS:</label>
                <input type="text" name="address" required><br><br>

                <label for="description">Mô tả:</label>
                <textarea name="description" required></textarea><br><br>

                <label for="price">Giá thuê:</label>
                <input type="number" name="price" step="0.01" required><br><br>

                <input type="submit" name="submit_house" value="Đăng tin">
            </div>
        </form>
    </div>
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
<script>
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
    $('input[name="image"]').change(function(event) {
        let reader = new FileReader();
        reader.onload = function() {
            $('#preview-img').attr('src', reader.result).show();
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>

</html>
