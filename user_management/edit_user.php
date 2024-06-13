<?php
include 'db_connection.php';

function sendResponse($conn, $message) {

  if($message==0){
    $sql = "SELECT * FROM users";
  }else{

    $user_id = $message;

    $sql = "SELECT * FROM users where id = $user_id";
  }
  
  $result = $conn->query($sql);
  $users = [];
  
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $users[] = $row;
      }
  }
  
  echo json_encode([
      "message" => $message,
      "users" => $users
  ]);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if($_POST['formName']=='edit_user'){
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


  $target_dir = "uploads/";
  if (!empty($profile_picture)) {
    $profile_picture_target = $target_dir . basename($profile_picture);
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture_target);
  }
  if (!empty($signature)) {
    $signature_target = $target_dir . basename($signature);
    move_uploaded_file($_FILES['signature']['tmp_name'], $signature_target);
  }

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
    sendResponse($conn, $id);
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}


if($_POST['formName']=='create_user'){


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


  $target_dir = "uploads/";
  $profile_picture_target = $target_dir . basename($profile_picture);
  $signature_target = $target_dir . basename($signature);
  move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture_target);
  move_uploaded_file($_FILES['signature']['tmp_name'], $signature_target);

  $sql = "INSERT INTO users (name, role, mobile, email, address, gender, dob, profile_picture, signature, password, approved)
          VALUES ('$name', '$role', '$mobile', '$email', '$address', '$gender', '$dob', '$profile_picture', '$signature', '$password', '$approved')";

  if ($conn->query($sql) === TRUE) {

    sendResponse($conn, $conn->insert_id);
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();

}

if($_POST['formName']=='delete_user'){


  $id = $_POST['id'];

  $sql = "DELETE FROM users WHERE id='$id'";

  if ($conn->query($sql) === TRUE) {
    sendResponse($conn, 0);
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();

}

}
?>
