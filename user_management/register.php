<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-10">
        <div class="card shadow-lg">
          <div class="card-header text-center bg-primary text-white">
            <h4>User Registration</h4>
          </div>
          <div class="card-body">
            <form id="registrationForm">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
              </div>
              <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter your mobile number">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address">
              </div>
              <div class="mb-3">
                <label class="form-label">Gender</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                  <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                  <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="other" value="Other">
                  <label class="form-check-label" for="other">Other</label>
                </div>
              </div>
              <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Register</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $("#registrationForm").on("submit", function(event) {
        event.preventDefault();

        // Validate form fields
        var isValid = true;
        $("#registrationForm input").each(function() {
          if ($(this).val() === "") {
            isValid = false;
            $(this).addClass("is-invalid");
          } else {
            $(this).removeClass("is-invalid");
          }
        });

        if ($("input[name='gender']:checked").length === 0) {
          isValid = false;
          $("input[name='gender']").addClass("is-invalid");
        } else {
          $("input[name='gender']").removeClass("is-invalid");
        }

        if (isValid) {
          var formData = {
            name: $("#name").val(),
            mobile: $("#mobile").val(),
            email: $("#email").val(),
            address: $("#address").val(),
            gender: $("input[name='gender']:checked").val(),
            dob: $("#dob").val(),
            password: $("#password").val()
          };

          $.ajax({
            url: "user_register.php",
            type: "POST",
            data: formData,
            success: function(response) {
              alert(response);
              $("#registrationForm")[0].reset();
            },
            error: function() {
              alert("Error occurred. Please try again.");
            }
          });
        }
      });
    });
  </script>
</body>
</html>
