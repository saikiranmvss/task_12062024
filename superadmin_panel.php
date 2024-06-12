<?php
session_start();

// Check if super admin is logged in, if not redirect to login page
if (!isset($_SESSION['superadmin_id'])) {
  header("Location: superadmin_login.html");
  exit();
}

// Include database connection
include 'db_connection.php';

// Fetch all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Super Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Super Admin Dashboard</h2>
    <div class="row mb-4">
      <div class="col-md-12">
        <h4>All Users</h4>
        <!-- Display all users table -->
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>
                        <a href='edit_user.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a>
                        <button class='btn btn-danger btn-sm' onclick='deleteUser(" . $row['id'] . ")'>Delete</button>
                      </td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='4'>No users found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <h4>Add User</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
        <!-- Add user modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form id="addUserForm">
                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Save</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <h4>Edit User</h4>
        <!-- Edit user form -->
      </div>
      <div class="col-md-4">
        <h4>Delete User</h4>
        <!-- Delete user form -->
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
      // Add User Form Submission
      $("#addUserForm").submit(function (e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "add_user.php",
          data: $(this).serialize(),
          success: function (response) {
            $('#addUserModal').modal('hide');
            location.reload();
          }
        });
      });
    });

    function deleteUser(userId) {
      if (confirm("Are you sure you want to delete this user?")) {
        $.ajax({
          type: "POST",
          url: "delete_user.php",
          data: { id: userId },
          success: function (response) {
            location.reload();
          }
        });
      }
    }
  </script>
</body>
</html>
