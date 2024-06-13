<?php
$servername = "localhost";
$username = "root";
$password = "";  
$dbname = "user_management"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $conn->real_escape_string($_POST['name']);
  $role = 'User'; 
  $mobile = $conn->real_escape_string($_POST['mobile']);
  $email = $conn->real_escape_string($_POST['email']);
  $address = $conn->real_escape_string($_POST['address']);
  $gender = $conn->real_escape_string($_POST['gender']);
  $dob = $conn->real_escape_string($_POST['dob']);
  $profile_picture = '';
  $signature = ''; 
  $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT); 
  $approved = 0;

  $checkEmailSql = "SELECT email FROM users WHERE email = ?";
  $stmt = $conn->prepare($checkEmailSql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows > 0) {
    echo "Email already exists";
    $stmt->close();
    exit();
  }
  $stmt->close();

  $sql = "INSERT INTO users (name, role, mobile, email, address, gender, dob, profile_picture, signature, password, approved) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssssssssi", $name, $role, $mobile, $email, $address, $gender, $dob, $profile_picture, $signature, $password, $approved);

  if ($stmt->execute()) {
    echo "Registration successful!";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $stmt->close();
}

$conn->close();
?>
