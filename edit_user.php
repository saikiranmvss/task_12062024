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
  $approved = $_POST['approved'];
  $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';

  $profile_picture = $_FILES['profile_picture']['name'];
  $signature = $_FILES['signature']['name'];

  // File upload handling
  $target_dir = "uploads/";
  if (!empty($profile_picture)) {
    $profile_picture_target = $target_dir . basename($profile_picture);
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture_target);
  }
  if (!empty($signature)) {
    $signature_target = $target_dir . basename($signature);
    move_uploaded_file($_FILES['signature']['tmp_name'], $signature_target);
  }

  // Update query
  $sql = "UPDATE users SET name='$name', role='$role', mobile='$mobile', email='$email', address='$address', gender='$gender', dob='$dob', approved='$approved'";
  if (!empty($profile_picture)) {
    $sql .= ", profile_picture='$profile_picture'";
  }
  if (!empty($signature)) {
    $sql .= ", signature='$signature'";
  }
  if (!empty($password)) {
    $sql .= ", password='$password'";
  }
  $sql .= " WHERE id='$id'";

  if ($conn->query($sql) === TRUE) {
    echo "User updated successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>
