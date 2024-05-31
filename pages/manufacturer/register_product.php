<?php include_once '../../includes/header.php' ?>

<?php include_once './manufacturer_header.php' ?>
    <div class="container mt-5">
        <h2>Generate QR Code</h2>
        <form action="generate_qr.php" method="post">
            <div class="mb-3">
                <label for="companyName" class="form-label">Company Name:</label>
                <input type="text" class="form-control" id="companyName" name="companyName" required>
            </div>
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name:</label>
                <input type="text" class="form-control" id="productName" name="productName" required>
            </div>
            <div class="mb-3">
                <label for="manufactureDate" class="form-label">Manufacture Date:</label>
                <input type="date" class="form-control" id="manufactureDate" name="manufactureDate" required>
            </div>
            <div class="mb-3">
                <label for="expireDate" class="form-label">Expiration Date:</label>
                <input type="date" class="form-control" id="expireDate" name="expireDate" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate QR Code</button>
        </form>
    </div>
</body>
</html>


<?php include_once '../../includes/footer.php' ?>