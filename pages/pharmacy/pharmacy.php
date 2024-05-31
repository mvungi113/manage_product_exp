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

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <!-- Brand logo -->
        <a class="navbar-brand" href="#">Brand-logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="row w-100">
                <!-- Center links -->
                <div class="col-md-8">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Scan Bar-Code</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Available Products</a>
                        </li>
                    </ul>
                </div>
                <!-- Right logout link -->
                <div class="col-md-4 text-end">
                    <a href="../../includes/logout.php" class="btn btn-outline-light">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>


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