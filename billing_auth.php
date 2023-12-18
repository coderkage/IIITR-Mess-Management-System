<?php
session_start();
include("config.php");

if ($_SESSION['role'] != 'warden' && $_SESSION['role'] != 'secretary' && $_SESSION['role'] != 'caterer') {
    header("Location: login.php");
}

$usernames_query = "SELECT user_id, username FROM users";
$usernames_result = mysqli_query($conn, $usernames_query);

$selected_user_id = isset($_GET['user_id']) ? $_GET['user_id'] : $_SESSION['user_id'];

// Retrieve billing data for the selected user
$billing_query = "SELECT * FROM billings WHERE student_id='$selected_user_id'";
$billing_result = mysqli_query($conn, $billing_query);
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
    <style>
        body {
            background-image: url('mess.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Adjust the opacity here */
            z-index: -1;
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            font-size: 3rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="student_welcome.php">IIITR Mess</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <!-- Add your other navigation links here -->
            <li class="nav-item active">
                <a class="nav-link" href="billings.php">Billing</a>
            </li>
        </ul>
        <!-- Dropdown for selecting a user -->
        
        <!-- Add your other navigation links here -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<br>

<!-- Display billing information for the selected user -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mx-auto text-center">
        <form class="form-inline ml-auto" method="get" action="">
            <div class="form-group">
                <label for="userSelect" class="mr-2">Select User:</label>
                <select class="form-control" id="userSelect" name="user_id" onchange="this.form.submit()">
                    <?php
                    while ($user_row = mysqli_fetch_assoc($usernames_result)) {
                        echo "<option value=\"{$user_row['user_id']}\" " . ($selected_user_id == $user_row['user_id'] ? 'selected' : '') . ">{$user_row['username']}</option>";
                    }
                    ?>
                </select>
            </div>
        </form>
<br> <br>
            <table class="table table-bordered table-striped table-light">
                <thead>
                    <tr>
                        <th scope="col">Join Date</th>
                        <th scope="col">Leave Date</th>
                        <th scope="col">Total Days</th>
                        <th scope="col">Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($billing_result)) {
                    echo "<tr>";
                    echo "<td>" . $row['joining_date'] . "</td>";
                    echo "<td>" . $row['leaving_date'] . "</td>";
                    echo "<td>" . $row['total_days'] . "</td>";
                    echo "<td>" . $row['total_amount'] . "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
