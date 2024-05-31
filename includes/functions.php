<?php
include '../config/db_config.php'; 
function register_user($first_name, $last_name, $email, $phone_number, $gender, $role, $password)
{
    global $conn;

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone_number, gender, role, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $first_name, $last_name, $email, $phone_number, $gender, $role, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        return true; // Registration successful
    } else {
        return false; // Registration failed
    }
}

function login_user($email, $password)
{
    global $conn;

    // Fetch user from the database
    $stmt = $conn->prepare("SELECT email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        return true; // Login successful
    } else {
        return false; // Login failed
    }
}

?>
