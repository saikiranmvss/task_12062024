<?php
session_start();

// Check login credentials and set session if valid
$email = $_POST['email'];
$password = $_POST['password'];

// You need to retrieve the hashed password from the database based on the email
$hashedPasswordFromDatabase = password_hash("admin123", PASSWORD_DEFAULT);

if ($email === "admin@example.com" && password_verify($password, $hashedPasswordFromDatabase)) {
    $_SESSION['admin_id'] = 1; // Set session ID or any other relevant data
    echo 1;
} else {
    echo 0;
}
?>

