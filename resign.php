<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
ob_start();
if (!isset($_SESSION['system'])) {
	$system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	foreach ($system as $k => $v) {
		$_SESSION['system'][$k] = $v;
	}
}
ob_end_flush();
?>

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Đăng ký - <?php echo $_SESSION['system']['name'] ?></title>

	<?php include('./header.php'); ?>
	<?php
	if (isset($_SESSION['login_id']))
		header("location:index.php?page=home");

	?>
</head>
<style>
	body {
		width: 100%;
		height: calc(100%);
	}

	main#main {
		width: 100%;
		height: calc(100%);
		background: white;
	}

	#register-right {
		position: absolute;
		right: 0;
		width: 40%;
		height: calc(100%);
		background: white;
		display: flex;
		align-items: center;
	}

	#register-left {
		position: absolute;
		left: 0;
		width: 60%;
		height: calc(100%);
		background: #59b6ec61;
		display: flex;
		align-items: center;
	}

	#register-right .card {
		margin: auto;
		z-index: 1
	}

	.logo {
		margin: auto;
		font-size: 8rem;
		background: white;
		padding: .5em 0.7em;
		border-radius: 50% 50%;
		color: #000000b3;
		z-index: 10;
	}
</style>

<body>

	<main id="main" class=" bg-light">
		<div id="register-left" class="bg-info">
			<img src="house.png" alt="..." width="100%">
		</div>

		<div id="register-right" class="bg-light">
			<div class="w-100">
				<h4 class="text-info text-center"><b><?php echo $_SESSION['system']['name'] ?></b></h4>
				<br><br>
				<div class="card col-md-8">
					<div class="card-body">
						<form id="register-form">
							<div class="form-group">
								<label for="name" class="control-label">Name</label>
								<input type="text" id="name" name="name" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="username" class="control-label">Username</label>
								<input type="text" id="username" name="username" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="password" class="control-label">Password</label>
								<input type="password" id="password" name="password" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="confirm_password" class="control-label">Confirm Password</label>
								<input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
							</div>
							<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Sign Up</button></center>
						</form>
						<p>Đã có tài khoản? <a href="login.php">Đăng nhập tại đây</a>.</p>
					</div>
				</div>
			</div>
		</div>

	</main>

	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

</body>
<script>
	$('#register-form').submit(function(e) {
		e.preventDefault();
		if ($('#password').val() !== $('#confirm_password').val()) {
			alert('Mật khẩu không khớp!');
			return false;
		}
		$.ajax({
			url: 'ajax.php?action=signup',
			method: 'POST',
			data: $(this).serialize(),
			success: function(resp) {
				console.log(resp); // Ghi log phản hồi từ server
				if (resp == 1) {
					alert('Đăng ký thành công!');
					location.href = 'login.php';
				} else if (resp == 2) {
					alert('Tên đăng nhập đã tồn tại.');
				} else {
					alert('Đăng ký thất bại, vui lòng thử lại.');
				}
			}

		});
	});
</script>

</html>