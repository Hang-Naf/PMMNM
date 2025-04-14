<?php 

// $conn= new mysqli('localhost',username: 'root','','house_rental_db')or die("Could not connect to mysql".mysqli_error($con));

// $connection = new mysqli('localhost', 'root', '', 'house_rental_db', port: 3307);

$servername = "localhost";
$username = "root";
$password = ""; // nếu không có mật khẩu, để trống
$dbname = "house_rental_db"; // tên cơ sở dữ liệu bạn đã import

// Tạo kết nối
$conn = new mysqli('localhost', 'root', '', 'house_rental_db', port : 3307);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
