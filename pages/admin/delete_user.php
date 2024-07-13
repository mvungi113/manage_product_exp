<?php
session_start();
include_once '../../config/db_config.php';

// Check if user ID is provided and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch user information to determine the role
    $sql_user = "SELECT * FROM users WHERE id = $user_id";
    $result_user = $conn->query($sql_user);

    if ($result_user->num_rows == 1) {
        $user = $result_user->fetch_assoc();
        $role = $user['role'];

        // Delete user from corresponding product table based on role
        if ($role == 'Pharmacy') {
            $sql_delete_products = "DELETE FROM pharmacyproduct WHERE user_id = $user_id";
        } elseif ($role == 'manufacturer') {
            $sql_delete_products = "DELETE FROM manufacturerproducts WHERE user_id = $user_id";
        }

        // Perform deletion of related products
        if (isset($sql_delete_products)) {
            if ($conn->query($sql_delete_products) === TRUE) {
                // Products deleted successfully, now delete the user
                $sql_delete_user = "DELETE FROM users WHERE id = $user_id";

                if ($conn->query($sql_delete_user) === TRUE) {
                    // User deleted successfully
                    $_SESSION['success_message'] = "User and related products deleted successfully.";
                } else {
                    $_SESSION['error_message'] = "Error deleting user: " . $conn->error;
                }
            } else {
                $_SESSION['error_message'] = "Error deleting related products: " . $conn->error;
            }
        } else {
            // No related products to delete, directly delete user
            $sql_delete_user = "DELETE FROM users WHERE id = $user_id";

            if ($conn->query($sql_delete_user) === TRUE) {
                // User deleted successfully
                $_SESSION['success_message'] = "User deleted successfully.";
            } else {
                $_SESSION['error_message'] = "Error deleting user: " . $conn->error;
            }
        }
    } else {
        $_SESSION['error_message'] = "User not found.";
    }
} else {
    $_SESSION['error_message'] = "Invalid user ID.";
}

// Redirect back to the users list page
header("Location: users.php");
exit();
?>
