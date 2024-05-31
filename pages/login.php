<?php
session_start();
require_once "../config/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email and password are not empty
    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on user role
                if ($user['role'] == 'admin') {
                    header("Location: ../pages/admin/admin.php");
                } elseif ($user['role'] == 'authority') {
                    header("Location: ../pages/authority/authority.php");
                } elseif ($user['role'] == 'manufacturer') {
                    header("Location: ../pages/manufacturer/manufacturer.php");
                } elseif ($user['role'] == 'pharmacy') {
                    header("Location: ../pages/pharmacy/pharmacy.php");
                }
                exit();
            } else {
                $error_message = "Invalid password.";
            }
        } else {
            $error_message = "Invalid email.";
        }
    } else {
        $error_message = "Please fill in all fields.";
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

<div class="center-form">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php if (isset($error_message)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo "<p>$error_message</p>" ?>
                    </div>

                <?php endif; ?>
                <h2>Login</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" required class="form-control" name="email" id="exampleFormControlInput1" placeholder="nzullodee@email.com">
                    </div>

                    <div class="mb-3">
                        <label for="inputPassword5" class="form-label">Password</label>
                        <input type="password" id="inputPassword5" name="password" class="form-control" aria-describedby="passwordHelpBlock">

                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">Login</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>




</body>

</html>