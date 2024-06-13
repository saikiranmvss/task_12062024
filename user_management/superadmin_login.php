<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$hashedPasswordFromDatabase = password_hash("superadmin123", PASSWORD_DEFAULT);

if ($email === "superadmin@example.com" && password_verify($password, $hashedPasswordFromDatabase)) {
    $_SESSION['superadmin_id'] = 1;
    echo "success";
} else {
    echo "error";
}
?>
