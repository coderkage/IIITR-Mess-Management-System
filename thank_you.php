<?php
session_start();
include("config.php");

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

<br>

<div class="container" style="margin-top: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center"><i>Your vote has been submitted successfully!</i></h2>
        </div>
    </div>
</div>

</body>
</html>

