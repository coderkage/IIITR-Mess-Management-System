<?php
require_once('tcpdf/tcpdf.php');
session_start();
include("config.php");

if ($_SESSION['role'] != 'student') {
    header("Location: login.php");
}

$student_id = $_SESSION['user_id'];
$student_name = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit_join_date'])) {
        $joining_date = $_POST['joining_date'];
        $insert_billing_query = "INSERT INTO billings (student_id, student_name, joining_date) VALUES ('$student_id', '$student_name', '$joining_date')";
        mysqli_query($conn, $insert_billing_query);
    }

    if (isset($_POST['submit_leave_date'])) {
        $leaving_date = $_POST['leaving_date'];

        // Calculate total days and total amount
        
        
        $update_billing_query = "UPDATE billings SET leaving_date='$leaving_date' WHERE student_id='$student_id' AND leaving_date IS NULL";
        mysqli_query($conn, $update_billing_query);
        $count_days_query = "UPDATE billings SET total_days = DATEDIFF(leaving_date, joining_date), total_amount = DATEDIFF(leaving_date, joining_date) * 150
        WHERE student_id='$student_id'";
        mysqli_query($conn, $count_days_query);

        $fetch_billing_query = "SELECT joining_date, total_days, total_amount FROM billings WHERE student_id='$student_id' AND leaving_date='$leaving_date'";
        $result = mysqli_query($conn, $fetch_billing_query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $joining_date = $row['joining_date'];
            $total_days = $row['total_days'];
            $total_amount = $row['total_amount'];
        }
    }

    header("Location: student_welcome.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Student Billing</title>
    <style>
        body {
            background-image: url('background.jpg');
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
            background: rgba(0, 0, 0, 0.5);
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

<?php  include("student_nav.php"); ?>

<div class="container" style="margin-top: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center">Leave/Join Information</h2>
            <?php
            $check_open_entry_query = "SELECT * FROM billings WHERE student_id='$student_id' AND leaving_date IS NULL";
            $open_entry_result = mysqli_query($conn, $check_open_entry_query);

            if (mysqli_num_rows($open_entry_result) > 0) {
                echo '
                <form method="post" action="">
                    <div class="form-group">
                        <label for="leaving_date">Leaving Date:</label>
                        <input type="date" class="form-control" id="leaving_date" name="leaving_date" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit_leave_date">Submit Leave Date</button>
                </form>
                ';
            } else {
                echo '
                <form method="post" action="">
                    <div class="form-group">
                        <label for="joining_date">Joining Date:</label>
                        <input type="date" class="form-control" id="joining_date" name="joining_date" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit_join_date">Submit Join Date</button>
                </form>
                ';
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
