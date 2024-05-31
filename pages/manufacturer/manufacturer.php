<?php 
session_start();
include_once '../../includes/header.php' ?>


<?php
// Session check
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/login.php");
    exit();
}
?>

<?php include_once './manufacturer_header.php' ?>
<div class="container">
    <h2>Manufacturer Page</h2>
    <div class="row ml-4">
        <div class="col-sm-6 mb-3  mb-sm-0 pt-4">
            <a href="./register_product.php" style="text-decoration: none;" class="card-link">
                <div class="card">
                    <div class="card-body text-center">
                        <!-- Circular Image -->
                        <img src="../../assets/images/product1.png" style="background-color: grey;" alt="Card Image" class="rounded-circle mb-3" width="100px" height="100px">
                        <h5 class="card-title pt-4">Register Product</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-6 mb-3 mb-sm-0 pt-4">
            <a href="available_products.php" style="text-decoration: none;" class="card-link">
                <div class="card">
                    <div class="card-body text-center">
                        <!-- Circular Image -->
                        <img src="../../assets/images/product1.png" style="background-color: grey;" alt="Card Image" class="rounded-circle mb-3" width="100px" height="100px">
                        <h5 class="card-title pt-4">Available Products</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>


<?php include_once '../../includes/footer.php' ?>