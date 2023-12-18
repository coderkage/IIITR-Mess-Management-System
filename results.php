<?php
session_start();
include("config.php");

if ($_SESSION['role'] != 'secretary') {
    header("Location: login.php");
}

$all_polls_query = "SELECT poll_id, question FROM polls";
$all_polls_result = mysqli_query($conn, $all_polls_query);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>IIITR Mess</title>
    <style>
        body {
            background-image: url('cool.jpg');
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
        hr {
            border: 0;
            height: 2px;
            background: linear-gradient(to right, rgba(255,255,255,0), rgba(255,255,255,0.75), rgba(255,255,255,0));
            margin: 20px 0; /* Adjust the margin as needed */
        }
    </style>
    
  </head>
  <body>
  <?php  include("sec_nav.php"); ?>

<br>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center"><i>Preference Poll Results</i></h2>
      </div>
    </div>
  </div><hr>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12 mx-auto text-center">
    
    <?php
    while ($row = mysqli_fetch_assoc($all_polls_result)) {
        $poll_id = $row['poll_id'];
        $question = $row['question'];

        echo "<h3>Poll $poll_id : $question</h3><br>";

        $votes_table = "votes_" . $poll_id;
        $get_votes_query = "SELECT preference, COUNT(*) as total_votes FROM $votes_table GROUP BY preference";
        $votes_result = mysqli_query($conn, $get_votes_query);

        while ($vote_row = mysqli_fetch_assoc($votes_result)) {
            $preference = $vote_row['preference'];
            $total_votes = $vote_row['total_votes'];

            echo "<h5><p>$preference: $total_votes</p><h5>";
        }

        // Get the total number of votes for the current poll
        $total_votes_query = "SELECT COUNT(*) as total_votes FROM $votes_table";
        $total_votes_result = mysqli_query($conn, $total_votes_query);
        $total_votes_row = mysqli_fetch_assoc($total_votes_result);
        $total_votes = $total_votes_row['total_votes'];

        echo "<h5><p>Total Count: $total_votes</p><h5><br>";
    }
    ?>
        </div>
    </div>
</div>
    
</body>
</html>