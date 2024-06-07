<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/login.php");
    exit();
}

include_once '../../config/db_config.php';

// Fetch products that will expire within the next 90 or 30 days
$sql = "SELECT company_name, product_name, manufacture_date, expire_date, qr_code_path FROM manufacturerproducts WHERE DATEDIFF(expire_date, CURDATE()) <= 90";
$result = $conn->query($sql);

// Include the header
include_once '../../includes/header.php';
include_once './manufacturer_header.php';
?>

<div class="container mt-5">
    <h2 class="mb-4">Product Expiration Notifications</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $daysToExpire = (new DateTime($row['expire_date']))->diff(new DateTime())->days;
            if ($daysToExpire <= 30) {
                $alertClass = 'alert-danger';
                $message = "Warning: This product will expire in $daysToExpire days!";
            } elseif ($daysToExpire <= 90) {
                $alertClass = 'alert-warning';
                $message = "Notice: This product will expire in $daysToExpire days.";
            }

            echo "<div class='alert $alertClass' role='alert'>";
            echo "<strong>Product: " . htmlspecialchars($row['product_name']) . "</strong><br>";
            echo "Company: " . htmlspecialchars($row['company_name']) . "<br>";
            echo "Manufacture Date: " . htmlspecialchars($row['manufacture_date']) . "<br>";
            echo "Expire Date: " . htmlspecialchars($row['expire_date']) . "<br>";
            echo "$message";
            echo "</div>";
        }
    } else {
        echo "<div class='alert alert-success' role='alert'>No products are close to their expiration date.</div>";
    }
    ?>
</div>

<?php
// Include the footer
include_once '../../includes/footer.php';
$conn->close();
?>
