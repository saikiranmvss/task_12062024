<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$hashedPasswordFromDatabase = password_hash("admin123", PASSWORD_DEFAULT);

if ($email === "admin@example.com" && password_verify($password, $hashedPasswordFromDatabase)) {
    $_SESSION['admin_id'] = 1; 
    echo 1;
} else {
    echo 0;
}
?>

