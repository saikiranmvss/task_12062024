<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize input
  $name = $conn->real_escape_string($_POST['name']);
  $role = 'User'; // Default role, can be adjusted as needed
  $mobile = $conn->real_escape_string($_POST['mobile']);
  $email = $conn->real_escape_string($_POST['email']);
  $address = $conn->real_escape_string($_POST['address']);
  $gender = $conn->real_escape_string($_POST['gender']);
  $dob = $conn->real_escape_string($_POST['dob']);
  $profile_picture = ''; // Handle file upload if needed
  $signature = ''; // Handle file upload if needed
  $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT); // Encrypt password
  $approved = 0; // Default to not approved

  // Check for existing email
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
