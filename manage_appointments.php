<?php include('db_connect.php'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <b>Quản lý lịch hẹn xem nhà</b>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>#</th>
                                <th>Ngày</th>
                                <th>Giờ</th>
                                <th>Địa điểm</th>
                                <th>Khoảng giá</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                            $schedules = $conn->query("SELECT * FROM schedules ORDER BY id DESC");
                            while ($row = $schedules->fetch_assoc()):
                                // Tách ngày và giờ từ schedule_time
                                $datetime = strtotime($row['schedule_time']);
                                $date = date('d-m-Y', $datetime);
                                $time = date('H:i', $datetime);
                            ?>
                            <tr class="text-center view_schedule" data-id="<?php echo $row['id']; ?>" style="cursor:pointer;">

                                <td><?php echo $i++; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo $time; ?></td>
                                <td><?php echo $row['location']; ?></td>
                                <td><?php echo $row['price_range']; ?></td>
                                <td>
                                    <?php if ($row['status'] == 1): ?>
                                        <span class="badge bg-success">Đã xác nhận</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ((int)$row['status'] == 0): ?>
                                        <button class="btn btn-sm btn-success confirm_schedule" data-id="<?php echo $row['id']; ?>">Xác nhận</button>
                                    <?php endif; ?>
                                    <button class="btn btn-sm btn-danger cancel_schedule" data-id="<?php echo $row['id']; ?>">Hủy</button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal hiển thị chi tiết lịch hẹn -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Chi tiết lịch hẹn</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal_content">
        Đang tải dữ liệu...
      </div>
    </div>
  </div>
</div>

<!-- Script xác nhận / hủy -->
<script>
    $(document).ready(function() {
        $('.confirm_schedule').click(function() {
            var id = $(this).data('id');
            if (confirm('Bạn có chắc muốn xác nhận lịch hẹn này?')) {
                $.post('ajax.php?action=confirm_schedule', { id: id }, function(response) {
                    if (response == 1) {
                        alert('Đã xác nhận!');
                        location.reload();
                    }
                });
            }
        });

        // Hủy lịch hẹn
        $('.cancel_schedule').click(function() {
            var id = $(this).data('id');
            if (confirm('Bạn có chắc muốn hủy lịch hẹn này?')) {
                $.post('ajax.php?action=cancel_schedule', { id: id }, function(response) {
                    if (response == 1) {
                        alert('🗑️ Lịch hẹn đã bị hủy!');
                        location.reload();
                    }
                });
            }
        });
    });

    // Khi click vào dòng lịch hẹn, xem chi tiết
$('.view_schedule').click(function () {
    var id = $(this).data('id');
    $.post('ajax.php?action=view_schedule', { id: id }, function (html) {
        $('#modal_content').html(html);
        $('#viewModal').modal('show');
    });
});

</script>
