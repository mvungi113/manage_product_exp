<?php
// Session check
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/login.php");
    exit();
}

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
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        // Calculate status based on expire date
                        $current_date = new DateTime();
                        $expire_date = new DateTime($row['expire_date']);
                        $interval = $current_date->diff($expire_date);
                        $days_to_expire = $interval->days;

                        if ($expire_date < $current_date) {
                            $status = "Expired";
                            $status_class = "text-danger";
                        } elseif ($days_to_expire <= 30) {
                            $status = "Soon to Expire";
                            $status_class = "text-warning";
                        } else {
                            $status = "Normal";
                            $status_class = "text-success";
                        }
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo strtoupper($row['product_name']); ?></td>
                            <td><?php echo strtoupper($row['company_name']); ?></td>
                            <td><?php echo $row['manufacture_date']; ?></td>
                            <td><?php echo $row['expire_date']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td class="<?php echo $status_class; ?>"><?php echo $status; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7">No products found for this user.</td>
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
