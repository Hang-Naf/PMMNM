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
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Họ và tên</th>
                                <th>Số điện thoại</th>
                                <th>Ngày</th>
                                <th>Giờ</th>
                                <th>Địa điểm</th>
                                <th>Loại nhà</th>
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
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row['tenant_name']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['date_in'])); ?></td>
                                <td><?php echo date('H:i', strtotime($row['time_in'])); ?></td>
                                <td><?php echo $row['location']; ?></td>
                                <td><?php echo $row['house_type']; ?></td>
                                <td><?php echo $row['price_range']; ?></td>
                                <td>
                                    <?php if ($row['status'] == 1): ?>
                                        <span class="badge badge-success">Đã xác nhận</span>
                                    <?php else: ?>
                                        <span class="badge badge-warning">Chờ xác nhận</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($row['status'] == 0): ?>
                                        <button class="btn btn-sm btn-primary confirm_schedule" data-id="<?= $row['id'] ?>">Xác nhận</button>
                                    <?php endif; ?>
                                        <button class="btn btn-sm btn-danger cancel_schedule" data-id="<?= $row['id'] ?>">Hủy</button>
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
<script>
    $(document).ready(function() {
        $('.confirm_schedule').click(function() {
            var id = $(this).data('id');
            if (confirm('Bạn có chắc muốn xác nhận lịch hẹn này?')) {
                $.post('ajax.php?action=confirm_schedule', { id: id }, function(response) {
                    if (response == 1) {
                        alert('Lịch hẹn đã được xác nhận!');
                        location.reload();
                    }
                });
            }
        });

        $('.cancel_schedule').click(function() {
            var id = $(this).data('id');
            if (confirm('Bạn có chắc muốn hủy lịch hẹn này?')) {
                $.post('ajax.php?action=cancel_schedule', { id: id }, function(response) {
                    if (response == 1) {
                        alert('Lịch hẹn đã bị hủy!');
                        location.reload();
                    }
                });
            }
        });
    });
</script>
