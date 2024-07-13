<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Manufacturing & Pharmacy Management</title>
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/style/style.css">
    <style>
    .carousel-inner {
        max-height: 500px; /* Adjust the max height as needed */
        overflow: hidden;
    }
    .carousel-image {
        object-fit: cover; /* Ensures the image covers the specified area */
        height: 500px; /* Adjust the height as needed */
    }
</style>
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <!-- Brand logo -->
            <a class="navbar-brand" href="#">Medical</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="row w-100">
                    <!-- Center links -->
                    <div class="col-md-8">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#about-us">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#contact-us">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Right logout link -->
                    <div class="col-md-4 text-end">
                        <a href="./pages/register.php" class="btn bg-warning text-light">Register</a>
                        <a href="./pages/login.php" class="btn bg-danger text-light">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

   <!-- Carousel -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./assets/images/20.jpg" class="d-block w-100 carousel-image" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Welcome to Medical Manufacturing & Pharmacy Management</h5>
            </div>
        </div>
        <div class="carousel-item">
            <img src="./assets/images/21.jpg" class="d-block w-100 carousel-image" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Manage your medical manufacturing processes and pharmacy operations efficiently.</h5>
            </div>
        </div>
        <div class="carousel-item">
            <img src="./assets/images/22.jpg" class="d-block w-100 carousel-image" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Register as a manufacturer or pharmacy to get started.</h5>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

    <div class="container mt-4">
        <div class="row d-flex">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Not registered yet</h5>
                        <p class="card-text">Register as a manufacturer or pharmacy to get started.</p>
                        <a href="./pages/register.php" class="btn btn-primary">Register</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Already have an account?</h5>
                        <p class="card-text">Login as a manufacturer or pharmacy to get started.</p>
                        <a href="./pages/login.php" class="btn btn-primary">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- About Us Section -->
<section id="about-us" class="container mt-4">
    <div class="row">
        <div class="col-sm-12 col-md-6">
        <h2>About Us</h2>
            <p>We are dedicated to streamlining medical manufacturing and pharmacy management. Our platform offers efficient solutions to help you manage your operations seamlessly, ensuring the highest standards of quality and compliance.</p>
            <p>Our team of experts is committed to providing innovative tools and resources that empower pharmacies and manufacturers to operate more efficiently and effectively. By leveraging the latest technologies, we strive to enhance the overall healthcare experience for providers and patients alike.</p>
        </div>
        <div class="col-sm-12 col-md-6">
        <img src="./assets/images/12.jpg" class="d-block w-100" alt="First slide">
         </div>
    </div>
</section>

<!-- Contact Us Section -->
<section id="contact-us" class="container mt-4 mb-4">
    <div class="row">
        <div class="col-sm-12 col-md-6">
        <img src="./assets/images/11.jpg" class="d-block w-100" alt="First slide">

        </div>
        <div class="col-sm-12 col-md-6">
            <h2>Support</h2>
            <p>We offer 24/7 support to ensure your operations run smoothly. Contact us through any of the means listed, and our team will assist you promptly.</p>
            <ul>
                <li>Email: support@mfumo.com</li>
                <li>Phone: 0796875748</li>
                <li>Phone: 0696875748</li>
                <li>Address: 1234 Ikuti St, Mbeya City, Tanzania</li>
            </ul>
        </div>
    </div>
</section>




    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>

</html>
