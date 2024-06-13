<?php
include 'db_connection.php';

$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$perPage = 10;
$total = $conn->query("SELECT COUNT(*) FROM employees WHERE name LIKE '%$search%'")->fetch_row()[0];
$pages = ceil($total / $perPage);

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

$start = ($page - 1) * $perPage;

$sql = "SELECT * FROM employees WHERE name LIKE '%$search%' LIMIT $start, $perPage";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Employee Management</h2>
        <form class="mb-4" method="get" action="">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by name" name="search" value="<?php echo $search; ?>">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Date of Birth</th>
                    <th>Date of Joining</th>
                    <th>Blood Group</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['designation'] . "</td>";
                        echo "<td>" . $row['dob'] . "</td>";
                        echo "<td>" . $row['doj'] . "</td>";
                        echo "<td>" . $row['blood_group'] . "</td>";
                        echo "<td>" . $row['mobile'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No employees found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <nav>
            <ul class="pagination">
                <?php
                for ($i = 1; $i <= $pages; $i++) {
                    echo "<li class='page-item'><a class='page-link' href='?page=$i&search=$search'>$i</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>
</body>
</html>
