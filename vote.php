<?php
session_start();
include("config.php");

if ($_SESSION['role'] != 'student') {
    // Redirect unauthorized users
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];

// Retrieve the list of all available polls from the database
$all_polls_query = "SELECT poll_id, question FROM polls";
$all_polls_result = mysqli_query($conn, $all_polls_query);

if (isset($_POST['vote'])) {
    $poll_id = $_POST['poll_id'];
    $preference = $_POST['preference'];

    // Check if the user has already voted in the selected poll
    $votes_table = "votes_" . $poll_id; // Adjust the table name based on your naming convention
    $check_vote_query = "SELECT * FROM $votes_table";
    $result = mysqli_query($conn, $check_vote_query);

    if (mysqli_num_rows($result) === 0) {
        // Insert the vote into the votes table
        $insert_vote_query = "INSERT INTO $votes_table (preference) VALUES ('$preference')";
        mysqli_query($conn, $insert_vote_query);
        // Redirect to a thank you page
        header("Location: thank_you.php");
    } else {
        // User has already voted in this poll, redirect to a thank you page or display a message
        header("Location: thank_you1.php");
    }
}
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

        h2 {
            font-size: 3rem;
        }
    </style>
</head>
<body>
<?php include("student_nav.php"); ?>

<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center"><i>Meal Preference</i></h2>
        </div>
    </div>
</div>
<br><br>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-3 mx-auto text-center">
            <form method="post" action="">

                <h3>Select Poll:</h3>
                <select name="poll_id">
                    <?php
                    while ($row = mysqli_fetch_assoc($all_polls_result)) {
                        echo "<option value=\"{$row['poll_id']}\">{$row['question']}</option>";
                    }
                    ?>
                </select>
                <br><br>
                <h3>Vote:</h3>
                <input type="radio" name="preference" value="veg"> Veg <br>
                <input type="radio" name="preference" value="non-veg"> Non-Veg <br>
                <input type="submit" name="vote" value="Vote">
            </form>
        </div>
    </div>
</div>

</body>
</html>
