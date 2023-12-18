<?php
session_start();
include("config.php");

if ($_SESSION['role'] != 'secretary') {
    // Redirect unauthorized users
    header("Location: login.php");
}

if (isset($_POST['create_poll'])) {
    if (isset($_POST['question'])) {
        $question = $_POST['question'];

        $query = "INSERT INTO polls (question) VALUES ('$question')";
        mysqli_query($conn, $query);

        $poll_id = mysqli_insert_id($conn);

// Ensure a valid table name by replacing spaces with underscores
$cleaned_question = str_replace(' ', '_', $question);
$table_name = "votes_" . $poll_id ;

$create_table_query = "CREATE TABLE $table_name (
    vote_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    preference VARCHAR(10)
)";
mysqli_query($conn, $create_table_query);
    } else {
        
    }
}

if (isset($_POST['delete_poll'])) {
    if (isset($_POST['poll_id'])) {
        $poll_id = $_POST['poll_id'];

        // Code to delete the poll and the corresponding votes table
        $delete_query = "DELETE FROM polls WHERE poll_id='$poll_id'";
        mysqli_query($conn, $delete_query);

        $table_name = "votes_" . $poll_id;
        $drop_table_query = "DROP TABLE IF EXISTS $table_name";
        mysqli_query($conn, $drop_table_query);
    }
}
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
            <h2 class="text-center">Manage Polls</h2>
      </div>
    </div>
  </div>
  <hr>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12 mx-auto text-center">
            
        <form method="post" action="">
            <input type="text" name="question" placeholder="Enter the poll question">
            <input type="submit" name="create_poll" value="Create Poll">
         <br>   <br> <br> <h4 class="text-center">or</h4><br> <br>
            <select name="poll_id">
                <?php
                $poll_query = "SELECT poll_id, question FROM polls";
                $poll_result = mysqli_query($conn, $poll_query);
                while ($row = mysqli_fetch_assoc($poll_result)) {
                    echo "<option value=\"{$row['poll_id']}\">{$row['question']}</option>";
                }
                ?>
            </select>
            <input type="submit" name="delete_poll" value="Delete Poll">
        </form>
            </form>
        </div>
    </div>
</div>
    
</body>
</html>
