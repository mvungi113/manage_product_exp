<?php
session_start();
include_once '../../config/db_config.php';

// Pagination variables
$recordsPerPage = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Fetch products from the database based on pagination
$sql = "SELECT id, company_name, product_name, manufacture_date, expire_date 
        FROM pharmacyproduct 
        LIMIT ?, ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param('ii', $offset, $recordsPerPage);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}

// Count total number of records
$totalRecordsSql = "SELECT COUNT(*) AS total FROM pharmacyproduct";
$totalRecordsResult = $conn->query($totalRecordsSql);

if ($totalRecordsResult === false) {
    die('Query failed: ' . htmlspecialchars($conn->error));
}

$totalRecords = $totalRecordsResult->fetch_assoc()['total'];

// Calculate total pages
$totalPages = ceil($totalRecords / $recordsPerPage);

// Include the header
include_once '../../includes/header.php';
include_once './authority_header.php';
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
                <th>Action</th>
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
                    echo "<td><a href='delete_product.php?id=" . urlencode($row['id']) . "' class='btn btn-danger btn-sm'>Delete</a></td>";
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
