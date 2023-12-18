<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== 1 || $_SESSION['role'] !== 'secretary') 
{
    header("Location: login.php");
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
        background: rgba(0, 0, 0, 0.5); /* Adjust the opacity here */
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

  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center"><i>Welcome Mess Secretary!</i></h2>
      </div>
    </div>
  </div>
  <hr>
  <div class="container">
      <div class="row mt-5">
      <div class="card text-center bg-dark col-md-3 mx-auto mb-5" style="width: 18rem;">
            <img src="food.jpg" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">View Menu</h5>
              <p class="card-text">Checkout the corrent mess menu</p>
                <a href="view_menu.php" class="btn btn-primary">>>></a>
              </div>
            </div>      
            <div class="card text-center bg-dark col-md-3 mx-auto mb-5" style="width: 18rem;">
            <img src="edit.png" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">Edit Menu</h5>
              <p class="card-text">Update the new menu with the additional changes made by the committee</p>
                <a href="edit_menu.php" class="btn btn-primary">>>></a>
              </div>
            </div>            
            <div class="card text-center bg-dark col-md-3 mx-auto mb-5" style="width: 18rem;">
            <img src="complaint.jpg" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">Complaints</h5>
              <p class="card-text">Review the complaints regarding the mess issues for the further improvements</p>
                <a href="resolution.php" class="btn btn-primary">>>></a>
              </div>
            </div>
            
      </div>
      <div class="row mt-5">
            <div class="card text-center bg-dark col-md-3 mx-auto mb-5" style="width: 18rem;">
            <img src="rating.jpg" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">Meal Ratings</h5>
              <p class="card-text">View the ratings of each items out of 5 rated by the students on weekly basis</p>
                <a href="view_ratings.php" class="btn btn-primary">>>></a>
              </div>
            </div>            
            <div class="card text-center bg-dark col-md-3 mx-auto mb-5" style="width: 18rem;">
            <img src="poll.png" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">Preference Polls</h5>
              <p class="card-text">Add / Remove polls to collect preferences of students for their meal</p>
                <a href="manage_poll.php" class="btn btn-primary">>>></a>
              </div>
            </div>
            <div class="card text-center bg-dark col-md-3 mx-auto mb-5" style="width: 18rem;">
            <img src="results.png" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">Poll Results</h5>
              <p class="card-text">Checkout the total count of veg./non-veg. preferences of students</p>
                <a href="results.php" class="btn btn-primary">>>></a>
              </div>
            </div>
      </div>
    </div>
</body>
</html>