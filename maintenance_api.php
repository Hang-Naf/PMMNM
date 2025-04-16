<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tenant_name = $_POST['tenant_name'];
    $room_number = $_POST['room_number'];
    $issue = $_POST['issue'];
    $request_date = $_POST['request_date'];

    $sql = "INSERT INTO maintenance_requests (tenant_name, room_number, issue, request_date)
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $tenant_name, $room_number, $issue, $request_date);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
