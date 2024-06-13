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
                        <button class='btn btn-primary btn-sm' onclick='openEditModal(" . json_encode($row) . ")'>Edit</button>
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
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" name="role" required>
                  </div>
                  <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" required>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                  </div>
                  <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender" required>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" required>
                  </div>
                  <div class="mb-3">
                    <label for="profile_picture" class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" id="profile_picture" name="profile_picture" required>
                  </div>
                  <div class="mb-3">
                    <label for="signature" class="form-label">Signature</label>
                    <input type="file" class="form-control" id="signature" name="signature" required>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                  <div class="mb-3">
                    <label for="approved" class="form-label">Approved</label>
                    <select class="form-select" id="approved" name="approved" required>
                      <option value="0">No</option>
                      <option value="1">Yes</option>
                    </select>
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
        <!-- Edit user modal -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form id="editUserForm">
                  <input type="hidden" id="edit-id" name="id">
                  <div class="mb-3">
                    <label for="edit-name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="edit-name" name="name" required>
                  </div>
                  <div class="mb-3">
                    <label for="edit-role" class="form-label">Role</label>
                    <input type="text" class="form-control" id="edit-role" name="role" required>
                  </div>
                  <div class="mb-3">
                    <label for="edit-mobile" class="form-label">Mobile</label>
                    <input type="text" class="form-control" id="edit-mobile" name="mobile" required>
                  </div>
                  <div class="mb-3">
                    <label for="edit-email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="edit-email" name="email" required>
                  </div>
                  <div class="mb-3">
                    <label for="edit-address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="edit-address" name="address" required>
                  </div>
                  <div class="mb-3">
                    <label for="edit-gender" class="form-label">Gender</label>
                    <select class="form-select" id="edit-gender" name="gender" required>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="edit-dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="edit-dob" name="dob" required>
                  </div>
                  <div class="mb-3">
                    <label for="edit-profile_picture" class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" id="edit-profile_picture" name="profile_picture">
                  </div>
                  <div class="mb-3">
                    <label for="edit-signature" class="form-label">Signature</label>
                    <input type="file" class="form-control" id="edit-signature" name="signature">
                  </div>
                  <div class="mb-3">
                    <label for="edit-password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="edit-password" name="password">
                  </div>
                  <div class="mb-3">
                    <label for="edit-approved" class="form-label">Approved</label>
                    <select class="form-select" id="edit-approved" name="approved" required>
                      <option value="0">No</option>
                      <option value="1">Yes</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <h4>Delete User</h4>
        <!-- Delete user functionality is handled by a confirmation dialog and AJAX -->
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function () {
      // Add User Form Submission
      $("#addUserForm").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('formName','create_user');
        $.ajax({
          type: "POST",
          url: "edit_user.php",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            $('#addUserModal').modal('hide');
            location.reload();
          },
          error: function (xhr, status, error) {
            alert('Error: ' + error);
          }
        });
      });

      // Edit User Form Submission
      $("#editUserForm").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('formName','edit_user');
        $.ajax({
          type: "POST",
          url: "edit_user.php",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            $('#editUserModal').modal('hide');
            location.reload();
          },
          error: function (xhr, status, error) {
            alert('Error: ' + error);
          }
        });
      });
    });

    function openEditModal(user) {
      $("#edit-id").val(user.id);
      $("#edit-name").val(user.name);
      $("#edit-role").val(user.role);
      $("#edit-mobile").val(user.mobile);
      $("#edit-email").val(user.email);
      $("#edit-address").val(user.address);
      $("#edit-gender").val(user.gender);
      $("#edit-dob").val(user.dob);
      $("#edit-approved").val(user.approved);
      $('#editUserModal').modal('show');
    }

    function deleteUser(userId) {
      if (confirm("Are you sure you want to delete this user?")) {
        $.ajax({
          type: "POST",
          url: "edit_user.php",
          data: { id: userId , formName : 'delete_user' },
          success: function (response) {
            location.reload();
          },
          error: function (xhr, status, error) {
            alert('Error: ' + error);
          }
        });
      }
    }
  </script>
</body>
</html>
