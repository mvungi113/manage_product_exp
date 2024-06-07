<?php
include_once '../../config/db_config.php';

// Session check
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/login.php");
    exit();
}

// Get form data
$user_id = $_SESSION['user_id'];
$companyName = $_POST['companyName'];
$productName = $_POST['productName'];
$manufactureDate = $_POST['manufactureDate'];
$expireDate = $_POST['expireDate'];

// Insert data into database
$sql = "INSERT INTO pharmacyproduct (user_id, company_name, product_name, manufacture_date, expire_date) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issss", $user_id, $companyName, $productName, $manufactureDate, $expireDate);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
