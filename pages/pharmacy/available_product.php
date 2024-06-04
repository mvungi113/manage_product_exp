<?php include_once '../../config/db_config.php' ?>
<?php include_once '../../includes/header.php' ;
include_once './pharmacy_header.php';?>

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
                // Include the database connection
                include_once '../../config/db_config.php';

                // Fetch products from the database
                $sql = "SELECT * FROM pharmacyproduct";
                $result = $conn->query($sql);

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
                        <td colspan="5">No products found</td>
                    </tr>
                    <?php
                }
                // Close database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../../includes/footer.php' ?>
