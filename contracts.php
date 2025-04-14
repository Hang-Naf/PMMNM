<?php
include 'db_connect.php'; // Kết nối database

$lessor_name = $lessor_id_number = $lessee_name = $lessee_id_number = $house_address = $rental_period = $deposit_amount = $contract_date = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lessor_name = $_POST['lessor_name'] ?? '';
    $lessor_id_number = $_POST['lessor_id_number'] ?? '';
    $lessee_name = $_POST['lessee_name'] ?? '';
    $lessee_id_number = $_POST['lessee_id_number'] ?? '';
    $house_address = $_POST['house_address'] ?? '';
    $rental_period = $_POST['rental_period'] ?? '';
    $deposit_amount = isset($_POST['deposit_amount']) ? number_format($_POST['deposit_amount'], 0, ',', '.') . ' VNĐ' : '';
    $contract_date = isset($_POST['contract_date']) ? date('d/m/Y', strtotime($_POST['contract_date'])) : '';
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hợp Đồng Thuê Nhà</title>
    <style>
        .contract {
            background-color: white;
            padding: 50px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        body { font-family: 'Times New Roman', Times, serif, sans-serif; margin: 20px; }
        h2 { text-align: center; }
        .contract { width: 80%; margin: auto; line-height: 1.6; }
        .section { margin-top: 15px; }
        .signature { display: flex; justify-content: space-between; margin-top: 40px; }
        .signature div { text-align: center; width: 40%; }

        /* Ẩn nút khi in */
        @media print {
            .sidebar, .menu, .navbar { 
                display: none !important; 
            }
            body {
                margin: 0;
                padding: 0;
            }
        }

        .print-button-container {
            text-align: center;
            margin-top: 20px;
        }
        #printButton {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        #printButton:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    

    <div class="contract">
        <p style="text-align:center;"><strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong><br>
        <i>Độc lập - Tự do - Hạnh phúc</i><br>
        ..........., ngày .... tháng .... năm ....</p>

        <h2>HỢP ĐỒNG THUÊ NHÀ</h2>
        <i>- Căn cứ Bộ luật Dân sự số 91/2015/QH13 ngày 24/11/2015; <br>
            - Căn cứ vào Luật Thương mại số 36/2005/QH11 ngày 14 tháng 06 năm 2005; <br>
            - Căn cứ vào nhu cầu và sự thỏa thuận của các bên tham gia Hợp đồng; <br>
        </i>

        <p><strong>BÊN CHO THUÊ (Bên A):</strong><br>
        Ông/Bà: …………………….<br>
        CMND/CCCD:................ Cơ quan cấp:…………………………. Ngày cấp:.............. <br>
        Nơi ĐKTT:........................................................................................
        <p><strong>BÊN THUÊ (Bên B):</strong><br>
        Ông/Bà: …………………….<br>
        CMND/CCCD:................ Cơ quan cấp:…………………………. Ngày cấp:.............. <br>
        Nơi ĐKTT:........................................................................................
        <div class="section">
            <strong>Điều 1. Nhà ở và các tài sản cho thuê kèm theo:</strong>
            <p><strong>1.1.</strong> Bên A đồng ý cho Bên B thuê và Bên B cũng đồng ý thuê quyền sử dụng đất và một căn nhà ......... tầng gắn liền với quyền sử dụng đất tại địa chỉ ... để sử dụng làm nơi để ở. <br>
            Diện tích quyền sử dụng đất:...................m2; <br>
            Diện tích căn nhà :....................m2; <br>
            <strong>1.2.</strong> Bên A cam kết quyền sử sụng đất và căn nhà gắn liền trên đất trên là tài sản sở hữu hợp pháp của Bên A. Mọi tranh chấp phát sinh từ tài sản cho thuê trên Bên A hoàn toàn chịu trách nhiệm trước pháp luật.<br></p>
        </div>
        
        <div class="section">
            <strong>Điều 2. Bàn giao và sử dụng diện tích thuê:</strong>
            <p><strong>2.1.</strong> Thời điểm Bên A bàn giao tài sản thuê vào ngày.....tháng.....năm…..; <br>
                <strong>2.2.</strong> Bên B được toàn quyền sử dụng tài sản thuê kể từ thời điểm được Bên A bàn giao từ thời điểm quy định tại Mục 2.1 trên đây.
            </p>
        </div>
        
        <div class="section">
            <strong>Điều 3. Thời hạn thuê:</strong>
            <p><strong>3.1.</strong> Bên A cam kết cho Bên B thuê tài sản thuê với thời hạn là ......... năm kể từ ngày bàn giao Tài sản thuê; <br>
                <strong>3.2.</strong> Hết thời hạn thuê nêu trên nếu bên B có nhu cầu tiếp tục sử dụng thì Bên A phải ưu tiên cho Bên B tiếp tục thuê.
            </p>
        </div>
        
        <div class="section">
            <strong>Điều 4. Đặt cọc tiền thuê nhà:</strong>
            <p><strong>4.1.</strong> Bên B sẽ giao cho Bên A một khoản tiền là ........................ VNĐ (bằng chữ:...............................................) ngay sau khi ký hợp đồng này. Số tiền này là tiền đặt cọc để đảm bảm thực hiện Hợp đồng cho thuê nhà. <br>
                <strong>4.2.</strong> Nếu Bên B đơn phương chấm dứt hợp đồng mà không thực hiện nghĩa vụ báo trước tới Bên A thì Bên A sẽ không phải hoàn trả lại Bên B số tiền đặt cọc này.<br>
                Nếu Bên A đơn phương chấm dứt hợp đồng mà không thực hiện nghĩa vụ báo trước tới bên B thì bên A sẽ phải hoàn trả lại Bên B số tiền đặt cọc và phải bồi thường thêm một khoản bằng chính tiền đặt cọc.<br>
                <strong>4.3.</strong> Tiền đặt cọc của Bên B sẽ không được dùng để thanh toán tiền thuê. Nếu Bên B vi phạm Hợp Đồng làm phát sinh thiệt hại cho Bên A thì Bên A có quyền khấu trừ tiền đặt cọc để bù đắp các chi phí khắc phục thiệt hại phát sinh. Mức chi phí bù đắp thiệt hại sẽ được Các Bên thống nhất bằng văn bản.<br>
                <strong>4.4.</strong> Vào thời điểm kết thúc thời hạn thuê hoặc kể từ ngày chấm dứt Hợp đồng, Bên A sẽ hoàn lại cho Bên B số tiền đặt cọc sau khi đã khấu trừ khoản tiền chi phí để khắc phục thiệt hại (nếu có).<br>
            </p>
        </div>
        
        <div class="section">
            <strong>Điều 5. Tiền thuê nhà:</strong><br>
            <p><strong>5.1</strong> Tiền thuê nhà đối với diện tích thuê nêu tại mục 1.1 Điều 1 là: .......................... VNĐ/tháng (Bằng chữ:...........................................)<br>
                <strong>5.2</strong> Tiền thuê nhà không bao gồm chi phí khác như tiền điện, nước, vệ sinh.... Khoản tiền này sẽ do bên B trả theo khối lượng, công suất sử dụng thực tế của Bên B hàng tháng, được tính theo đơn giá của nhà nước.
            </p>
        </div>
        
        <div class="section">
            <strong>Điều 6. Phương thức thanh toán tiền thuê nhà:</strong>
            <p>Tiền thuê nhà được thanh toán theo 01 (một) tháng/lần vào ngày 05 (năm) hàng tháng. <br>
            Các chi phí khác được bên B tự thanh toán với các cơ quan, đơn vị có liên quan khi được yêu cầu. <br>
            Việc thanh toán tiền thuê nhà được thực hiện bằng đồng tiền Việt Nam theo hình thức trả trực tiếp bằng tiền mặt.</p>
        </div>
        
        <div class="section">
            <strong>Điều 7. Quyền và nghĩa vụ của bên cho thuê nhà:</strong> <br>
            <strong>7.1. Quyền lợi:</strong>
            <p>- Yêu cầu Bên B thanh toán tiền thuê và chi phí khác đầy đủ, đúng hạn theo thoả thuận trong Hợp Đồng. <br>
            - Yêu cầu Bên B phải sửa chữa phần hư hỏng, thiệt hại do lỗi của Bên B gây ra.</p>
            <strong>7.2. Nghĩa vụ của</strong>
            <p>- Bàn giao diện tích thuê cho Bên B theo đúng thời gian quy định trong Hợp đồng.<br>
            - Đảm bảo việc cho thuê theo Hợp đồng này là đúng quy định của pháp luật. <br>
            - Đảm bảo cho Bên B thực hiện quyền sử dụng diện tích thuê một cách độc lập và liên tục trong suốt thời hạn thuê, trừ trường hợp vi phạm pháp luật và/hoặc các quy định của Hợp đồng này. <br>
            - Không xâm phạm trái phép đến tài sản của Bên B trong phần diện tích thuê. Nếu Bên A có những hành vi vi phạm gây thiệt hại cho Bên B trong thời gian thuê thì Bên A phải bồi thường.<br>
            - Tuân thủ các nghĩa vụ khác theo thoả thuận tại Hợp đồng này hoặc/và các văn bản kèm theo Hợp đồng này; hoặc/và theo quy định của pháp luật Việt Nam.</p>
           
        </div>
        
        <div class="section">
            <strong>Điều 8. Quyền và nghĩa vụ của bên thuê nhà:</strong>
            <p><strong>8.1. Quyền lợi</strong> <br>
            - Nhận bàn giao diện tích thuê theo đúng thoả thuận trong Hợp đồng; <br>
            - Được sử dụng phần diện tích thuê làm nơi ở và các hoạt động hợp pháp khác; <br>
            - Yêu cầu Bên A sửa chữa kịp thời những hư hỏng không phải do lỗi của Bên B trong phần diện tích thuê để bảo đảm an toàn;<br>
            - Được tháo dỡ và đem ra khỏi phần diện tích thuê các tài sản, trang thiết bị của Bên B đã lắp đặt trong phần diện tích thuê khi hết thời hạn thuê hoặc đơn phương chấm dứt hợp đồng.<br>

            <strong>8.2. Nghĩa vụ </strong> <br>
            - Sử dụng diện tích thuê đúng mục đích đã thỏa thuận, giữ gìn nhà ở và có trách nhiệm trong việc sửa chữa những hư hỏng do mình gây ra;<br>
            - Thanh toán tiền đặt cọc, tiền thuê đầy đủ, đúng thời hạn đã thỏa thuận;<br>
            - Trả lại diện tích thuê cho Bên A khi hết thời hạn thuê hoặc chấm dứt Hợp đồng thuê;<br>
            - Mọi việc sửa chữa, cải tạo, lắp đặt bổ sung các trang thiết bị làm ảnh hưởng đến kết cấu của căn phòng…, Bên B phải có văn bản thông báo cho Bên A và chỉ được tiến hành các công việc này sau khi có sự đồng ý bằng văn bản của Bên A;<br>
            - Tuân thủ một cách chặt chẽ quy định tại Hợp đồng này và các quy định của pháp luật Việt Nam.<br>

            </p>
        </div>
        
        <div class="section">
            <strong>Điều 9. Đơn phương chấm dứt hợp đồng thuê nhà:</strong>
            <p>Trong trường hợp một trong Hai Bên muốn đơn phương chấm dứt Hợp đồng trước hạn thì phải thông báo bằng văn bản cho bên kia trước 30 (ba mươi) ngày so với ngày mong muốn chấm dứt. Nếu một trong Hai Bên không thực hiện nghĩa vụ thông báo cho Bên kia thì sẽ phải bồi thường cho bên đó một khoản tiền thuê tương đương với thời gian không thông báo và các thiệt hại khác phát sinh do việc chấm dứt Hợp đồng trái quy định.</p>
        </div>
        
        <div class="section">
            <strong>Điều 10. Điều khoản thi hành:</strong>
            <p>- Hợp đồng này có hiệu lực kể từ ngày hai bên cùng ký kết; <br>
            - Các Bên cam kết thực hiện nghiêm chỉnh và đầy đủ các thoả thuận trong Hợp đồng này trên tinh thần hợp tác, thiện chí; <br>
            - Mọi sửa đổi, bổ sung đối với bất kỳ điều khoản nào của Hợp đồng phải được lập thành văn bản, có đầy đủ chữ ký của mỗi Bên. Văn bản sửa đổi bổ sung Hợp đồng có giá trị pháp lý như Hợp đồng, là một phần không tách rời của Hợp đồng này. <br>
            - Hợp đồng được lập thành 02 (hai) bản có giá trị như nhau, mỗi Bên giữ 01 (một) bản để thực hiện. <br>
            </p>
        </div>

        <div class="signature">
            <div>
                <p><strong>BÊN CHO THUÊ</strong></p>
                <p>(Ký và ghi rõ họ tên)</p>

                <p><input type="text" id="lessor_name" name="lessor_name" value="<?php echo htmlspecialchars($lessor_name); ?>" required></strong>
            </div>
            <div>
                <p><strong>BÊN THUÊ</strong></p>
                <p>(Ký và ghi rõ họ tên)</p>

                <p><input type="text" id="lessee_name" name="lessee_name" value="<?php echo htmlspecialchars($lessee_name); ?>" required></strong></p>
            </div>
        </div>
    </div>

    <!-- Nút in hợp đồng -->
    <div class="print-button-container">
        <button id="printButton" onclick="printContract()">🖨️ In Hợp Đồng</button>
    </div>

    <script>
        function printContract() {
            window.print();
        }
    </script>
</body>
</html>
