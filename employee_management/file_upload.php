<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $file = $_FILES['file'];

    $fileName = basename($file['name']);
    $targetDir = "uploads/";
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        $sql = "INSERT INTO identity_files (employee_id, file_name, file_path) VALUES ('$employee_id', '$fileName', '$targetFile')";
        if ($conn->query($sql) === TRUE) {
            echo "File uploaded successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file";
    }
}

$employees = $conn->query("SELECT id, name FROM employees");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">File Management System</h2>
        <form id="fileUploadForm" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="employee_id" class="form-label">Select Employee</label>
                <select class="form-select" id="employee_id" name="employee_id" required>
                    <?php
                    while ($employee = $employees->fetch_assoc()) {
                        echo "<option value='{$employee['id']}'>{$employee['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Identity File</label>
                <input type="file" class="form-control" id="file" name="file" required>
                <img id="preview" src="#" alt="File Preview" style="display: none; max-width: 200px; max-height: 200px; margin-top: 10px;" />
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
        <h3 class="mt-5">Uploaded Files</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>File Name</th>
                    <th>Upload Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $files = $conn->query("SELECT * FROM identity_files");
                while ($file = $files->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$file['employee_id']}</td>";
                    echo "<td>{$file['file_name']}</td>";
                    echo "<td>{$file['upload_date']}</td>";
                    echo "<td><a href='{$file['file_path']}' target='_blank'>View</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        document.getElementById("file").onchange = function (event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById("preview");
                preview.style.display = "block";
                preview.src = URL.createObjectURL(file);
            }
        };
    </script>
</body>
</html>
