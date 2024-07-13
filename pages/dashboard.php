<?php
include '../includes/session.php';
if (!is_logged_in()) {
    header("Location: ./login.php");
    exit();
}

// Fetch user details based on session email and display dashboard accordingly
$email = $_SESSION['email'];
echo $email;
// Fetch user role from the database and display respective dashboard content
?>


