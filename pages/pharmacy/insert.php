<?php
include_once '../../config/db_config.php';



// Get form data
$companyName = $_POST['companyName'];
$productName = $_POST['productName'];
$manufactureDate = $_POST['manufactureDate'];
$expireDate = $_POST['expireDate'];

// Insert data into database
$sql = "INSERT INTO pharmacyproduct (company_name, product_name, manufacture_date, expire_date) 
        VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $companyName, $productName, $manufactureDate, $expireDate);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
