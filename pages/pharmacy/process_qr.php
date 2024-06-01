<?php

// Include the Zxing library
require_once 'path/to/Zxing/autoload.php';

use Zxing\QrReader;

// Function to process the uploaded image and extract QR code content
function processQRCodeImage($imagePath) {
    try {
        // Create a new QR code reader instance
        $reader = new QrReader($imagePath);
        
        // Decode the QR code image
        $qrContent = $reader->text();
        
        // Return the decoded QR code content
        return $qrContent;
    } catch (Exception $e) {
        // Handle any errors
        return null;
    }
}

// Function to insert data into the database
function insertDataIntoDatabase($qrContent) {
    // Extract the individual fields from the QR code content
    list($companyName, $productName, $manufactureDate, $expireDate) = explode(",", $qrContent);

    // Perform database insertion
    include_once '../../config/db_config.php';

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO pharmacyproduct (company_name, product_name, manufacture_date, expire_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $companyName, $productName, $manufactureDate, $expireDate);

    // Execute the SQL statement
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Check if file is uploaded
    if(isset($_FILES['qrCodeImage'])) {
        $file = $_FILES['qrCodeImage'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];

        if($fileError === 0) {
            // Move the uploaded file to a permanent location
            $destination = 'uploads/' . $fileName;
            move_uploaded_file($fileTmpName, $destination);

            // Process the uploaded image to extract QR code content
            $qrContent = processQRCodeImage($destination);

            if($qrContent !== null) {
                // Insert data into the database
                insertDataIntoDatabase($qrContent);
                
                echo "QR Code data inserted into database successfully.";
            } else {
                echo "Error decoding QR code.";
            }
        } else {
            echo "Error uploading file.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upload QR Code and Insert into Database</title>
</head>
<body>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="qrCodeImage" accept="image/*">
    <button type="submit" name="submit">Upload and Insert into Database</button>
</form>

</body>
</html>
