<?php
include '../config/db_config.php'; 
function register_user($first_name, $last_name, $email, $phone_number, $gender, $role, $password, $country, $district, $ward, $region)
{
    global $conn;

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone_number, gender, role, password, country, district, ward, region) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("sssssssssss", $first_name, $last_name, $email, $phone_number, $gender, $role, $hashed_password, $country, $district, $ward, $region);

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
