<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tải ảnh lên</title>
</head>
<body>
    <h1>Tải ảnh lên</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <input type="submit" name="submit" value="Tải lên">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        // Thư mục nơi lưu ảnh
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra xem ảnh có phải là ảnh thật không
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "Tệp là ảnh - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Tệp không phải là ảnh.";
            $uploadOk = 0;
        }

        // Kiểm tra nếu $uploadOk được đặt thành 0 bởi một lỗi
        if ($uploadOk == 0) {
            echo "Xin lỗi, ảnh của bạn không được tải lên.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "Ảnh ". htmlspecialchars(basename($_FILES["image"]["name"])) . " đã được tải lên.";
                echo "<br><img src='$target_file' alt='Ảnh đã tải lên' style='max-width: 500px;'>";
            } else {
                echo "Xin lỗi, có lỗi xảy ra khi tải ảnh của bạn lên.";
            }
        }
    }
    ?>
</body>
</html>