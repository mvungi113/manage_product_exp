<?php
include_once '../includes/functions.php';

$errors = []; // Array to store validation errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    
    // Location details
    $country = isset($_POST['country']) ? $_POST['country'] : null;
    $district = isset($_POST['district']) ? $_POST['district'] : null;
    $ward = isset($_POST['ward']) ? $_POST['ward'] : null;
    $region = isset($_POST['region']) ? $_POST['region'] : null;

    // Validate first name
    if (strlen($first_name) < 3 || preg_match('/\d/', $first_name)) {
        $errors['first_name'] = "First name must be at least 3 characters long and contain no numbers.";
    }

    // Validate last name
    if (strlen($last_name) < 3 || preg_match('/\d/', $last_name)) {
        $errors['last_name'] = "Last name must be at least 3 characters long and contain no numbers.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }

    // Validate phone number (must start with 07 or 06 and be exactly 10 digits)
    if (!preg_match('/^(07|06)\d{8}$/', $phone_number)) {
        $errors['phone_number'] = "Phone number must start with 07 or 06 and be exactly 10 digits.";
    }

    // Validate password (must be at least 6 characters, include uppercase, lowercase, number, and special character)
    if (strlen($password) < 6 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[@$!%*#?&]/', $password)) {
        $errors['password'] = "Password must be at least 6 characters long, and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
    }

    // If there are no errors, proceed with registration
    if (empty($errors)) {
        $registration_result = register_user($first_name, $last_name, $email, $phone_number, $gender, $role, $password, $country, $district, $ward, $region);
        if ($registration_result === true) {
            $success_message = "Registration successful.";
            header('Location: ./admin/admin.php');
            exit;
        } else {
            $error_message = "Registration failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Authority User</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style/style.css">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
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

            <h2>Register Authority User</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" required class="form-control <?php echo isset($errors['first_name']) ? 'is-invalid' : ''; ?>" name="first_name" id="first_name" value="<?php echo isset($first_name) ? htmlspecialchars($first_name) : ''; ?>" placeholder="Enter first name">
                    <?php if (isset($errors['first_name'])) : ?>
                        <div class="invalid-feedback">
                            <?php echo $errors['first_name']; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" required class="form-control <?php echo isset($errors['last_name']) ? 'is-invalid' : ''; ?>" name="last_name" id="last_name" value="<?php echo isset($last_name) ? htmlspecialchars($last_name) : ''; ?>" placeholder="Enter last name">
                    <?php if (isset($errors['last_name'])) : ?>
                        <div class="invalid-feedback">
                            <?php echo $errors['last_name']; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" required class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" name="email" id="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" placeholder="Enter email">
                    <?php if (isset($errors['email'])) : ?>
                        <div class="invalid-feedback">
                            <?php echo $errors['email']; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" required class="form-control <?php echo isset($errors['phone_number']) ? 'is-invalid' : ''; ?>" name="phone_number" id="phone_number" value="<?php echo isset($phone_number) ? htmlspecialchars($phone_number) : ''; ?>" placeholder="Enter phone number">
                    <?php if (isset($errors['phone_number'])) : ?>
                        <div class="invalid-feedback">
                            <?php echo $errors['phone_number']; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select <?php echo isset($errors['gender']) ? 'is-invalid' : ''; ?>" required name="gender" id="gender" aria-label="Select gender">
                        <option selected disabled>Select gender</option>
                        <option value="Male" <?php echo isset($gender) && $gender === 'Male' ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo isset($gender) && $gender === 'Female' ? 'selected' : ''; ?>>Female</option>
                        <option value="Others" <?php echo isset($gender) && $gender === 'Others' ? 'selected' : ''; ?>>Others</option>
                    </select>
                    <?php if (isset($errors['gender'])) : ?>
                        <div class="invalid-feedback">
                            <?php echo $errors['gender']; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" name="country" id="country" value="<?php echo isset($country) ? htmlspecialchars($country) : ''; ?>" placeholder="Enter country">
                </div>

                <div class="mb-3">
                    <label for="district" class="form-label">District</label>
                    <input type="text" class="form-control" name="district" id="district" value="<?php echo isset($district) ? htmlspecialchars($district) : ''; ?>" placeholder="Enter district">
                </div>

                <div class="mb-3">
                    <label for="ward" class="form-label">Ward</label>
                    <input type="text" class="form-control" name="ward" id="ward" value="<?php echo isset($ward) ? htmlspecialchars($ward) : ''; ?>" placeholder="Enter ward">
                </div>

                <div class="mb-3">
                    <label for="region" class="form-label">Region</label>
                    <input type="text" class="form-control" name="region" id="region" value="<?php echo isset($region) ? htmlspecialchars($region) : ''; ?>" placeholder="Enter region">
                </div>

                <div class="mb-3">
                    <input type="hidden" name="role" value="Authority">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" required class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Enter password">
                    <?php if (isset($errors['password'])) : ?>
                        <div class="invalid-feedback">
                            <?php echo $errors['password']; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3 text-center">
                    <button class="btn btn-primary" name="submit" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once '../includes/footer.php'; ?>
</body>
</html>
