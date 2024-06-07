<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/login.php");
    exit();
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Include database configuration
include_once '../../config/db_config.php';

// Pagination variables
$recordsPerPage = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Fetch 10 products from the database based on pagination for the logged-in user
$sql = "SELECT company_name, product_name, manufacture_date, expire_date, qr_code_path 
        FROM manufacturerproducts 
        WHERE user_id = $user_id
        LIMIT $offset, $recordsPerPage";
$result = $conn->query($sql);

// Count total number of records for the logged-in user
$totalRecordsSql = "SELECT COUNT(*) AS total FROM manufacturerproducts WHERE user_id = $user_id";
$totalRecordsResult = $conn->query($totalRecordsSql);
$totalRecords = $totalRecordsResult->fetch_assoc()['total'];

// Calculate total pages
$totalPages = ceil($totalRecords / $recordsPerPage);

// Include the header
include_once '../../includes/header.php';
include_once './manufacturer_header.php';
?>

<div class="container mt-5">
    <h2 class="mb-4">Available Products</h2>
    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>Company Name</th>
                <th>Product Name</th>
                <th>Manufacture Date</th>
                <th>Expire Date</th>
                <th>QR Code</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['company_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['manufacture_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['expire_date']) . "</td>";
                    echo "<td><img src='../../pages//manufacturer/" . htmlspecialchars($row['qr_code_path']) . "' alt='QR Code' width='100'></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No products available</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<li class='page-item" . ($page == $i ? ' active' : '') . "'><a class='page-link' href='?page=$i'>$i</a></li>";
            }
            ?>
        </ul>
    </nav>
</div>

<?php
// Include the footer
include_once '../../includes/footer.php';
$conn->close();
?>
