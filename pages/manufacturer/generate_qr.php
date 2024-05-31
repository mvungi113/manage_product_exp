<?php
require '../../vendor/autoload.php'; // Ensure Composer's autoload file is included
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

// Database connection
include_once '../../config/db_config.php';

// Create the qrcodes directory if it doesn't exist
$qrDir = './qrcodes';
if (!is_dir($qrDir)) {
    mkdir($qrDir, 0777, true);
}

// Get form data
$companyName = $_POST['companyName'];
$productName = $_POST['productName'];
$manufactureDate = $_POST['manufactureDate'];
$expireDate = $_POST['expireDate'];

// Generate the content string
$content = "Company Name: $companyName\nProduct Name: $productName\nManufacture Date: $manufactureDate\nExpire Date: $expireDate";

// Set QR code options
$options = new QROptions([
    'version'    => 5,
    'outputType' => QRCode::OUTPUT_IMAGE_PNG,
    'eccLevel'   => QRCode::ECC_L,
]);

// Define the path to save the QR code image
$fileName = 'product_qrcode_' . time() . '.png';
$filePath = $qrDir . '/' . $fileName;

// Generate the QR code and save it
try {
    $qrcode = (new QRCode($options))->render($content);
    file_put_contents($filePath, $qrcode);

    // Check if the file was created
    if (!file_exists($filePath)) {
        throw new Exception("Failed to create QR code image.");
    }

    // Insert data into the database
    $sql = "INSERT INTO products (company_name, product_name, manufacture_date, expire_date, qr_code_path) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $companyName, $productName, $manufactureDate, $expireDate, $fileName);
    $stmt->execute();
    $stmt->close();

    // Close the database connection
    $conn->close();
} catch (Exception $e) {
    die("Error generating QR code: " . $e->getMessage());
}
?>
<div class="container mt-5">
        <h2>QR Code Generated Successfully</h2>
        <img src="<?php echo $filePath; ?>" alt="QR Code" class="img-thumbnail">
        <br><br>
        <a href="./register_product.php" class="btn btn-primary">Generate Another QR Code</a>
    </div>


<?php include_once '../../includes/header.php' ?>