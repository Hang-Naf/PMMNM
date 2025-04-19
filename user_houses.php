<html>

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
    </style>
</head>

<body>
    <div class="container">
        <div class="navbar">
            <i class="fas fa-bars menu-icon">
            </i>
            <div class="dropdown">
                <button class="dropdown-toggle">
                    Danh mục
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
                <input placeholder="Bất động sản" type="text" />
                <button>
                    <i class="fas fa-search">
                    </i>
                </button>
            </div>
            <div class="icons">
                <i class="fas fa-bell">
                </i>
                <i class="fas fa-comments">
                </i>
                <i class="fas fa-user">
                </i>
            </div>
            <button class="post-button" onclick="window.location.href='user_addhouse.php'">
                ĐĂNG TIN
            </button>
        </div>
        <div class="main-content">
            <div class="left">
                <div class="image-gallery">
                    <img alt="Main image of the property" height="400" src="https://storage.googleapis.com/a1aa/image/SKhlF_wEzG8hQFRzFIsRxXQPl7uO_pfxakYyf7G4V3Q.jpg" width="600" />
                    <div class="thumbnails">
                        <img alt="Thumbnail 1" height="100" src="https://storage.googleapis.com/a1aa/image/-yCQQNJ7JQV-cHxr6jM7Jmp5Ns4AYB1pa_JCzommPm0.jpg" width="100" />
                        <img alt="Thumbnail 2" height="100" src="https://storage.googleapis.com/a1aa/image/oh77uIFMcLFHp1mDc5c30_d5M8r5TPIZY9P4BAS2zVg.jpg" width="100" />
                        <img alt="Thumbnail 3" height="100" src="https://storage.googleapis.com/a1aa/image/q1xYTo8p0VrkbPSVhQtrRJs5bf11Jjv5x6risn9kbAk.jpg" width="100" />
                        <img alt="Thumbnail 4" height="100" src="https://storage.googleapis.com/a1aa/image/pUa2ML-en1kcQMW9fWKRp4Bpwd5_G7rhFG9C9MkwO3w.jpg" width="100" />
                        <img alt="Thumbnail 5" height="100" src="https://storage.googleapis.com/a1aa/image/twrpq9hbQeeSxUHeEcvBHrKHb6cMFl1ttqP_VwpGdc4.jpg" width="100" />
                    </div>
                </div>
                <div class="details">
                    <h1>
                        Cho thuê nhà hxh Đoàn Thị Điểm, p1, P Nhuận 3pn 3wc 1trệt 2lầu
                    </h1>
                    <div class="price">
                        15 triệu/tháng - 40 m²
                    </div>
                    <div class="info">
                        <div>
                            <i class="fas fa-home">
                            </i>
                            Loại hình nhà: Nhà ngõ, hẻm
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
                            Mô tả chi tiết
                        </h2>
                        <p>
                            BDT liên hệ: 091822 ***
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
                        <input placeholder="Họ và tên" type="text" />
                        <input placeholder="Số điện thoại" type="text" />
                        <textarea placeholder="Thêm lời nhắn (100 kí tự)"></textarea>
                        <button>
                            Gửi thông tin
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>