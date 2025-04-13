<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "house_rental_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Kết nối thất bại: " . $conn->connect_error);
}

// ⚠️ Xử lý XÓA phải nằm ngoài khối POST
if (isset($_GET['action']) && $_GET['action'] == 'delete_house') {
	$id = $_POST['id'];
	$query = $conn->query("SELECT image FROM houses WHERE id = '$id'");
	if ($query->num_rows > 0) {
		$row = $query->fetch_assoc();
		if (file_exists($row['image']) && !empty($row['image'])) {
			unlink($row['image']);
		}
	}
	$delete = $conn->query("DELETE FROM houses WHERE id = '$id'");
	echo $delete ? 1 : 0;
	exit();
}

// ⚠️ Xử lý thêm/sửa nhà
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$id = isset($_POST['id']) ? $_POST['id'] : null;
	$house_no = $_POST['house_no'];
	$category_id = $_POST['category_id'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$address = $_POST['address'];
	$updated_at = date('Y-m-d H:i:s');
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

	// Nếu là chỉnh sửa
	if ($id) {
		$stmt = $conn->prepare("UPDATE houses SET house_no=?, category_id=?, description=?, price=?, address=?, image=?, created_at=? WHERE id=?"); // sửa updated_at=? thành created_at=?
		$stmt->bind_param("sisdsssi", $house_no, $category_id, $description, $price, $address, $image, $updated_at, $id);
	} else {
		// Nếu là thêm mới
		$stmt = $conn->prepare("INSERT INTO houses (house_no, category_id, description, price, address, image, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sisdsss", $house_no, $category_id, $description, $price, $address, $image, $updated_at);
	}

	if ($stmt->execute()) {
		echo "1";
	} else {
		echo "Lỗi SQL: " . $stmt->error . "\n";
		print_r($_POST);
	}
	$stmt->close();
	exit();
}
?>


<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<!-- Form nhập/sửa -->
			<div class="col-md-4">
				<form action="" id="manage-house" enctype="multipart/form-data">
					<div class="card">
						<div class="card-header">House Form</div>
						<div class="card-body">
							<div class="form-group" id="msg"></div>
							<input type="hidden" name="id">
							<div class="form-group">
								<label>House No</label>
								<input type="text" class="form-control" name="house_no" required>
							</div>
							<div class="form-group">
								<label>Category</label>
								<select name="category_id" class="custom-select" required>
									<?php
									$categories = $conn->query("SELECT * FROM categories ORDER BY name ASC");
									while ($row = $categories->fetch_assoc()) {
										echo "<option value='{$row['id']}'>{$row['name']}</option>";
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea name="description" class="form-control" required></textarea>
							</div>
							<div class="form-group">
								<label>Price</label>
								<input type="number" class="form-control" name="price" step="any" required>
							</div>
							<div class="form-group">
								<label>Address</label>
								<input type="text" class="form-control" name="address" required>
							</div>
							<div class="form-group">
								<label>House Image</label>
								<input type="file" class="form-control" name="image">
								<img id="preview-img" src="" width="240" style="display: none; margin-top: 10px;">
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-primary">Save</button>
							<button class="btn btn-default" type="reset">Cancel</button>
						</div>
					</div>
				</form>
			</div>

			<!-- Danh sách nhà -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-header"><b>House List</b></div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>House</th>
									<th>Image</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$house = $conn->query("SELECT h.*, c.name as cname FROM houses h INNER JOIN categories c ON c.id = h.category_id ORDER BY h.id ASC");
								while ($row = $house->fetch_assoc()):
								?>
									<tr>
										<td><?php echo $i++ ?></td>
										<td>
											<p>House #: <b><?php echo $row['house_no'] ?></b></p>
											<p>Type: <b><?php echo $row['cname'] ?></b></p>
											<p>Description: <b><?php echo $row['description'] ?></b></p>
											<p>Address: <b><?php echo $row['address'] ?></b></p>
											<p>Price: <b><?php echo number_format($row['price'], 2) ?></b></p>
										</td>
										<td><img src="<?php echo $row['image']; ?>" width="100"></td>
										<td>
											<button class="btn btn-success edit_house" data-id="<?php echo $row['id'] ?>"
												data-house_no="<?php echo $row['house_no'] ?>"
												data-category_id="<?php echo $row['category_id'] ?>"
												data-description="<?php echo $row['description'] ?>"
												data-price="<?php echo $row['price'] ?>"
												data-address="<?php echo $row['address'] ?>"
												data-image="<?php echo $row['image'] ?>">
												Edit
											</button>
											<button class="btn btn-danger delete_house" data-id="<?php echo $row['id'] ?>">Delete</button>
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
</div>

<script>
	$('input[name="image"]').change(function(event) {
		let reader = new FileReader();
		reader.onload = function() {
			$('#preview-img').attr('src', reader.result).show();
		};
		reader.readAsDataURL(event.target.files[0]);
	});

	$('#manage-house').submit(function(e) {
		e.preventDefault();
		let formData = new FormData(this);
		$.ajax({
			url: '', // URL xử lý form (có thể để trống vì đang ở cùng trang)
			method: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				console.log("Server response:", response);
				if (response.trim() == "1") {
					alert("Cập nhật thành công!");
					location.reload(); // Reload lại trang để cập nhật danh sách
				} else {
					alert("Lỗi khi cập nhật: " + response);
				}
			}
		});
	});

	$('.edit_house').click(function() {
		let form = $('#manage-house');
		form.find("[name='id']").val($(this).data('id'));
		form.find("[name='house_no']").val($(this).data('house_no'));
		form.find("[name='category_id']").val($(this).data('category_id'));
		form.find("[name='description']").val($(this).data('description'));
		form.find("[name='price']").val($(this).data('price'));
		form.find("[name='address']").val($(this).data('address'));
		$('#preview-img').attr('src', $(this).data('image')).show();
	});

	$('.delete_house').click(function() {
		let id = $(this).attr('data-id');
		if (confirm("Are you sure you want to delete this house?")) {
			$.ajax({
				url: 'ajax.php?action=delete_house',
				method: 'POST',
				data: {
					id: id
				},
				success: function(resp) {
					if (resp == 1) {
						alert("House deleted successfully!");
						location.reload();
					} else {
						alert("Error deleting house.");
					}
				}
			});
		}
	});
</script>
