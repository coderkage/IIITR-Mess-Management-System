<?php
session_start();
include("config.php");

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$user_query = "SELECT user_id, username, name, role FROM users";
$user_result = mysqli_query($conn, $user_query);
$student_query = "SELECT user_id, username, role FROM users WHERE role = 'student'";
$student_result = mysqli_query($conn, $student_query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["update_role"])) {
        $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
        $new_role = mysqli_real_escape_string($conn, $_POST["new_role"]);

        $update_query = "UPDATE users SET role = '$new_role' WHERE user_id = '$user_id'";
        if (mysqli_query($conn, $update_query)) {
            echo '<script>alert("User role updated successfully.");</script>';
            header("Location: user1.php");
        } else {
            echo '<script>alert("Error updating user role.");</script>';
            header("Location: user1.php");
        }
    } elseif (isset($_POST["delete_user"])) {
        $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);

        $delete_query = "DELETE FROM users WHERE user_id = '$user_id'";
        if (mysqli_query($conn, $delete_query)) {
            echo '<script>alert("User deleted successfully.");</script>';
            header("Location: user1.php");
        } else {
            echo '<script>alert("Error deleting user.");</script>';
            header("Location: user1.php");
        }
    } elseif (isset($_POST["delete_selected"])) {
        if (isset($_POST["selected_users"]) && is_array($_POST["selected_users"])) {
            $selected_users = implode("','", $_POST["selected_users"]);

            $delete_query = "DELETE FROM users WHERE user_id IN ('$selected_users')";
            if (mysqli_query($conn, $delete_query)) {
                echo '<script>alert("Selected users deleted successfully.");</script>';
                header("Location: user1.php");
            } else {
                echo '<script>alert("Error deleting selected users.");</script>';
                header("Location: user1.php");
            }
        }
    } elseif (isset($_POST["add_user"])) {
        $new_username = mysqli_real_escape_string($conn, $_POST["new_username"]);
        $new_password = mysqli_real_escape_string($conn, $_POST["new_password"]);
        $new_role = mysqli_real_escape_string($conn, $_POST["new_role"]);
        $new_name = mysqli_real_escape_string($conn, $_POST["new_name"]);

        $insert_query = "INSERT INTO users (username, name, password, role) VALUES ('$new_username', '$new_name', '$new_password', '$new_role')";
        if (mysqli_query($conn, $insert_query)) {
            echo '<script>alert("User added successfully.");</script>';
            header("Location: user1.php");
        } else {
            echo '<script>alert("Error adding user.");</script>';
            header("Location: user1.php");
        }
    } elseif (isset($_POST["bulk_add_users"])) {
        if (isset($_FILES["bulk_users_file"]) && $_FILES["bulk_users_file"]["error"] == UPLOAD_ERR_OK) {
            $file_tmp = $_FILES["bulk_users_file"]["tmp_name"];

            $csv_data = array_map('str_getcsv', file($file_tmp));
            
            foreach ($csv_data as $user) {
                $new_username = mysqli_real_escape_string($conn, $user[0]);
                $new_name = mysqli_real_escape_string($conn, $user[1]);
                $new_password = mysqli_real_escape_string($conn, $user[2]);
                $new_role = mysqli_real_escape_string($conn, $user[3]);

                $insert_query = "INSERT INTO users (username, name, password, role) VALUES ('$new_username', '$new_name', '$new_password', '$new_role')";
                if (mysqli_query($conn, $insert_query)) {
                    // echo '<script>alert("Bulk users added successfully.");</script>';
                    header("Location: user1.php");
                } else {
                    echo '<script>alert("Error adding bulk users.");</script>';
                    header("Location: user1.php");
                }
            }
        } else {
            echo '<script>alert("Error uploading file.");</script>';
            header("Location: user1.php");
        }
    }
}
?>

<!DOCTYPE html>
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
    <!-- Add your HTML for the user list page here -->

    <?php include("admin_nav.php"); ?>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <h2 class="text-center">Add New User</h2>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="new_username">Username:</label>
                        <input type="text" class="form-control" name="new_username" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password:</label>
                        <input type="password" class="form-control" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_role">Role:</label>
                        <select name="new_role" class="form-control">
                            <option value='student'>Student</option>
                            <option value='secretary'>Mess Secretary</option>
                            <option value='warden'>Chief Warden</option>
                            <option value='caterer'>Caterer</option>
                            <option value='admin'>Admin</option>
                        </select>
                    </div>
                    <button type="submit" name="add_user" class="btn btn-success">Add User</button>
                </form>
                <h2 class="text-center">Add Multiple Users</h2>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="bulk_users_file">Upload CSV File:</label>
                        <input type="file" class="form-control-file" name="bulk_users_file" accept=".csv" required>
                    </div>
                    <button type="submit" name="bulk_add_users" class="btn btn-success">Add Users</button>
                </form>
                <br>
                <h2 class="text-center">Edit Registered Users</h2>
                <br>
                <form method="post" action="">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Select</th>
                                <th scope="col" class="text-center">User ID</th>
                                <th scope="col" class="text-center">Username</th>
                                <th scope="col" class="text-center">Role</th>
                                <th scope="col" class="text-center">Update Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($user_result)) {
                                echo "<tr>";
                                echo "<td class='text-center'><input type='checkbox' name='selected_users[]' value='" . $row['user_id'] . "'></td>";
                                echo "<td class='text-center'>" . $row['user_id'] . "</td>";
                                echo "<td class='text-center'>" . $row['username'] . "</td>";
                                echo "<td class='text-center'>" . $row['role'] . "</td>";
                                echo "<td class='text-center'>";
                                echo "<form method='post' action=''>";
                                echo "<input type='hidden' name='user_id' value='" . $row['user_id'] . "'>";
                                echo "<select name='new_role' class='form-control'>";
                                echo "<option value='student'>Student</option>";
                                echo "<option value='secretary'>Mess Secretary</option>";
                                echo "<option value='warden'>Chief Warden</option>";
                                echo "<option value='caterer'>Caterer</option>";
                                echo "<option value='admin'>Admin</option>";
                                echo "</select>";
                                echo "<button type='submit' name='update_role' class='btn btn-primary btn-sm'>Update Role</button>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button type="submit" name="delete_selected" class="btn btn-danger">Delete Selected</button>
                    </div>
                </form>
                <br>
                <!-- Add form for adding new user -->
            </div>
        </div>
    </div>
    <script>
        function changeRole() {
            var selectedRole = document.getElementById("roleSelect").value;
            window.location.href = "?role=" + selectedRole;
        }
    </script>
    

</body>
</html>
