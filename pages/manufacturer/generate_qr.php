<?php
// Include the library
require_once '../../phpqrcode/qrlib.php';

// Database connection
include_once '../../config/db_config.php';
// Get form data
$companyName = $_POST['companyName'];
$productName = $_POST['productName'];
$manufactureDate = $_POST['manufactureDate'];
$expireDate = $_POST['expireDate'];

// Generate the content string
$content = "Company Name: $companyName\nProduct Name: $productName\nManufacture Date: $manufactureDate\nExpire Date: $expireDate";

// Output file path
$filePath = 'qrcodes/' . uniqid() . '.png';

// Generate the QR code
QRcode::png($content, $filePath);

// Insert data into database
$sql = "INSERT INTO products (company_name, product_name, manufacture_date, expire_date, qr_code_path) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $companyName, $productName, $manufactureDate, $expireDate, $filePath);
$stmt->execute();
$stmt->close();

// Close database connection
$conn->close();

// Display the QR code
include_once '../../includes/header.php';
include_once './manufacturer_header.php';
?>

<div class="center-form">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="alert text-success" role="alert">
                    QR Code Generated Successfully
                </div>
                <div class="mb-3">
                    <?php echo '<img src="' . $filePath . '" alt="QR Code">'; ?>
                </div>



                <div class="mb-3">
                    <a href="<?php echo $filePath; ?>" download="product_qrcode.png">
                        <button class="btn btn-primary">Download</button>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
<?php include_once '../../includes/footer.php' ?>