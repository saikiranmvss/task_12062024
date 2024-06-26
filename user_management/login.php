<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";  
$dbname = "user_management";  

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $conn->real_escape_string($_POST['email']);
  $password = $conn->real_escape_string($_POST['password']);

  $sql = "SELECT id, name, password , approved FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $name, $hashed_password , $approval);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
      $_SESSION['user_id'] = $id;
      $_SESSION['user_name'] = $name;
      if($approval==0){
        echo 3;
      }else{
        echo 0;
      }      
    } else {
      echo 1;
    }
  } else {
    echo 2;
  }

  $stmt->close();
}

$conn->close();
?>
