<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $role = $_POST['role'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $gender = $_POST['gender'];
  $dob = $_POST['dob'];
  $profile_picture = $_FILES['profile_picture']['name'];
  $signature = $_FILES['signature']['name'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $approved = $_POST['approved'];

  // Upload files
  $target_dir = "uploads/";
  $profile_picture_target = $target_dir . basename($profile_picture);
  $signature_target = $target_dir . basename($signature);
  move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture_target);
  move_uploaded_file($_FILES['signature']['tmp_name'], $signature_target);

  $sql = "INSERT INTO users (name, role, mobile, email, address, gender, dob, profile_picture, signature, password, approved)
          VALUES ('$name', '$role', '$mobile', '$email', '$address', '$gender', '$dob', '$profile_picture', '$signature', '$password', '$approved')";

  if ($conn->query($sql) === TRUE) {
    echo "User created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>
