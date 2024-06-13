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

$sql = "SELECT name, mobile, email, address, gender, dob, profile_picture, signature FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $mobile, $email, $address, $gender, $dob, $profile_picture, $signature);
$stmt->fetch();
$stmt->close();

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-10">
        <div class="card shadow-lg">
          <div class="card-header text-center bg-primary text-white">
            <h4>Update Details</h4>
          </div>
          <div class="card-body">
            <form id="updateForm" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
              </div>
              <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>">
              </div>
              <div class="mb-3">
                <label class="form-label">Gender</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?php echo ($gender == 'Male') ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php echo ($gender == 'Female') ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="other" value="Other" <?php echo ($gender == 'Other') ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="other">Other</label>
                </div>
              </div>
              <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>">
              </div>
              <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                <?php if ($profile_picture): ?>
                  <img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" class="img-thumbnail mt-2" style="max-width: 150px;">
                <?php endif; ?>
              </div>
              <div class="mb-3">
                <label for="signature" class="form-label">Signature</label>
                <input type="file" class="form-control" id="signature" name="signature">
                <?php if ($signature): ?>
                  <img src="<?php echo htmlspecialchars($signature); ?>" alt="Signature" class="img-thumbnail mt-2" style="max-width: 150px;">
                <?php endif; ?>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $("#updateForm").on("submit", function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
          url: "update_details_user.php",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            alert(response);
          },
          error: function() {
            alert("Error occurred. Please try again.");
          }
        });
      });
    });
  </script>
</body>
</html>
