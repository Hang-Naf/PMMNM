<html>

<head>
    <title>
        Chợ Tốt
    </title>
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
            padding: 20px;
            position: relative;
            display: flex;
            justify-content: space-evenly;
            top: 60px;
        }

        .content .section {
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 20px;
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
            padding: 20px;
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
            margin-top: 20px;
            width: 55%;
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
    <div class="header">
        <i class="fas fa-bars menu-icon">
        </i>
        <div class="search-bar">
            <input placeholder="Tìm kiếm sản phẩm" type="text" />
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
            <i class="fas fa-shopping-bag">
            </i>
            <i class="fas fa-user-circle">
            </i>
        </div>
        <!-- <button class="post-button" onclick="window.location.href='user_addhouse.php'">
            ĐĂNG TIN
        </button> -->
    </div>
    <div class="content">
        <div class="section">
            <h2>
                Hình ảnh và Video sản phẩm
            </h2>
            <a href="#">
                Xem thêm về Quy định đăng tin
            </a>
            <div class="upload-box">
                <img alt="Camera icon" height="50" src="https://storage.googleapis.com/a1aa/image/K43a3fMNLs2MeB5vz7hWaUORHTt5qdFhrOL8g3MwTVs.jpg" width="50" />
                <p>
                    Hình có kích thước tối thiểu 240x240
                </p>
            </div>
        </div>
        <div class="category-select">
            <label for="category">
                Danh Mục Tin Đăng
                <span style="color: red;">
                    *
                </span>
            </label>
            <select id="category">
                <option value="">
                    Chọn danh mục
                </option>
                <!-- Add more options as needed -->
            </select>
        </div>
        <!-- <div class="illustration"> -->
        <!-- <img alt="Illustration of online shopping with various icons and elements" height="400" src="https://storage.googleapis.com/a1aa/image/cu4VGXG1ay6B1cV4sFqw7ORszcXXUMXNGLEyPH2BVyk.jpg" width="600"/> -->
        <!-- </div> -->
    </div>
</body>

</html>