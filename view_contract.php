<?php
include 'db_connect.php';

// Kiểm tra nếu 'id' tồn tại và hợp lệ
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID không hợp lệ.");
}

$id = $_GET['id'];
$sql = "SELECT * FROM contracts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$contract = $result->fetch_assoc();

if (!$contract) {
    die("Hợp đồng không tồn tại.");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hợp Đồng Thuê Nhà</title>
    <style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }

  .contract-wrapper {
    width: 21cm;
    margin: auto;
    padding: 2cm;
  }

  h2, h3 {
    text-align: center;
  }

  .section-title {
    font-weight: bold;
    margin-top: 20px;
  }

  .contract-content p {
    line-height: 1.6;
  }

  .signature {
    text-align: center;
    margin-top: 40px;
    display: flex;
    justify-content: space-around;
  }

  .signature input {
    text-align: center;
    width: 200px;
    margin-top: 5px;
  }

  .name-display {
    font-weight: bold;
    margin-top: 5px;
    display: none;
  }

  #print-btn {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 999;
  }

  @media print {
    #sidebar, .navbar, .topbar, #print-btn, .btn {
      display: none !important;
    }

    body {
      margin: 0;
      padding: 0;
    }

    .contract-wrapper {
      width: 21cm !important;
      margin: auto !important;
      padding: 0 !important;
    }

    .input-signature {
      display: none !important;
    }

    .name-display {
      display: block !important;
    }
  }
</style>


