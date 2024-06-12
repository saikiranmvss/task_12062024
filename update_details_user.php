<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit();
}

$servername = "localhost";
$username = "root";
$password = "";  // Update with your database password
$dbname = "user_management";  // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize input
  $name = $conn->real_escape_string($_POST['name']);
  $mobile = $conn->real_escape_string($_POST['mobile']);
  $address = $conn->real_escape_string($_POST['address']);
  $gender = $conn->real_escape_string($_POST['gender']);
  $dob = $conn->real_escape_string($_POST['dob']);

  // Handle file uploads
  $profile_picture = '';
  if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $profile_picture = 'uploads/' . basename($_FILES['profile_picture']['name']);
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture);
  }

  $signature = '';
  if (isset($_FILES['signature']) && $_FILES['signature']['error'] == 0) {
    $signature = 'uploads/' . basename($_FILES['signature']['name']);
    move_uploaded_file($_FILES['signature']['tmp_name'], $signature);
  }

  $sql = "UPDATE users SET name = ?, mobile = ?, address = ?, gender = ?, dob = ?, profile_picture = ?, signature = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssssi", $name, $mobile, $address, $gender, $dob, $profile_picture, $signature, $user_id);

  if ($stmt->execute()) {
    echo "Details updated successfully!";
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
