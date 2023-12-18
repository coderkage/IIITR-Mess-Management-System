<?php
session_start();
include("config.php");
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== 1 || $_SESSION['role'] !== 'student') 
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
        hr {
            border: 0;
            height: 2px;
            background: linear-gradient(to right, rgba(255,255,255,0), rgba(255,255,255,0.75), rgba(255,255,255,0));
            margin: 20px 0; /* Adjust the margin as needed */
        }
    </style>
  </head>
  <body>
<?php  include("student_nav.php"); ?>
<br>

  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center"><i>Welcome Student!</i></h2>
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
              <p class="card-text">Checkout the current mess menu</p>
                <a href="view_menu.php" class="btn btn-primary">>>></a>
              </div>
            </div>      
            <div class="card text-center bg-dark col-md-3 mx-auto mb-5" style="width: 18rem;">
            <img src="poll.png" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">Meal Preference</h5>
              <p class="card-text">Submit your meal preference corresponding to the poll</p>
                <a href="vote.php" class="btn btn-primary">>>></a>
              </div>
            </div>            
            <div class="card text-center bg-dark col-md-3 mx-auto mb-5" style="width: 18rem;">
            <img src="rating.jpg" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">Rate Meal</h5>
              <p class="card-text">Rate today's items of breakfast, lunch, snacks and dinner</p>
                <a href="rate_user.php" class="btn btn-primary">>>></a>
              </div>
            </div>            
      </div>
      <div class="row mt-5">
            <div class="card text-center bg-dark col-md-3 mx-auto mb-5" style="width: 18rem;">
            <img src="complaint.jpg" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">File Complaint</h5>
              <p class="card-text">Facing any issue regarding mess? Don't hesitate, let us know..</p>
                <a href="complain.php" class="btn btn-primary">>>></a>
              </div>
            </div>            
            <div class="card text-center bg-dark col-md-3 mx-auto mb-5" style="width: 18rem;">
            <img src="leave.jpg" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">Leave Update</h5>
              <p class="card-text">Update your joining / leaving date of the hostel</p>
                <a href="leave_join.php" class="btn btn-primary">>>></a>
              </div>
            </div>
            <div class="card text-center bg-dark col-md-3 mx-auto mb-5" style="width: 18rem;">
            <img src="billing.png" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">Billings</h5>
              <p class="card-text">Checkout the total mess fees for each period of staying in hostel</p>
                <a href="billings.php" class="btn btn-primary">>>></a>
              </div>
            </div>
      </div>
    </div>
    
</body>
</html>