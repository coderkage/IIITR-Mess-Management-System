<?php
session_start();
include("config.php");
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
}

// Fetch counts for each role
$roles = ['student', 'secretary', 'warden', 'caterer', 'admin'];
$roleCounts = [];

foreach ($roles as $role) {
    $countQuery = "SELECT COUNT(*) as count FROM users WHERE role = '$role'";
    $countResult = mysqli_query($conn, $countQuery);
    $countRow = mysqli_fetch_assoc($countResult);
    $roleCounts[$role] = $countRow['count'];
}

// Number of rows per page
$rowsPerPage = 25;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$selectedRole = isset($_GET['role']) ? $_GET['role'] : 'student';

$offset = ($page - 1) * $rowsPerPage;

$query = "SELECT user_id, username, name, role FROM users WHERE role = '$selectedRole' LIMIT $rowsPerPage OFFSET $offset";
$result = mysqli_query($conn, $query);

$countQuery = "SELECT COUNT(*) as count FROM users WHERE role = '$selectedRole'";
$countResult = mysqli_query($conn, $countQuery);
$countRow = mysqli_fetch_assoc($countResult);
$totalRows = $countRow['count'];
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>IIITR Mess</title>
</head>
<body>
<?php include("admin_nav.php"); ?>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center">List of Registered <?php echo ucfirst($selectedRole); ?></h2>
            <br>

            <!-- Role Selection Dropdown -->
            <div class="form-group">
                <label for="roleSelect">Select Role:</label>
                <select class="form-control" id="roleSelect" onchange="changeRole()">
                    <?php
                    foreach ($roles as $role) {
                        echo "<option value=\"$role\" " . ($selectedRole === $role ? 'selected' : '') . ">$role</option>";
                    }
                    ?>
                </select>
            </div>

            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">User ID</th>
                        <th scope="col" class="text-center">Username</th>
                        <th scope="col" class="text-center">Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td class='text-center'>" . $row['user_id'] . "</td>";
                        echo "<td class='text-center'>" . $row['username'] . "</td>";
                        echo "<td class='text-center'>" . $row['name'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination Links -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php
                    // Calculate the total number of pages
                    $totalPages = ceil($totalRows / $rowsPerPage);

                    // Display pagination links
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo "<li class='page-item " . ($i == $page ? 'active' : '') . "'>";
                        echo "<a class='page-link' href='?role=$selectedRole&page=$i'>$i</a>";
                        echo "</li>";
                    }
                    ?>
                </ul>
            </nav>
            <!-- Display role counts -->
            <div class="text-left">
                <?php
                foreach ($roleCounts as $role => $count) {
                    echo "<p>Total Number of $role : $count</p>";
                }
                ?>
            </div>
        </div>
        
    </div>
</div>

<!-- JavaScript to redirect when changing the role -->
<script>
    function changeRole() {
        var selectedRole = document.getElementById("roleSelect").value;
        window.location.href = "?role=" + selectedRole;
    }
</script>
</body>
</html>
