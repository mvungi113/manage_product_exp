<?php
session_start();
include_once '../../config/db_config.php';

// Check if ID parameter is set
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];

    // Prepare SQL statement to delete product
    $sql = "DELETE FROM pharmacyproduct WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind ID parameter
    $stmt->bind_param('i', $product_id);

    // Execute the deletion
    if ($stmt->execute()) {
        // Redirect back to the product list page after deletion
        header("Location: ./available_product.php");
        exit();
    } else {
        die('Delete failed: ' . htmlspecialchars($stmt->error));
    }
} else {
    die('Invalid product ID');
}
?>
