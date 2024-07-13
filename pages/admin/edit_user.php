<?php
session_start();
include_once '../../config/db_config.php';

$errors = []; // Array to store validation errors

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/login.php");
    exit();
}

// Check if ID parameter is provided
if (!isset($_GET['id'])) {
    header("Location: ./users.php"); // Redirect back to users list if ID is not provided
    exit();
}

$user_id = $_GET['id'];

// Fetch user details from the database
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "User not found.";
    exit();
}

$user = $result->fetch_assoc();

// Handle form submission for updating user information
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    // Validate inputs
    if (strlen($first_name) < 3 || preg_match('/\d/', $first_name)) {
        $errors['first_name'] = "First name must be at least 3 characters long and contain no numbers.";
    }

    if (strlen($last_name) < 3 || preg_match('/\d/', $last_name)) {
        $errors['last_name'] = "Last name must be at least 3 characters long and contain no numbers.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }

    if (!preg_match('/^(07|06)\d{8}$/', $phone_number)) {
        $errors['phone_number'] = "Phone number must start with 07 or 06 and be exactly 10 digits.";
    }

    // If there are no errors, proceed with updating user information
    if (empty($errors)) {
        // Update user in the database
        $update_sql = "UPDATE users SET first_name=?, last_name=?, email=?, phone_number=? WHERE id=?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssssi", $first_name, $last_name, $email, $phone_number, $user_id);
        
        if ($update_stmt->execute()) {
            $success_message = "User updated successfully.";
            header("Location: ./users.php"); // Redirect to users list after successful update
            exit();
        } else {
            $error_message = "Failed to update user.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/style/style.css">
    <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Edit User</h2>

                <?php if (isset($error_message)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $user_id); ?>" method="post">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" required class="form-control <?php echo isset($errors['first_name']) ? 'is-invalid' : ''; ?>" name="first_name" id="first_name" value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : htmlspecialchars($user['first_name']); ?>">
                        <?php if (isset($errors['first_name'])) : ?>
                            <div class="invalid-feedback">
                                <?php echo $errors['first_name']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" required class="form-control <?php echo isset($errors['last_name']) ? 'is-invalid' : ''; ?>" name="last_name" id="last_name" value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : htmlspecialchars($user['last_name']); ?>">
                        <?php if (isset($errors['last_name'])) : ?>
                            <div class="invalid-feedback">
                                <?php echo $errors['last_name']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" required class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : htmlspecialchars($user['email']); ?>">
                        <?php if (isset($errors['email'])) : ?>
                            <div class="invalid-feedback">
                                <?php echo $errors['email']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" required class="form-control <?php echo isset($errors['phone_number']) ? 'is-invalid' : ''; ?>" name="phone_number" id="phone_number" value="<?php echo isset($_POST['phone_number']) ? htmlspecialchars($_POST['phone_number']) : htmlspecialchars($user['phone_number']); ?>">
                        <?php if (isset($errors['phone_number'])) : ?>
                            <div class="invalid-feedback">
                                <?php echo $errors['phone_number']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="./users.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
