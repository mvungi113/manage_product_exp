<?php
// Read the QR data from the request
$qrData = json_decode(file_get_contents('php://input'), true);

// Insert the QR data into the products table in the database
// Make sure to sanitize and validate the data before inserting it into the database
// For demonstration purposes, we'll just print the data
$decodedData = $qrData['qrData'];
echo json_encode(['success' => true, 'message' => $decodedData]);
?>
