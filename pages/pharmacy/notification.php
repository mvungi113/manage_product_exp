<?php
session_start();
include_once '../../config/db_config.php';

// Fetch products that will expire within the next 90 days
$sql = "SELECT company_name, product_name, manufacture_date, expire_date FROM pharmacyproduct WHERE DATEDIFF(expire_date, CURDATE()) <= 90";
$result = $conn->query($sql);

// Include the header
include_once '../../includes/header.php';
include_once './pharmacy_header.php';
?>

<div class="container mt-5">
    <h2 class="mb-4">Product Expiration Notifications</h2>
    <?php
    // Check if the query was successful
    if ($result === false) {
        // Query failed, display error message
        echo "<div class='alert alert-danger' role='alert'>Error: " . $conn->error . "</div>";
    } else {
        // Check if there are any products
        if ($result->num_rows > 0) {
            // Output the notifications
            while ($row = $result->fetch_assoc()) {
                // Convert VARCHAR expire_date to DateTime object
                $expireDate = DateTime::createFromFormat('Y-m-d', $row['expire_date']);

                // Calculate the remaining days until expiration
                $daysToExpire = (new DateTime())->diff($expireDate)->days;

                // Determine the alert class and message based on remaining days
                if ($daysToExpire <= 30) {
                    $alertClass = 'alert-danger';
                    $message = "Warning: This product will expire in $daysToExpire days!";
                } elseif ($daysToExpire <= 90) {
                    $alertClass = 'alert-warning';
                    $message = "Notice: This product will expire in $daysToExpire days.";
                } else {
                    // No notification for products expiring beyond 90 days
                    continue;
                }

                // Display the notification
                echo "<div class='alert $alertClass' role='alert'>";
                echo "<strong>Product: " . htmlspecialchars($row['product_name']) . "</strong><br>";
                echo "Company: " . htmlspecialchars($row['company_name']) . "<br>";
                echo "Manufacture Date: " . htmlspecialchars($row['manufacture_date']) . "<br>";
                echo "Expire Date: " . htmlspecialchars($row['expire_date']) . "<br>";
                echo "$message";
                echo "</div>";
            }
        } else {
            // No products found
            echo "<div class='alert alert-success' role='alert'>No products found.</div>";
        }
    }
    ?>
</div>

<?php
// Include the footer
include_once '../../includes/footer.php';
$conn->close();
?>
