<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== 1 || $_SESSION['role'] !== 'caterer') 
{
    header("Location: login.php");
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
            background-image: url('food.jpg');
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
<?php 
include("caterer_nav.php"); ?>
<br>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center"><i>Welcome Caterer!</i></h2>
      </div>
    </div>
  </div>
  <br><br>
    <div class="container">
      <div class="row mt-5">
            <div class="card text-center bg-dark col-md-3 mx-auto mb-5" style="width: 18rem;">
            <img src="vegnonveg.png" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">Meal Preference</h5>
              <p class="card-text">View the list of veg. / non-veg. preference count of students for the dinner</p>
                <a href="results_cat.php" class="btn btn-primary">>>></a>
              </div>
            </div>
            <div class="card text-center bg-dark col-md-3 mx-auto mb-5" style="width: 18rem;">
            <img src="rating.jpg" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">Meal Ratings</h5>
              <p class="card-text">View the ratings of each items out of 5 rated by the students on weekly basis</p>
                <a href="view_ratings.php" class="btn btn-primary">>>></a>
              </div>
            </div>            
            <div class="card text-center bg-dark col-md-3 mx-auto mb-5" style="width: 18rem;">
            <img src="complaint.jpg" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">Complaints</h5>
              <p class="card-text">Review the complaints regarding the mess issues for the further improvements</p>
                <a href="caterer_complaint.php" class="btn btn-primary">>>></a>
              </div>
            </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-5">
            <div class="card text-center bg-dark col-md-3 mx-auto" style="width: 18rem;">
            <img src="billing.png" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">Billing</h5>
              <p class="card-text">Check the billing list of each student on the basis of their stay in hostel</p>
                <a href="billing_auth.php" class="btn btn-primary">>>></a>
              </div>
            </div>
            <div class="card text-center bg-dark col-md-3 mx-auto" style="width: 18rem;">
            <img src="food.jpg" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">View Menu</h5>
              <p class="card-text"></p>
                <a href="view_menu.php" class="btn btn-primary">>>></a>
              </div>
            </div>            
      </div>
    </div>
<br><br>
</body>
</html>