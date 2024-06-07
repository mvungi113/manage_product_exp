<?php
// Session check
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/login.php");
    exit();
}
?>

<?php 
include_once '../../config/db_config.php';
include_once '../../includes/header.php';
include_once './pharmacy_header.php';

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch products associated with the user ID
$sql = "SELECT * FROM pharmacyproduct WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<div class="container mt-5">
    <h2 class="mb-4">Available Products</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Company Name</th>
                    <th>Manufacture Date</th>
                    <th>Expire Date</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['company_name']; ?></td>
                            <td><?php echo $row['manufacture_date']; ?></td>
                            <td><?php echo $row['expire_date']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6">No products found for this user.</td>
                    </tr>
                    <?php
                }
                // Close prepared statement
                $stmt->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../../includes/footer.php' ?>
