<?php

include_once '../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    if (register_user($first_name, $last_name, $email, $phone_number, $gender, $role, $password)) {
        $success_message = "Registration successful.";
        header('Location: ./admin/admin.php');
    } else {
        $error_message = "Registration failed.";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Be Added</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style/stye.css">
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>

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
                            <a class="nav-link active" aria-current="page" href="./admin/admin.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./register_authority.php">Register Authority Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./admin/notification.php">Notification</a>
                        </li>
                    </ul>
                </div>
                <!-- Right logout link -->
                <div class="col-md-4 text-end">
                    <a href="../includes/logout.php" class="btn btn-outline-light">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php if (isset($success_message)) : ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo "<p>$success_message</p>"; ?>
                    </div>

                <?php endif; ?>

                <?php if (isset($error_message)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo "<p>$error_message</p>"; ?>
                    </div>


                <?php endif; ?>


                <h2>Register</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">First Name</label>
                        <input type="text" required class="form-control" name="first_name" id="exampleFormControlInput1" placeholder="Nzullo">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                        <input type="text" required class="form-control" name="last_name" id="exampleFormControlInput1" placeholder="Dee">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" required class="form-control" name="email" id="exampleFormControlInput1" placeholder="nzullodee@email.com">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                        <input type="text" required class="form-control" name="phone_number" id="exampleFormControlInput1" placeholder="0764****78">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Gender</label>
                        <select class="form-select" required name="gender" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <!-- <label for="exampleFormControlInput1" class="form-label">Role</label> -->
                        <input type="text" name="role" required class="form-control" id="exampleFormControlInput1" value="Authority"  >

                   </div>

                    <div class="mb-3">
                        <label for="inputPassword5" class="form-label">Password</label>
                        <input type="password" id="inputPassword5" name="password" class="form-control" aria-describedby="passwordHelpBlock">

                    </div>
                    
                    <div class="mb-3 float-right">
                        <button class="btn btn-primary " name="submit" type="submit">Register</button>
                    </div>

                </form>

            </div>
    </div>
</div>


<?php include_once '../includes/footer.php' ?>