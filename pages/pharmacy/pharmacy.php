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

<?php include_once './pharmacy_header.php' ?>


<div class="container">


    <h2>Pharmacy Page</h2>
    <div class="row">
    <div class="col-sm-4 mb-3 mb-sm-0 pt-4">
                <div class="card">
                    <div class="card-body text-center">
                        <!-- Circular Image -->
                        <img src="../../assets/images/scanner1.png" style="background-color: grey;" alt="Card Image" class="rounded-circle mb-3" width="100px" height="100px">
                        <h5 class="card-title">Scan Bar-Code</h5>
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-3 mb-sm-0 pt-4">
                <div class="card">
                    <div class="card-body text-center">
                        <!-- Circular Image -->
                        <img src="../../assets/images/notification1.png" style="background-color: grey;" alt="Card Image" class="rounded-circle mb-3" width="100px" height="100px">
                        <h5 class="card-title">Notification</h5>
                        
                    </div>
                </div>
            </div>

            <div class="col-sm-4 mb-3 mb-sm-0 pt-4">
                <div class="card">
                    <div class="card-body text-center">
                        <!-- Circular Image -->
                        <img src="../../assets/images/product1.png" style="background-color: grey;" alt="Card Image" class="rounded-circle mb-3" width="100px" height="100px">
                        <h5 class="card-title">Available Products</h5>
                        
                    </div>
                </div>
            </div>
</div>
    
</div>

<?php include_once '../../includes/footer.php' ?>