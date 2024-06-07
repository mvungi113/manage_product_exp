<?php session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/login.php");
    exit();
}

 include_once '../../includes/header.php' ;
 ?>

<?php include_once './manufacturer_header.php' ?>

<div class="center-form">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">

                <h2>Generate QR Code</h2>
                <form action="generate_qr.php" method="post">

                    <div class="mb-3">

                        <label for="exampleFormControlInput1" class="form-label">Company Name:</label><br>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="companyName" required>
                    </div>
                    <div class="mb-3">

                        <label for="exampleFormControlInput1" class="form-label">Product Name:</label><br>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="productName" required>
                    </div>
                    <div class="mb-3">
                    <label  for="exampleFormControlInput1" class="form-label">Manufacture Date:</label><br>
                    <input type="date" class="form-control" id="exampleFormControlInput1" name="manufactureDate" required>
                    </div>
                   
                    <div class="mb-3">
                    <label  for="exampleFormControlInput1" class="form-label">Expire Date:</label>
                    <input type="date"class="form-control" id="exampleFormControlInput1"  name="expireDate" required><br><br>
                    </div>
                    
                    <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Generate QR Code</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once '../../includes/footer.php' ?>