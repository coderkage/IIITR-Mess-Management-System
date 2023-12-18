<?php

session_start();
include("config.php");

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== 1 || $_SESSION['role'] !== 'admin') 
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
            background-image: url('admin.png');
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
<?php include("admin_nav.php"); ?>

<br>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center"><i>Welcome Admin!</i></h2>
      </div>
    </div>
  </div>
  <br>
  <div class="container">
      <div class="row mt-5">
            <div class="card text-center bg-dark col-md-3 mx-auto" style="width: 20rem;">
            <img src="users.jpg" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">View Users</h5>
              <p class="card-text">View the list of all the users (students, wardens, mess secretary, caterer and admin)</p>
                <a href="users.php" class="btn btn-primary">>>></a>
              </div>
            </div>
            <div class="card text-center bg-dark col-md-3 mx-auto" style="width: 20rem;">
            <img src="user1.png" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
              <h5 class="card-title">Manage Users</h5>
              <p class="card-text">Manage user accounts with the ability to add or delete users manually or in bulk</p>
                <a href="user1.php" class="btn btn-primary">>>></a>
              </div>
            </div>
      </div>
    </div>
    <br><br><br><br>

</body>
</html>