</head>
<body>
<div class="contract-wrapper">
    <h2>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h2>
    <h3>Độc lập - Tự do - Hạnh phúc</h3>
    <p>………., ngày .... tháng .... năm ....</p>
    <h2>HỢP ĐỒNG THUÊ NHÀ</h2>
    <p>- Căn cứ Bộ luật Dân sự số 91/2015/QH13 ngày 24/11/2015;</p>
    <p>- Căn cứ vào Luật Thương mại số 36/2005/QH11 ngày 14 tháng 06 năm 2005;</p>
    <p>- Căn cứ vào nhu cầu và sự thỏa thuận của các bên tham gia Hợp đồng;</p>
    <p>Hôm nay, ngày.....tháng......năm........., các Bên gồm:</p>

    <!-- <div class="contract-content"> -->
        <p><strong>BÊN CHO THUÊ (Bên A):</strong></p>
        <p><strong>Ông: </strong> <?php echo htmlspecialchars($contract['lessor_name']); ?></p>
        <p><strong>CMND số: </strong> <?php echo htmlspecialchars($contract['lessor_id_number']); ?></p>
        <p><strong>Cơ quan cấp: </strong> <?php echo htmlspecialchars($contract['lessor_issuing_authority']); ?></p>
        <p><strong>Ngày cấp: </strong> <?php echo htmlspecialchars($contract['lessor_issue_date']); ?></p>
        <p><strong>Nơi ĐKTT: </strong> <?php echo htmlspecialchars($contract['lessor_permanent_residence']); ?></p>

        <p><strong>BÊN THUÊ (Bên B):</strong></p>
        <p><strong>Ông: </strong> <?php echo htmlspecialchars($contract['lessee_name']); ?></p>
        <p><strong>CMND số: </strong> <?php echo htmlspecialchars($contract['lessee_id_number']); ?></p>
        <p><strong>Cơ quan cấp: </strong> <?php echo htmlspecialchars($contract['lessee_issuing_authority']); ?></p>
        <p><strong>Ngày cấp: </strong> <?php echo htmlspecialchars($contract['lessee_issue_date']); ?></p>
        <p><strong>Nơi ĐKTT: </strong> <?php echo htmlspecialchars($contract['lessee_permanent_residence']); ?></p>

        <p>Bên A và Bên B sau đây gọi chung là “Hai Bên” hoặc “Các Bên”.</p>
        <p>Sau khi thảo luận, Hai Bên thống nhất đi đến ký kết Hợp đồng thuê nhà (“Hợp Đồng”) với các điều khoản và điều kiện dưới đây:</p>

        <div class="section-title">Điều 1. Nhà ở và các tài sản cho thuê kèm theo nhà ở:</div>
        <p><strong>1.1. Địa chỉ nhà thuê:</strong> <?php echo htmlspecialchars($contract['house_address']); ?></p>
        <p><strong>1.2. Thời gian thuê:</strong> <?php echo htmlspecialchars($contract['rental_period']); ?></p>
        <p><strong>1.3. Tiền đặt cọc:</strong> <?php echo number_format($contract['deposit_amount']); ?> VNĐ</p>

        <div class="section-title">Điều 2. Bàn giao và sử dụng diện tích thuê:</div>
        <p><strong>2.1. Thời điểm bàn giao tài sản thuê:</strong> <?php echo htmlspecialchars($contract['handover_date']); ?></p>
        <p><strong>2.2. Quyền sử dụng:</strong> Bên B được toàn quyền sử dụng tài sản từ thời điểm bàn giao.</p>

        <div class="section-title">Điều 3. Thời hạn thuê</div>
        <p><strong>3.1. Thời hạn thuê:</strong> <?php echo htmlspecialchars($contract['rental_period']); ?> năm.</p>
        <p><strong>3.2. Gia hạn:</strong> Nếu Bên B có nhu cầu, Bên A sẽ ưu tiên gia hạn hợp đồng.</p>

        <div class="section-title">Điều 4. Đặt cọc tiền thuê nhà</div>
        <p><strong>4.1. Số tiền đặt cọc:</strong> <?php echo number_format($contract['deposit_amount']); ?> VNĐ.</p>

        <div class="section-title">Điều 5. Tiền thuê nhà</div>
        <p><strong>5.1. Tiền thuê:</strong> <?php echo number_format($contract['rental_amount']); ?> VNĐ/tháng.</p>

        <div class="section-title">Điều 6. Phương thức thanh toán</div>
        <p>Tiền thuê nhà được thanh toán hàng tháng vào ngày 05.</p>

        <div class="section-title">Điều 7. Quyền và nghĩa vụ của Bên A</div>
        <p>7.1 Quyền lợi: Yêu cầu Bên B thanh toán tiền thuê đúng hạn.</p>
        <p>7.2 Nghĩa vụ: Bàn giao tài sản đúng thời gian quy định.</p>

        <div class="section-title">Điều 8. Quyền và nghĩa vụ của Bên B</div>
        <p>8.1 Quyền lợi: Nhận bàn giao tài sản đúng thời gian quy định.</p>
        <p>8.2 Nghĩa vụ: Thanh toán tiền thuê đúng hạn, giữ gìn tài sản.</p>

        <div class="section-title">Điều 9. Đơn phương chấm dứt hợp đồng</div>
        <p>Trong trường hợp muốn đơn phương chấm dứt hợp đồng, cần thông báo trước 30 ngày.</p>

        <div class="section-title">Điều 10. Điều khoản thi hành</div>
        <p>Hợp đồng có hiệu lực từ ngày ký và được lập thành 02 bản có giá trị như nhau.</p>

        <div class="signature">
            <!-- <p>BÊN CHO THUÊ</p>
            <p>(Ký và ghi rõ họ tên)</p>
            <p>BÊN THUÊ</p>
            <p>(Ký và ghi rõ họ tên)</p> -->
            <div>
                <p><strong>BÊN CHO THUÊ</strong></p>
                <input class="input-signature" id="lessor-sign" placeholder="(Ký và ghi rõ họ tên)">
                <p class="name-display" id="lessor-name" style="display: none;"></p>
            </div>
            <div>
                <p><strong>BÊN THUÊ</strong></p>
                <input class="input-signature" id="lessee-sign" placeholder="(Ký và ghi rõ họ tên)">
                <p class="name-display" id="lessee-name" style="display: none;"></p>
            </div>
        </div>
    <!-- </div> -->
</div>
<script>
    // Khi người dùng gõ tên, hiển thị ra dòng chữ tương ứng
    const lessorInput = document.getElementById('lessor-sign');
    const lesseeInput = document.getElementById('lessee-sign');
    const lessorDisplay = document.getElementById('lessor-name');
    const lesseeDisplay = document.getElementById('lessee-name');

    function updateSignatures() {
        lessorDisplay.textContent = lessorInput.value;
        lesseeDisplay.textContent = lesseeInput.value;
    }

    lessorInput.addEventListener('input', updateSignatures);
    lesseeInput.addEventListener('input', updateSignatures);

    // Cập nhật nội dung ngay trước khi in
    window.onbeforeprint = () => {
        updateSignatures();
        lessorDisplay.style.display = 'block';
        lesseeDisplay.style.display = 'block';
    };
</script>
<button id="print-btn" class="btn btn-primary" onclick="window.print()">🖨️ In Hợp Đồng</button>

</body>
</html>
