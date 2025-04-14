<?php
include 'db_connect.php'; // Kết nối database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lessor_name = $_POST['lessor_name'];
    $lessor_id_number = $_POST['lessor_id_number'];
    $lessee_name = $_POST['lessee_name'];
    $lessee_id_number = $_POST['lessee_id_number'];
    $house_address = $_POST['house_address'];
    $rental_period = $_POST['rental_period'];
    $deposit_amount = $_POST['deposit_amount'];
    $contract_date = $_POST['contract_date'];

    $sql = "INSERT INTO contracts (lessor_name, lessor_id_number, lessee_name, lessee_id_number, house_address, rental_period, deposit_amount, contract_date)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssds", $lessor_name, $lessor_id_number, $lessee_name, $lessee_id_number, $house_address, $rental_period, $deposit_amount, $contract_date);

    if ($stmt->execute()) {
        $last_id = $conn->insert_id;
        header("Location: view_contract.php?id=$last_id");
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }
}
?>
