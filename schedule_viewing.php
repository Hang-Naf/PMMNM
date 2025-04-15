<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lịch hẹn xem nhà</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Đặt lịch hẹn xem nhà</h3>
                    </div>
                    <div class="card-body">
                        <form id="booking-form">
                            <!-- Thông tin khách hàng -->
                            <div class="mb-3">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" name="phone" required>
                            </div>

                            <!-- Chọn thời gian -->
                            <div class="mb-3">
                                <label class="form-label">Ngày xem nhà</label>
                                <input type="date" class="form-control" name="date" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Giờ xem nhà</label>
                                <input type="time" class="form-control" name="time" required>
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
                                <select class="form-select" name="house_type">
                                    <option value="Chung cư">Chung cư</option>
                                    <option value="Nhà riêng">Nhà riêng</option>
                                    <option value="Biệt thự">Biệt thự</option>
                                    <option value="Nhà phố">Nhà phố</option>
                                </select>
                            </div>

                            <!-- Khoảng giá nhà -->
                            <div class="mb-3">
                                <label class="form-label">Khoảng giá</label>
                                <select class="form-select" name="price_range">
                                    <option value="Dưới 1 tỷ">Dưới 1 tỷ</option>
                                    <option value="1 - 3 tỷ">1 - 3 tỷ</option>
                                    <option value="3 - 5 tỷ">3 - 5 tỷ</option>
                                    <option value="5 - 10 tỷ">5 - 10 tỷ</option>
                                    <option value="Trên 10 tỷ">Trên 10 tỷ</option>
                                </select>
                            </div>

                            <!-- Ghi chú thêm -->
                            <div class="mb-3">
                                <label class="form-label">Ghi chú</label>
                                <textarea class="form-control" name="note" rows="3" placeholder="Nhập yêu cầu đặc biệt (nếu có)..."></textarea>
                            </div>

                            <!-- Nút đặt lịch -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-success w-100">Xác nhận đặt lịch</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="success-message" class="alert alert-success mt-3 text-center d-none">
                    🎉 Lịch hẹn đã được đặt thành công!
                </div>
            </div>
        </div>
    </div>

    <script>
$(document).ready(function () {
    $('#booking-form').submit(function (e) {
        e.preventDefault(); // chặn reload

        $.ajax({
            type: 'POST',
            url: 'save_schedules.php',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (res) {
                if (res.status === 'success') {
                    alert("🎉 " + res.message);
                    window.location.href = 'index.php?page=manage_appointments';
                } else {
                    alert("❌ " + res.message);
                }
            },
            error: function () {
                alert("❌ Gửi dữ liệu thất bại!");
            }
        });
    });
});
</script>


</body>
</html>