<?php include('db_connect.php');?>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <!-- FORM Panel -->
            <div class="col-md-4">
                <form action="" id="manage-notification">
                    <div class="card">
                        <div class="card-header">
                            Admin Notification Panel
                        </div>
                        <div class="card-body">
                            <div class="form-group" id="msg"></div>
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label class="control-label">Title</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Message</label>
                                <textarea name="message" cols="30" rows="4" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
                                    <button class="btn btn-sm btn-default col-sm-3" type="reset"> Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <b>Admin Notification List</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Message</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $notifications = $conn->query("SELECT * FROM notifications ORDER BY id ASC");
                                if ($notifications) { // Kiểm tra nếu truy vấn không lỗi
                                    while($row = $notifications->fetch_assoc()):
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td><?php echo htmlspecialchars($row['title']) ?></td>
                                        <td><?php echo htmlspecialchars($row['message']) ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary edit_notification" type="button" data-id="<?php echo $row['id'] ?>" data-title="<?php echo htmlspecialchars($row['title']) ?>" data-message="<?php echo htmlspecialchars($row['message']) ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger delete_notification" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
                                        </td>
                                    </tr>
                                <?php 
                                    endwhile;
                                } else {
                                    echo "<tr><td colspan='4' class='text-center'>No notifications found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>
</div>

<script>
    $('#manage-notification').submit(function(e){
    e.preventDefault();
    start_load();
    $('#msg').html('');

    let formData = new FormData($(this)[0]);

    $.ajax({
        url: 'ajax.php?action=save_notification',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        success: function(resp){
            console.log("Server Response:", resp);  // ✅ Kiểm tra phản hồi từ server
            if(resp == 1){
                alert_toast("Notification successfully saved", 'success');
                setTimeout(function(){ location.reload() }, 1500);
            } else {
                $('#msg').html('<div class="alert alert-danger">Lỗi khi lưu: ' + resp + '</div>');
            }
        },
        error: function(xhr, status, error) {
            console.log("AJAX Error:", error);  // ✅ Bắt lỗi nếu AJAX có vấn đề
        }
    });
});


    $('.edit_notification').click(function(){
        start_load();
        var form = $('#manage-notification');
        form.get(0).reset();
        form.find("[name='id']").val($(this).attr('data-id'));
        form.find("[name='title']").val($(this).attr('data-title'));
        form.find("[name='message']").val($(this).attr('data-message'));
        end_load();
    });

    $('.delete_notification').click(function(){
        _conf("Are you sure to delete this notification?", "delete_notification", [$(this).attr('data-id')]);
    });

    function delete_notification(id){
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_notification',
            method: 'POST',
            data: {id: id},
            success:function(resp){
                if(resp == 1){
                    alert_toast("Notification successfully deleted", 'success');
                    setTimeout(function(){ location.reload() }, 1500);
                }
            }
        });
    }
</script>